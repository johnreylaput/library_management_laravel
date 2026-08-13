@extends('layout.app')

@section('title', 'Edit Fine')

@section('content')
<h2 class="mb-4">Edit Fine</h2>
<form method="POST" action="{{ route('fines.update', $fine->id) }}">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Amount</label>
        <input type="number" name="amount" class="form-control" value="{{ $fine->amount }}" step="0.01" required>
    </div>
    <div class="mb-3">
        <label>Reason</label>
        <input type="text" name="reason" class="form-control" value="{{ $fine->reason ?? '' }}">
    </div>
    <div class="mb-3">
        <label>Paid</label>
        <select name="paid" class="form-select">
            <option value="No" {{ $fine->paid === 'No' ? 'selected' : '' }}>No</option>
            <option value="Yes" {{ $fine->paid === 'Yes' ? 'selected' : '' }}>Yes</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Update Fine</button>
    <a href="{{ route('fines.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
