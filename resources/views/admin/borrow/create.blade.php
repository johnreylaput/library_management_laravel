@extends('layout.app')

@section('title', 'New Borrow')

@section('content')
<h2 class="mb-4">New Borrow</h2>

@if(session('error'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @if(session('recommendations') && session('recommendations')->count() > 0)
        <div class="card mb-3">
            <div class="card-header bg-warning"><h5>Recommended Books</h5></div>
            <div class="card-body">
                <div class="row">
                    @foreach(session('recommendations') as $rec)
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $rec->title }}</h5>
                                    <p class="card-text mb-1"><strong>Author:</strong> {{ $rec->author->author_name ?? 'N/A' }}</p>
                                    <p class="card-text mb-1"><strong>Category:</strong> {{ $rec->category->category_name ?? 'Uncategorized' }}</p>
                                    <p class="card-text mb-2"><strong>Available:</strong> {{ $rec->available_quantity }}</p>
                                    <form method="POST" action="{{ route('borrow.store') }}" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="member_input" value="{{ old('member_input') }}">
                                        <input type="hidden" name="book_input" value="{{ $rec->title }}">
                                        <input type="hidden" name="borrow_date" value="{{ old('borrow_date', date('Y-m-d')) }}">
                                        <input type="hidden" name="due_date" value="{{ old('due_date') }}">
                                        <input type="hidden" name="remarks" value="{{ old('remarks') }}">
                                        <button type="submit" class="btn btn-outline-primary btn-sm w-100">Borrow This</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endif

<form method="POST" action="{{ route('borrow.store') }}">
    @csrf
    <div class="mb-3">
        <label>Member Name / Member No</label>
        <input type="text" name="member_input" class="form-control" value="{{ old('member_input') }}" required placeholder="Enter member name or member number">
    </div>
    <div class="mb-3">
        <label>Book Title</label>
        <input type="text" name="book_input" class="form-control" value="{{ old('book_input') }}" required placeholder="Enter book title">
    </div>
    <div class="mb-3">
        <label>Borrowed By (Librarian)</label>
        <select name="borrowed_by" class="form-select">
            <option value="">Select Librarian</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ old('borrowed_by') == $user->id ? 'selected' : '' }}>{{ $user->full_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Borrow Date</label>
        <input type="date" name="borrow_date" class="form-control" value="{{ old('borrow_date', date('Y-m-d')) }}" required>
    </div>
    <div class="mb-3">
        <label>Due Date</label>
        <input type="date" name="due_date" class="form-control" value="{{ old('due_date', date('Y-m-d', strtotime('+3 days'))) }}" required>
    </div>
    <div class="mb-3">
        <label>Remarks</label>
        <textarea name="remarks" class="form-control" rows="2">{{ old('remarks') }}</textarea>
    </div>
    <button type="submit" class="btn btn-success">Save Borrow</button>
    <a href="{{ route('borrow.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
