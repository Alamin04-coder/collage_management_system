<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .main-content {
            margin-left: 220px;
            padding: 20px;
            transition: all 0.3s ease;
        }
        @media (max-width: 991.98px) {
            .main-content {
                margin-left: 0;
                padding: 10px;
            }
        }
        table th {
            background-color: #343a40;
            color: white;
        }
        table tbody tr {
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        table tbody tr:hover {
            background-color: #f1f3f5;
            transform: scale(1.01);
        }
        .image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #dee2e6;
            transition: transform 0.3s ease, border-color 0.3s ease;
        }
        .image:hover {
            transform: scale(1.15);
            border-color: #0d6efd;
        }
        .btn-sm {
            transition: all 0.3s ease;
        }
        .btn-sm:hover {
            transform: scale(1.1);
            opacity: 0.9;
        }
        .card {
            border: none;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        .card:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        /* Responsive table */
        .table-responsive {
            overflow-x: auto;
        }
        @media (max-width: 767.98px) {
            .d-flex.justify-content-between {
                flex-direction: column !important;
                align-items: stretch !important;
                gap: 10px;
            }
            .main-content h1 {
                font-size: 1.5rem;
            }
            .table th, .table td {
                font-size: 0.85rem;
                padding: 0.4rem;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Menu Button (Small Screens) -->
    @include('layouts.sidebar')


    <!-- Main Content -->
    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">User List</h1>
            <a href="{{ route('user.create') }}" class="btn btn-primary">
                ➕ Add User
            </a>

            <form action="{{ route('users.list') }}" method="get" class="mb-3 d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search by Name, Role, Email..." value="{{$search}}">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
           @include('layouts.message') 

        @if($users->isEmpty())
        <div class="alert alert-info">
            No students found.
        </div>
        @else


        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th> 
                            <th>Role</th>   
                            <th>Account created</th>                       
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role}}</td>
                            <td>{{ $user->created_at ? $user->created_at->format('d M Y, h:i A') : 'not found' }}</td>
                            <td class="text-center">
                                <a href="{{route('admin.user.edit',$user->id)}}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{route('destroy.user',$user->id)}}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif

            </div>
            <div class="d-flex justify-content-center mt-4">
                {{$users->links()}}
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>