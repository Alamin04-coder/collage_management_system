<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Complete Your Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url("{{asset('images/student.jpg')}}");
            background-size: cover;
            background-position: center;
            min-height: 100vh;
        }

        .form-card {
            background-color: rgba(0, 0, 0, 0.6); /* transparent black for contrast */
            border-radius: 15px;
            padding: 30px;
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

        .btn-primary {
            background-color: #4facfe;
            border: none;
        }

        .btn-primary:hover {
            background-color: #00f2fe;
            transition: background-color 0.3s ease;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #4facfe;
            background: rgba(255, 255, 255, 0.8);
        }

        .form-control:focus {
            border-color: #00f2fe;
            box-shadow: 0 0 8px rgba(79, 172, 254, 0.6);
        }

        .form-label,
        .form-floating label {
            font-weight: bold;
            color:blue;
            font-size: 1rem;
        }

        .profile-img-preview {
            display: none;
            margin-top: 10px;
            border-radius: 50%;
            width: 120px;
            height: 120px;
            object-fit: cover;
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="form-card w-75">
            <div class="text-center mb-4">
                <h2>Complete Your Profile</h2>
            </div>
                @include('layouts.message') 

            <form action="{{route('student.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="form_type" value="student">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Full Name">
                            <label for="name">Full Name</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="session" name="session" placeholder="Session">
                            <label for="session">Session</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="department" name="department" placeholder="Department">
                            <label for="department">Department</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="class_roll" name="class_roll" placeholder="Class Roll">
                            <label for="class_roll">Class Roll</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="board_roll" name="board_roll" placeholder="Board Roll">
                            <label for="board_roll">Board Roll</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="registration_no" name="registration_no" placeholder="Registration No">
                            <label for="registration_no">Registration No</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="shift" name="shift" placeholder="Shift">
                            <label for="shift">Shift</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Profile Picture</label>
                        <input type="file" name="image" class="form-control" accept="image/*"
                            onchange="previewImage(event)" required>
                        <img id="preview" class="profile-img-preview" alt="Profile Preview">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 mt-4">Save Profile</button>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

</body>

</html>
