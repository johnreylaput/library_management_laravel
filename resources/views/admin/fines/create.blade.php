@extends('layout.app')

@section('title', 'New Fine')

@section('content')
<h2 class="mb-4">New Fine</h2>
<form method="POST" action="{{ route('fines.store') }}">
    @csrf
    <div class="mb-3">
        <label>Borrow Record</label>
        <select name="borrow_id" class="form-select" required>
            <option value="">Select Borrow Record</option>
            @foreach($borrows as $borrow)
                <option value="{{ $borrow->id }}">{{ $borrow->member->user->full_name ?? $borrow->member_id }} - {{ $borrow->book->title ?? 'Book' }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Amount</label>
        <input type="number" name="amount" class="form-control" step="0.01" required>
    </div>
    <div class="mb-3">
        <label>Reason</label>
        <input type="text" name="reason" class="form-control">
    </div>
    <div class="mb-3">
        <label>Paid</label>
        <select name="paid" class="form-select">
            <option value="No">No</option>
            <option value="Yes">Yes</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Save Fine</button>
    <a href="{{ route('fines.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
