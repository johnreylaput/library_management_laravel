@extends('layout.app')

@section('title', 'Edit Book')

@section('content')
<h2 class="mb-4">Edit Book</h2>
<form method="POST" action="{{ route('books.update', $book->id) }}">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="form-label fw-bold">Author:</label>
        <select name="author" class="form-select" required>
            <option value="">Select Author</option>
            @if($book->author && !$authors->contains('author_name', $book->author))
                <option value="{{ $book->author }}" selected>{{ $book->author }}</option>
            @endif
            @foreach($authors as $author)
                <option value="{{ $author->author_name }}" @selected(old('author', $book->author) === $author->author_name)>{{ $author->author_name }}</option>
            @endforeach
        </select>
        @error('author')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Title:</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $book->title) }}" required>
        @error('title')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Edition:</label>
        <input type="text" name="edition" class="form-control" value="{{ old('edition', $book->edition) }}" required>
        @error('edition')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Year:</label>
        <input type="number" name="year" class="form-control" value="{{ old('year', $book->year) }}" min="1" max="{{ now()->year }}" placeholder="e.g. 2024" required>
        @error('year')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Subject:</label>
        <input type="text" name="subject" class="form-control" value="{{ old('subject', $book->subject) }}" placeholder="e.g. Computer Science" required>
        @error('subject')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Publication:</label>
        <select name="publication" class="form-select" required>
            <option value="">Select Publication</option>
            <option value="Foreign" @selected(old('publication', $book->publication) === 'Foreign')>Foreign</option>
            <option value="Local" @selected(old('publication', $book->publication) === 'Local')>Local</option>
        </select>
        @error('publication')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <button type="submit" class="btn btn-success">Update Book</button>
    <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
