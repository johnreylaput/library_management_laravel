@extends('layout.app')

@section('title', 'My Profile')

@section('content')
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
<h2 class="mb-4">My Profile</h2>
<div class="card mb-4">
    <div class="card-body">
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Full Name</label>
                    <input type="text" name="full_name" class="form-control" value="{{ $user->full_name }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Update Profile</button>
        </form>
    </div>
</div>

<h4 class="mb-3">Borrowing History</h4>
<table class="table table-striped">
    <thead class="table-dark">
        <tr>
            <th>Book</th>
            <th>Borrow Date</th>
            <th>Due Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($borrowRecords as $record)
            <tr>
                <td>{{ $record->book->title ?? 'Book' }}</td>
                <td>{{ $record->borrow_date }}</td>
                <td>{{ $record->due_date }}</td>
                <td>
                    <span class="badge bg-{{ $record->status === 'Returned' ? 'success' : ($record->status === 'Overdue' ? 'danger' : 'warning') }}">
                        {{ $record->status }}
                    </span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
