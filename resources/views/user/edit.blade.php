@extends('layouts.default')
@section('title', 'Update User')
@section('content')

<head>
    <meta charset="UTF-8">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-image: url("{{asset('images/student.jpg')}}");
            background-size: cover;
            background-position: center;
            min-height: 100vh;
        }

        .form-card {
            background-color: rgba(0, 0, 0, 0.4);
            border-radius: 15px;
            padding: 30px;
            backdrop-filter: blur(10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            transition: box-shadow 0.3s ease;
        }

        .form-card:hover {
            box-shadow: 0 10px 30px rgba(45, 163, 206, 0.5),
                0 -10px 30px rgba(68, 86, 205, 0.5),
                10px 0 30px rgba(227, 22, 101, 0.5),
                -10px 0 30px rgba(213, 63, 218, 0.5);
        }

        .form-floating .form-control,
        .form-floating .form-select {
            height: 50px;
            padding: 0.75rem 1rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .form-floating .form-control:focus,
        .form-floating .form-select:focus {
            border: 2px solid #4facfe;
            box-shadow: 0 0 8px rgba(79, 172, 254, 0.5);
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .form-floating label {
            color: #ccc;
            transition: all 0.3s ease;
        }

        .form-floating input:focus~label,
        .form-floating input:not(:placeholder-shown)~label,
        .form-floating select:focus~label,
        .form-floating select:not([value=""])~label {
            color: #4facfe;
            font-size: 0.85rem;
            transform: translateY(-0.6rem);
        }

        h2 {
            color: #ffffff;
            font-weight: bold;
        }

        .btn-outline-primary {
            border: 1px solid #4facfe;
            color: #4facfe;
            background: transparent;
        }

        .btn-outline-primary:hover {
            background: #4facfe;
            color: #fff;
            transition: 0.3s;
        }

        .form-select {
            background: rgba(255, 255, 255, 0.05) !important;
            color: #fff !important;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .form-select:focus {
            background: rgba(255, 255, 255, 0.1) !important;
            color: #fff !important;
            border: 2px solid #4facfe;
            box-shadow: 0 0 8px rgba(79, 172, 254, 0.5);
        }

        .form-select option {
            background: #222 !important;
            color: #fff !important;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #aaa;
        }

        .password-toggle:hover {
            color: #fff;
        }

        .position-relative {
            position: relative;
        }
    </style>
</head>

<body>
    


    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-4">
            <div class="form-card">
                <h2 class="text-center mb-4">User update Form</h2>

              @include('layouts.message') 

                <form method="POST" action="{{ route('admin.user.update',$user->id) }}">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="form_type" value="user">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{old('name',$user->name)}}">
                        <label for="name">Name</label>
                        <div class="error-text" style="color: red">@error('name') {{ $message }} @enderror</div>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{old('email',$user->email)}}">
                        <label for="email">Email address</label>
                        <div class="error-text" style="color: red">@error('email') {{ $message }} @enderror</div>
                    </div>


                    @if(Auth::user()->role === 'admin')
                    <div class="form-floating mb-3">
                        <select class="form-select" id="role" name="role">
                            <option value="" disabled>Select Role</option>
                            <option value="student" {{ $user->role === 'student' ? 'selected' : '' }}>Student</option>
                            <option value="teacher" {{ $user->role === 'teacher' ? 'selected' : '' }}>Teacher</option>
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                    @endif

                    @if(Auth::user()->role ==='student' || Auth::user()->role ==='teacher')
                    <div class="form-floating mb-3 position-relative">
                        <input type="password" class="form-control" id="password" name="current_password" placeholder="Password">
                        <label for="password"> Password</label>
                        <i class="fa-solid fa-eye password-toggle" onclick="togglePassword('password', this)"></i>
                        <div class="error-text" style="color: red">@error('password') {{ $message }} @enderror</div>
                    </div>
                    @endif

                    @if(Auth::user()->role === 'admin')
                    <div class="d-flex justify-content-center align-items-center gap-3 mb-4">
                        <a href="{{route('users.list') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                        @elseif(Auth::user()->role ==='student')
                        <a href="{{route('update.profile') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                        @else

                        <a href="{{route('users.list') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                        @endif
                        <button type="submit" class="btn btn-primary">
                            Update User
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(id, icon) {
            const input = document.getElementById(id);
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>


</body>
@endsection