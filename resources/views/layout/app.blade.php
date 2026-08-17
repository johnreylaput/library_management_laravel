<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Library Management System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { margin: 0; }
        .sidebar { min-height: 100vh; overflow-y: auto; }
        .sidebar .nav-link { padding: 0.5rem 1rem; }
        .sidebar .nav-link:hover { background-color: rgba(255,255,255,0.1); }
        .sidebar-logo {
            width: 60px;
            height: 60px;
            object-fit: contain;
            border-radius: 8px;
            background: white;
            padding: 4px;
        }
        .dashboard-logo {
            width: 100%;
            max-width: 100%;
            height: auto;
            object-fit: contain;
            object-position: center;
            display: block;
        }
        .dashboard-header {
            position: relative;
            width: 100%;
            overflow: visible;
            margin: 0 0 1.5rem 0;
            padding: 0;
            background: linear-gradient(135deg, rgba(30,60,114,0.85) 0%, rgba(42,82,152,0.85) 100%);
        }
        .sidebar h6 {
            font-size: 15px;
            line-height: 1.2;
        }
        .sidebar small {
            font-size: 11px;
            letter-spacing: 0.5px;
        }
        .alert {
            border-radius: 8px;
            font-size: 0.95rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            @include('layout.sidebar')
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i> <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('warning'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle"></i> <strong>Notice!</strong> {{ session('warning') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-x-circle"></i> <strong>Error!</strong> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
