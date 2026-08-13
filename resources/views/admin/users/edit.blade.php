@extends('layout.app')

@section('title', 'Edit User')

@section('content')
<h2 class="mb-4">Edit User</h2>
<form method="POST" action="{{ route('users.update', $user->id) }}">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Full Name</label>
        <input type="text" name="full_name" class="form-control" value="{{ $user->full_name }}" required>
    </div>
    <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control" value="{{ $user->username }}" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
    </div>
    <div class="mb-3">
        <label>Password (leave blank to keep current)</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="mb-3">
        <label>Role</label>
        <select name="role" class="form-select" required>
            <option value="Admin" {{ $user->role === 'Admin' ? 'selected' : '' }}>Admin</option>
            <option value="Librarian" {{ $user->role === 'Librarian' ? 'selected' : '' }}>Librarian</option>
            <option value="Member" {{ $user->role === 'Member' ? 'selected' : '' }}>Member</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-select" required>
            <option value="Active" {{ $user->status === 'Active' ? 'selected' : '' }}>Active</option>
            <option value="Inactive" {{ $user->status === 'Inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Update User</button>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
