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
            width: calc(100% + 4px);
            max-width: none;
            height: auto;
            object-fit: contain;
            object-position: center;
            image-rendering: auto;
            backface-visibility: hidden;
            transform: translateZ(0);
            display: block;
            margin-right: -4px;
        }
        .dashboard-header {
            position: relative;
            width: calc(100% + 2rem);
            max-width: none;
            overflow: hidden;
            margin: -1rem 0 -1rem -1rem;
            padding: 0;
            background: linear-gradient(135deg, rgba(30,60,114,0.85) 0%, rgba(42,82,152,0.85) 100%);
        }
        @media (min-width: 768px) {
            .dashboard-header {
                margin: -1.5rem 0 -1.5rem -1.5rem;
            }
        }
        .sidebar h6 {
            font-size: 15px;
            line-height: 1.2;
        }
        .sidebar small {
            font-size: 11px;
            letter-spacing: 0.5px;
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
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('warning'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('warning') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
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
