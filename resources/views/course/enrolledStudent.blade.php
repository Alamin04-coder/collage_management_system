<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Student Course Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .main-content {
            padding: 20px;
        }

        h1 {
            font-weight: bold;
            color: #343a40;
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
    </style>
</head>
<body>

@if(Auth::user()->role ==="admin")
@include('layouts.sidebar')
@endif
@include('layouts.navbar')

<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <h1 class="mb-0">📚 Teacher-Student Course List</h1>
        
         <form action="{{ route('enrolled') }}" method="get" class="d-flex flex-wrap mt-2 mt-lg-0" style="gap: 8px;">
            <input type="text" name="search" class="form-control" 
                placeholder="Search by Name, Code..." value="{{$search}}">
            <button type="submit" class="btn btn-outline-primary">Search</button>
        </form>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Teacher Name</th>
                            <th>Student Name</th>
                            <th>Date</th>
                            <th>Course Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($course as $course_data)
                        <tr>
                            <td>{{$course_data->id}}</td>
                            <td>{{$course_data->course->course_name}}</td>
                            <td>{{$course_data->teacher->name}}</td>
                            <td>{{$course_data->student->name}}</td>
                            <td>{{$course_data->created_at}}</td>
                        </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
