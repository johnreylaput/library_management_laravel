@extends('layout.app')

@section('title', 'Users')

@section('content')
<h2 class="mb-4">Users</h2>
<a href="{{ route('users.create') }}" class="btn btn-primary mb-3"><i class="bi bi-plus-circle"></i> Add User</a>

<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->full_name }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <span class="badge bg-{{ $user->status === 'Active' ? 'success' : 'secondary' }}">
                        {{ $user->status }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this user?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
