@extends('layout.app')

@section('title', 'User Details')

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <h2>{{ $user->full_name }}</h2>
        <p class="mt-3"><strong>Username:</strong> {{ $user->username }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Role:</strong> {{ $user->role }}</p>
        <p><strong>Status:</strong> {{ $user->status }}</p>
    </div>
</div>
<a href="{{ route('users.index') }}" class="btn btn-secondary">Back to Users</a>
@endsection
