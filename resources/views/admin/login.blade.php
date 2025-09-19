@extends('layouts.default')
@section('title', 'Login')
@section('content')

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-image: url("{{ asset('images/loginPage.jpg') }}");
            background-size: cover;
            background-position: center;
            min-height: 100vh;
        }

        .form-card {
            background-color: rgba(0, 0, 0, 0.4);
            /* Glassy effect */
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
                -10px 0 30px rgba(80, 12, 82, 0.5);
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

        .form-check-label {
            color: #4facfe;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-4">
            <div class="form-card">
                <h2 class="text-center mb-4">Login Form</h2>

                @include('layouts.message')

                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf

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

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>

                    <button type="submit" class="btn btn-outline-primary w-100">Login</button>
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