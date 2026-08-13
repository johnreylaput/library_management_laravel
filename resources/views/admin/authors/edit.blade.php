@extends('layout.app')

@section('title', 'Edit Author')

@section('content')
<h2 class="mb-4">Edit Author</h2>
<form method="POST" action="{{ route('authors.update', $author->id) }}">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Author Name</label>
        <input type="text" name="author_name" class="form-control" value="{{ $author->author_name }}" required>
    </div>
    <div class="mb-3">
        <label>Biography</label>
        <textarea name="biography" class="form-control" rows="3">{{ $author->biography ?? '' }}</textarea>
    </div>
    <button type="submit" class="btn btn-success">Update Author</button>
    <a href="{{ route('authors.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
