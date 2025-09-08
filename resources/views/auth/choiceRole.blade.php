@extends('layouts.default')
@section('title', 'Role Selection')
@section('content')

<head>
    <meta charset="UTF-8">
    <title>Role Selection</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-image: url("{{asset('images/collage.jpg')}}");
            background-size: cover;
            background-position: center;
            min-height: 100vh;
        }

        .profile-card {
            background-color: transparent;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
            display: block;
        }

        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(45, 163, 206, 0.5),
                        0 -10px 30px rgba(68, 86, 205, 0.5),
                        10px 0 30px rgba(227, 22, 101, 0.5),
                        -10px 0 30px rgba(80, 12, 82, 0.5);
        }

        .profile-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 15px;
            border: 3px solid #4e73df;
            transition: transform 0.3s ease, border-color 0.3s ease;
        }

        .profile-img:hover {
            transform: scale(1.08);
            border-color: #1cc88a;
        }

        h2 {
            color:black;
            font-weight: bold;
            margin-bottom: 10px;
            min-height: 1.5em;
        }

        p {
            color: #FFF;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .btn-primary {
            background-color: #4facfe;
            border: none;
            outline: none;
            background: transparent;
        }

        .btn-primary:hover {
            background-color: #00f2fe;
            transition: background-color 0.3s ease;
        }

        .cursor {
            display: inline-block;
            width: 3px;
            background: black;
            animation: blink 0.7s infinite;
        }

        @keyframes blink {
            0%, 50%, 100% { opacity: 1; }
            25%, 75% { opacity: 0; }
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <h1 class="text-center text-light fw-bold mb-4" id="mainHeading"></h1>
        <div class="row g-4 justify-content-center">
           
            {{-- Student Card --}}
            @if(Auth::user()->role == 'student')
            <div class="col-md-4">
                <div class="profile-card">
                    <img src="{{asset('images/student.jpg')}}" alt="Student" class="profile-img">
                    <h2 id="Name"></h2> 
                    <p id="Desc"></p>
                    <a href="{{ route('student.info') }}" id="button" class="btn btn-outline-primary w-100"></a>
                </div>
            </div>
            @endif

            {{-- Teacher Card --}}
            @if(Auth::user()->role == 'teacher')
            <div class="col-md-4">
                <div class="profile-card">
                    <img src="{{asset('images/teacher.jpg')}}" alt="Teacher" class="profile-img">
                    <h2 id="Name"></h2> 
                    <p id="Desc"></p>
                    <a href="{{ route('teacher.info') }}" id="button" class="btn btn-outline-primary w-100"></a>
                </div>
            </div>
            @endif

            {{-- Admin Card --}}
            @if(Auth::user()->role == 'admin')
            <div class="col-md-4">
                <div class="profile-card">
                    <img src="{{asset('images/admin.jpg')}}" alt="Admin" class="profile-img">
                    <h2 id="Name"></h2> 
                    <p id="Desc"></p>
                    <a href="{{ route('admin.dashboard') }}" id="button" class="btn btn-outline-primary w-100"></a>
                </div>
            </div>
            @endif

        </div>
    </div>

    <script>
        function typeEffect(elementId, text, speed = 100, callback = null) {
            const target = document.getElementById(elementId);
            target.innerHTML = '';
            let i = 0;
            function typing() {
                if (i < text.length) {
                    target.innerHTML += text.charAt(i);
                    i++;
                    setTimeout(typing, speed);
                } else if (callback) {
                    callback();
                }
            }
            typing();
        }

        document.addEventListener('DOMContentLoaded', () => {
            typeEffect('mainHeading', 'Complete your account information 😉', 80, () => {
                typeEffect('Name', "Welcome {{ Auth::user()->name }}", 100, () => {
                    typeEffect('Desc', 'Access your courses, assignments, and learning materials.', 40,() => {
                        typeEffect('button','Get Started',120);
                    });
                });
            });
        });
    </script>
</body>
@endsection
