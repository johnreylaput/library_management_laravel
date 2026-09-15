@extends('layout.app')

@section('title', 'Books')

@section('content')
<h2 class="mb-4">Books</h2>
<a href="{{ route('books.create') }}" class="btn btn-primary mb-3"><i class="bi bi-plus-circle"></i> Add Book</a>

<form method="GET" action="{{ route('books.index') }}" class="row g-2 mb-3">
    <div class="col-md-4">
        <input type="text" name="q" class="form-control" placeholder="Search books..." value="{{ $search ?? '' }}">
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-dark w-100"><i class="bi bi-search"></i> Search</button>
    </div>
</form>

<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Author</th>
            <th>Title</th>
            <th>Edition</th>
            <th>Year</th>
            <th>Subject</th>
            <th>Publication</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($books as $book)
            <tr>
                <td>{{ $book->author ?? '-' }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->edition ?? '-' }}</td>
                <td>{{ $book->year ?? '-' }}</td>
                <td>{{ $book->subject ?? '-' }}</td>
                <td>{{ $book->publication ?? '-' }}</td>
                <td>
                    <a href="{{ route('member.books.show', $book->id) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this book?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection