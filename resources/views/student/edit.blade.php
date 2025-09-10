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
            background-color: rgba(0, 0, 0, 0.6);
            /* transparent black for contrast */
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
                <h2>Edit Your Profile</h2>
            </div>
            <div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if (session('info'))

                <script>
                    alert("{{ session('info') }}");
                </script>

                @endif
            </div>
            <form action="{{route('admin.student.update',$students->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" value="{{old('name', $students->name)}}">
                            <label for="name">Full Name</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="session" name="session" placeholder="Session" value="{{old('session', $students->session)}}">
                            <label for="session">Session</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="department" name="department" placeholder="Department" value="{{old('department', $students->department)}}">
                            <label for="department">Department</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="class_roll" name="class_roll" placeholder="Class Roll" value="{{old('class_roll', $students->class_roll)}}">
                            <label for="class_roll">Class Roll</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="board_roll" name="board_roll" placeholder="Board Roll" value="{{old('board_roll', $students->board_roll)}}">
                            <label for="board_roll">Board Roll</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="registration_no" name="registration_no" placeholder="Registration No" value="{{old('registration_no', $students->registration_no)}}">
                            <label for="registration_no">Registration No</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="shift" name="shift" placeholder="Shift" value="{{old('shift', $students->shift)}}">
                            <label for="shift">Shift</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Profile Picture</label>
                        <input type="file" name="image" class="form-control" accept="image/*"
                            onchange="previewImage(event)">


                        @if(!empty($students->image))
                        <img id="preview"
                            src="{{ asset('student_images/' . $students->image) }}"
                            class="profile-img-preview"
                            alt="Profile Preview"
                            style="display:block;">
                        @else
                        <img id="preview"
                            class="profile-img-preview"
                            alt="Profile Preview"
                            style="display:none;">
                        @endif
                    </div>
                    
                    <div class="d-flex justify-content-center align-items-center gap-3 mb-4">
                        @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.student.list')}}" class="btn btn-secondary">
                            Cancel
                        </a>
                        @else
                        <a href="{{ route('update.profile')}}" class="btn btn-secondary">
                            Cancel
                        </a>
                        @endif

                        <button type="submit" class="btn btn-primary">
                            Update Profile
                        </button>
                    </div>

                </div>



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