@extends('layout.app')

@section('title', 'Add Journal Article')

@section('content')
<h2 class="mb-4">Add Journal Article</h2>
@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{ route('journals.store') }}">
    @csrf
    <div class="row">
        <div class="col-md-12 mb-3">
            <label>Author of the Article:</label>
            <input type="text" name="authors" class="form-control" required>
        </div>
        <div class="col-md-12 mb-3">
            <label>Title of the Article:</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="col-md-12 mb-3">
            <label>Source: "Title of the Journal"</label>
            <input type="text" name="journal_name_source" class="form-control">
        </div>
        <div class="col-md-12 mb-3">
            <label>Title of the Journal:</label>
            <input type="text" name="journal_name" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
            <label>Volume</label>
            <input type="text" name="volume" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>Issue</label>
            <input type="text" name="issue" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>Pages</label>
            <input type="text" name="pages" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>Publication Date</label>
            <input type="text" name="publication_date" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>ISSN</label>
            <input type="text" name="issn" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>Link</label>
            <input type="url" name="link" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>Borrowed</label>
            <select name="availability" class="form-select">
                <option value="" selected></option>
                <option value="Available">Available</option>
                <option value="Unavailable">Unavailable</option>
                <option value="Archived">Archived</option>
            </select>
        </div>
        <div class="col-md-12 mb-3">
            <label>Abstract: "full abstract"</label>
            <textarea name="abstract" class="form-control" rows="4"></textarea>
        </div>
        <div class="col-md-12 mb-3">
            <label>Keyword:</label>
            <input type="text" name="keyword" class="form-control">
        </div>
        <div class="col-md-12 mb-3">
            <label>Note:</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>
    </div>
    <div class="d-flex gap-2 mt-3">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-check-circle"></i> Save
        </button>
        <a href="{{ route('e-periodical.index', ['view' => 'all-journals']) }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back to View Journal Article
        </a>
    </div>
</form>
@endsection
