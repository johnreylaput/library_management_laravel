@extends('layout.app')

@section('title', 'Edit Category')

@section('content')
<h2 class="mb-4">Edit Category</h2>
<form method="POST" action="{{ route('categories.update', $category->id) }}">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Category Name</label>
        <input type="text" name="category_name" class="form-control" value="{{ $category->category_name }}" required>
    </div>
    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control" rows="3">{{ $category->description ?? '' }}</textarea>
    </div>
    <button type="submit" class="btn btn-success">Update Category</button>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
