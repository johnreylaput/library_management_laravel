@extends('layout.app')

@section('title', 'Add Thesis')

@section('content')
<h2 class="mb-4">Add Thesis</h2>
<form method="POST" action="{{ route('theses.store') }}">
    @csrf
    <div class="row">
        <div class="col-md-6 mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
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
            <label>Institution</label>
            <input type="text" name="institution" class="form-control" value="{{ old('institution') }}" placeholder="e.g. University of the Philippines">
        </div>
        <div class="col-md-4 mb-3">
            <label>Date Published</label>
            <input type="date" name="date_published" class="form-control" value="{{ old('date_published') }}" required>
        </div>
        <div class="col-md-6 mb-3">
            <label>Pages</label>
            <input type="text" name="pages" class="form-control" value="{{ old('pages') }}" placeholder="e.g. 150">
        </div>
        <div class="col-md-6 mb-3">
            <label>Category</label>
            <select name="category_id" class="form-select">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label>Advisor / Author Reference</label>
            <select name="author_id" class="form-select">
                <option value="">Select Author</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                        {{ $author->author_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label>Publisher</label>
            <select name="publisher_id" class="form-select">
                <option value="">Select Publisher</option>
                @foreach($publishers as $publisher)
                    <option value="{{ $publisher->id }}" {{ old('publisher_id') == $publisher->id ? 'selected' : '' }}>
                        {{ $publisher->publisher_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-12 mb-3">
            <label>Link / URL</label>
            <input type="url" name="link" class="form-control" value="{{ old('link') }}">
        </div>
        <div class="col-md-6 mb-3">
            <label>Database / Collection</label>
            <input type="text" name="database_collection" class="form-control" value="{{ old('database_collection') }}" placeholder="e.g. University Repository, JSTOR">
        </div>
        <div class="col-md-6 mb-3">
            <label>Availability</label>
            <select name="availability" class="form-select">
                <option value="Available" {{ old('availability') === 'Available' ? 'selected' : '' }}>Available</option>
                <option value="Unavailable" {{ old('availability') === 'Unavailable' ? 'selected' : '' }}>Unavailable</option>
                <option value="Archived" {{ old('availability') === 'Archived' ? 'selected' : '' }}>Archived</option>
            </select>
        </div>
        <div class="col-md-12 mb-3">
            <label>Subjects / Keywords</label>
            <input type="text" name="subjects_keywords" class="form-control" value="{{ old('subjects_keywords') }}" required>
        </div>
        <div class="col-12 mb-3">
            <label>Summary</label>
            <textarea name="summary" class="form-control" rows="4" required>{{ old('summary') }}</textarea>
        </div>
        <div class="col-12 mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Save Thesis</button>
    <a href="{{ route('theses.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
