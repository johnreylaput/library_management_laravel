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
                <label class="form-label fw-bold">Author:</label>
                <input type="text" class="form-control" value="{{ $author->author_name }}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Title:</label>
                <input type="text" class="form-control" value="{{ $author->title ?? 'N/A' }}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Edition:</label>
                <input type="text" class="form-control" value="{{ $author->edition ?? 'N/A' }}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Year:</label>
                <input type="text" class="form-control" value="{{ $author->year ?? 'N/A' }}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Subject:</label>
                <input type="text" class="form-control" value="{{ $author->subject ?? 'N/A' }}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Publication:</label>
                <select class="form-select" disabled>
                    <option value="">-- Select Publication --</option>
                    <option value="Foreign" {{ $author->publication === 'Foreign' ? 'selected' : '' }}>Foreign</option>
                    <option value="Local" {{ $author->publication === 'Local' ? 'selected' : '' }}>Local</option>
                </select>
            </div>
        </form>
    </div>
</div>
<a href="{{ route('authors.index') }}" class="btn btn-secondary">Back to Authors</a>
@endsection