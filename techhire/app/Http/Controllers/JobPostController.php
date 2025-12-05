<?php
namespace App\Http\Controllers;

use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobPostController extends Controller
{
    public function index(Request $request)
{
    $query = JobPost::active()->with('employer');
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('title', 'like', '%' . $search . '%')
              ->orWhere('description', 'like', '%' . $search . '%')
              ->orWhere('tech_stack', 'like', '%' . $search . '%'); 
        });
    }

    if ($request->filled('job_type')) {
        $query->where('job_type', $request->job_type);
    }


    if ($request->filled('experience_level')) {
        $query->where('experience_level', $request->experience_level);
    }

    $jobs = $query->latest()->paginate(10)->withQueryString();
    
    return view('jobs.index', compact('jobs'));
}

    public function show(JobPost $job)
    {
        $job->load('employer', 'applications');
        return view('jobs.show', compact('job'));
    }

    public function create()
    {
        // Authorization removed - handled by route middleware
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        // Authorization removed - handled by route middleware
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'location' => 'required|string',
            'job_type' => 'required|in:full_time,part_time,contract,remote',
            'salary_range' => 'nullable|string',
            'tech_stack' => 'required|array',
            'experience_level' => 'required|in:entry,mid,senior',
        ]);

        JobPost::create([
            'title' => $request->title,
            'description' => $request->description,
            'requirements' => $request->requirements,
            'location' => $request->location,
            'job_type' => $request->job_type,
            'salary_range' => $request->salary_range,
            'tech_stack' => $request->tech_stack,
            'experience_level' => $request->experience_level,
            'employer_id' => Auth::id(),
            'status' => 'active',
        ]);

        return redirect()->route('jobs.index')->with('success', 'Job posted successfully!');
    }

    public function edit(JobPost $job)
    {
        // Check if the current user is the owner of this job
        if ($job->employer_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, JobPost $job)
    {
        // Check if the current user is the owner of this job
        if ($job->employer_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'location' => 'required|string',
            'job_type' => 'required|in:full_time,part_time,contract,remote',
            'salary_range' => 'nullable|string',
            'tech_stack' => 'required|array',
            'experience_level' => 'required|in:entry,mid,senior',
        ]);

        $job->update($request->all());

        return redirect()->route('jobs.show', $job)->with('success', 'Job updated successfully!');
    }

    public function destroy(JobPost $job)
    {
        // Check if the current user is the owner of this job
        if ($job->employer_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully!');
    }
}