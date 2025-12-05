<?php
namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function store(Request $request, JobPost $job)
    {
        $request->validate([
            'cover_letter' => 'required|string',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048', 
            'portfolio_links' => 'nullable|url',
        ]);

        // Check if user already applied
        $existingApplication = Application::where('job_post_id', $job->id)
            ->where('job_seeker_id', Auth::id())
            ->first();

        if ($existingApplication) {
            return back()->with('error', 'You have already applied for this job.');
        }

        // Handle File Upload
        $resumePath = null;
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
        }

        Application::create([
            'job_post_id' => $job->id,
            'job_seeker_id' => Auth::id(),
            'cover_letter' => $request->cover_letter,
            'resume_path' => $resumePath,
            'portfolio_links' => $request->portfolio_links,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Application submitted successfully!');
    }

    public function index()
    {
        // For Job Seekers to see their own applications
        $applications = Auth::user()->applications()->with('jobPost.employer')->latest()->paginate(10);
        return view('applications.index', compact('applications'));
    }

    public function updateStatus(Request $request, Application $application)
    {
        // Security Check: Ensure the logged-in user is the employer who posted this job
        if (Auth::id() !== $application->jobPost->employer_id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);

        $application->update([
            'status' => $request->status
        ]);

        $statusMessage = $request->status === 'accepted' ? 'Application accepted!' : 'Application rejected.';
        
        return back()->with('success', $statusMessage);
    }
}