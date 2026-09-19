@extends('layout.app')

@section('title', 'View Book')

@section('content')
<div class="card mb-4">
    <div class="card-header">
        <h4 class="mb-0">View Book</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 mb-3 d-flex justify-content-center">
                @if($book->cover_image)
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Book Cover" class="img-fluid border rounded" style="max-height: 300px; max-width: 200px; object-fit: contain; object-position: center;">
                @else
                    <div class="text-center text-muted fst-italic border rounded d-flex align-items-center justify-content-center" style="min-height: 300px; min-width: 200px;">
                        <span>No Cover Available</span>
                    </div>
                @endif
            </div>
            <div class="col-md-8">
                <form>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Author:</label>
                        <input type="text" class="form-control" value="{{ $book->author ?? 'N/A' }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Title:</label>
                        <input type="text" class="form-control" value="{{ $book->title ?? 'N/A' }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Edition:</label>
                        <input type="text" class="form-control" value="{{ $book->edition ?? 'N/A' }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Year:</label>
                        <input type="text" class="form-control" value="{{ $book->year ?? 'N/A' }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Subject:</label>
                        <input type="text" class="form-control" value="{{ $book->subject ?? 'N/A' }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Publication:</label>
                        <select class="form-select" disabled>
                            <option value="">Select Publication</option>
                            <option value="Foreign" {{ $book->publication === 'Foreign' ? 'selected' : '' }}>Foreign</option>
                            <option value="Local" {{ $book->publication === 'Local' ? 'selected' : '' }}>Local</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<a href="{{ route('books.index') }}" class="btn btn-secondary">Back to Books</a>
@endsection
