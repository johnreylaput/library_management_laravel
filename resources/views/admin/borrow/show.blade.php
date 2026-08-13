@extends('layout.app')

@section('title', 'Borrow Details')

@section('content')
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <h4>Borrow Request #{{ $borrow->id }}</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5>Member Information</h5>
                <p><strong>Name:</strong> {{ $borrow->member->user->full_name ?? '-' }}</p>
                <p><strong>Member No:</strong> {{ $borrow->member->member_no ?? '-' }}</p>
                <p><strong>Course:</strong> {{ $borrow->member->course ?? '-' }}</p>
                <p><strong>Year Level:</strong> {{ $borrow->member->year_level ?? '-' }}</p>
                <p><strong>Contact:</strong> {{ $borrow->member->contact_number ?? '-' }}</p>
                <p><strong>Address:</strong> {{ $borrow->member->address ?? '-' }}</p>
            </div>
            <div class="col-md-6">
                @if($borrow->book)
                    <h5>Book Information</h5>
                    <p><strong>Title:</strong> {{ $borrow->book->title ?? '-' }}</p>
                    <p><strong>ISBN:</strong> {{ $borrow->book->isbn ?? '-' }}</p>
                    <p><strong>Author:</strong> {{ $borrow->book->author->author_name ?? '-' }}</p>
                    <p><strong>Category:</strong> {{ $borrow->book->category->category_name ?? '-' }}</p>
                    <p><strong>Status:</strong> {{ $borrow->book->status ?? '-' }}</p>
                    <p><strong>Available Quantity:</strong> {{ $borrow->book->available_quantity ?? 0 }}</p>
                @elseif($borrow->journal)
                    <h5>Journal Information</h5>
                    <p><strong>Title:</strong> {{ $borrow->journal->title ?? '-' }}</p>
                    <p><strong>Journal Name:</strong> {{ $borrow->journal->journal_name ?? '-' }}</p>
                    <p><strong>Authors:</strong> {{ $borrow->journal->authors ?? '-' }}</p>
                    <p><strong>Category:</strong> {{ $borrow->journal->category->category_name ?? '-' }}</p>
                    <p><strong>Availability:</strong> {{ $borrow->journal->availability ?? '-' }}</p>
                @elseif($borrow->thesis)
                    <h5>Thesis Information</h5>
                    <p><strong>Title:</strong> {{ $borrow->thesis->title ?? '-' }}</p>
                    <p><strong>Authors:</strong> {{ $borrow->thesis->authors ?? '-' }}</p>
                    <p><strong>Institution:</strong> {{ $borrow->thesis->institution ?? '-' }}</p>
                    <p><strong>Category:</strong> {{ $borrow->thesis->category->category_name ?? '-' }}</p>
                    <p><strong>Availability:</strong> {{ $borrow->thesis->availability ?? '-' }}</p>
                @else
                    <h5>Item Information</h5>
                    <p class="text-muted">No item information available.</p>
                @endif
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <p><strong>Borrow Date:</strong> {{ $borrow->borrow_date }}</p>
                <p><strong>Due Date:</strong> {{ $borrow->due_date }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Status:</strong>
                    <span class="badge bg-{{ $borrow->status === 'Borrowed' ? 'warning' : ($borrow->status === 'Overdue' ? 'danger' : ($borrow->status === 'Pending' ? 'info' : 'success')) }}">
                        {{ $borrow->status }}
                    </span>
                </p>
                <p><strong>Remarks:</strong> {{ $borrow->remarks ?? '-' }}</p>
            </div>
        </div>
        @if($borrow->status === 'Pending')
            <hr>
            <div class="d-flex gap-2">
                <form action="{{ route('borrow.approve', $borrow->id) }}" method="POST" onsubmit="return confirm('Approve this borrow request?')">
                    @csrf
                    <button type="submit" class="btn btn-success"><i class="bi bi-check"></i> Approve Request</button>
                </form>
                <form action="{{ route('borrow.reject', $borrow->id) }}" method="POST" onsubmit="return confirm('Reject this borrow request?')">
                    @csrf
                    <button type="submit" class="btn btn-danger"><i class="bi bi-x"></i> Reject Request</button>
                </form>
            </div>
        @endif
    </div>
</div>
<a href="{{ route('borrow.index') }}" class="btn btn-secondary">Back to Borrow Records</a>
@endsection
