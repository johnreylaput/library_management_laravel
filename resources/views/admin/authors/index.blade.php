@extends('layout.app')

@section('title', 'Authors')

@section('content')
<h2 class="mb-4">Authors</h2>
<a href="{{ route('authors.create') }}" class="btn btn-primary mb-3"><i class="bi bi-plus-circle"></i> Add Author</a>

<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Name</th>
            <th>Biography</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($authors as $author)
            <tr>
                <td>{{ $author->author_name }}</td>
                <td>{{ Str::limit($author->biography ?? '-', 100) }}</td>
                <td>
                    <a href="{{ route('authors.show', $author->id) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('authors.destroy', $author->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this author?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
