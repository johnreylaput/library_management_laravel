@extends('layout.app')

@section('title', 'Add Book')

@section('content')
<h2 class="mb-4">Add Book</h2>
<form method="POST" action="{{ route('books.store') }}">
    @csrf
    <div class="row">
        <div class="col-md-6 mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
            <label>Accession No</label>
            <input type="text" name="accession_no" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>ISBN</label>
            <input type="text" name="isbn" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>Category</label>
            <select name="category_id" class="form-select">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label>Author</label>
            <select name="author_id" class="form-select">
                <option value="">Select Author</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->author_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label>Publisher</label>
            <select name="publisher_id" class="form-select">
                <option value="">Select Publisher</option>
                @foreach($publishers as $publisher)
                    <option value="{{ $publisher->id }}">{{ $publisher->publisher_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control" value="1" min="1">
        </div>
        <div class="col-12 mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Save Book</button>
    <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
