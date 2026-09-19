@extends('layout.app')

@section('title', 'Edit Thesis')

@section('content')
<h2 class="mb-4">Edit Thesis</h2>
<form method="POST" action="{{ route('theses.update', $thesis->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-6 mb-3">
            <label>Author</label>
            <input type="text" name="author" class="form-control" value="{{ old('author', $thesis->author) }}" required>
        </div>
        <div class="col-md-4 mb-3">
            <label>Research</label>
            <select name="research" class="form-select" required>
                <option value="">Select Research Type</option>
                <option value="Thesis" {{ old('research', $thesis->research) === 'Thesis' ? 'selected' : '' }}>Thesis</option>
                <option value="Capstone" {{ old('research', $thesis->research) === 'Capstone' ? 'selected' : '' }}>Capstone</option>
                <option value="Feasibility Study" {{ old('research', $thesis->research) === 'Feasibility Study' ? 'selected' : '' }}>Feasibility Study</option>
                <option value="Marketing Research" {{ old('research', $thesis->research) === 'Marketing Research' ? 'selected' : '' }}>Marketing Research</option>
                <option value="Undergraduate Thesis" {{ old('research', $thesis->research) === 'Undergraduate Thesis' ? 'selected' : '' }}>Undergraduate Thesis</option>
                <option value="Masteral Thesis" {{ old('research', $thesis->research) === 'Masteral Thesis' ? 'selected' : '' }}>Masteral Thesis</option>
                <option value="Doctoral Thesis" {{ old('research', $thesis->research) === 'Doctoral Thesis' ? 'selected' : '' }}>Doctoral Thesis</option>
                <option value="University Research" {{ old('research', $thesis->research) === 'University Research' ? 'selected' : '' }}>University Research</option>
            </select>
        </div>
        <div class="col-md-4 mb-3">
            <label>Date Published</label>
            <input type="date" name="date_published" class="form-control" value="{{ old('date_published', $thesis->date_published) }}" required>
        </div>
        <div class="col-md-12 mb-3">
            <label>Subjects / Keywords</label>
            <input type="text" name="subjects_keywords" class="form-control" value="{{ old('subjects_keywords', $thesis->subjects_keywords) }}" required>
        </div>
        <div class="col-12 mb-3">
            <label>Summary</label>
            <textarea name="summary" class="form-control" rows="4" required>{{ old('summary', $thesis->summary) }}</textarea>
        </div>
        <div class="col-12 mb-3">
            <label>Cover Image:</label>
            @if($thesis->cover_image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $thesis->cover_image) }}" alt="Current Cover" class="img-thumbnail" style="max-height: 150px;">
                    <div class="form-text">Leave empty to keep current image</div>
                </div>
            @endif
            <input type="file" name="cover_image" class="form-control" accept="image/*">
        </div>
    </div>
    <button type="submit" class="btn btn-success">Update Thesis</button>
    <a href="{{ route('theses.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
