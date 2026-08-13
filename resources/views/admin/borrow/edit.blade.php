@extends('layout.app')

@section('title', 'Edit Borrow')

@section('content')
<h2 class="mb-4">Edit Borrow</h2>
<form method="POST" action="{{ route('borrow.update', $borrow->id) }}">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Member</label>
        <select name="member_id" class="form-select" required>
            @foreach($members as $member)
                <option value="{{ $member->id }}" {{ $borrow->member_id == $member->id ? 'selected' : '' }}>
                    {{ $member->user->full_name ?? $member->member_no }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Book</label>
        <select name="book_id" class="form-select" required>
            @foreach($books as $book)
                <option value="{{ $book->id }}" {{ $borrow->book_id == $book->id ? 'selected' : '' }}>
                    {{ $book->title }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Borrowed By</label>
        <select name="borrowed_by" class="form-select">
            <option value="">Select Librarian</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $borrow->borrowed_by == $user->id ? 'selected' : '' }}>
                    {{ $user->full_name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Borrow Date</label>
        <input type="date" name="borrow_date" class="form-control" value="{{ $borrow->borrow_date }}" required>
    </div>
    <div class="mb-3">
        <label>Due Date</label>
        <input type="date" name="due_date" class="form-control" value="{{ $borrow->due_date }}" required>
    </div>
    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-select">
            <option value="Borrowed" {{ $borrow->status === 'Borrowed' ? 'selected' : '' }}>Borrowed</option>
            <option value="Returned" {{ $borrow->status === 'Returned' ? 'selected' : '' }}>Returned</option>
            <option value="Overdue" {{ $borrow->status === 'Overdue' ? 'selected' : '' }}>Overdue</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Remarks</label>
        <textarea name="remarks" class="form-control" rows="2">{{ $borrow->remarks ?? '' }}</textarea>
    </div>
    <button type="submit" class="btn btn-success">Update Borrow</button>
    <a href="{{ route('borrow.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
