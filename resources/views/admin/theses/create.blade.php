@extends('layout.app')

@section('title', 'Add Thesis')

@section('content')
<h2 class="mb-4">Add Thesis</h2>
<form method="POST" action="{{ route('theses.store') }}">
    @csrf
    <div class="row">
        <div class="col-md-6 mb-3">
            <label>Author</label>
            <input type="text" name="author" class="form-control" value="{{ old('author') }}" required>
        </div>
        <div class="col-md-4 mb-3">
            <label>Research</label>
            <select name="research" class="form-select" required>
                <option value="">Select Research Type</option>
                <option value="Thesis" {{ old('research') === 'Thesis' ? 'selected' : '' }}>Thesis</option>
                <option value="Capstone" {{ old('research') === 'Capstone' ? 'selected' : '' }}>Capstone</option>
                <option value="Feasibility Study" {{ old('research') === 'Feasibility Study' ? 'selected' : '' }}>Feasibility Study</option>
                <option value="Marketing Research" {{ old('research') === 'Marketing Research' ? 'selected' : '' }}>Marketing Research</option>
                <option value="Undergraduate Thesis" {{ old('research') === 'Undergraduate Thesis' ? 'selected' : '' }}>Undergraduate Thesis</option>
                <option value="Masteral Thesis" {{ old('research') === 'Masteral Thesis' ? 'selected' : '' }}>Masteral Thesis</option>
                <option value="Doctoral Thesis" {{ old('research') === 'Doctoral Thesis' ? 'selected' : '' }}>Doctoral Thesis</option>
                <option value="University Research" {{ old('research') === 'University Research' ? 'selected' : '' }}>University Research</option>
            </select>
        </div>
        <div class="col-md-4 mb-3">
            <label>Date Published</label>
            <input type="date" name="date_published" class="form-control" value="{{ old('date_published') }}" required>
        </div>
        <div class="col-md-12 mb-3">
            <label>Subjects / Keywords</label>
            <input type="text" name="subjects_keywords" class="form-control" value="{{ old('subjects_keywords') }}" required>
        </div>
        <div class="col-12 mb-3">
            <label>Summary</label>
            <textarea name="summary" class="form-control" rows="4" required>{{ old('summary') }}</textarea>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Save Thesis</button>
    <a href="{{ route('theses.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
