@extends('layouts.default')
@section('title', 'Student Dashboard')

@section('content')

<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
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
            border-radius: 50%;
            border: 3px solid #fff;
            margin-bottom: 20px;
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
    @include('layouts.navbar')
    <div class="container dashboard-container">


        <!-- student dashboard -->
        <div class="card-grid">
            <a href="{{route('course.list')}}">
                <div class="feature-card">
                    <i class="bi bi-book"></i>
                    <h5>ALL Courses</h5>
                    <p>Click Here for view all courses</p>
                </div>
            </a>

            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#noticeModal">
                <div class="feature-card">
                    <i class="bi bi-card-checklist"></i>
                    <h5>My Course</h5>
                    <p>click here for view your courses details </p>
                </div>
            </a>
        </div>

        <div class="modal fade" id="noticeModal" tabindex="-1" aria-labelledby="noticeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-dark">
                        @if(Auth::user()->role === "student")
                        <h5 class="modal-title" id="noticeModalLabel">{{Auth::user()->student ? Auth::user()->student->name : 'no name'}}, your Course</h5>
                        @elseif(Auth::user()->role === "teacher")
                        <h5 class="modal-title" id="noticeModalLabel">{{Auth::user()->teacher ? Auth::user()->teacher->name : 'no name'}}, your Course</h5>
                        @endif
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if(isset($courses) && $courses->count())
                        <ul class="list-group">
                            @foreach($courses as $course)
                            @if(Auth::user()->role === "student")
                            <li class="list-group-item">
                                
                                <p>Course Name:-{{$course->course ? $course->course->course_name : "not found"}}</p>
                                <p>Description :-{{$course->course ? $course->course->description : "not found"}}</p>
                                <p>Teacher Name :-{{$course->teacher ? $course->teacher->name : 'not found'}}</p>
                                <p>Enrolled date:-{{$course->created_at->format('d M Y') ?? 'not found' }}</p>
                            </li>
                            @elseif(Auth::user()->role === "teacher")
                            
                            <li class="list-group-item">
                                <p>{{$course->course_name ?? "not found"}}</p>
                                <p>{{$course->description ?? "not found"}}</p>
                                <p>{{$course->course_fee ?? 'not found'}}</p>
                                <p>{{$course->course_code ?? 'not found'}}</p>
                                <p>{{$course->created_at->format('d M Y') ?? 'not found' }}</p>
                                <a href="{{route('course.edit',$course->id)}}" class="btn btn-sm btn-warning">Edit</a>


                            </li>
                            @endif
                            @endforeach
                        </ul>
                        @else
                        <p style="color: #667eea; text-align:center;">No course available.</p>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection