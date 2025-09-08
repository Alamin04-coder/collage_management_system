<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teachers List</title>
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
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <h1 class="mb-0">Teacher List</h1>
            <a href="{{route('teacher.info')}}" class="btn btn-primary mb-2 mb-lg-0">
                ➕ Add Teacher
            </a>
            <form action="{{ route('teacher.list') }}" method="get" class="mb-3 d-flex flex-wrap" style="gap: 8px;">
                <input type="text" name="search" class="form-control me-2" placeholder="Search by Name, Class Roll, Board Roll..." value="{{ $search }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
        <div>
            @if (session('success'))
            <div class="alert alert-info alert-dismissible fade show"  style="text-align: center;" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (session('info'))
            <div class="alert alert-info alert-dismissible fade show" style="text-align: center;" role="alert">
                {{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger" >
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        @if($teachers->isEmpty())
        <div class="alert alert-info"  style="text-align: center;" >
            No Teachers found.
        </div>
        @else
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Teacher ID</th>
                                <th>Phone</th>
                                <th>Specialization</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Joining Date</th>
                                <th>Image</th>
                                <th class="text-center">View</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($teachers as $t_data)
                            <tr>
                                <td>{{$t_data->id}}</td>
                                <td>{{$t_data->name}}</td>
                                <td>{{$t_data->teacher_id}}</td>
                                <td>{{$t_data->phone}}</td>
                                <td>{{$t_data->specialization}}</td>
                                <td>{{$t_data->gender}}</td>
                                <td>{{$t_data->address}}</td>
                                <td>{{$t_data->join_date}}</td>
                                @if($t_data->image)
                                <td><img src="{{ asset('teacher_images/' . $t_data->image) }}" alt="Teacher Image" class="image"></td>
                                @else
                                <td><img src="{{ asset('images/logo2.png') }}" alt="Default Image" class="image"></td>
                                @endif
                                <td class="text-center">
                                    <a href="{{route('teacher.viewSingleTeacher',$t_data->id)}}" class="btn btn-sm btn-info">View</a>
                                </td>
                                <td class="text-center">
                                    <a href="{{route('teacher.edit',$t_data->id)}}" class="btn btn-sm btn-warning">Edit</a>
                                </td>
                                <td class="text-center">
                                    <form action="{{route('destroy.teacher',$t_data->id)}}" method="POST" class="d-inline">
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
                </div>
                @endif
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{$teachers->links()}}
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
