@extends('layout.app')

@section('title', 'Books')

@section('content')
<h2 class="mb-4">Books</h2>
<div class="mb-3">
    <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-plus-circle"></i> Add Book
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('books.create') }}"><i class="bi bi-plus-circle"></i> Add New Book</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><span class="dropdown-item-text text-muted">Quick Actions</span></li>
        </ul>
    </div>
</div>

<form method="GET" action="{{ route('books.index') }}" class="row g-2 mb-3">
    <div class="col-md-4">
        <input type="text" name="q" class="form-control" placeholder="Search books..." value="{{ $search ?? '' }}">
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
            <th>Author</th>
            <th>Category</th>
            <th>ISBN</th>
            <th>Available</th>
            <th>Added By</th>
            <th>Edited By</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author->author_name ?? '-' }}</td>
                <td>{{ $book->category->category_name ?? '-' }}</td>
                <td>{{ $book->isbn ?? '-' }}</td>
                <td>{{ $book->available_quantity }}</td>
                <td>{{ $book->added_by ?? '-' }}</td>
                <td>
                    @php
                        $editorText = $book->edited_by ?? '-';
                        preg_match('/^(.+) \(([^)]+)\)$/', $editorText, $editorMatches);
                    @endphp
                    {{ $editorMatches[1] ?? $editorText }}
                    @if(isset($editorMatches[2]))
                        <span class="badge bg-info">{{ $editorMatches[2] }}</span>
                    @endif
                </td>
                <td>
                    <span class="badge bg-{{ ($book->status === 'Available' && $book->available_quantity > 0) ? 'success' : 'danger' }}">
                        {{ $book->status }}
                    </span>
                </td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-gear"></i> Actions
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('member.books.show', $book->id) }}">
                                    <i class="bi bi-eye text-info"></i> View
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('books.edit', $book->id) }}">
                                    <i class="bi bi-pencil text-warning"></i> Edit
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm(@if(Auth::check() && Auth::user()->role === 'Working-Student')'Submit a deletion request for this book? The librarian will review it.'@else'Delete this book?'@endif)">
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
