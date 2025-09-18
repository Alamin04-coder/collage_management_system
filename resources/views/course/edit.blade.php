<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Course</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

  @include('layouts.message')

  <div class="container py-5">
    <div class="card shadow-lg mx-auto" style="max-width: 600px;">
      <div class="card-body">
        <h2 class="card-title text-center mb-4">Update Course</h2>

        <form action="{{ route('course.update', $course->id) }}" method="POST">
          @csrf
          @method('PUT')
          <input type="hidden" name="form_type" value="course">

          <div class="mb-3 form-floating">
            <input type="text" class="form-control" id="course_name" name="course_name" placeholder="Course Name" value="{{ old('course_name', $course->course_name) }}" required>
            <label for="course_name">Course Name</label>
          </div>

          <div class="mb-3 form-floating">
            <input type="text" class="form-control" id="course_fee" name="course_fee" placeholder="Course Fee" value="{{ old('course_fee', $course->course_fee) }}" required>
            <label for="course_fee">Course Fee</label>
          </div>

          <div class="mb-3 form-floating">
            <input type="text" class="form-control" id="course_time" name="course_time" placeholder="Course Time" value="{{ old('course_time', $course->course_time) }}" required>
            <label for="course_time">Course Time</label>
          </div>

          <div class="mb-3 form-floating">
            <input type="text" class="form-control" id="course_code" name="course_code" placeholder="Course Code" value="{{ old('course_code', $course->course_code) }}" required>
            <label for="course_code">Course Code</label>
          </div>

          <div class="mb-3 form-floating">
            <textarea class="form-control" placeholder="Description" id="description" name="description" style="height: 100px;" required>{{ old('description', $course->description) }}</textarea>
            <label for="description">Description</label>
          </div>

          <div class="mb-3 form-floating">
            <select class="form-select" id="teacher" name="teacher_id" required>
              <option value="{{ $course->teacher->id }}">{{ $course->teacher->name }}</option>
              @if(Auth::user()->role === "admin")
                @if($teachers && count($teachers) > 0)
                  @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                  @endforeach
                @else
                  <option value="">No teacher Found</option>
                @endif
              @endif
            </select>
            <label for="teacher">Assign Teacher</label>
          </div>

          <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary flex-fill">Update Course</button>
            <a href="{{ route('course.list') }}" class="btn btn-secondary flex-fill">Cancel</a>
          </div>

        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
