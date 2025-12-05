<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\DashboardController;

// --- PUBLIC PAGES ---
Route::get('/', function () {
    return view('welcome'); 
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// --- AUTHENTICATION ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- PUBLIC JOB LISTINGS ---
Route::get('/jobs', [JobPostController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{job}', [JobPostController::class, 'show'])->name('jobs.show');

// --- PROTECTED ROUTES (Logged in Users) ---
Route::middleware(['auth'])->group(function () {
    
    // 1. Dashboard & Employer Tools
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/employer/jobs', [DashboardController::class, 'myJobs'])->name('dashboard.my_jobs');
    Route::get('/dashboard/employer/applications', [DashboardController::class, 'applications'])->name('dashboard.applications');

    // 2. Job Management (Create, Edit, Delete)
    Route::get('/jobs/create/new', [JobPostController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobPostController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{job}/edit', [JobPostController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{job}', [JobPostController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{job}', [JobPostController::class, 'destroy'])->name('jobs.destroy');

    // 3. Application Management
    Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])->name('applications.store');
    // For Job Seekers to view their history
    Route::get('/my-applications', [ApplicationController::class, 'index'])->name('applications.index');
    
    // For Employers to Accept/Reject
    Route::patch('/applications/{application}/status', [ApplicationController::class, 'updateStatus'])->name('applications.updateStatus');
});