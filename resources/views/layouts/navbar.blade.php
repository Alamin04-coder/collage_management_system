<style>
    /* Navbar Custom Style */
    .navbar-custom {
        background: linear-gradient(90deg, #1d2b64, #f89);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 0.8rem 2rem;
    }

    .navbar-custom .navbar-brand {
        font-weight: bold;
        font-size: 1.5rem;
        color: #fff;
        letter-spacing: 1px;
    }

    .navbar-custom .nav-link {
        color: #e0e0e0;
        margin-left: 1rem;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .navbar-custom .nav-link:hover {
        color: #fff;
        transform: scale(1.05);
    }

    .navbar-custom .navbar-toggler {
        border: none;
        outline: none;
        color: #fff;
    }

    .navbar-custom .dropdown-menu {
        border-radius: 8px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);

    }

    /* Optional: Small Screen Adjustments */
    @media (max-width: 768px) {
        .navbar-custom .nav-link {
            margin-left: 0;

        }
    }
</style>

<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    @if(Auth::user()->role === 'admin')
                    <a class="nav-link active" aria-current="page" href="{{route('admin.dashboard')}}">Home</a>
                    @elseif(Auth::user()->role === 'student')
                    <a class="nav-link active" aria-current="page" href="{{route('student.dashboard')}}">Home</a>
                    @elseif(Auth::user()->role === 'teacher')
                    <a class="nav-link active" aria-current="page" href="{{route('teacher.dashboard')}}">Home</a>
                    @endif
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @if(Auth::user()->role === 'student')
                        <img src="{{isset($student) && $student->image ? asset('student_images/'.$student->image) : asset('images/logo.png')}}" alt="student image" class="rounded-circle me-2" width="35" height="35">
                        @elseif(Auth::user()->role === 'teacher')
                        <img src="{{ isset($teacher)&& $teacher->image ? asset('teacher_images/'.$teacher->image) : asset('images/logo.png')}}" alt="Teacher image" class="rounded-circle me-2" width="35" height="35">
                        @elseif(Auth::user()->role === 'admin')
                        <img src="{{asset('images/admin.jpg')}}" alt="admin images" class="rounded-circle me-2" width="35" height="35">
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#userProfileModal">Profile</a></li>

                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>



    <!-- User Profile Modal -->
    <div class="modal fade" id="userProfileModal" tabindex="-1" aria-labelledby="userProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="userProfileModalLabel">User Profile</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-borderless">
                        <tr>
                            <th>Name:</th>
                            <td>{{ Auth::user()->name }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ Auth::user()->email }}</td>
                        </tr>
                        <tr>
                            <th>Role:</th>
                            <td>{{ Auth::user()->role}}</td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <a href="{{route('admin.user.edit',Auth::id())}}" class="btn btn-sm btn-primary">Edit profile</a>
                            </td>
                            <td>
                                @if(Auth::user()->role ==='teacher')
                                <a href="{{route('teacher.update.profile')}}" class="btn btn-sm btn-primary">personal information</a>
                                @elseif(Auth::user()->role === 'student')
                                <a href="{{route('update.profile')}}" class="btn btn-sm btn-primary">personal information</a>
                                @endif
                            </td>
                        </tr>
                    </table>

                    <!-- Change Password Form -->
                    <h6 class="mt-3">Change Password</h6>
                    <form method="POST" action="{{route('update.user.password',Auth::user()->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="mb-2">
                            <input type="password" name="current_password" class="form-control" placeholder="Current Password" required>
                        </div>
                        <div class="mb-2">
                            <input type="password" name="password" class="form-control" placeholder="New Password" required>
                        </div>
                        <div class="mb-2">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
</nav>