@extends('layout.app')

@section('title', 'Theses')

@section('content')
<h2 class="mb-4">Theses</h2>
<div class="mb-3">
    <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-plus-circle"></i> Add Thesis
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('theses.create') }}"><i class="bi bi-plus-circle"></i> Add New Thesis</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><span class="dropdown-item-text text-muted">Quick Actions</span></li>
        </ul>
    </div>
</div>

<form method="GET" action="{{ route('theses.index') }}" class="row g-2 mb-3">
    <div class="col-md-4">
        <input type="text" name="q" class="form-control" placeholder="Search theses..." value="{{ $search ?? '' }}">
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
            <th>Authors</th>
            <th>Institution</th>
            <th>Thesis Type</th>
            <th>Year</th>
            <th>Added By</th>
            <th>Edited By</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($theses as $thesis)
            <tr>
                <td>{{ $thesis->title }}</td>
                <td>{{ Str::limit($thesis->authors, 30) }}</td>
                <td>{{ $thesis->institution ?? '-' }}</td>
                <td>{{ $thesis->thesis_type ?? '-' }}</td>
                <td>{{ $thesis->year ?? '-' }}</td>
                <td>{{ $thesis->added_by ?? '-' }}</td>
                <td>
                    @php
                        $editorText = $thesis->edited_by ?? '-';
                        preg_match('/^(.+) \(([^)]+)\)$/', $editorText, $editorMatches);
                    @endphp
                    {{ $editorMatches[1] ?? $editorText }}
                    @if(isset($editorMatches[2]))
                        <span class="badge bg-info">{{ $editorMatches[2] }}</span>
                    @endif
                </td>
                <td>
                    <span class="badge bg-{{ $thesis->status === 'Available' ? 'success' : 'danger' }}">
                        {{ $thesis->status }}
                    </span>
                </td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-gear"></i> Actions
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('member.theses.show', $thesis->id) }}">
                                    <i class="bi bi-eye text-info"></i> View
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('theses.edit', $thesis->id) }}">
                                    <i class="bi bi-pencil text-warning"></i> Edit
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('theses.destroy', $thesis->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm(@if(Auth::check() && Auth::user()->role === 'Working-Student')'Submit a deletion request for this thesis? The librarian will review it.'@else'Delete this thesis?'@endif)">
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
