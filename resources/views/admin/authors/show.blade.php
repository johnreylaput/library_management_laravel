@extends('layout.app')

@section('title', $author->author_name)

@section('content')
<div class="card mb-4">
    <div class="card-header">
        <h4 class="mb-0">View Author</h4>
    </div>
    <div class="card-body">
        <form>
            <div class="mb-3">
                <label class="form-label fw-bold">Author Name:</label>
                <input type="text" class="form-control" value="{{ $author->author_name }}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Biography:</label>
                <textarea class="form-control" rows="4" readonly>{{ $author->biography ?? 'N/A' }}</textarea>
            </div>
        </form>
    </div>
</div>
<a href="{{ route('authors.index') }}" class="btn btn-secondary">Back to Authors</a>
@endsection