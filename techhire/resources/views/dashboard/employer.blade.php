@extends('layouts.app')

@section('title', 'Employer Dashboard')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-3 sidebar p-3">
            <h5><i class="fas fa-building"></i> Employer Dashboard</h5>
            <hr>
            <nav class="nav flex-column">
                <a class="nav-link active" href="#"><i class="fas fa-chart-line"></i> Overview</a>
                <a class="nav-link" href="{{ route('jobs.create') }}"><i class="fas fa-plus"></i> Post New Job</a>
                <a class="nav-link" href="{{ route('dashboard.applications') }}"><i class="fas fa-briefcase"></i> My Jobs</a>
                <a class="nav-link" href="{{ route('dashboard.my_jobs') }}"><i class="fas fa-file-alt"></i> Applications</a>
            </nav>
        </div>
        
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Welcome back, {{ auth()->user()->name }}!</h2>
                <a href="{{ route('jobs.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Post New Job
                </a>
            </div>
            
            <div class="row mb-4">
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>{{ $stats['total_jobs'] }}</h4>
                                    <small>Total Jobs Posted</small>
                                </div>
                                <i class="fas fa-briefcase fa-2x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-3">
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
                
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>{{ $stats['total_applications'] }}</h4>
                                    <small>Total Applications</small>
                                </div>
                                <i class="fas fa-file-alt fa-2x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>Recent Job Posts</h5>
                </div>
                <div class="card-body">
                    @if($recent_jobs->count() > 0)
                        @foreach($recent_jobs as $job)
                            <div class="d-flex justify-content-between align-items-center border-bottom py-3">
                                <div>
                                    <h6 class="mb-1">{{ $job->title }}</h6>
                                    <div class="mb-2">
                                        @foreach($job->tech_stack as $tech)
                                            <span class="tech-badge">{{ $tech }}</span>
                                        @endforeach
                                    </div>
                                    <small class="text-muted">
                                        <i class="fas fa-map-marker-alt"></i> {{ $job->location }} | 
                                        <i class="fas fa-clock"></i> {{ $job->created_at->diffForHumans() }}
                                    </small>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-{{ $job->status === 'active' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($job->status) }}
                                    </span>
                                    <div class="mt-2">
                                        <a href="{{ route('jobs.show', $job) }}" class="btn btn-sm btn-outline-primary me-1">View</a>
                                        <a href="{{ route('jobs.edit', $job) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted">You haven't posted any jobs yet. <a href="{{ route('jobs.create') }}">Post your first job</a>!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection