@extends('layout.app')

@section('title', 'Edit Return')

@section('content')
<h2 class="mb-4">Edit Return</h2>
<form method="POST" action="{{ route('return.update', $return->id) }}">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Returned By</label>
        <select name="returned_by" class="form-select">
            <option value="">Select User</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $return->returned_by == $user->id ? 'selected' : '' }}>
                    {{ $user->full_name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Return Date</label>
        <input type="date" name="return_date" class="form-control" value="{{ $return->return_date ?? '' }}">
    </div>
    <div class="mb-3">
        <label>Condition</label>
        <select name="condition_status" class="form-select">
            <option value="Good" {{ $return->condition_status === 'Good' ? 'selected' : '' }}>Good</option>
            <option value="Damaged" {{ $return->condition_status === 'Damaged' ? 'selected' : '' }}>Damaged</option>
            <option value="Lost" {{ $return->condition_status === 'Lost' ? 'selected' : '' }}>Lost</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Remarks</label>
        <textarea name="remarks" class="form-control" rows="2">{{ $return->remarks ?? '' }}</textarea>
    </div>
    <button type="submit" class="btn btn-success">Update Return</button>
    <a href="{{ route('return.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
