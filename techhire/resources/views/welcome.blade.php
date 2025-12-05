<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to TechHire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="{{ asset('css/welcome-styles.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}"><img src="./asset/logo.png" name="logo" class="logo"> TechHire</a>
            
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
    <section class="hero text-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 text-lg-start text-center">
                    <h1 class="display-4 fw-bold mb-3">Find Your Dream Tech Job</h1>
                    <p class="lead mb-4">Connect with top tech companies and discover opportunities in software development, AI, cybersecurity, and more.</p>
                    <div class="d-flex justify-content-lg-start justify-content-center gap-3 flex-wrap">
                        <a href="{{ route('jobs.index') }}" class="btn btn-light btn-lg">Browse Jobs</a>
                        @guest
                            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">Get Started</a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4 mb-4">
                    <i class="fas fa-search feature-icon mb-3"></i>
                    <h4>Easy Job Search</h4>
                    <p>Filter jobs by technology stack, location, and experience level to find the perfect match.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <i class="fas fa-users feature-icon mb-3"></i>
                    <h4>Top Tech Companies</h4>
                    <p>Connect with leading companies in the tech industry looking for talented developers.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <i class="fas fa-rocket feature-icon mb-3"></i>
                    <h4>Career Growth</h4>
                    <p>Find opportunities that match your skills and help you advance in your tech career.</p>
                </div>
            </div>
        </div>
    
    </section>
    <footer class="footer">
        <div class="container text-center">
            <div class="row">
                <div class="col-3 microsoft">
                    <p class="footer-text"><i class="bi bi-microsoft"></i>Microsoft</p>
                </div>
                <div class="col-3 nvidia">
                    <p class="footer-text"><i class="bi bi-nvidia"></i>NVidia</p>
                </div>
                <div class="col-3 apple">
                    <p class="footer-text"><i class="bi bi-apple"></i>Apple</p>
                </div>
                <div class="col-3 amazon">
                    <p class="footer-text"><i class="bi bi-amazon"></i>Amazon</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
