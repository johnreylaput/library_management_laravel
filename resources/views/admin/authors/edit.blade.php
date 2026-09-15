@extends('layout.app')

@section('title', 'Edit Author')

@section('content')
<h2 class="mb-4">Edit Author</h2>
<form method="POST" action="{{ route('authors.update', $author->id) }}">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="form-label fw-bold">Author:</label>
        <input type="text" name="author_name" class="form-control" value="{{ $author->author_name }}" placeholder="e.g. John Smith" required>
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Title:</label>
        <input type="text" name="title" class="form-control" value="{{ $author->title ?? '' }}" placeholder="e.g. Introduction to Programming">
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Edition:</label>
        <input type="text" name="edition" class="form-control" value="{{ $author->edition ?? '' }}" placeholder="e.g. 1st Edition">
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Year:</label>
        <input type="text" name="year" class="form-control" value="{{ $author->year ?? '' }}" placeholder="e.g. 2024">
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Subject:</label>
        <input type="text" name="subject" class="form-control" value="{{ $author->subject ?? '' }}" placeholder="e.g. Computer Science">
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Publication:</label>
        <select name="publication" class="form-select">
            <option value="">-- Select Publication --</option>
            <option value="Foreign" {{ $author->publication === 'Foreign' ? 'selected' : '' }}>Foreign</option>
            <option value="Local" {{ $author->publication === 'Local' ? 'selected' : '' }}>Local</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Update Author</button>
    <a href="{{ route('authors.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection