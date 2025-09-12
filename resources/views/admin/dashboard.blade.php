<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        /* Card Hover Effect */
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease-in-out;
            cursor: pointer;
        }

        .card:hover {
            transform: translateY(-8px) scale(1.05);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
        }
    </style>

</head>

<body>

    @include('layouts.navbar')
    @include('layouts.sidebar')
    @include('layouts.message') 



    <!-- Main Content -->
    <div class="main-content" id="main">
        <h1 class="mb-4">Welcome, {{ Auth::user()->name ?? 'Admin' }}</h1>

        <div class="row g-4">
            <div class="col-md-3 col-sm-6">
                <a href="{{route('teacher.list')}}">
                    <div class="card bg-primary text-white text-center p-3">
                        <h4>Total Teachers</h4>
                        <p class="fs-3">{{$totalTeacher}}</p>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="{{route('admin.student.list')}}">
                    <div class="card bg-success text-white text-center p-3">

                        <h4>Total Students</h4>
                        <p class="fs-3">{{$totalStudent}}</p>

                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="{{route('course.list')}}">
                    <div class="card bg-warning text-dark text-center p-3">
                        <h4>Courses</h4>
                        <p class="fs-3">{{$totalCourse}}</p>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="{{route('users.list')}}">
                    <div class="card bg-danger text-white text-center p-3">
                        <h4>Users</h4>
                        <p class="fs-3">{{$totalUser}}</p>
                    </div>
                </a>
            </div>
        </div>

        <div class="card mt-5">
            <div class="card-header bg-dark text-white">Recent Activity</div>
            <div class="card-body">
                <ul>
                    <li>Teacher John added a new course</li>
                    <li>Student Alex registered for Math 101</li>
                    <li>Admin updated system settings</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }

        setTimeout(function() {
            let alert = document.querySelector('.alert');
            if (alert) {
                alert.style.display = 'none';
            }
        }, 3000);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>