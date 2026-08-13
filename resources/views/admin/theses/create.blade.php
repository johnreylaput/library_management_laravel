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
            <label>Author(s)</label>
            <input type="text" name="authors" class="form-control" placeholder="e.g. Smith, John; Doe, Jane">
        </div>
        <div class="col-md-4 mb-3">
            <label>Thesis Type</label>
            <input type="text" name="thesis_type" class="form-control" placeholder="e.g. Master's, PhD">
        </div>
        <div class="col-md-4 mb-3">
            <label>Institution</label>
            <input type="text" name="institution" class="form-control" placeholder="e.g. University of the Philippines">
        </div>
        <div class="col-md-4 mb-3">
            <label>Year</label>
            <input type="number" name="year" class="form-control" placeholder="e.g. 2024" min="1900" max="2099">
        </div>
        <div class="col-md-6 mb-3">
            <label>Pages</label>
            <input type="text" name="pages" class="form-control" placeholder="e.g. 150">
        </div>
        <div class="col-md-6 mb-3">
            <label>Category</label>
            <select name="category_id" class="form-select">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label>Advisor / Author Reference</label>
            <select name="author_id" class="form-select">
                <option value="">Select Author</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->author_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label>Publisher</label>
            <select name="publisher_id" class="form-select">
                <option value="">Select Publisher</option>
                @foreach($publishers as $publisher)
                    <option value="{{ $publisher->id }}">{{ $publisher->publisher_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 mb-3">
            <label>Link / URL</label>
            <input type="url" name="link" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>Database / Collection</label>
            <input type="text" name="database_collection" class="form-control" placeholder="e.g. University Repository, JSTOR">
        </div>
        <div class="col-md-6 mb-3">
            <label>Availability</label>
            <select name="availability" class="form-select">
                <option value="Available">Available</option>
                <option value="Unavailable">Unavailable</option>
                <option value="Archived">Archived</option>
            </select>
        </div>
        <div class="col-md-12 mb-3">
            <label>Subject / Keywords</label>
            <input type="text" name="subjects" class="form-control" placeholder="e.g. Psychology, Education">
        </div>
        <div class="col-12 mb-3">
            <label>Abstract</label>
            <textarea name="abstract" class="form-control" rows="4"></textarea>
        </div>
        <div class="col-12 mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Save Thesis</button>
    <a href="{{ route('theses.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
