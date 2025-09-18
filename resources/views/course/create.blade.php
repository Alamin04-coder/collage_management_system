<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Course</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .card {
      border-radius: 20px;
    }

    .form-floating input,
    .form-floating textarea,
    .form-floating select {
      border-radius: 10px;
    }

    .btn-primary,
    .btn-secondary {
      border-radius: 10px;
      font-size: 16px;
    }
  </style>
</head>

<body>

@include('layouts.message')

<div class="container">
  <div class="card shadow-lg mx-auto p-4" style="max-width: 600px;">
    <h2 class="text-center mb-4">Create New Course</h2>

    <form action="{{ route('course.store') }}" method="POST">
      @csrf
      <input type="hidden" name="form_type" value="course">

      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="course_name" name="course_name" placeholder="Course Name" required>
        <label for="course_name">Course Name</label>
      </div>

      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="course_fee" name="course_fee" placeholder="Course Fee" required>
        <label for="course_fee">Course Fee</label>
      </div>

      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="course_time" name="course_time" placeholder="Course Time" required>
        <label for="course_time">Course Time</label>
      </div>

      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="course_code" name="course_code" placeholder="Course Code" required>
        <label for="course_code">Course Code</label>
      </div>

      <div class="form-floating mb-3">
        <textarea class="form-control" placeholder="Description" id="description" name="description" style="height: 100px;" required></textarea>
        <label for="description">Description</label>
      </div>

      <div class="form-floating mb-3">
        <select class="form-select" id="teacher" name="teacher_id" required>
          <option value="" disabled selected>Select Teacher</option>
          @if($teachers && count($teachers) > 0)
            @foreach($teachers as $teacher)
              <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
            @endforeach
          @else
            <option value="">No Teacher Found</option>
          @endif
        </select>
        <label for="teacher">Assign Teacher</label>
      </div>

      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary flex-fill">Create Course</button>
        <a href="{{ route('course.list') }}" class="btn btn-secondary flex-fill">Cancel</a>
      </div>

    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
