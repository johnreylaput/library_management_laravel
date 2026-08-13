@extends('layout.app')

@section('title', 'Add Librarian')

@section('content')
<h2 class="mb-4">Add Librarian</h2>
<form method="POST" action="{{ route('librarians.store') }}">
    @csrf
    <div class="mb-3">
        <label>Full Name</label>
        <input type="text" name="full_name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-select" required>
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Save Librarian</button>
    <a href="{{ route('librarians.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
