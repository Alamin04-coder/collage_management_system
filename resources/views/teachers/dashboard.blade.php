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
    </style>
</head>

<body>
    <div class="container dashboard-container">

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
            <a href="{{route('course.list')}}">
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
            <div class="feature-card">
                <i class="bi bi-chat-dots"></i>
                <h5>Messages</h5>
                <p>Communicate with your teachers</p>
            </div>
            <div class="feature-card">
                <i class="bi bi-calendar-event"></i>
                <h5>Events</h5>
                <p>Stay updated with upcoming events</p>
            </div>
            <a href="{{route('teacher.update.profile')}}">
                <div class="feature-card">

                    <i class="bi bi-gear"></i>
                    <h5>Settings</h5>
                    <p>Update your profile and preferences</p>

                </div>
            </a>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <div class="feature-card">
                    <i class="bi bi-box-arrow-left"></i>

                    <h5>Logout</h5>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                    <p> click here for exit your account</p>
                </div>
        </div>
    </div>
    </div>
</body>
@endsection