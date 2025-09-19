@extends('layouts.default')
@section('title', 'Teacher Dashboard')

@section('content')

<head>
    <meta charset="UTF-8">
    <title>teacher Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            color: #fff;
        }

        .dashboard-container {
            padding-top: 60px;
            padding-bottom: 60px;
        }

        .dashboard-title {
            font-weight: 800;
            letter-spacing: 1px;
            text-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        }

        .profile-card {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
            margin-bottom: 40px;
            transition: all 0.3s ease-in-out;
        }

        .profile-card:hover {
            transform: translateY(-10px);
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.4);
        }

        .profile-img {
            width: 120px;
            height: 120px;
            margin-bottom: 20px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #dee2e6;
            transition: transform 0.3s ease, border-color 0.3s ease;
        }

        .profile-img:hover {
            transform: scale(1.15);
            border-color: #0d6efd;
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 30px 20px;
            text-align: center;
            transition: all 0.4s ease-in-out;
            cursor: pointer;
            color: #fff;
        }

        .feature-card:hover {
            transform: translateY(-8px) scale(1.05);
            background: rgba(255, 255, 255, 0.25);
            box-shadow: 0px 8px 25px rgba(0, 0, 0, 0.3);
        }

        .feature-card i {
            font-size: 50px;
            margin-bottom: 15px;
            color: #ffde59;
        }

        .feature-card h5 {
            font-weight: 600;
            letter-spacing: 1px;
        }

        a {
            text-decoration: none;

        }

        .notice-banner {
            background: blueviolet;
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
            animation: scrollNotice 30s linear infinite;
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
    </style>
</head>

<body>

    @include('layouts.navbar')
    @if(isset($notices) && $notices->isNotEmpty())
    <div class="notice-banner">
        <div class="notice-track">
            @foreach($notices as $notice)
            <span class="notice-item">{{ $notice->title }} - {{ Str::limit($notice->description, 100)}} - Published Time {{ $notice->created_at->format('d M, Y') }}</span>
            @endforeach
        </div>
    </div>
    @endif

    <div class="container dashboard-container">
        @include('layouts.message')

        <div class="text-center mb-5">
            <h1 class="dashboard-title">🎓 Welcome, {{ Auth::user()->teacher->name ?? 'alamin' }}!</h1>
            <p class="lead">Here you can maintain your dashboard</p>
        </div>

        <!-- Profile Card -->
        <div class="profile-card mx-auto col-md-6">
            <img src="{{isset($teacher) && $teacher->image ? asset('teacher_images/'.$teacher->image) :
            asset('images/logo.png')}}"
                alt="Profile Picture"
                class="profile-img">
            <h3>{{$teacher->name ?? 'Name not Found'}}</h3>
            <p class="mb-1"><strong>Email:</strong> {{ Auth::user()->email ?? 'No Email' }}</p>
            <p class="mb-1"><strong>Role:</strong> {{ Auth::user()->role ?? 'none' }}</p>
        </div>

        <!-- Dashboard Features -->
        <div class="card-grid">
            <a href="{{route('myCourse')}}">
                <div class="feature-card">
                    <i class="bi bi-book"></i>
                    <h5>My Courses</h5>
                    <p>View all enrolled courses and materials</p>
                </div>
            </a>
            <div class="feature-card">
                <i class="bi bi-card-checklist"></i>
                <h5>Assignments</h5>
                <p>Check pending and submitted assignments</p>
            </div>
            <div class="feature-card">
                <i class="bi bi-bar-chart-line"></i>
                <h5>Results</h5>
                <p>Track your academic performance</p>
            </div>
            <a href="#">
            <div class="feature-card">
                <i class="bi bi-chat-dots"></i>
                <h5>Messages</h5>
                <p>Communicate with your teachers</p>
            </div>
            </a>
            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#noticeModal">
            <div class="feature-card">
                <i class="bi bi-calendar-event"></i>
                <h5>Events</h5>
                <p>Stay updated with upcoming events</p>
            </div>
            </a>

            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <div class="feature-card">
                    <i class="bi bi-box-arrow-left"></i>

                    <h5>Logout</h5>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                    <p> click here for exit your account</p> <br>
                </div>
            </a>
            <div class="modal fade" id="noticeModal" tabindex="-1" aria-labelledby="noticeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title" id="noticeModalLabel">Latest Notices</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if(isset($allNotice) && $allNotice->count())
                        <ul class="list-group">
                            @foreach($allNotice as $notice1)
                            <li class="list-group-item">
                                <h6>{{ $notice1->title }}</h6><br>
                                <p>{{ $notice1->description }}</p>
                                <p>Published date :{{ $notice1->created_at->format('d M, Y h:i A') }}</p>
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <p>No notices available.</p>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <a href="{{route('notice.list')}}" class="btn btn-success">create Notice</a>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</body>
@endsection