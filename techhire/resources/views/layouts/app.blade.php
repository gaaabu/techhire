<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechHire - @yield('title', 'Find Your Dream Tech Job')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    
    <link href="{{ asset('css/about-styles.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: "Figtree", sans-serif;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-wrapper {
            flex: 1;
            padding-bottom: 3rem;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.25rem;
        }
        
        .btn-register {
            background-color: #0d6efd;
            color: white;
            border-radius: 5px;
        }
        
        .btn-register:hover {
            background-color: #0b5ed7;
            color: white;
        }
    </style>
    @yield('styles')
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('asset/logo.png') }}" alt="TechHire Logo" style="max-height: 40px; margin-right: 8px;"> 
                TechHire
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('jobs.*') ? 'active' : '' }}" href="{{ route('jobs.index') }}">Browse Jobs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="/about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="/contact">Contact Us</a>
                    </li>
                </ul>
                
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
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
                                        <button class="dropdown-item text-danger" type="submit">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-register ms-2 px-4" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="main-wrapper">
        
        @if(session('success'))
            <div class="container mt-4">
                <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="container mt-4">
                <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="container mt-4">
                <div class="alert alert-danger shadow-sm border-0">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @yield('content')
        
    </div>

    <section class="footer bg-dark text-white py-5">
        <div class="container">
            <div class="row g-4">
            
                <div class="col-md-3">
                    <h5 class="mb-3">TechHire</h5>
                    <p class="text-muted small">We're bridging the gap between top-tier tech talent and innovative companies. Find your future today.</p>
                </div>

                <div class="col-md-3">
                    <h5 class="mb-3">Company</h5>
                    <ul class="list-unstyled">
                        <li><a href="/about" class="text-white text-decoration-none opacity-75 hover-opacity-100">About Us</a></li>
                        <li><a href="/contact" class="text-white text-decoration-none opacity-75 hover-opacity-100">Contact Us</a></li>
                        <li><a href="/team" class="text-white text-decoration-none opacity-75 hover-opacity-100">Our Team</a></li>
                        <li><a href="#" class="text-white text-decoration-none opacity-75 hover-opacity-100">Partners</a></li>
                    </ul>
                </div>

                <div class="col-md-3">
                    <h5 class="mb-3">Popular Categories</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('jobs.index', ['search' => 'Software']) }}" class="text-white text-decoration-none opacity-75">Software Development</a></li>
                        <li><a href="{{ route('jobs.index', ['search' => 'Web']) }}" class="text-white text-decoration-none opacity-75">Web Development</a></li>
                        <li><a href="{{ route('jobs.index', ['search' => 'Mobile']) }}" class="text-white text-decoration-none opacity-75">Mobile Development</a></li>
                        <li><a href="{{ route('jobs.index', ['search' => 'Data']) }}" class="text-white text-decoration-none opacity-75">Data Science</a></li>
                    </ul>
                </div>

                <div class="col-md-3">
                    <h5 class="mb-3">Newsletter</h5>
                    <form>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Your email">
                            <button class="btn btn-primary" type="button">Subscribe</button>
                        </div>
                        <small class="text-muted">Get the latest jobs sent to your inbox.</small>
                    </form>
                </div>

            </div>
            <hr class="my-4 border-secondary">
            <div class="text-center text-muted small">
                &copy; {{ date('Y') }} TechHire. All rights reserved.
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>