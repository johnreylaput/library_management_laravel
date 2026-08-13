@extends('layout.app')

@section('title', 'Edit Thesis')

@section('content')
<h2 class="mb-4">Edit Thesis</h2>
<form method="POST" action="{{ route('theses.update', $thesis->id) }}">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-6 mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $thesis->title) }}" required>
        </div>
        <div class="col-md-6 mb-3">
            <label>Author(s)</label>
            <input type="text" name="authors" class="form-control" value="{{ old('authors', $thesis->authors) }}" placeholder="e.g. Smith, John; Doe, Jane">
        </div>
        <div class="col-md-4 mb-3">
            <label>Thesis Type</label>
            <input type="text" name="thesis_type" class="form-control" value="{{ old('thesis_type', $thesis->thesis_type) }}" placeholder="e.g. Master's, PhD">
        </div>
        <div class="col-md-4 mb-3">
            <label>Institution</label>
            <input type="text" name="institution" class="form-control" value="{{ old('institution', $thesis->institution) }}" placeholder="e.g. University of the Philippines">
        </div>
        <div class="col-md-4 mb-3">
            <label>Year</label>
            <input type="number" name="year" class="form-control" value="{{ old('year', $thesis->year) }}" placeholder="e.g. 2024" min="1900" max="2099">
        </div>
        <div class="col-md-6 mb-3">
            <label>Pages</label>
            <input type="text" name="pages" class="form-control" value="{{ old('pages', $thesis->pages) }}" placeholder="e.g. 150">
        </div>
        <div class="col-md-6 mb-3">
            <label>Category</label>
            <select name="category_id" class="form-select">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $thesis->category_id) == $category->id ? 'selected' : '' }}>
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
                    <option value="{{ $author->id }}" {{ old('author_id', $thesis->author_id) == $author->id ? 'selected' : '' }}>
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
                    <option value="{{ $publisher->id }}" {{ old('publisher_id', $thesis->publisher_id) == $publisher->id ? 'selected' : '' }}>
                        {{ $publisher->publisher_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-12 mb-3">
            <label>Link / URL</label>
            <input type="url" name="link" class="form-control" value="{{ old('link', $thesis->link) }}">
        </div>
        <div class="col-md-6 mb-3">
            <label>Database / Collection</label>
            <input type="text" name="database_collection" class="form-control" value="{{ old('database_collection', $thesis->database_collection) }}" placeholder="e.g. University Repository, JSTOR">
        </div>
        <div class="col-md-6 mb-3">
            <label>Availability</label>
            <select name="availability" class="form-select">
                <option value="Available" {{ old('availability', $thesis->availability) === 'Available' ? 'selected' : '' }}>Available</option>
                <option value="Unavailable" {{ old('availability', $thesis->availability) === 'Unavailable' ? 'selected' : '' }}>Unavailable</option>
                <option value="Archived" {{ old('availability', $thesis->availability) === 'Archived' ? 'selected' : '' }}>Archived</option>
            </select>
        </div>
        <div class="col-md-12 mb-3">
            <label>Subject / Keywords</label>
            <input type="text" name="subjects" class="form-control" value="{{ old('subjects', $thesis->subjects) }}" placeholder="e.g. Psychology, Education">
        </div>
        <div class="col-12 mb-3">
            <label>Abstract</label>
            <textarea name="abstract" class="form-control" rows="4">{{ old('abstract', $thesis->abstract) }}</textarea>
        </div>
        <div class="col-12 mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', $thesis->description) }}</textarea>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Update Thesis</button>
    <a href="{{ route('theses.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
