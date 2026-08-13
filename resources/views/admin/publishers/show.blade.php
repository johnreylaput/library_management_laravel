@extends('layout.app')

@section('title', $publisher->publisher_name)

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <h2>{{ $publisher->publisher_name }}</h2>
        <p class="mt-3"><strong>Address:</strong> {{ $publisher->address ?? '-' }}</p>
        <p><strong>Contact:</strong> {{ $publisher->contact_number ?? '-' }}</p>
    </div>
</div>
<a href="{{ route('publishers.index') }}" class="btn btn-secondary">Back to Publishers</a>
@endsection
