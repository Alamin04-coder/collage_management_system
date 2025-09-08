<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student/Teacher Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('{{ asset("images/bg1.jpg") }}') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }


        .profile-card {
            background-color: transparent;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            transition: box-shadow 0.3s ease;
            width: 100%;
            max-width: 500px;
        }

        .profile-card:hover {
            box-shadow: 0 10px 30px rgba(45, 163, 206, 0.5),
                0 -10px 30px rgba(68, 86, 205, 0.5),
                10px 0 30px rgba(227, 22, 101, 0.5),
                -10px 0 30px rgba(80, 12, 82, 0.5);
        }


        .profile-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 15px;
            border: 3px solid #4e73df;
            transition: transform 0.3s ease, border-color 0.3s ease;
        }

        .profile-img:hover {
            transform: scale(1.08);
            border-color: #1cc88a;
        }

        .profile-title {
            font-weight: 600;
            color: #333;
        }

        .profile-data {
            color: #666;
        }

        .btn-custom {
            background: #4e73df;
            color: white;
            border-radius: 25px;
            padding: 8px 20px;
            font-weight: bold;
            transition: background 0.3s ease, transform 0.2s ease;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }

        .btn-custom:hover {
            background: #1cc88a;
            transform: scale(1.05);
        }

        .profile-info p {
            background-color: transparent;
            padding: 0.5px;
            border-radius: 8px;
            margin-bottom: 8px;
            transition: background 0.3s ease, transform 0.2s ease;
            font-size: 17px;
            text-align: left;
        }

        .profile-info p:hover {
            background: #e2e6ea;
            transform: translateX(5px);
        }

        /* Small screens */
        @media (max-width: 576px) {
            .profile-card {
                width: 95%;
                padding: 15px;
            }

            .profile-img {
                width: 100px;
                height: 100px;
            }

            .profile-info p {
                font-size: 13px;
                
            }
        }
    </style>
</head>

<body>

    <div class="profile-card text-center" >
        <!-- Profile Image -->
        @if($teacher->image)
        <img src="{{ asset('teacher_images/'.$teacher->image) }}" alt="Profile Image" class="profile-img">
        @else
        <img src="{{ asset('images/logo2.png') }}" alt="Default Image" class="profile-img">
        @endif

        <!-- Profile Info -->
        <div class="profile-info text-start">
            <p><span class="profile-title">Name:</span> {{$teacher->name ?? 'not found'}}</p>
            <p><span class="profile-title">Teacher Id:</span> {{$teacher->teacher_id ?? 'not found'}}</p>
            <p><span class="profile-title">Phone:</span> {{$teacher->phone ?? 'not found'}}</p>
            <p><span class="profile-title">Gender:</span> {{$teacher->gender ?? 'not found'}}</p>
            <p><span class="profile-title">Date of Birth:</span> {{$teacher->dob ?? 'not found'}}</p>
            <p><span class="profile-title">Department :</span> {{$teacher->department ?? 'not found'}}</p>
            <p><span class="profile-title">Specialization:</span> {{$teacher->specialization ?? 'not found'}}</p>
            <p><span class="profile-title">Address:</span> {{$teacher->address ?? 'not found'}}</p>
            <p><span class="profile-title">Joining Date:</span> {{$teacher->join_date ?? 'not found'}}</p>
            <p><span class="profile-title">Role:</span> {{$teacher->user->role}}</p>
            <p><span class="profile-title">Account Created:</span>
        {{ Auth::user()->created_at->format('d M Y, h:i A') ?? 'not found' }}
      </p>
        </div>

        <div>
            <!-- Back Button -->
            <a href="{{ url()->previous() }}" class="btn btn-custom">⬅ Back</a>
            <form action="{{ route('destroy.user',Auth::user()->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
        </div>

</body>

</html>