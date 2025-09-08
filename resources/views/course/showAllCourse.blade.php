<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        background-color: #f4f6f9;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .main-content {
        padding: 20px;
        transition: all 0.3s ease;
    }

    /* যখন sidebar থাকবে তখন */
    .with-sidebar .main-content {
        margin-left: 220px;
    }

    @media (max-width: 991.98px) {
        .with-sidebar .main-content {
            margin-left: 0;
            padding: 10px;
        }
    }

    h1 {
        font-weight: bold;
        color: #343a40;
    }

    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-weight: 500;
    }

    table th {
        background-color: #343a40;
        color: white;
        text-align: center;
    }

    table td {
        vertical-align: middle;
        text-align: center;
    }

    table tbody tr:hover {
        background-color: #f8f9fa;
        transition: 0.3s;
    }

    .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
    }

    .card-body {
        padding: 0;
    }

    .table-responsive {
        padding: 20px;
    }

    .alert {
        border-radius: 8px;
    }

    /* Responsive tweaks */
    @media (max-width: 767.98px) {
        .d-flex.justify-content-between {
            flex-direction: column !important;
            align-items: stretch !important;
            gap: 10px;
        }

        h1 {
            font-size: 1.4rem;
            text-align: center;
        }

        .btn-primary {
            width: 100%;
            justify-content: center;
        }
    }
</style>

</head>
<body>

@if(Auth::user()->role === 'admin')
   
    @include('layouts.sidebar')
@endif
 @include('layouts.navbar')

<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <h1 class="mb-0">📚 Course List</h1>

        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'teacher')
        <a href="{{ route('create.course.page') }}" class="btn btn-primary mb-2 mb-lg-0">
            ➕ Add Course
        </a>
        @endif

        <form action="{{ route('course.list') }}" method="get" class="d-flex flex-wrap mt-2 mt-lg-0" style="gap: 8px;">
            <input type="text" name="search" class="form-control" 
                placeholder="Search by Name, Code..." value="{{ $search }}">
            <button type="submit" class="btn btn-outline-primary">Search</button>
        </form>
    </div>

    <!-- Alerts -->
    <div>
        @if (session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif
        @if (session('info'))
            <div class="alert alert-info text-center">{{ session('info') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    @if($course->isEmpty())
        <div class="alert alert-info text-center">
            No courses found.
        </div>
    @else
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Teacher</th>
                            <th>Fee</th>
                            <th>Code</th>
                            <th>Time</th>
                            <th>Description</th>
                            <th>View</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($course as $c_info)
                        <tr>
                            <td>{{ $c_info->id }}</td>
                            <td>{{ $c_info->course_name }}</td>
                            <td>{{ $c_info->teacher_id }}</td>
                            <td>{{ $c_info->course_fee }}</td>
                            <td>{{ $c_info->course_code }}</td>
                            <td>{{ $c_info->course_time }}</td>
                            <td>{{ $c_info->description }}</td>
                            <td>
                                <a href="{{ route('single.course',$c_info->id) }}" class="btn btn-sm btn-info">View</a>
                            </td>
                            <td>
                                <a href="{{ route('course.edit',$c_info->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('course.destroy',$c_info->id) }}" method="POST" class="d-inline">
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
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $course->links() }}
    </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
