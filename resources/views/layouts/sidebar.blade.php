<!-- resources/views/layouts/sidebar.blade.php -->
<style>
    /* Sidebar */
 .sidebar {
        height: 100vh;
        background-color: #343a40;
        padding-top: 20px;
        position: fixed;
        width: 220px;
        left: 0;
        top: 0;
        transition: all 0.3s ease;
        z-index: 1000;
    }
    .sidebar a {
        color: #ddd;
        display: block;
        padding: 12px 20px;
        text-decoration: none;
        transition: 0.3s;
    }
    .sidebar a:hover {
            background-color: #495057;
            color: #fff;
            padding-left: 30px;
            /* slide effect */
        }
    .main-content {
        margin-left: 220px;
        padding: 20px;
        transition: margin-left 0.3s ease;
    }
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }
    @media (max-width: 768px) {
        .sidebar {
            left: -220px;
        }
        .sidebar.active {
            left: 0;
        }
        .main-content {
            margin-left: 0;
        }
        .menu-toggle {
            display: block;
            position: fixed;
            top: 15px;
            left: 15px;
            background-color: #343a40;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            z-index: 1100;
        }
    }
    a{
        text-decoration: none;
    }
    .menu-toggle {
        display: none;
    }
</style>

<div class="sidebar" id="sidebar">
    <h4 class="text-white text-center mb-4">Admin Panel</h4>
    <a href="{{route('admin.dashboard')}}">Dashboard</a>
    <a href="{{route('teacher.list')}}">Manage Teachers</a>
    <a href="{{route('admin.student.list')}}">Manage Students</a>
    <a href="{{route('course.list')}}">Courses</a>
    <a href="{{route('users.list')}}">Users</a>
    <a href="{{ route('logout') }}" 
       onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
</div>
