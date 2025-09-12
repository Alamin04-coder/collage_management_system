<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Course</title>
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

    .container {
      background: rgba(255, 255, 255, 0.9);
      padding: 40px;
      border-radius: 20px;
      width: 100%;
      max-width: 500px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    h1 {
      text-align: center;
      color: #333;
      margin-bottom: 30px;
    }

    .form-group {
      position: relative;
      margin-bottom: 25px;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
      width: 100%;
      padding: 14px 12px;
      border: 1px solid #ccc;
      border-radius: 10px;
      font-size: 16px;
      background: none;
    }

    .form-group label {
      position: absolute;
      left: 12px;
      top: 14px;
      color: #888;
      font-size: 16px;
      pointer-events: none;
      transition: 0.3s ease all;
    }

    .form-group input:focus+label,
    .form-group input:not(:placeholder-shown)+label,
    .form-group textarea:focus+label,
    .form-group textarea:not(:placeholder-shown)+label,
    .form-group select:focus+label,
    .form-group select:not([value=""])+label {
      top: -10px;
      left: 10px;
      font-size: 13px;
      background: #fff;
      padding: 0 5px;
      color: #667eea;
    }

    textarea {
      resize: none;
    }

    button {
      width: 100%;
      background: #667eea;
      color: #fff;
      padding: 12px;
      border: none;
      border-radius: 10px;
      font-size: 18px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    button:hover {
      background: #5a67d8;
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }
  </style>
</head>

<body>
@include('layouts.message') 

  <div class="container">
    <h1>Create New Course</h1>
    <form action="{{route('course.store')}}" method="POST">
      @csrf

      <input type="hidden" name="form_type" value="course">
      <div class="form-group">
        <input type="text" id="name" name="course_name" placeholder=" " required>
        <label for="course_name">Course Name</label>
      </div>
      <div class="form-group">
        <input type="text" id="name" name="course_fee" placeholder=" " required>
        <label for="course_fee">Course Fee</label>
      </div>
      <div class="form-group">
        <input type="text" id="name" name="course_time" placeholder=" " required>
        <label for="course_time">Course time</label>
      </div>

      <div class="form-group">
        <input type="text" id="code" name="course_code" placeholder=" " required>
        <label for="course_code">Course Code</label>
      </div>

      <div class="form-group">
        <textarea id="description" name="description" rows="4" placeholder=" " required></textarea>
        <label for="description">Description</label>
      </div>

      <div class="form-group">
        <select id="teacher" name="teacher_id" required>
          <option value="" disabled selected>Select teacher</option>
          @if($teachers && count($teachers) > 0)
          @foreach($teachers as $teacher)
          <option value="{{$teacher->id}}">{{$teacher->name}}</option>
          @endforeach
          @else
          <option value="">No teacher Found</option>
          @endif
        </select>
        <label for="teacher">Assign Teacher</label>
      </div>

      <button type="submit">Create Course</button>
    </form>
  </div>

</body>

</html>