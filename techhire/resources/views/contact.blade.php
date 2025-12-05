<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/contact-styles.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <title>Document</title>
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
                        <a class="nav-link active" href="/contact">Contact Us</a>
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
            <h1 class="display-4 fw-bold mb-3">Contact Us</h1>
        </div>
    </section>

    <section class="contact-main">
        <div class="left-contact">
            <div class="left-contact-text">
                <h1>Let's Build Your Future, Together.</h1>
                <p>We're here to help you take the next step in your career. Whether you have a question, feedback, or need support, feel free to reach out to us anytime.</p>
            </div>
            <div class="left-contact-list">
                <ul class="contact-list">
                    <li class="contact-info">
                        <h5><i class="bi bi-telephone"></i></h5>
                        <h5>Call For Inquiry</h5>
                        <p>+63 388-6895</p>
                    </li>
                    <li class="contact-info">
                        <h5><i class="bi bi-envelope"></i></h5>
                        <h5>Send Us Email</h5>
                        <p>techhire@gmail.com</p>
                    </li>
                    <li class="contact-info">
                        <h5><i class="bi bi-clock"></i></h5>
                        <h5>Opening Hours</h5>
                        <p>Mon - Fri: 10AM - 10PM</p>
                    </li>
                    <li class="contact-info">
                        <h5><i class="bi bi-geo-alt"></i></h5>
                        <h5>Office</h5>
                        <p>KM 53 Pan Philippine Highway, Brgy. Milagrosa, Calamba, Philippines</p>
                    </li>
                </ul>
            </div>
            
        </div>
        <div class="right-contact">
            <div class="card-container">
                <div class="contact-card p-4 shadow-sm">
                    <h3 class="mb-3">Contact Info</h3>
                    <p class="text-muted mb-4">
                        Our team is ready to assist you on your journey, just drop us a message and we'll get back to you as soon as we can.
                    </p>

                    <form>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" placeholder="Your name">
                            </div>
                            <div class="col">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" placeholder="Your last name">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" placeholder="Your E-mail address">
                        </div>

                        <div class="mb-4">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" rows="6" placeholder="Your message..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Send Message</button>
                    </form>
                </div>
            </div>

        </div>
    </section>
    <section class="contact-map">
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3868.2826426479087!2d121.13365167592494!3d14.1782166862597!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd63862f343bdd%3A0x27b21f8ee9b7395d!2sNational%20University%20Laguna!5e0!3m2!1sen!2sph!4v1748361055678!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <section class="contact-partners">
        <div class="partners-list-container">
            <ul class="partners-list">
                <li class="partners"><h4><i class="bi bi-microsoft"></i>Microsoft</h4></li>
                <li class="partners"><h4><i class="bi bi-apple"></i>Apple</h4></li>
                <li class="partners"><h4><i class="bi bi-nvidia"></i>Nvidia</h4></li>
                <li class="partners"><h4><i class="bi bi-amazon"></i>Amazon</h4></li>
            </ul>
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
                <li><a href="#" class="text-white">About</li>
                <li><a href="/contact" class="text-white">Contact Us</a></li>
                <li><a href="/team" class="text-white">Our Team</a></li>
                <li><a href="#about-working" class="text-white">Partners</a></li>
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const faqQuestions = document.querySelectorAll(".faq-question");

            faqQuestions.forEach(question => {
                question.addEventListener("click", function() {
                    const answer = this.nextElementSibling;
                    const arrow = this.querySelector(".arrow");

                    if (answer.style.maxHeight) {
                        answer.style.maxHeight = null;
                        arrow.innerHTML = "&#9662;";
                    } else {
                        answer.style.maxHeight = answer.scrollHeight + "px";
                        arrow.innerHTML = "&#9652;"; 
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>