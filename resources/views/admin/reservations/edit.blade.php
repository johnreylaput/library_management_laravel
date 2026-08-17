@extends('layout.app')

@section('title', 'Edit Reservation')

@section('content')
<h2 class="mb-4">Edit Reservation</h2>

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Please fix the following errors:</strong>
        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<form method="POST" action="{{ route('reservations.update', $reservation->id) }}">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Member Name / Member No</label>
        <input type="text" name="member_input" class="form-control" value="{{ old('member_input', $reservation->member->user->full_name ?? $reservation->member->member_no ?? '') }}" required>
    </div>
    <div class="mb-3">
        <label>Book Title</label>
        <input type="text" name="book_input" class="form-control" value="{{ old('book_input', $reservation->book->title ?? '') }}" required>
    </div>
    <div class="mb-3">
        <label>Reservation Date</label>
        <input type="date" name="reservation_date" class="form-control" value="{{ old('reservation_date', $reservation->reservation_date ?? date('Y-m-d')) }}">
    </div>
    <div class="mb-3">
        <label>Due Date</label>
        <input type="date" name="due_date" class="form-control" value="{{ old('due_date', $reservation->due_date ?? date('Y-m-d', strtotime('+3 days'))) }}">
    </div>
    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-select">
            <option value="Pending" {{ old('status', $reservation->status) === 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="Approved" {{ old('status', $reservation->status) === 'Approved' ? 'selected' : '' }}>Approved</option>
            <option value="Cancelled" {{ old('status', $reservation->status) === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
            <option value="Claimed" {{ old('status', $reservation->status) === 'Claimed' ? 'selected' : '' }}>Claimed</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Update Reservation</button>
    <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
