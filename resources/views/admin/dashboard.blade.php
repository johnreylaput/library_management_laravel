@extends('layout.app')

@section('title', 'Dashboard')

@section('content')
<div class="dashboard-header">
    <img src="{{ asset('images/lgn.png') }}" alt="Library Management System" class="dashboard-logo">
</div>

@if(isset($showPendingAlert) && $showPendingAlert && ($stats['pending_borrow_requests'] > 0 || $stats['pending_reservation_requests'] > 0))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <h4><i class="bi bi-bell"></i> Pending Requests</h4>
    @if($stats['pending_borrow_requests'] > 0)
        <p>You have <strong>{{ $stats['pending_borrow_requests'] }}</strong> pending borrow request(s) waiting for approval.</p>
    @endif
    @if($stats['pending_reservation_requests'] > 0)
        <p>You have <strong>{{ $stats['pending_reservation_requests'] }}</strong> pending reservation request(s) waiting for approval.</p>
    @endif
    <a href="{{ route('borrow.index') }}" class="btn btn-primary btn-sm">Review Borrow Requests</a>
    <a href="{{ route('reservations.index') }}" class="btn btn-success btn-sm">Review Reservations</a>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-book"></i> Books</h5>
                <h2>{{ $stats['total_books'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-people"></i> Members</h5>
                <h2>{{ $stats['total_members'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-dark">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-journal-arrow-down"></i> Borrowed</h5>
                <h2>{{ $stats['total_borrowed'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-exclamation-triangle"></i> Overdue</h5>
                <h2>{{ $stats['total_overdue'] }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card border-warning">
            <div class="card-header bg-warning text-dark">
                <h5><i class="bi bi-bell"></i> Due Date Alerts</h5>
            </div>
            <div class="card-body">
                @if($dueBorrows->count() > 0 || $dueReservations->count() > 0)
                    @if($dueBorrows->count() > 0)
                        <h6 class="mb-3">Borrows Due Soon</h6>
                        <div class="list-group list-group-flush mb-3">
                            @foreach($dueBorrows as $borrow)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $borrow->member->user->full_name ?? 'Unknown' }}</strong>
                                        <br><small class="text-muted">Book: {{ $borrow->book->title ?? 'Unknown' }}</small>
                                        <br><small class="text-muted">Due: {{ $borrow->due_date }}</small>
                                        @if($borrow->due_date === now()->toDateString())
                                            <span class="badge bg-danger">Due Today</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Due Tomorrow</span>
                                        @endif
                                    </div>
                                    <form action="{{ route('notifications.send') }}" method="POST" class="d-inline" onsubmit="return confirm(`Send due date notification to {{ $borrow->member->user->full_name ?? 'this member' }}?`)">
                                        @csrf
                                        <input type="hidden" name="type" value="borrow">
                                        <input type="hidden" name="record_id" value="{{ $borrow->id }}">
                                        <input type="hidden" name="title" value="Book Due Date Reminder">
                                        <input type="hidden" name="message" value="The book {{ $borrow->book->title ?? 'your borrowed book' }} is due on {{ $borrow->due_date }}. Please return it on time.">
                                        <button type="submit" class="btn btn-primary btn-sm">Notify</button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @if($dueReservations->count() > 0)
                         <h6 class="mb-3">Reservations Due Soon</h6>
                        <div class="list-group list-group-flush">
                            @foreach($dueReservations as $reservation)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $reservation->member->user->full_name ?? 'Unknown' }}</strong>
                                        <br><small class="text-muted">Book: {{ $reservation->book->title ?? 'Unknown' }}</small>
                                        <br><small class="text-muted">Due: {{ $reservation->due_date }}</small>
                                        <span class="badge bg-info">Due Soon</span>
                                    </div>
                                    <form action="{{ route('notifications.send') }}" method="POST" class="d-inline" onsubmit="return confirm(`Send reservation reminder to {{ $reservation->member->user->full_name ?? 'this member' }}?`)">
                                        @csrf
                                        <input type="hidden" name="type" value="reservation">
                                        <input type="hidden" name="record_id" value="{{ $reservation->id }}">
                                        <input type="hidden" name="title" value="Reservation Expiring Soon">
                                        <input type="hidden" name="message" value="Your reservation for {{ $reservation->book->title ?? 'the book' }} is due on {{ $reservation->due_date }}. Please borrow it before the due date.">
                                        <button type="submit" class="btn btn-primary btn-sm">Notify</button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @else
                    <p class="text-muted mb-0">No upcoming due dates or expirations within 1 day.</p>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Pending Reservation Requests</h5>
                <a href="{{ route('reservations.index') }}" class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="card-body">
                @if($pendingBorrows->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($pendingBorrows as $borrow)
                            @php
                                $itemTitle = $borrow->book?->title ?? $borrow->journal?->title ?? $borrow->thesis?->title ?? 'Unknown Item';
                                $itemType = $borrow->book ? 'Book' : ($borrow->journal ? 'Journal' : ($borrow->thesis ? 'Thesis' : 'Item'));
                            @endphp
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $borrow->member->user->full_name ?? 'Unknown Member' }}</strong>
                                        <br><small class="text-muted">{{ $itemType }}: {{ $itemTitle }}</small>
                                        <br><small class="text-muted">Due: {{ $borrow->due_date }}</small>
                                    </div>
                                    <div>
                                        <form action="{{ route('borrow.approve', $borrow->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Approve this borrow request?')">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success"><i class="bi bi-check"></i> Approve</button>
                                        </form>
                                        <form action="{{ route('borrow.reject', $borrow->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Reject this borrow request?')">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-x"></i> Reject</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">No pending borrow requests.</p>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Pending Reservation Requests</h5>
                <a href="{{ route('reservations.index') }}" class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="card-body">
                @if($pendingReservations->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($pendingReservations as $reservation)
                            @php
                                $itemTitle = $reservation->book?->title ?? $reservation->journal?->title ?? $reservation->thesis?->title ?? 'Unknown Item';
                                $itemType = $reservation->book ? 'Book' : ($reservation->journal ? 'Journal' : ($reservation->thesis ? 'Thesis' : 'Item'));
                            @endphp
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $reservation->member->user->full_name ?? 'Unknown Member' }}</strong>
                                        <br><small class="text-muted">{{ $itemType }}: {{ $itemTitle }}</small>
                                        <br><small class="text-muted">Reservation Date: {{ $reservation->reservation_date }}</small>
                                        <br><small class="text-muted">Due Date: {{ $reservation->due_date }}</small>
                                    </div>
                                    <div>
                                        <form action="{{ route('reservations.approve', $reservation->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Approve this reservation?')">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success"><i class="bi bi-check"></i> Approve</button>
                                        </form>
                                        <form action="{{ route('reservations.reject', $reservation->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Reject this reservation?')">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-x"></i> Reject</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">No pending reservation requests.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h5>Recent Activity</h5></div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @foreach($recentLogs as $log)
                        <li class="list-group-item">
                            <strong>{{ $log->username }}</strong> - {{ $log->action }}
                            <br><small class="text-muted">{{ $log->created_at->format('Y-m-d h:i:s A') }}</small>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><h5>Quick Stats</h></div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between">
                    <span>Pending Borrow Requests</span>
                    <span class="badge bg-warning">{{ $stats['pending_borrow_requests'] }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Pending Reservation Requests</span>
                    <span class="badge bg-info">{{ $stats['pending_reservation_requests'] }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total Fines</span>
                    <span class="badge bg-danger">{{ $stats['total_fines'] }}</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
