<?php
namespace App\Http\Controllers;

use App\Models\JobPost;
use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            return $this->adminDashboard();
        } elseif ($user->isEmployer()) {
            return $this->employerDashboard();
        } else {
            return $this->jobSeekerDashboard();
        }
    }

    // --- NEW FUNCTIONS FOR EMPLOYER BUTTONS ---

    public function myJobs()
    {
        $user = Auth::user();
        // Fetch jobs posted by this employer with application counts
        $jobs = $user->jobPosts()->withCount('applications')->latest()->paginate(10);
        
        return view('dashboard.my_jobs', compact('jobs'));
    }

    public function applications()
    {
        $user = Auth::user();
        // Fetch applications for jobs posted by this employer
        $applications = Application::whereHas('jobPost', function($q) use ($user) {
            $q->where('employer_id', $user->id);
        })->with(['jobPost', 'jobSeeker'])->latest()->paginate(10);

        return view('dashboard.applications', compact('applications'));
    }

    // --- EXISTING DASHBOARD LOGIC ---

    private function adminDashboard()
    {
        $stats = [
            'total_jobs' => JobPost::count(),
            'active_jobs' => JobPost::active()->count(),
            'total_applications' => Application::count(),
            'total_users' => User::count(),
            'employers' => User::where('role', 'employer')->count(),
            'job_seekers' => User::where('role', 'job_seeker')->count(),
        ];

        $recent_jobs = JobPost::with('employer')->latest()->take(5)->get();
        
        return view('dashboard.admin', compact('stats', 'recent_jobs'));
    }

    private function employerDashboard()
    {
        $user = Auth::user();
        $stats = [
            'total_jobs' => $user->jobPosts()->count(),
            'active_jobs' => $user->jobPosts()->active()->count(),
            'total_applications' => Application::whereHas('jobPost', function($q) use ($user) {
                $q->where('employer_id', $user->id);
            })->count(),
        ];

        $recent_jobs = $user->jobPosts()->latest()->take(5)->get();
        
        return view('dashboard.employer', compact('stats', 'recent_jobs'));
    }

    private function jobSeekerDashboard()
    {
        $user = Auth::user();
        $stats = [
            'applications_sent' => $user->applications()->count(),
            'pending_applications' => $user->applications()->where('status', 'pending')->count(),
        ];

        $recent_applications = $user->applications()->with('jobPost')->latest()->take(5)->get();
        $recommended_jobs = JobPost::active()->latest()->take(5)->get();
        
        return view('dashboard.job_seeker', compact('stats', 'recent_applications', 'recommended_jobs'));
    }
}