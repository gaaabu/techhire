@extends('layouts.app')

@section('title', 'My Applications')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>My Job Applications</h2>
        <a href="{{ route('jobs.index') }}" class="btn btn-primary">
            <i class="fas fa-search"></i> Browse More Jobs
        </a>
    </div>
    
    @if($applications->count() > 0)
        @foreach($applications as $application)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <h5 class="card-title">
                                <a href="{{ route('jobs.show', $application->jobPost) }}" class="text-decoration-none">
                                    {{ $application->jobPost->title }}
                                </a>
                            </h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                <i class="fas fa-building"></i> {{ $application->jobPost->employer->name }}
                            </h6>
                            <div class="mb-2">
                                @foreach($application->jobPost->tech_stack as $tech)
                                    <span class="tech-badge">{{ $tech }}</span>
                                @endforeach
                            </div>
                            <small class="text-muted">
                                <i class="fas fa-map-marker-alt"></i> {{ $application->jobPost->location }} | 
                                <i class="fas fa-briefcase"></i> {{ ucfirst(str_replace('_', ' ', $application->jobPost->job_type)) }} | 
                                <i class="fas fa-chart-line"></i> {{ ucfirst($application->jobPost->experience_level) }} Level
                            </small>
                        </div>
                        <div class="col-lg-4 text-end">
                            <span class="badge bg-{{ $application->status === 'pending' ? 'warning' : ($application->status === 'accepted' ? 'success' : ($application->status === 'reviewed' ? 'info' : 'secondary')) }} mb-2">
                                {{ ucfirst($application->status) }}
                            </span>
                            <p class="text-muted mb-0">Applied {{ $application->created_at->diffForHumans() }}</p>
                            <a href="{{ route('jobs.show', $application->jobPost) }}" class="btn btn-sm btn-outline-primary mt-2">View Job</a>
                        </div>
                    </div>
                    
                    @if($application->cover_letter)
                        <div class="mt-3">
                            <h6>Your Cover Letter:</h6>
                            <div class="bg-light p-3 rounded">
                                {{ Str::limit($application->cover_letter, 200) }}
                                @if(strlen($application->cover_letter) > 200)
                                    <button class="btn btn-link btn-sm p-0" type="button" data-bs-toggle="collapse" data-bs-target="#cover-letter-{{ $application->id }}">
                                        Read more
                                    </button>
                                    <div class="collapse" id="cover-letter-{{ $application->id }}">
                                        {{ substr($application->cover_letter, 200) }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
        
        <div class="d-flex justify-content-center">
            {{ $applications->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
            <h4>No applications yet</h4>
            <p class="text-muted">You haven't applied to any jobs yet. Start browsing available positions!</p>
            <a href="{{ route('jobs.index') }}" class="btn btn-primary">Browse Jobs</a>
        </div>
    @endif
</div>
@endsection