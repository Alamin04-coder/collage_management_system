@extends('layouts.default')
@section('title', 'Register')
@section('content')

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-image: url("images/background.jpg");
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

        h2 {
            color: #ffffff;
            font-weight: bold;
        }

        .form-floating .form-control {
            height: 50px;
            padding: 0.75rem 1rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .form-floating .form-control:focus {
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
        .form-floating input:not(:placeholder-shown)~label {
            color: #4facfe;
            font-size: 0.85rem;
            transform: translateY(-0.6rem);
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
                <h2 class="text-center mb-4">Register Form</h2>

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show text-center"
                    style="width: 400px; margin: 0 auto">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                        <label for="name">Name</label>
                        <div class="error-text" style="color: red">@error('name') {{ $message }} @enderror</div>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                        <label for="email">Email address</label>
                        <div class="error-text" style="color: red">@error('email') {{ $message }} @enderror</div>
                    </div>

                    <div class="form-floating mb-3 position-relative">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        <label for="password">Password</label>
                        <i class="fa-solid fa-eye password-toggle" onclick="togglePassword('password', this)"></i>
                        <div class="error-text" style="color: red">@error('password') {{ $message }} @enderror</div>
                    </div>

                    <div class="form-floating mb-3 position-relative">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                        <label for="password_confirmation">Confirm Password</label>
                        <i class="fa-solid fa-eye password-toggle" onclick="togglePassword('password_confirmation', this)"></i>
                        <div class="error-text" style="color: red">@error('password_confirmation') {{ $message }} @enderror</div>
                    </div>

                    <button type="submit" class="btn btn-outline-primary w-100">Sign Up</button>

                    <div class="text-center mt-3">
                        <p style="color: #ffffff">Already have an account?
                            <a href="{{ route('login') }}" style="color: #4facfe;">Login</a>
                        </p>
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
