@extends('layout.app')

@section('title', 'My Dashboard')

@section('content')
<div class="dashboard-header">
    <img src="{{ asset('images/lgn.png') }}" alt="Library Management System" class="dashboard-logo">
</div>
@if(isset($receivedNotifications) && $receivedNotifications->count() > 0)
    @php
        $deletionResultNotifications = $receivedNotifications->filter(fn($notification) => $notification->type === 'deletion_request');
        $otherNotifications = $receivedNotifications->filter(fn($notification) => $notification->type !== 'deletion_request');
    @endphp

    @if($deletionResultNotifications->count() > 0)
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <h4 class="alert-heading"><i class="bi bi-check2-circle"></i> Request Results</h4>
            @foreach($deletionResultNotifications as $notification)
                @php
                    $alertType = str_contains($notification->title, 'Approved') ? 'alert-success' : 'alert-danger';
                    $icon = str_contains($notification->title, 'Approved') ? 'bi-check-circle' : 'bi-x-circle';
                @endphp
                <div class="mb-2 p-2 border rounded {{ $alertType }} bg-opacity-10">
                    <strong><i class="bi {{ $icon }}"></i> {{ $notification->title }}</strong>
                    <p class="mb-1">{{ $notification->message }}</p>
                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                </div>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($otherNotifications->count() > 0)
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <h4 class="alert-heading"><i class="bi bi-bell"></i> Notifications</h4>
            @foreach($otherNotifications as $notification)
                <div class="mb-2">
                    <strong>{{ $notification->title }}</strong>
                    <p class="mb-1">{{ $notification->message }}</p>
                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                </div>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@endif
@if(isset($dueNotifications) && $dueNotifications->count() > 0)
    @foreach($dueNotifications as $notification)
        <div class="alert alert-{{ $notification['type'] }} alert-dismissible fade show" role="alert">
            <h4 class="alert-heading"><i class="bi {{ $notification['icon'] }}"></i> {{ $notification['title'] }}</h4>
            <p>{!! $notification['message'] !!}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endforeach
@endif
@if(isset($welcomeType) && $welcomeType === 'new')
    <div class="alert alert-success">
        <h4 class="alert-heading"><i class="bi bi-person-check"></i> Welcome, {{ Auth::user()->full_name }}!</h4>
        <p>Your account has been successfully registered. Here is your dashboard overview.</p>
    </div>
@else
    <div class="alert alert-success">
        <h4 class="alert-heading"><i class="bi bi-person-check"></i> Welcome Back, {{ Auth::user()->full_name }}!</h4>
        <p>Here's your dashboard overview.</p>
    </div>
@endif
<h1 class="mb-4"><i class="bi bi-speedometer2"></i> My Dashboard</h1>

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
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-journal-arrow-down"></i> My Borrowed</h5>
                <h2>{{ $stats['my_borrowed'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-dark">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-calendar-check"></i> My Reservations</h5>
                <h2>{{ $stats['my_reservations'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-exclamation-triangle"></i> My Overdue</h5>
                <h2>{{ $stats['my_overdue'] }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><h5>My Recent Borrows</h5></div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @forelse($borrows as $borrow)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $borrow->book->title ?? 'Book' }}
                            <span class="badge bg-{{ $borrow->status === 'Returned' ? 'success' : ($borrow->status === 'Overdue' ? 'danger' : 'warning') }}">
                                {{ $borrow->status }}
                            </span>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">No borrow records yet.</li>
                    @endforelse
                </ul>
                <div class="mt-3">
                    <a href="{{ route('member.borrow.index') }}" class="btn btn-primary btn-sm"><i class="bi bi-search"></i> Browse Books to Borrow</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><h5>My Reservations</h5></div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @forelse($reservations as $reservation)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $reservation->book->title ?? 'Book' }}
                            <span class="badge bg-info">{{ $reservation->status }}</span>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">No reservations yet.</li>
                    @endforelse
                </ul>
                <div class="mt-3">
                    <a href="{{ route('member.reservation.index') }}" class="btn btn-success btn-sm"><i class="bi bi-calendar-check"></i> Browse Books to Reserve</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><h5>My Fines</h5></div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @forelse($fines as $fine)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $fine->reason ?? 'Fine' }}
                            <span class="badge bg-danger">${{ number_format($fine->amount ?? 0, 2) }}</span>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">No fines yet.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
