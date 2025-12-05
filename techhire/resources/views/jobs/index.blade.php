<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/about-styles.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <title>Browse Jobs - TechHire</title>
    
    <style>
        body {
            background-color: #f8f9fa;
            font-family: "Figtree", sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        .main-wrapper {
            flex: 1; 
        }

        .search-section {
            background-color: #fff;
            padding: 2rem 0;
            border-bottom: 1px solid #e0e0e0;
            margin-bottom: 2rem;
        }
        
        .job-card {
            background: white;
            border: 1px solid #eef2f6;
            border-radius: 10px;
            transition: all 0.2s ease;
            margin-bottom: 15px;
            padding: 20px;
            position: relative; 
        }
        
        .job-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            border-color: #4f46e5;
        }
        
        .tech-badge {
            background-color: #eef2ff;
            color: #4f46e5;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-right: 5px;
            display: inline-block;
        }
        
        .filter-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            border: 1px solid #eef2f6;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('asset/logo.png') }}" name="logo" class="logo" style="max-height: 40px;"> TechHire</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link active" href="{{ route('jobs.index') }}">Browse Jobs</a></li>
                    <li class="nav-item"><a class="nav-link" href="/about">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="/contact">Contact Us</a></li>
                </ul>
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">{{ Auth::user()->name }}</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                                @if(Auth::user()->isEmployer())
                                    <li><a class="dropdown-item" href="{{ route('jobs.create') }}">Post Job</a></li>
                                @endif
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="dropdown-item" type="submit">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="btn btn-register ms-2" href="{{ route('register') }}">Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="main-wrapper">
        
        <section class="search-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 text-center">
                        <h2 class="fw-bold mb-3">Find Your Next Tech Role</h2>
                        <form action="{{ route('jobs.index') }}" method="GET" class="d-flex gap-2">
                            <input type="text" name="search" class="form-control form-control-lg" placeholder="Search by job title, skill, or keyword..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary btn-lg px-4">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section class="pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 mb-4">
                        <div class="filter-card">
                            <h5 class="fw-bold mb-3"><i class="fas fa-filter me-2"></i>Filters</h5>
                            <form action="{{ route('jobs.index') }}" method="GET">
                                @if(request('search'))
                                    <input type="hidden" name="search" value="{{ request('search') }}">
                                @endif
                                
                                <div class="mb-3">
                                    <label class="form-label fw-bold small text-muted">Job Type</label>
                                    <select name="job_type" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="">All Types</option>
                                        <option value="full_time" {{ request('job_type') == 'full_time' ? 'selected' : '' }}>Full Time</option>
                                        <option value="part_time" {{ request('job_type') == 'part_time' ? 'selected' : '' }}>Part Time</option>
                                        <option value="contract" {{ request('job_type') == 'contract' ? 'selected' : '' }}>Contract</option>
                                        <option value="remote" {{ request('job_type') == 'remote' ? 'selected' : '' }}>Remote</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold small text-muted">Experience Level</label>
                                    <select name="experience_level" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="">All Levels</option>
                                        <option value="entry" {{ request('experience_level') == 'entry' ? 'selected' : '' }}>Entry Level</option>
                                        <option value="mid" {{ request('experience_level') == 'mid' ? 'selected' : '' }}>Mid Level</option>
                                        <option value="senior" {{ request('experience_level') == 'senior' ? 'selected' : '' }}>Senior Level</option>
                                    </select>
                                </div>
                                
                                <div class="d-grid">
                                    <a href="{{ route('jobs.index') }}" class="btn btn-outline-secondary btn-sm">Clear Filters</a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-9">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0">
                                @if(request('search'))
                                    Results for "{{ request('search') }}"
                                @else
                                    Latest Jobs
                                @endif
                            </h5>
                            <span class="text-muted small">{{ $jobs->total() }} jobs found</span>
                        </div>

                        @forelse($jobs as $job)
                            <div class="job-card">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h5 class="fw-bold mb-1">
                                            <a href="{{ route('jobs.show', $job) }}" class="text-decoration-none text-dark hover-primary">
                                                {{ $job->title }}
                                            </a>
                                        </h5>
                                        <p class="text-muted mb-2 small">
                                            <i class="bi bi-building me-1"></i> {{ $job->employer->name }} 
                                            <span class="mx-2">•</span> 
                                            <i class="bi bi-geo-alt me-1"></i> {{ $job->location }}
                                        </p>
                                        <div class="mb-2">
                                            @if(is_array($job->tech_stack))
                                                @foreach(array_slice($job->tech_stack, 0, 4) as $tech)
                                                    <span class="tech-badge">{{ $tech }}</span>
                                                @endforeach
                                                @if(count($job->tech_stack) > 4)
                                                    <span class="text-muted small">+{{ count($job->tech_stack) - 4 }} more</span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                        <div class="mb-2">
                                            <span class="badge bg-light text-dark border">{{ ucfirst(str_replace('_', ' ', $job->job_type)) }}</span>
                                            <span class="badge bg-light text-dark border">{{ ucfirst($job->experience_level) }}</span>
                                        </div>
                                        <small class="text-muted d-block">{{ $job->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <i class="bi bi-search display-4 text-muted mb-3"></i>
                                <h4>No jobs found</h4>
                                <p class="text-muted">Try adjusting your search terms or filters.</p>
                                <a href="{{ route('jobs.index') }}" class="btn btn-primary">View All Jobs</a>
                            </div>
                        @endforelse

                        <div class="mt-4 d-flex justify-content-center">
                            {{ $jobs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div> <section class="footer bg-dark text-white py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3">
                    <h5>Jobs</h5>
                    <ul class="list-unstyled">
                        <li>We're always looking for passionate, talented individuals.</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Company</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white text-decoration-none">About</a></li>
                        <li><a href="/contact" class="text-white text-decoration-none">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Categories</h5>
                    <ul class="list-unstyled">
                        <li>Software Development</li>
                        <li>Data Science & AI/ML</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Newsletter</h5>
                    <form>
                        <input type="email" class="form-control mb-2" placeholder="Your email">
                        <button type="submit" class="btn btn-primary w-100">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>