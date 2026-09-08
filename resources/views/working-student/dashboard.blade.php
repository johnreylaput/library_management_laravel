@extends('layout.app')

@section('title', 'Working-Student Dashboard')

@section('content')
<div class="dashboard-header">
    <img src="{{ asset('images/templib.png') }}" alt="Library Management System" class="dashboard-logo">
</div>

@if(isset($receivedNotifications) && $receivedNotifications->count() > 0)
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <h4 class="alert-heading"><i class="bi bi-bell"></i> Notifications</h4>
        @foreach($receivedNotifications as $notification)
            <div class="mb-2">
                <strong>{{ $notification->title }}</strong>
                <p class="mb-1">{{ $notification->message }}</p>
                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
            </div>
        @endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        <i class="bi bi-info-circle"></i> {{ session('success') }}
    </div>
@endif
@if(session('info'))
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i> {{ session('info') }}
    </div>
@endif

<h1 class="mb-4"><i class="bi bi-speedometer2"></i> Working-Student Dashboard</h1>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-book"></i> Total Books</h5>
                <h2>{{ $stats['total_books'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-journal-arrow-down"></i> Total Periodicals</h5>
                <h2>{{ $stats['total_journals'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-file-earmark-text"></i> Total Theses</h5>
                <h2>{{ $stats['total_theses'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-dark">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-person-check"></i> My Borrows</h5>
                <h2>{{ $stats['my_borrowed'] }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-exclamation-triangle"></i> My Overdue</h5>
                <h2>{{ $stats['my_overdue'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-calendar-check"></i> Pending Reservations</h5>
                <h2>{{ $stats['my_reservations'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-secondary text-white">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-list-check"></i> My Deletion Requests</h5>
                <h2>{{ $stats['my_deletion_requests'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-dark">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-trash"></i> Items Pending Approval</h5>
                <h2>{{ $stats['my_deletion_requests'] }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5><i class="bi bi-person-check"></i> My Recent Borrows</h5>
                <a href="{{ route('borrow.index') }}" class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="card-body">
                @forelse($myBorrows as $borrow)
                    @php
                        $itemTitle = $borrow->book?->title ?? $borrow->journal?->title ?? $borrow->thesis?->title ?? 'Unknown Item';
                        $itemType = $borrow->book ? 'Book' : ($borrow->journal ? 'Journal' : ($borrow->thesis ? 'Thesis' : 'Item'));
                    @endphp
                    <div class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $itemTitle }}</strong>
                                <br><small class="text-muted">{{ $itemType }} - Due: {{ $borrow->due_date }}</small>
                            </div>
                            <span class="badge bg-{{ $borrow->status === 'Returned' ? 'success' : ($borrow->status === 'Overdue' ? 'danger' : 'warning') }}">
                                {{ $borrow->status }}
                            </span>
                        </li>
                    </div>
                @empty
                    <p class="text-muted">No borrow records yet.</p>
                @endforelse
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5><i class="bi bi-trash"></i> My Deletion Requests</h5>
                <a href="{{ route('deletion-requests.my-requests') }}" class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="card-body">
                @forelse($myDeletionRequests as $request)
                    @php
                        $statusBadge = [
                            'Pending' => 'bg-warning text-dark',
                            'Approved' => 'bg-success',
                            'Rejected' => 'bg-danger',
                            'Expired' => 'bg-secondary',
                        ][$request->status] ?? 'bg-info';
                    @endphp
                    <div class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $request->title }}</strong>
                                <br><small class="text-muted">{{ $request->item_type === 'App\Models\Book' ? 'Book' : ($request->item_type === 'App\Models\Journal' ? 'Journal' : 'Thesis') }}</small>
                                <br><small class="text-muted">Submitted: {{ $request->created_at->format('Y-m-d') }}</small>
                            </div>
                            <span class="badge {{ $statusBadge }}">{{ $request->status }}</span>
                        </li>
                    </div>
                @empty
                    <p class="text-muted">No deletion requests yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><h5><i class="bi bi-list-ul"></i> My Recent Activity</h5></div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @forelse($myActivityLogs as $log)
                        <li class="list-group-item">
                            <strong>{{ $log->username }}</strong> - {{ $log->action }}
                            <br><small class="text-muted">{{ $log->created_at->format('Y-m-d h:i:s A') }}</small>
                            @if($log->description)
                                <br><small>{{ $log->description }}</small>
                            @endif
                        </li>
                    @empty
                        <li class="list-group-item text-muted">No activity yet.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
