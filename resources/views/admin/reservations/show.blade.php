@extends('layout.app')

@section('title', 'Reservation Details')

@section('content')
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <h4>Reservation Request #{{ $reservation->id }}</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5>Member Information</h5>
                <p><strong>Name:</strong> {{ $reservation->member->user->full_name ?? '-' }}</p>
                <p><strong>Member No:</strong> {{ $reservation->member->member_no ?? '-' }}</p>
                <p><strong>Course:</strong> {{ $reservation->member->course ?? '-' }}</p>
                <p><strong>Year Level:</strong> {{ $reservation->member->year_level ?? '-' }}</p>
                <p><strong>Contact:</strong> {{ $reservation->member->contact_number ?? '-' }}</p>
                <p><strong>Address:</strong> {{ $reservation->member->address ?? '-' }}</p>
            </div>
            <div class="col-md-6">
                @if($reservation->book)
                    <h5>Book Information</h5>
                    <p><strong>Title:</strong> {{ $reservation->book->title ?? '-' }}</p>
                    <p><strong>ISBN:</strong> {{ $reservation->book->isbn ?? '-' }}</p>
                    <p><strong>Author:</strong> {{ $reservation->book->author->author_name ?? '-' }}</p>
                    <p><strong>Category:</strong> {{ $reservation->book->category->category_name ?? '-' }}</p>
                    <p><strong>Status:</strong> {{ $reservation->book->status ?? '-' }}</p>
                    <p><strong>Available Quantity:</strong> {{ $reservation->book->available_quantity ?? 0 }}</p>
                @elseif($reservation->journal)
                    <h5>Journal Information</h5>
                    <p><strong>Title:</strong> {{ $reservation->journal->title ?? '-' }}</p>
                    <p><strong>Journal Name:</strong> {{ $reservation->journal->journal_name ?? '-' }}</p>
                    <p><strong>Authors:</strong> {{ $reservation->journal->authors ?? '-' }}</p>
                    <p><strong>Category:</strong> {{ $reservation->journal->category->category_name ?? '-' }}</p>
                    <p><strong>Availability:</strong> {{ $reservation->journal->availability ?? '-' }}</p>
                @elseif($reservation->thesis)
                    <h5>Thesis Information</h5>
                    <p><strong>Title:</strong> {{ $reservation->thesis->title ?? '-' }}</p>
                    <p><strong>Authors:</strong> {{ $reservation->thesis->authors ?? '-' }}</p>
                    <p><strong>Institution:</strong> {{ $reservation->thesis->institution ?? '-' }}</p>
                    <p><strong>Category:</strong> {{ $reservation->thesis->category->category_name ?? '-' }}</p>
                    <p><strong>Availability:</strong> {{ $reservation->thesis->availability ?? '-' }}</p>
                @else
                    <h5>Item Information</h5>
                    <p class="text-muted">No item information available.</p>
                @endif
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <p><strong>Reservation Date:</strong> {{ $reservation->reservation_date ?? '-' }}</p>
                <p><strong>Expiration Date:</strong> {{ $reservation->expiration_date ?? '-' }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Status:</strong>
                    <span class="badge bg-{{ $reservation->status === 'Pending' ? 'warning' : ($reservation->status === 'Approved' ? 'info' : ($reservation->status === 'Claimed' ? 'success' : 'danger')) }}">
                        {{ $reservation->status }}
                    </span>
                </p>
            </div>
        </div>
        @if($reservation->status === 'Pending')
            <hr>
            <div class="d-flex gap-2">
                <form action="{{ route('reservations.approve', $reservation->id) }}" method="POST" onsubmit="return confirm('Approve this reservation?')">
                    @csrf
                    <button type="submit" class="btn btn-success"><i class="bi bi-check"></i> Approve Request</button>
                </form>
                <form action="{{ route('reservations.reject', $reservation->id) }}" method="POST" onsubmit="return confirm('Reject this reservation?')">
                    @csrf
                    <button type="submit" class="btn btn-danger"><i class="bi bi-x"></i> Reject Request</button>
                </form>
            </div>
        @endif
    </div>
</div>
<a href="{{ route('reservations.index') }}" class="btn btn-secondary">Back to Reservations</a>
@endsection
