@extends('layout.app')

@section('title', 'View Book')

@section('content')
<div class="card mb-4">
    <div class="card-header">
        <h4 class="mb-0">View Book</h4>
    </div>
    <div class="card-body">
        <form>
            <div class="mb-3">
                <label class="form-label fw-bold">Author:</label>
                <input type="text" class="form-control" value="{{ $book->author ?? 'N/A' }}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Subject:</label>
                <input type="text" class="form-control" value="{{ $book->subject ?? 'N/A' }}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Year:</label>
                <input type="text" class="form-control" value="{{ $book->year ?? 'N/A' }}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Publication:</label>
                <select class="form-select" disabled>
                    <option value="">-- Select Publication --</option>
                    <option value="Foreign" {{ $book->publication === 'Foreign' ? 'selected' : '' }}>Foreign</option>
                    <option value="Local" {{ $book->publication === 'Local' ? 'selected' : '' }}>Local</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Added By:</label>
                <input type="text" class="form-control" value="{{ $book->added_by ?? 'N/A' }}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Edited By:</label>
                <input type="text" class="form-control" value="@php $editorText = $book->edited_by ?? 'N/A'; preg_match('/^(.+) \(([^)]+)\)$/', $editorText, $editorMatches); @endphp{{ $editorMatches[1] ?? $editorText }}" readonly>
            </div>
        </form>
    </div>
</div>
<a href="{{ route('books.index') }}" class="btn btn-secondary">Back to Books</a>
@endsection
