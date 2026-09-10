@extends('layout.app')

@section('title', 'My Deletion Requests')

@section('content')
@php
    $deletionNotifications = \App\Models\Notification::where('user_id', auth()->id())
        ->where('type', 'deletion_request')
        ->where('is_read', false)
        ->latest()
        ->take(5)
        ->get();
@endphp

@if($deletionNotifications->count() > 0)
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <h4 class="alert-heading"><i class="bi bi-bell"></i> Request Updates</h4>
        @foreach($deletionNotifications as $notification)
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
    </div>
@endif

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-list-check"></i> My Deletion Requests</h2>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('info'))
    <div class="alert alert-info alert-dismissible fade show">
        {{ session('info') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if($requests->count() > 0)
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Item Type</th>
                    <th>Title</th>
                    <th>Item ID</th>
                    <th>Submitted At</th>
                    <th>Status</th>
                    <th>Reviewed By</th>
                    <th>Reviewed At</th>
                    <th>Rejection Reason</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $req)
                    <tr>
                        <td>
                            @php
                                $typeLabel = 'Unknown';
                                if ($req->item_type === \App\Models\Book::class) $typeLabel = 'Book';
                                elseif ($req->item_type === \App\Models\Journal::class) $typeLabel = 'Journal';
                                elseif ($req->item_type === \App\Models\Thesis::class) $typeLabel = 'Thesis';
                            @endphp
                            <span class="badge bg-secondary">{{ $typeLabel }}</span>
                        </td>
                        <td>{{ $req->title }}</td>
                        <td>{{ $req->item_id }}</td>
                        <td>{{ $req->created_at->format('Y-m-d h:i A') }}</td>
                        <td>
                            @if($req->status === 'Pending')
                                <span class="badge bg-warning text-dark">
                                    <i class="bi bi-hourglass-split"></i> Pending
                                </span>
                            @elseif($req->status === 'Approved')
                                <span class="badge bg-success">
                                    <i class="bi bi-check-circle"></i> Accepted
                                </span>
                            @elseif($req->status === 'Rejected')
                                <span class="badge bg-danger">
                                    <i class="bi bi-x-circle"></i> Rejected
                                </span>
                            @elseif($req->status === 'Expired')
                                <span class="badge bg-secondary">
                                    <i class="bi bi-clock"></i> Expired
                                </span>
                            @endif
                        </td>
                        <td>{{ $req->reviewer->full_name ?? 'N/A' }}</td>
                        <td>{{ $req->reviewed_at ? $req->reviewed_at->format('Y-m-d h:i A') : 'N/A' }}</td>
                        <td>
                            @if($req->status === 'Rejected' && $req->rejection_reason)
                                <div class="alert alert-danger mb-0 py-2 px-3">
                                    <i class="bi bi-exclamation-triangle"></i> {{ $req->rejection_reason }}
                                </div>
                            @elseif($req->status === 'Approved')
                                <span class="text-success"><i class="bi bi-check"></i> Item was moved to Recently Deleted.</span>
                            @else
                                <span class="text-muted">Awaiting maria.librarian review...</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i> You haven't submitted any deletion requests yet.
    </div>
@endif
@endsection
