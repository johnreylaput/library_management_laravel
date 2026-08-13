@extends('layout.app')

@section('title', 'Add Category')

@section('content')
<h2 class="mb-4">Add Category</h2>
<form method="POST" action="{{ route('categories.store') }}">
    @csrf
    <div class="mb-3">
        <label>Category Name</label>
        <input type="text" name="category_name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-success">Save Category</button>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
