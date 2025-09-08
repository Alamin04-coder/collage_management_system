<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Student & User Info</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .card {
      transition: all 0.4s ease;
    }

    .card:hover {
      transform: translateY(-12px) scale(1.05);
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
    }

    .card img {
      transition: transform 0.4s ease, box-shadow 0.4s ease;
    }

    .card:hover img {
      transform: scale(1.1);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
    }
  </style>
</head>

<body class="bg-gradient-to-r from-blue-200 via-purple-200 to-pink-200 min-h-screen flex items-center justify-center p-6">

  @if (session('success'))
  <div class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg animate-bounce">
    {{ session('success') }}
  </div>
  @endif

  @if (session('info'))
  <script>
    alert("{{ session('info') }}");
  </script>
  @endif

  @if ($errors->any())
  <div class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <div class="grid grid-cols-1 md:grid-cols-3 gap-8 w-full max-w-6xl">
    <!-- Student Info Card -->
    <div class="card bg-white/70 backdrop-blur-md rounded-2xl shadow-xl p-6 flex flex-col items-center text-center border border-white/30">
      <img src="{{ asset('teacher_images/'.$teacher->image) ?? 'no image'}}" alt="Teacher image"
        class="rounded-full w-32 h-32 mb-4 shadow-md">
      <h2 class="text-2xl font-bold text-gray-800 mb-2">🎓 Teacher Info</h2>
      <p class="text-gray-600 mb-4">Update your personal Information.</p>
      <a href="{{route('teacher.edit',$teacher->id)}}">
        <button
          class="px-5 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow-md transition duration-300">Update Details</button>
      </a>
    </div>

    <!-- User Info Card -->
    <div class="card bg-white/70 backdrop-blur-md rounded-2xl shadow-xl p-6 flex flex-col items-center text-center border border-white/30">
      <img src="{{ asset('images/image.png') ?? 'no image'}}" alt="User"
        class="rounded-full w-32 h-32 mb-4 shadow-md">
      <h2 class="text-2xl font-bold text-gray-800 mb-2">👤 User Info</h2>
      <p class="text-gray-600 mb-4">Update your username, email, and password.</p>
      <a href="{{route('admin.user.edit',Auth::user()->id)}}">
        <button
          class="px-5 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg shadow-md transition duration-300">Update Details</button>
      </a>
    </div>

    <!-- Your Information -->
    <div class="card bg-white/70 backdrop-blur-md rounded-2xl shadow-xl p-6 flex flex-col items-center text-center border border-white/30">
      <img src="{{ asset('teacher_images/'.$teacher->image) ?? 'no image'}}" alt="teacher image"
        class="rounded-full w-32 h-32 mb-4 shadow-md">
      <h2 class="text-2xl font-bold text-gray-800 mb-2">📜 Your Information</h2>
      <p class="text-gray-600 mb-4">See your personal Details.</p>
      <a href="{{route('teacher.viewSingleTeacher',$teacher->id)}}">
        <button
          class="px-5 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded-lg shadow-md transition duration-300">See Details</button>
      </a>
    </div>
  </div>
</body>

</html>
