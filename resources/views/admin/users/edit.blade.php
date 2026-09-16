@extends('layout.app')

@section('title', 'Edit User')

@section('content')

<div class="container">

    <h2 class="mb-4">Edit User</h2>

    <form method="POST" action="{{ route('users.update', $user->id) }}">

        @csrf
        @method('PUT')

        {{-- Full Name --}}
        <div class="mb-3">
            <label for="full_name" class="form-label">
                Full Name
            </label>

            <input
                type="text"
                id="full_name"
                name="full_name"
                class="form-control"
                value="{{ old('full_name', $user->full_name) }}"
                required
            >

            @error('full_name')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>


        {{-- Username --}}
        <div class="mb-3">
            <label for="username" class="form-label">
                Username
            </label>

            <input
                type="text"
                id="username"
                name="username"
                class="form-control"
                value="{{ old('username', $user->username) }}"
                required
            >

            @error('username')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>


        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">
                Email
            </label>

            <input
                type="email"
                id="email"
                name="email"
                class="form-control"
                value="{{ old('email', $user->email) }}"
                required
            >

            @error('email')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>


        {{-- Password --}}
        <div class="mb-3">
            <label for="password" class="form-label">
                Password
                <small class="text-muted">
                    (leave blank to keep current password)
                </small>
            </label>

            <input
                type="password"
                id="password"
                name="password"
                class="form-control"
            >

            @error('password')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>


        {{-- Role --}}
        <div class="mb-3">
            <label for="role" class="form-label">
                Role
            </label>

            <select
                id="role"
                name="role"
                class="form-select"
                required
            >
                <option value="Admin"
                    {{ old('role', $user->role) === 'Admin' ? 'selected' : '' }}>
                    Admin
                </option>

                <option value="Librarian"
                    {{ old('role', $user->role) === 'Librarian' ? 'selected' : '' }}>
                    Librarian
                </option>

                <option value="Member"
                    {{ old('role', $user->role) === 'Member' ? 'selected' : '' }}>
                    Member
                </option>

                <option value="Working.Student"
                    {{ old('role', $user->role) === 'Working.Student' ? 'selected' : '' }}>
                    Working Student
                </option>
            </select>

            @error('role')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>


        {{-- Status --}}
        <div class="mb-3">
            <label for="status" class="form-label">
                Status
            </label>

            <select
                id="status"
                name="status"
                class="form-select"
                required
            >

                <option value="Active"
                    {{ old('status', $user->status) === 'Active' ? 'selected' : '' }}>
                    Active
                </option>

                <option value="Inactive"
                    {{ old('status', $user->status) === 'Inactive' ? 'selected' : '' }}>
                    Inactive
                </option>

            </select>

            @error('status')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>


        {{-- Buttons --}}
        <button type="submit" class="btn btn-success">
            Update User
        </button>

        <a
            href="{{ route('users.index') }}"
            class="btn btn-secondary"
        >
            Cancel
        </a>

    </form>

</div>

@endsection