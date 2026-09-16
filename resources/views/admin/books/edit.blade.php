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
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label>Accession No</label>
            <input type="text" name="accession_no" class="form-control" value="{{ $book->accession_no ?? '' }}">
            @error('accession_no')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label>ISBN</label>
            <input type="text" name="isbn" class="form-control" value="{{ $book->isbn ?? '' }}">
            @error('isbn')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label>Category</label>
            <select name="category_id" class="form-select">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label>Author</label>
            <select name="author_id" class="form-select">
                <option value="">Select Author</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" {{ $book->author_id == $author->id ? 'selected' : '' }}>
                        {{ $author->author_name }}
                    </option>
                @endforeach
            </select>
            @error('author_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label>Publisher</label>
            <select name="publisher_id" class="form-select">
                <option value="">Select Publisher</option>
                @foreach($publishers as $publisher)
                    <option value="{{ $publisher->id }}" {{ $book->publisher_id == $publisher->id ? 'selected' : '' }}>
                        {{ $publisher->publisher_name }}
                    </option>
                @endforeach
            </select>
            @error('publisher_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control" value="{{ $book->quantity }}" min="1">
            @error('quantity')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label>Available Quantity</label>
            <input type="number" name="available_quantity" class="form-control" value="{{ $book->available_quantity }}" min="0">
            @error('available_quantity')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label>Status</label>
            <select name="status" class="form-select">
                <option value="Available" {{ $book->status === 'Available' ? 'selected' : '' }}>Available</option>
                <option value="Unavailable" {{ $book->status === 'Unavailable' ? 'selected' : '' }}>Unavailable</option>
                <option value="Archived" {{ $book->status === 'Archived' ? 'selected' : '' }}>Archived</option>
            </select>
            @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-12 mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3">{{ $book->description ?? '' }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <button type="submit" class="btn btn-success">Update Book</button>
    <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
