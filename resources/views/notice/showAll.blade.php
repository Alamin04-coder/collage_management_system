<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notice List</title>
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
      text-align: left;
      white-space: nowrap;
    }

    table td {
      vertical-align: middle;
      text-align: left;
      word-wrap: break-word;
      white-space: normal;
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

    
      .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 5px;
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
      <h1 class="mb-0">📢 Notice List</h1>

      @if(Auth::user()->role !== 'student')
        <a href="{{ route('notice.create') }}" class="btn btn-primary mb-2 mb-lg-0">
          ➕ Add Notice
        </a>
      @endif
    </div>

    
    @include('layouts.message')

    @if($notices->isEmpty())
      <div class="alert alert-info text-center">
        No notices found.
      </div>
    @else
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover align-middle">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Published Date</th>
                  <th>View</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                @foreach($notices as $notice)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $notice->title }}</td>
                    <td>{{ Str::limit($notice->description, 50) }}</td>
                    <td>{{ $notice->created_at->format('d M, Y') }}</td>
                    <td>
                     
                        <a href="#" class="btn btn-sm btn-info">Details</a>
                    </td>

                        @if(Auth::user()->role !== "student")
                        <td>
                          <a href="{{ route('notice.edit',$notice->id) }}" class="btn btn-sm btn-warning">Edit</a>
                          </td>
                          <td>
                          <form action="{{ route('notice.destroy',$notice->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                              onclick="return confirm('Are you sure?')">Delete</button>
                          </form>
                          </td>
                        @endif
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    @endif
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
