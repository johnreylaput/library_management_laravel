@extends('layout.app')

@section('title', 'New Return')

@section('content')
<h2 class="mb-4">New Return</h2>
<form method="POST" action="{{ route('return.store') }}">
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
        <label>Returned By</label>
        <select name="returned_by" class="form-select">
            <option value="">Select User</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->full_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Return Date</label>
        <input type="date" name="return_date" class="form-control" value="{{ date('Y-m-d') }}">
    </div>
    <div class="mb-3">
        <label>Condition</label>
        <select name="condition_status" class="form-select" required>
            <option value="Good">Good</option>
            <option value="Damaged">Damaged</option>
            <option value="Lost">Lost</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Remarks</label>
        <textarea name="remarks" class="form-control" rows="2"></textarea>
    </div>
    <button type="submit" class="btn btn-success">Save Return</button>
    <a href="{{ route('return.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
