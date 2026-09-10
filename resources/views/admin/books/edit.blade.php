@extends('layout.app')

@section('title', 'Edit Book')

@section('content')
<h2 class="mb-4">Edit Book</h2>
<form method="POST" action="{{ route('books.update', $book->id) }}">
    @csrf @method('PUT')
    <div class="row">
        <div class="col-md-6 mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ $book->title }}" required>
        </div>
        <div class="col-md-6 mb-3">
            <label>ISBN</label>
            <input type="text" name="isbn" class="form-control" value="{{ $book->isbn ?? '' }}">
        </div>
        <div class="col-md-6 mb-3">
            <label>Category</label>
            <input type="text" name="category_name" class="form-control" value="{{ $book->category->category_name ?? '' }}" placeholder="Enter category name">
        </div>
        <div class="col-md-6 mb-3">
            <label>Author</label>
            <input type="text" name="author_name" class="form-control" value="{{ $book->author->author_name ?? '' }}" placeholder="Enter author name">
        </div>
        <div class="col-md-6 mb-3">
            <label>Publisher</label>
            <input type="text" name="publisher_name" class="form-control" value="{{ $book->publisher->publisher_name ?? '' }}" placeholder="Enter publisher name">
        </div>
        <div class="col-md-6 mb-3">
            <label>Publication Year</label>
            <input type="number" name="publication_year" class="form-control" value="{{ $book->publication_year ?? '' }}" placeholder="e.g. 2024">
        </div>
        <div class="col-md-6 mb-3">
            <label>Edition</label>
            <input type="text" name="edition" class="form-control" value="{{ $book->edition ?? '' }}" placeholder="e.g. 1st Edition">
        </div>
        <div class="col-md-6 mb-3">
            <label>Language</label>
            <input type="text" name="language" class="form-control" value="{{ $book->language ?? '' }}" placeholder="e.g. English">
        </div>
        <div class="col-md-6 mb-3">
            <label>Pages</label>
            <input type="number" name="pages" class="form-control" value="{{ $book->pages ?? '' }}" placeholder="e.g. 300">
        </div>
        <div class="col-md-6 mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control" value="{{ $book->quantity }}" min="1">
        </div>
        <div class="col-md-6 mb-3">
            <label>Available Quantity</label>
            <input type="number" name="available_quantity" class="form-control" value="{{ $book->available_quantity }}" min="0">
        </div>
        <div class="col-md-6 mb-3">
            <label>Shelf Location</label>
            <input type="text" name="shelf_location" class="form-control" value="{{ $book->shelf_location ?? '' }}" placeholder="e.g. A-01">
        </div>
        <div class="col-md-6 mb-3">
            <label>Status</label>
            <select name="status" class="form-select">
                <option value="Available" {{ $book->status === 'Available' ? 'selected' : '' }}>Available</option>
                <option value="Unavailable" {{ $book->status === 'Unavailable' ? 'selected' : '' }}>Unavailable</option>
                <option value="Archived" {{ $book->status === 'Archived' ? 'selected' : '' }}>Archived</option>
            </select>
        </div>
        <div class="col-12 mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3">{{ $book->description ?? '' }}</textarea>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Update Book</button>
    <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
