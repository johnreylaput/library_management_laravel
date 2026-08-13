@extends('layout.app')

@section('title', 'Librarian Details')

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <h2>{{ $librarian->full_name }}</h2>
        <p class="mt-3"><strong>Username:</strong> {{ $librarian->username }}</p>
        <p><strong>Email:</strong> {{ $librarian->email }}</p>
        <p><strong>Role:</strong> {{ $librarian->role }}</p>
        <p><strong>Status:</strong> {{ $librarian->status }}</p>
    </div>
</div>
<a href="{{ route('librarians.index') }}" class="btn btn-secondary">Back to Librarians</a>
@endsection
