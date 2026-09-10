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
            <input type="text" name="category_name" class="form-control" placeholder="Enter category name">
        </div>
        <div class="col-md-6 mb-3">
            <label>Author</label>
            <input type="text" name="author_name" class="form-control" placeholder="Enter author name">
        </div>
        <div class="col-md-6 mb-3">
            <label>Publisher</label>
            <input type="text" name="publisher_name" class="form-control" placeholder="Enter publisher name">
        </div>
        <div class="col-md-6 mb-3">
            <label>Publication Year</label>
            <input type="number" name="publication_year" class="form-control" placeholder="e.g. 2024">
        </div>
        <div class="col-md-6 mb-3">
            <label>Edition</label>
            <input type="text" name="edition" class="form-control" placeholder="e.g. 1st Edition">
        </div>
        <div class="col-md-6 mb-3">
            <label>Language</label>
            <input type="text" name="language" class="form-control" placeholder="e.g. English">
        </div>
        <div class="col-md-6 mb-3">
            <label>Pages</label>
            <input type="number" name="pages" class="form-control" placeholder="e.g. 300">
        </div>
        <div class="col-md-6 mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control" value="1" min="1">
        </div>
        <div class="col-md-6 mb-3">
            <label>Available Quantity</label>
            <input type="number" name="available_quantity" class="form-control" value="1" min="0">
        </div>
        <div class="col-md-6 mb-3">
            <label>Shelf Location</label>
            <input type="text" name="shelf_location" class="form-control" placeholder="e.g. A-01">
        </div>
        <div class="col-md-6 mb-3">
            <label>Status</label>
            <select name="status" class="form-select">
                <option value="Available">Available</option>
                <option value="Unavailable">Unavailable</option>
                <option value="Archived">Archived</option>
            </select>
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
