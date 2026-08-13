@extends('layout.app')

@section('title', 'Edit Journal Article')

@section('content')
<h2 class="mb-4">Edit Journal Article</h2>
<form method="POST" action="{{ route('journals.update', $journal->id) }}">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-12 mb-3">
            <label>Author of the Article:</label>
            <input type="text" name="authors" class="form-control" value="{{ old('authors', $journal->authors) }}" placeholder="e.g. Smith, John; Doe, Jane">
        </div>
        <div class="col-md-12 mb-3">
            <label>Title of the Article:</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $journal->title) }}" required>
        </div>
        <div class="col-md-12 mb-3">
            <label>Source: "Title of the Journal"</label>
            <input type="text" name="journal_name_source" class="form-control" value="{{ old('journal_name_source', $journal->journal_name) }}">
        </div>
        <div class="col-md-12 mb-3">
            <label>Title of the Journal:</label>
            <input type="text" name="journal_name" class="form-control" value="{{ old('journal_name', $journal->journal_name) }}" required>
        </div>
        <div class="col-md-12 mb-3">
            <label>Abstract: "full abstract"</label>
            <textarea name="abstract" class="form-control" rows="4">{{ old('abstract', $journal->abstract) }}</textarea>
        </div>
        <div class="col-md-12 mb-3">
            <label>Subject:</label>
            <input type="text" name="subjects" class="form-control" value="{{ old('subjects', $journal->subjects) }}" placeholder="e.g. Psychology, Education">
        </div>
        <div class="col-md-12 mb-3">
            <label>Keyword:</label>
            <input type="text" name="keyword" class="form-control" value="{{ old('keyword', $journal->keyword) }}" placeholder="e.g. education, psychology, research">
        </div>
        <div class="col-md-12 mb-3">
            <label>Note:</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', $journal->description) }}</textarea>
        </div>
        <div class="col-md-6 mb-3">
            <label>Volume</label>
            <input type="text" name="volume" class="form-control" value="{{ old('volume', $journal->volume) }}">
        </div>
        <div class="col-md-6 mb-3">
            <label>Issue</label>
            <input type="text" name="issue" class="form-control" value="{{ old('issue', $journal->issue) }}">
        </div>
        <div class="col-md-6 mb-3">
            <label>Pages</label>
            <input type="text" name="pages" class="form-control" value="{{ old('pages', $journal->pages) }}" placeholder="e.g. 123-145">
        </div>
        <div class="col-md-6 mb-3">
            <label>Publication Date</label>
            <input type="date" name="publication_date" class="form-control" value="{{ old('publication_date', $journal->publication_date) }}">
        </div>
        <div class="col-md-6 mb-3">
            <label>DOI</label>
            <input type="text" name="doi" class="form-control" value="{{ old('doi', $journal->doi) }}" placeholder="e.g. 10.1234/example.doi">
        </div>
        <div class="col-md-6 mb-3">
            <label>ISSN</label>
            <input type="text" name="issn" class="form-control" value="{{ old('issn', $journal->issn) }}" placeholder="e.g. 1234-5678">
        </div>
        <div class="col-md-6 mb-3">
            <label>Link / URL</label>
            <input type="url" name="link" class="form-control" value="{{ old('link', $journal->link) }}">
        </div>
        <div class="col-md-6 mb-3">
            <label>Database / Collection</label>
            <input type="text" name="database_collection" class="form-control" value="{{ old('database_collection', $journal->database_collection) }}" placeholder="e.g. JSTOR, ScienceDirect">
        </div>
        <div class="col-md-6 mb-3">
            <label>Availability</label>
            <select name="availability" class="form-select">
                <option value="Available" {{ old('availability', $journal->availability) === 'Available' ? 'selected' : '' }}>Available</option>
                <option value="Unavailable" {{ old('availability', $journal->availability) === 'Unavailable' ? 'selected' : '' }}>Unavailable</option>
                <option value="Archived" {{ old('availability', $journal->availability) === 'Archived' ? 'selected' : '' }}>Archived</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label>Publisher</label>
            <input type="text" name="publisher_text" class="form-control" value="{{ old('publisher_text', $journal->publisher_text) }}" placeholder="e.g. Elsevier, Springer">
        </div>
    </div>
    <button type="submit" class="btn btn-success">Update Journal Article</button>
    <a href="{{ route('journals.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
