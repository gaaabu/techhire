@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-3 sidebar p-3">
            <h5><i class="fas fa-tachometer-alt"></i> Admin Dashboard</h5>
            <hr>
            <nav class="nav flex-column">
                <a class="nav-link active" href="#"><i class="fas fa-chart-line"></i> Overview</a>
                <a class="nav-link" href="#"><i class="fas fa-briefcase"></i> Manage Jobs</a>
                <a class="nav-link" href="#"><i class="fas fa-users"></i> Manage Users</a>
                <a class="nav-link" href="#"><i class="fas fa-file-alt"></i> Applications</a>
            </nav>
        </div>
        
        <div class="col-lg-9">
            <h2>Platform Overview</h2>
            
            <div class="row mb-4">
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>{{ $stats['total_jobs'] }}</h4>
                                    <small>Total Jobs</small>
                                </div>
                                <i class="fas fa-briefcase fa-2x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>{{ $stats['active_jobs'] }}</h4>
                                    <small>Active Jobs</small>
                                </div>
                                <i class="fas fa-check-circle fa-2x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>{{ $stats['total_applications'] }}</h4>
                                    <small>Applications</small>
                                </div>
                                <i class="fas fa-file-alt fa-2x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>{{ $stats['total_users'] }}</h4>
                                    <small>Total Users</small>
                                </div>
                                <i class="fas fa-users fa-2x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h5>User Distribution</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Employers:</strong> {{ $stats['employers'] }}</p>
                            <p><strong>Job Seekers:</strong> {{ $stats['job_seekers'] }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Recent Job Posts</h5>
                        </div>
                        <div class="card-body">
                            @foreach($recent_jobs as $job)
                                <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                    <div>
                                        <h6 class="mb-0">{{ $job->title }}</h6>
                                        <small class="text-muted">by {{ $job->employer->name }}</small>
                                    </div>
                                    <small class="text-muted">{{ $job->created_at->diffForHumans() }}</small>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection