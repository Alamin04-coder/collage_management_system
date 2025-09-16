<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Enrollment</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Course Enrollment Form</h4>
                    </div>
                    <div class="card-body">

                        @include('layouts.message')
                        <form action="{{route('enroll.course')}}" method="POST">
                            @csrf


                            <input type="hidden" name="form_type" value="course_enroll">
                            <div class="mb-3">
                                <label for="course" class="form-label">Course</label>
                                <input type="text" name="course" class="form-control" value="{{$course->course_name ??'name not found'}}">
                            </div>

                            <input type="hidden" name="course_id" value="{{$course->id}}">

                            <div class="mb-3">
                                <label for="teacher" class="form-label">Teacher</label>
                                <input type="text" name="teacher" class="form-control" value="{{$course->teacher->name}}">
                            </div>
                            <input type="hidden" name="teacher_id" value="{{$course->teacher->id}}">


                            <div class="mb-3">
                                <label for="student" class="form-label">Student</label>
                                <input type="text" name="student" class="form-control" value="{{Auth::user()->student->name ?? Auth::user()->name}}">
                            </div>

                            <input type="hidden" name="student_id" value="{{Auth::user()->student->id ?? Auth::id()}}">

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control">
                            </div>


                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>

                            <div class="d-flex justify-content-center align-items-center gap-3 mb-4">

                                <a href="{{ route('course.list')}}" class="btn btn-secondary">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Enroll Course
                                </button>
                            </div>


                        </form>


                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>