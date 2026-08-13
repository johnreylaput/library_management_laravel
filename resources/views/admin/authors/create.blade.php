@extends('layout.app')

@section('title', 'Add Author')

@section('content')
<h2 class="mb-4">Add Author</h2>
<form method="POST" action="{{ route('authors.store') }}">
    @csrf
    <div class="mb-3">
        <label>Author Name</label>
        <input type="text" name="author_name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Biography</label>
        <textarea name="biography" class="form-control" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-success">Save Author</button>
    <a href="{{ route('authors.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
