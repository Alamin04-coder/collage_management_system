<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Faridpur Polytechnic Institute</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #003366;
        }

        .navbar-brand {
            font-size: 2rem;
            font-weight: bold;
            color: #fff;
        }

        .navbar-nav .nav-link {
            color: #eaeaea;
            margin-right: 1rem;
            transition: color 0.2s;
        }

        .navbar-nav .nav-link:hover {
            color: #fff;
        }

        .carousel-item img {
            height: 500px;
            object-fit: cover;
        }

        .carousel-caption {
            background: rgba(0, 0, 0, 0.4);
            border-radius: 0.5rem;
            padding: 2rem;
        }

        .btn-custom {
            background-color: #006699;
            color: #fff;
            border: none;
            padding: 0.75rem 1.5rem;
            font-size: 1.1rem;
            border-radius: 0.3rem;
            transition: background 0.2s;
        }

        .btn-custom:hover {
            background-color: #004d73;
            color: #fff;
        }

        .features {
            padding: 3rem 0;
        }

        .feature-card {
            background-color: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .feature-icon {
            font-size: 3rem;
            color: #006699;
            margin-bottom: 1rem;
        }

        footer {
            background-color: #003366;
            color: #fff;
            padding: 1.5rem 0;
        }

        .modal-header {
            border-bottom: none;
        }

        .modal-footer {
            border-top: none;
        }
         .notice-banner {
            background: transparent;
            color: #000;
            overflow: hidden;
            white-space: nowrap;
            padding: 10px 0;
            font-weight: bold;
            font-size: 1rem;
        }

        .notice-track {
            display: inline-block;
            padding-left: 100%;
            animation: scrollNotice 50s linear infinite;
        }

        .notice-item {
            display: inline-block;
            margin-right: 50px;
        }


        @keyframes scrollNotice {
            0% {
                transform: translateX(0%);
            }

            100% {
                transform: translateX(-100%);
            }

        }
        a{
            text-decoration: none;
            color: black;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Faridpur Polytechnic Institute</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#departmentsModal">Departments</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#">Admissions</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#noticeModal">Notice</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#contactModal">Contact Us</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    @if(isset($notices) && $notices->isNotEmpty())
    <div class="notice-banner">
        <div class="notice-track">
            @foreach($notices as $notice)
            <span class="notice-item">{{ $notice->title }} - {{ Str::limit($notice->description, 100)}} - Published Time {{ $notice->created_at->format('d M, Y') }}</span>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Departments Modal -->
    <div class="modal fade" id="departmentsModal" tabindex="-1" aria-labelledby="departmentsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="departmentsModalLabel">Departments</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-4 text-center">
                        @foreach(['Computer Technology', 'Electrical Technology', 'Electronics Technology', 'Civil Technology', 'Mechanical Technology', 'Power Technology'] as $dept)
                        <div class="col-md-4">
                            <div class="p-3 border rounded bg-light">
                                <h6>{{ $dept }}</h6>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Modal -->
    <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="contactModalLabel">Contact Us</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="get">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Your Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="3" placeholder="Type your message"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-custom">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Notice Modal -->
    <div class="modal fade" id="noticeModal" tabindex="-1" aria-labelledby="noticeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="noticeModalLabel">Latest Notices</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if(isset($notices) && $notices->count())
                    <ul class="list-group">
                        @foreach($notices as $notice)
                        <li class="list-group-item">
                            <h6>{{ $notice->title }}</h6><br>
                            <p>{{ $notice->description }}</p> <p>Published date :{{ $notice->created_at->format('d M, Y h:i A') }}</p>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <p>No notices available.</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner">
            
            <div class="carousel-item active">
                
                <img src="images/bg.jpg" class="d-block w-100" alt="Slide 1">
                
                <div class="carousel-caption d-flex flex-column justify-content-center h-100">
                    <h1 class="fw-bold">Welcome to Student Management System</h1>
                    <p>Faridpur Polytechnic Institute</p>
                    <a href="#" class="btn btn-custom mt-3">Learn More</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/bg2.jpg" class="d-block w-100" alt="Slide 2">
                <div class="carousel-caption d-flex flex-column justify-content-center h-100">
                    <h1 class="fw-bold">Quality Technical Education</h1>
                    <p>Building a Skilled Nation</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/collage.jpg" class="d-block w-100" alt="Slide 3">
                <div class="carousel-caption d-flex flex-column justify-content-center h-100">
                    <h1 class="fw-bold">Modern Labs & Workshops</h1>
                    <p>Practical Learning for Students</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- Features -->
    <section class="features">
        <div class="container">
            <div class="row text-center mb-5">
                <h2 class="fw-bold">What We Offer</h2>
                <p class="text-muted">Empowering students with modern technical education</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card p-4 text-center">
                        <div class="feature-icon">🎓</div>
                        <h4 class="fw-bold">Quality Education</h4>
                        <p>Experienced teachers, updated curriculum.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card p-4 text-center">
                        <div class="feature-icon">🏫</div>
                        <h4 class="fw-bold">Modern Labs</h4>
                        <p>Practical labs and workshops for hands-on learning.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card p-4 text-center">
                        <div class="feature-icon">📚</div>
                        <h4 class="fw-bold">Student Support</h4>
                        <p>Guidance, library, and scholarship assistance.</p>
                    </div>
                </div>
                <a href="{{route('course.list')}}">
                 <div class="col-md-4">
                    <div class="feature-card p-4 text-center">
                        <div class="feature-icon">📚</div>
                        <h4 class="fw-bold">Our Course</h4>
                        <p>click here to view our Course </p>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container text-center">
            <h3>Ready to Join?</h3>
            <p class="mb-4">Admissions are open for the upcoming session. Apply now and shape your future.</p>
            <a href="#" class="btn btn-custom">Apply Now</a>
        </div>
    </section>

    <footer class="text-center">
        <div class="container">
            <p class="mb-0">© 2025 Faridpur Polytechnic Institute. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>