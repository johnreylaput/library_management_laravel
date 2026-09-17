@extends('layout.app')

@section('title', 'Add Book')

@section('content')
<h2 class="mb-4">Add Book</h2>
<form method="POST" action="{{ route('books.store') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label fw-bold">Author:</label>
        <select name="author" class="form-select" required>
            <option value="">Select Author</option>
            @foreach($authors as $author)
                <option value="{{ $author->author_name }}" @selected(old('author') === $author->author_name)>{{ $author->author_name }}</option>
            @endforeach
        </select>
        @error('author')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Title:</label>
        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        @error('title')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Edition:</label>
        <input type="text" name="edition" class="form-control" value="{{ old('edition') }}" required>
        @error('edition')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Year:</label>
        <input type="number" name="year" class="form-control" value="{{ old('year') }}" min="1" max="{{ now()->year }}" placeholder="e.g. 2024" required>
        @error('year')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Subject:</label>
        <input type="text" name="subject" class="form-control" value="{{ old('subject') }}" placeholder="e.g. Computer Science" required>
        @error('subject')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Publication:</label>
        <select name="publication" class="form-select" required>
            <option value="">Select Publication</option>
            <option value="Foreign" @selected(old('publication') === 'Foreign')>Foreign</option>
            <option value="Local" @selected(old('publication') === 'Local')>Local</option>
        </select>
        @error('publication')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <button type="submit" class="btn btn-success">Save Book</button>
    <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
