@extends('layout.app')

@section('title', 'Edit Book')

@section('content')
<h2 class="mb-4">Edit Book</h2>
<form method="POST" action="{{ route('books.update', $book->id) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="form-label fw-bold">Author:</label>
        <input type="text" name="author" class="form-control" value="{{ old('author', $book->author) }}" required>
        @error('author')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Title:</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $book->title) }}" required>
        @error('title')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Edition:</label>
        <input type="text" name="edition" class="form-control" value="{{ old('edition', $book->edition) }}" required>
        @error('edition')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Year:</label>
        <input type="number" name="year" class="form-control" value="{{ old('year', $book->year) }}" min="1" max="{{ now()->year }}" placeholder="e.g. 2024" required>
        @error('year')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Subject:</label>
        <input type="text" name="subject" class="form-control" value="{{ old('subject', $book->subject) }}" placeholder="e.g. Computer Science" required>
        @error('subject')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Publication:</label>
        <select name="publication" class="form-select" required>
            <option value="">Select Publication</option>
            <option value="Foreign" @selected(old('publication', $book->publication) === 'Foreign')>Foreign</option>
            <option value="Local" @selected(old('publication', $book->publication) === 'Local')>Local</option>
        </select>
        @error('publication')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Book Cover:</label>
        <input type="file" name="cover_image" class="form-control" accept="image/jpeg,image/png,image/webp">
        @error('cover_image')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        <small class="text-muted">Allowed formats: JPG, JPEG, PNG, WEBP. Max size: 2MB. Leave empty to keep the existing cover.</small>
        @if($book->cover_image)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Current Cover" class="border rounded" style="max-height: 200px; max-width: 150px; object-fit: contain; object-position: center;">
            </div>
        @else
            <div class="mt-2 text-muted fst-italic">No cover image set.</div>
        @endif
        <div id="cover-preview-container" class="mt-2" style="display: none;">
            <img id="cover-preview" src="#" alt="Cover Preview" class="img-fluid border rounded" style="max-height: 200px; max-width: 150px; object-fit: contain; object-position: center;">
        </div>
    </div>
    <button type="submit" class="btn btn-success">Update Book</button>
    <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection

@push('scripts')
<script>
document.querySelector('input[name="cover_image"]').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const container = document.getElementById('cover-preview-container');
    const img = document.getElementById('cover-preview');

    if (file) {
        const url = URL.createObjectURL(file);
        img.src = url;
        container.style.display = 'block';
    } else {
        container.style.display = 'none';
        img.src = '#';
    }
});
</script>
@endpush
