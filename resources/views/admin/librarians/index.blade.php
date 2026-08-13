@extends('layout.app')

@section('title', 'Librarians')

@section('content')
<h2 class="mb-4">Librarians</h2>
<a href="{{ route('librarians.create') }}" class="btn btn-primary mb-3"><i class="bi bi-plus-circle"></i> Add Librarian</a>

<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($librarians as $librarian)
            <tr>
                <td>{{ $librarian->full_name }}</td>
                <td>{{ $librarian->username }}</td>
                <td>{{ $librarian->email }}</td>
                <td>
                    <span class="badge bg-{{ $librarian->status === 'Active' ? 'success' : 'secondary' }}">
                        {{ $librarian->status }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('librarians.show', $librarian->id) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('librarians.edit', $librarian->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('librarians.destroy', $librarian->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this librarian?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
