@extends('layout.app')

@section('title', 'Add Book')

@section('content')
<h2 class="mb-4">Add Book</h2>
<form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label class="form-label fw-bold">Author:</label>
        <input type="text" name="author" class="form-control" value="{{ old('author') }}" required>
        @error('author')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Title:</label>
        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        @error('title')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Edition:</label>
        <input type="text" name="edition" class="form-control" value="{{ old('edition') }}" required>
        @error('edition')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Year:</label>
        <input type="number" name="year" class="form-control" value="{{ old('year') }}" min="1" max="{{ now()->year }}" placeholder="e.g. 2024" required>
        @error('year')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Subject:</label>
        <input type="text" name="subject" class="form-control" value="{{ old('subject') }}" placeholder="e.g. Computer Science" required>
        @error('subject')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Publication:</label>
        <select name="publication" class="form-select" required>
            <option value="">Select Publication</option>
            <option value="Foreign" @selected(old('publication') === 'Foreign')>Foreign</option>
            <option value="Local" @selected(old('publication') === 'Local')>Local</option>
        </select>
        @error('publication')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Book Cover:</label>
        <input type="file" name="cover_image" class="form-control" accept="image/jpeg,image/png,image/webp">
        @error('cover_image')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        <small class="text-muted">Allowed formats: JPG, JPEG, PNG, WEBP. Max size: 2MB.</small>
        <div id="cover-preview-container" class="mt-2" style="display: none;">
            <img id="cover-preview" src="#" alt="Cover Preview" class="img-fluid border rounded" style="max-height: 200px; max-width: 150px; object-fit: contain; object-position: center;">
        </div>
    </div>
    <button type="submit" class="btn btn-success">Save Book</button>
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
