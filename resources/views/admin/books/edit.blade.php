@extends('layout.app')

@section('title', 'Edit Book')

@section('content')
<h2 class="mb-4">Edit Book</h2>
<form method="POST" action="{{ route('books.update', $book->id) }}">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="form-label fw-bold">Author:</label>
        <input type="text" name="author" class="form-control" value="{{ $book->author ?? '' }}" placeholder="e.g. John Smith" required>
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Title:</label>
        <input type="text" name="title" class="form-control" value="{{ $book->title }}" placeholder="e.g. Introduction to Programming" required>
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Edition:</label>
        <input type="text" name="edition" class="form-control" value="{{ $book->edition ?? '' }}" placeholder="e.g. 1st Edition">
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Year:</label>
        <input type="text" name="year" class="form-control" value="{{ $book->year ?? '' }}" placeholder="e.g. 2024">
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Subject:</label>
        <input type="text" name="subject" class="form-control" value="{{ $book->subject ?? '' }}" placeholder="e.g. Computer Science">
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Publication:</label>
        <select name="publication" class="form-select">
            <option value="">-- Select Publication --</option>
            <option value="Foreign" {{ $book->publication === 'Foreign' ? 'selected' : '' }}>Foreign</option>
            <option value="Local" {{ $book->publication === 'Local' ? 'selected' : '' }}>Local</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Update Book</button>
    <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection