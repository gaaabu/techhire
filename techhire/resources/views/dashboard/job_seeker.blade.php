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
    <title>Job Seeker Dashboard - TechHire</title>
    
    <style>
        
        body {
            background-color: #f8f9fa; 
            font-family: "Figtree", sans-serif;
        }
        .dashboard-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            border: none;
            margin-bottom: 20px;
        }
        .sidebar-link {
            color: #333;
            padding: 12px 15px;
            border-radius: 8px;
            transition: all 0.3s;
            display: block;
            text-decoration: none;
            margin-bottom: 5px;
        }
        .sidebar-link:hover, .sidebar-link.active {
            background-color: #e9ecef;
            color: #000;
            font-weight: 600;
        }
        .tech-badge {
            background-color: #eef2ff;
            color: #4f46e5;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-right: 5px;
            display: inline-block;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}"><img src="./asset/logo.png" name="logo" class="logo" style="max-height: 40px;"> TechHire</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('jobs.index') }}">Browse Jobs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Contact Us</a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                                @if(Auth::user()->isEmployer())
                                    <li><a class="dropdown-item" href="{{ route('jobs.create') }}">Post Job</a></li>
                                @endif
                                @if(Auth::user()->isJobSeeker())
                                    <li><a class="dropdown-item" href="{{ route('applications.index') }}">My Applications</a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="dropdown-item" type="submit">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-register ms-2" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <section class="py-5">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-3">
                    <div class="dashboard-card p-4">
                        <div class="text-center mb-4">
                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-user fa-2x text-secondary"></i>
                            </div>
                            <h5 class="mt-3 mb-0">{{ auth()->user()->name }}</h5>
                            <small class="text-muted">Job Seeker</small>
                        </div>
                        <hr>
                        <nav class="nav flex-column">
                            <a class="sidebar-link active" href="#"><i class="fas fa-chart-line me-2"></i> Overview</a>
                            <a class="sidebar-link" href="{{ route('jobs.index') }}"><i class="fas fa-search me-2"></i> Browse Jobs</a>
                            <a class="sidebar-link" href="{{ route('applications.index') }}"><i class="fas fa-file-alt me-2"></i> My Applications</a>
                            <a class="sidebar-link" href="#"><i class="fas fa-user-edit me-2"></i> Edit Profile</a>
                        </nav>
                    </div>
                </div>
                
                <div class="col-lg-9">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h2 class="fw-bold">Dashboard</h2>
                            <p class="text-muted mb-0">Welcome back! Here is what's happening with your applications.</p>
                        </div>
                        <a href="{{ route('jobs.index') }}" class="btn btn-primary">
                            <i class="fas fa-search me-2"></i> Find Jobs
                        </a>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-lg-6 col-md-6 mb-3">
                            <div class="dashboard-card card-body bg-primary text-white p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h2 class="display-6 fw-bold mb-0">{{ $stats['applications_sent'] }}</h2>
                                        <span>Applications Sent</span>
                                    </div>
                                    <i class="fas fa-paper-plane fa-3x opacity-50"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6 col-md-6 mb-3">
                            <div class="dashboard-card card-body bg-warning text-dark p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h2 class="display-6 fw-bold mb-0">{{ $stats['pending_applications'] }}</h2>
                                        <span>Pending Review</span>
                                    </div>
                                    <i class="fas fa-clock fa-3x opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="dashboard-card h-100">
                                <div class="card-header bg-white border-bottom p-3">
                                    <h5 class="mb-0 fw-bold">Recent Applications</h5>
                                </div>
                                <div class="card-body p-0">
                                    @if($recent_applications->count() > 0)
                                        <div class="list-group list-group-flush">
                                            @foreach($recent_applications as $application)
                                                <div class="list-group-item p-3 border-bottom">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <h6 class="mb-1 fw-bold">{{ $application->jobPost->title }}</h6>
                                                            <small class="text-muted"><i class="bi bi-building"></i> {{ $application->jobPost->employer->name }}</small>
                                                        </div>
                                                        <div class="text-end">
                                                            <span class="badge bg-{{ $application->status === 'pending' ? 'warning' : ($application->status === 'accepted' ? 'success' : 'secondary') }}">
                                                                {{ ucfirst($application->status) }}
                                                            </span>
                                                            <div class="mt-1"><small class="text-muted" style="font-size: 0.75rem;">{{ $application->created_at->diffForHumans() }}</small></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="p-3 text-center">
                                            <a href="{{ route('applications.index') }}" class="btn btn-sm btn-outline-primary w-100">View All Applications</a>
                                        </div>
                                    @else
                                        <div class="p-5 text-center text-muted">
                                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                            <p>You haven't applied to any jobs yet.</p>
                                            <a href="{{ route('jobs.index') }}" class="btn btn-primary btn-sm">Start Browsing</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6 mb-4">
                            <div class="dashboard-card h-100">
                                <div class="card-header bg-white border-bottom p-3">
                                    <h5 class="mb-0 fw-bold">Recommended for You</h5>
                                </div>
                                <div class="card-body p-0">
                                    @if(count($recommended_jobs) > 0)
                                        <div class="list-group list-group-flush">
                                            @foreach($recommended_jobs as $job)
                                                <div class="list-group-item p-3 border-bottom">
                                                    <div class="mb-2">
                                                        <a href="{{ route('jobs.show', $job) }}" class="text-decoration-none text-dark">
                                                            <h6 class="mb-1 fw-bold">{{ $job->title }}</h6>
                                                        </a>
                                                        <small class="text-muted">
                                                            <i class="bi bi-building me-1"></i> {{ $job->employer->name }}
                                                            <span class="mx-1">•</span>
                                                            <i class="bi bi-geo-alt me-1"></i> {{ $job->location }}
                                                        </small>
                                                    </div>
                                                    <div>
                                                        @foreach(array_slice($job->tech_stack, 0, 3) as $tech)
                                                            <span class="tech-badge">{{ $tech }}</span>
                                                        @endforeach
                                                        @if(count($job->tech_stack) > 3)
                                                            <span class="tech-badge text-muted bg-light">+{{ count($job->tech_stack) - 3 }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="p-3 text-center">
                                            <a href="{{ route('jobs.index') }}" class="btn btn-sm btn-outline-primary w-100">Browse All Jobs</a>
                                        </div>
                                    @else
                                         <div class="p-5 text-center text-muted">
                                            <p>No specific recommendations yet.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="footer bg-dark text-white py-5">
        <div class="container">
            <div class="row g-4">
            
            <div class="col-md-3">
                <h5>Jobs</h5>
                <ul class="list-unstyled">
                <li>We're always looking for passionate, talented individuals to join our team. Explore open positions and take the next
                    step in your career with us.
                </li>
                </ul>
            </div>

            <div class="col-md-3">
                <h5>Company</h5>
                <ul class="list-unstyled">
                <li><a href="#" class="text-white text-decoration-none">About</a></li>
                <li><a href="/contact" class="text-white text-decoration-none">Contact Us</a></li>
                <li><a href="/team" class="text-white text-decoration-none">Our Team</a></li>
                <li><a href="#about-working" class="text-white text-decoration-none">Partners</a></li>
                </ul>
            </div>

            <div class="col-md-3">
                <h5>Job Categories</h5>
                <ul class="list-unstyled">
                <li>Software Development</li>
                <li>Web Development</li>
                <li>Mobile Development</li>
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