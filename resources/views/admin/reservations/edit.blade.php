@extends('layout.app')

@section('title', 'Edit Reservation')

@section('content')
<h2 class="mb-4">Edit Reservation</h2>
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
        <input type="date" name="reservation_date" class="form-control" value="{{ old('reservation_date', $reservation->reservation_date ?? '') }}">
    </div>
    <div class="mb-3">
        <label>Expiration Date</label>
        <input type="date" name="expiration_date" class="form-control" value="{{ old('expiration_date', $reservation->expiration_date ?? '') }}">
    </div>
    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-select">
            <option value="Pending" {{ $reservation->status === 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="Approved" {{ $reservation->status === 'Approved' ? 'selected' : '' }}>Approved</option>
            <option value="Cancelled" {{ $reservation->status === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
            <option value="Claimed" {{ $reservation->status === 'Claimed' ? 'selected' : '' }}>Claimed</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Update Reservation</button>
    <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
