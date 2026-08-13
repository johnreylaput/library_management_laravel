@extends('layout.app')

@section('title', 'Review Deletion Requests')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-trash"></i> Review Deletion Requests</h2>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('info'))
    <div class="alert alert-info alert-dismissible fade show">
        {{ session('info') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<h4 class="mb-3"><i class="bi bi-hourglass-split"></i> Pending Requests</h4>

@if($pendingRequests->count() > 0)
    <div class="table-responsive mb-5">
        <table class="table table-striped table-bordered">
            <thead class="table-warning">
                <tr>
                    <th>Item Type</th>
                    <th>Title</th>
                    <th>Item ID</th>
                    <th>Requested By</th>
                    <th>Submitted At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pendingRequests as $req)
                    <tr>
                        <td><span class="badge bg-secondary">{{ $req->item_type }}</span></td>
                        <td>{{ $req->title }}</td>
                        <td>{{ $req->item_id }}</td>
                        <td>{{ $req->user->full_name ?? 'Unknown' }} <small class="text-muted">({{ $req->user->username ?? '' }})</small></td>
                        <td>{{ $req->created_at->format('Y-m-d h:i A') }}</td>
                        <td>
                            <form action="{{ route('deletion-requests.approve', $req->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Approve deletion of {{ addslashes($req->title) }}?')">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="bi bi-check-circle"></i> Approve
                                </button>
                            </form>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal-{{ $req->id }}">
                                <i class="bi bi-x-circle"></i> Reject
                            </button>

                            <div class="modal fade" id="rejectModal-{{ $req->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title">Reject Deletion Request</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('deletion-requests.reject', $req->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <p>Are you sure you want to reject the deletion request for <strong>{{ $req->title }}</strong>?</p>
                                                <div class="mb-3">
                                                    <label class="form-label">Rejection Reason (optional)</label>
                                                    <textarea name="rejection_reason" class="form-control" rows="3" placeholder="Provide a reason for rejection..."></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Reject</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="alert alert-info mb-5">
        <i class="bi bi-info-circle"></i> No pending deletion requests.
    </div>
@endif

<h4 class="mb-3"><i class="bi bi-clock-history"></i> Recently Resolved</h4>

@if($resolvedRequests->count() > 0)
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Item Type</th>
                    <th>Title</th>
                    <th>Requested By</th>
                    <th>Status</th>
                    <th>Reviewed By</th>
                    <th>Reviewed At</th>
                    <th>Rejection Reason</th>
                </tr>
            </thead>
            <tbody>
                @foreach($resolvedRequests as $req)
                    <tr>
                        <td><span class="badge bg-secondary">{{ $req->item_type }}</span></td>
                        <td>{{ $req->title }}</td>
                        <td>{{ $req->user->full_name ?? 'Unknown' }}</td>
                        <td>
                            @if($req->status === 'Approved')
                                <span class="badge bg-success">Approved</span>
                            @else
                                <span class="badge bg-danger">Rejected</span>
                            @endif
                        </td>
                        <td>{{ $req->reviewer->full_name ?? 'N/A' }}</td>
                        <td>{{ $req->reviewed_at ? $req->reviewed_at->format('Y-m-d h:i A') : 'N/A' }}</td>
                        <td>{{ $req->rejection_reason ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="alert alert-secondary">
        <i class="bi bi-info-circle"></i> No resolved deletion requests yet.
    </div>
@endif
@endsection
