@extends('layout.app')

@section('title', 'Journals')

@section('content')
<h2 class="mb-4">Journals</h2>
<div class="mb-3">
    <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-plus-circle"></i> Add Journal Article
        </button>
        <ul class="dropdown-menu">
            <li>
                <a class="dropdown-item" href="{{ route('journals.create') }}">
                    <i class="bi bi-plus-circle"></i> Add New Journal Article
                </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <a class="dropdown-item" href="{{ route('journals.index') }}">
                    <i class="bi bi-list"></i> View All Journal Articles
                </a>
            </li>
        </ul>
    </div>
</div>

<form method="GET" action="{{ route('journals.index') }}" class="row g-2 mb-3">
    <div class="col-md-4">
        <input type="text" name="q" class="form-control" placeholder="Search journals..." value="{{ $search ?? '' }}">
    </div>
    <div class="col-md-3">
        <select name="category" class="form-select">
            <option value="">All Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ ($categoryId ?? '') == $category->id ? 'selected' : '' }}>
                    {{ $category->category_name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-dark w-100"><i class="bi bi-search"></i> Search</button>
    </div>
</form>

<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Title</th>
            <th>Journal Name</th>
            <th>Authors</th>
            <th>Volume / Issue</th>
            <th>Publication Date</th>
            <th>Added By</th>
            <th>Edited By</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($journals as $journal)
            <tr>
                <td>{{ $journal->title }}</td>
                <td>{{ $journal->journal_name }}</td>
                <td>{{ Str::limit($journal->authors, 30) }}</td>
                <td>{{ $journal->volume ?? '-' }} / {{ $journal->issue ?? '-' }}</td>
                <td>{{ $journal->publication_date ?? '-' }}</td>
                <td>{{ $journal->added_by ?? '-' }}</td>
                <td>
                    @php
                        $editorText = $journal->edited_by ?? '-';
                        preg_match('/^(.+) \(([^)]+)\)$/', $editorText, $editorMatches);
                    @endphp
                    {{ $editorMatches[1] ?? $editorText }}
                    @if(isset($editorMatches[2]))
                        <span class="badge bg-info">{{ $editorMatches[2] }}</span>
                    @endif
                </td>
                <td>
                    <span class="badge bg-{{ $journal->status === 'Available' ? 'success' : 'danger' }}">
                        {{ $journal->status }}
                    </span>
                </td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-gear"></i> Actions
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('member.journals.show', $journal->id) }}">
                                    <i class="bi bi-eye text-info"></i> View
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('journals.edit', $journal->id) }}">
                                    <i class="bi bi-pencil text-warning"></i> Edit
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('journals.destroy', $journal->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm(@if(Auth::check() && Auth::user()->role === 'Working-Student')'Submit a deletion request for this journal? The librarian will review it.'@else'Delete this journal?'@endif)">
                                        @if(Auth::check() && Auth::user()->role === 'Working-Student')
                                            <i class="bi bi-send"></i> Request Deletion
                                        @else
                                            <i class="bi bi-trash"></i> Delete
                                        @endif
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection