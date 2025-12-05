@extends('layouts.app')

@section('title', $job->title)

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h3 class="mb-2 fw-bold">{{ $job->title }}</h3>
                            <h5 class="text-muted mb-0">
                                <i class="fas fa-building me-2"></i> {{ $job->employer->name }}
                            </h5>
                        </div>
                        @auth
                            @if(auth()->user()->isEmployer() && auth()->user()->id === $job->employer_id)
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-cog"></i> Manage
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="{{ route('jobs.edit', $job) }}">Edit Job</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form action="{{ route('jobs.destroy', $job) }}" method="POST" 
                                                  onsubmit="return confirm('Are you sure you want to delete this job?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item text-danger" type="submit">Delete Job</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p class="mb-2"><i class="fas fa-map-marker-alt text-primary me-2"></i> <strong>Location:</strong> {{ $job->location }}</p>
                            <p class="mb-2"><i class="fas fa-briefcase text-primary me-2"></i> <strong>Type:</strong> {{ ucfirst(str_replace('_', ' ', $job->job_type)) }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2"><i class="fas fa-chart-line text-primary me-2"></i> <strong>Experience:</strong> {{ ucfirst($job->experience_level) }} Level</p>
                            @if($job->salary_range)
                                <p class="mb-2"><i class="fas fa-dollar-sign text-primary me-2"></i> <strong>Salary:</strong> {{ $job->salary_range }}</p>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h5 class="fw-bold">Technology Stack</h5>
                        <div class="mt-2">
                            @foreach($job->tech_stack as $tech)
                                <span class="badge bg-light text-dark border me-1">{{ $tech }}</span>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h5 class="fw-bold">Job Description</h5>
                        <div class="text-muted">{!! nl2br(e($job->description)) !!}</div>
                    </div>
                    
                    <div class="mb-4">
                        <h5 class="fw-bold">Requirements</h5>
                        <div class="text-muted">{!! nl2br(e($job->requirements)) !!}</div>
                    </div>
                    
                    <hr>
                    <small class="text-muted">Posted {{ $job->created_at->diffForHumans() }}</small>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            @auth
                @if(auth()->user()->isJobSeeker())
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-primary text-white p-3">
                            <h5 class="mb-0"><i class="fas fa-paper-plane me-2"></i> Apply for This Job</h5>
                        </div>
                        <div class="card-body p-4">
                            @php
                                $hasApplied = auth()->user()->applications()->where('job_post_id', $job->id)->exists();
                            @endphp
                            
                            @if($hasApplied)
                                <div class="alert alert-info border-0 d-flex align-items-center">
                                    <i class="fas fa-check-circle fs-4 me-3"></i>
                                    <div>
                                        <strong>Applied!</strong><br>
                                        You have already submitted an application for this position.
                                    </div>
                                </div>
                            @else
                                <!-- IMPORTANT: enctype="multipart/form-data" is required for file uploads -->
                                <form action="{{ route('applications.store', $job) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <!-- Cover Letter -->
                                    <div class="mb-3">
                                        <label for="cover_letter" class="form-label fw-bold">Cover Letter</label>
                                        <textarea class="form-control @error('cover_letter') is-invalid @enderror" 
                                                  id="cover_letter" name="cover_letter" rows="5" 
                                                  placeholder="Tell the employer why you're interested...">{{ old('cover_letter') }}</textarea>
                                        @error('cover_letter')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- NEW: Resume Upload -->
                                    <div class="mb-3">
                                        <label for="resume" class="form-label fw-bold">Upload Resume <span class="text-danger">*</span></label>
                                        <input class="form-control @error('resume') is-invalid @enderror" 
                                               type="file" id="resume" name="resume" accept=".pdf,.doc,.docx">
                                        <div class="form-text small">Accepted formats: PDF, DOC, DOCX (Max 2MB)</div>
                                        @error('resume')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- NEW: Optional Links -->
                                    <div class="mb-4">
                                        <label for="portfolio_links" class="form-label fw-bold">Portfolio / Links (Optional)</label>
                                        <input type="text" class="form-control @error('portfolio_links') is-invalid @enderror" 
                                               id="portfolio_links" name="portfolio_links" 
                                               placeholder="https://github.com/yourname" value="{{ old('portfolio_links') }}">
                                        @error('portfolio_links')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                                        Submit Application
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endif
            @else
                <div class="card shadow-sm mb-4">
                    <div class="card-body text-center p-5">
                        <i class="fas fa-lock fa-3x text-muted mb-3"></i>
                        <h5>Interested in this job?</h5>
                        <p class="text-muted">Create an account to apply for this position.</p>
                        <div class="d-grid gap-2">
                            <a href="{{ route('register') }}" class="btn btn-primary">Register Now</a>
                            <a href="{{ route('login') }}" class="btn btn-outline-secondary">Login</a>
                        </div>
                    </div>
                </div>
            @endauth
            
            <div class="card shadow-sm">
                <div class="card-header bg-white p-3">
                    <h5 class="mb-0 fw-bold">About the Company</h5>
                </div>
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">{{ $job->employer->name }}</h6>
                    <ul class="list-unstyled text-muted mb-0">
                        @if($job->employer->location)
                            <li class="mb-2"><i class="fas fa-map-marker-alt me-2 text-primary"></i> {{ $job->employer->location }}</li>
                        @endif
                        @if($job->employer->email)
                            <li class="mb-2"><i class="fas fa-envelope me-2 text-primary"></i> {{ $job->employer->email }}</li>
                        @endif
                        @if($job->employer->phone)
                            <li class="mb-2"><i class="fas fa-phone me-2 text-primary"></i> {{ $job->employer->phone }}</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection