<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Complete Teacher Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
       body {
            background-image:url("{{ asset('images/teacher.jpg') }}");
            background-size: cover;
            background-position: center;
            min-height: 100vh;
        }


        .form-card {
            background-color: rgba(0, 0, 0, 0.6);
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

        .form-control, .form-select {
            border-radius: 10px;
            border: 1px solid #4facfe;
            background: rgba(255, 255, 255, 0.8);
        }

        .form-control:focus, .form-select:focus {
            border-color: #00f2fe;
            box-shadow: 0 0 8px rgba(79, 172, 254, 0.6);
        }

        .form-label,
        .form-floating label {
            font-weight: bold;
            color: blue;
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
                <h2>Complete Teacher Profile</h2>
            </div>
            @include('layouts.message') 
            <form action="{{route('store.teacher')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="form_type" value="teacher">
                <div class="row g-3">
                    <!-- Full Name -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" required>
                            <label for="name">Full Name</label>
                        </div>
                    </div>

                    <!-- teacher id -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="teacher_id" name="teacher_id" placeholder="Teacher ID" required>
                            <label for="teacher_id">Teacher ID</label>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number">
                            <label for="phone">Phone Number</label>
                        </div>
                    </div>

                    <!-- Gender -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="gender" name="gender">
                                <option value="" disabled selected>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                            <label for="gender">Gender</label>
                        </div>
                    </div>

                    <!-- Date of Birth -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="dob" name="dob" placeholder="Date of Birth">
                            <label for="dob">Date of Birth</label>
                        </div>
                    </div>

                    <!-- Department -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="department" name="department" placeholder="Department">
                            <label for="department">Department</label>
                        </div>
                    </div>

                    <!-- Specialization -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="specialization" name="specialization" placeholder="Specialization">
                            <label for="specialization">Specialization</label>
                        </div>
                    </div>

                    <!-- Date of Joining -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="join_date" name="join_date" placeholder="Date of Joining">
                            <label for="join_date">Date of Joining</label>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                            <label for="address">Address</label>
                        </div>
                    </div>

                    <!-- Profile Picture -->
                    <div class="col-md-6">
                        <label class="form-label">Profile Picture</label>
                        <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event)">
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
