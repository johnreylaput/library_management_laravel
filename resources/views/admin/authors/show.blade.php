@extends('layout.app')

@section('title', $author->author_name)

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <h2>{{ $author->author_name }}</h2>
        <p class="mt-3">{{ $author->biography ?? 'No biography available.' }}</p>
    </div>
</div>
<a href="{{ route('authors.index') }}" class="btn btn-secondary">Back to Authors</a>
@endsection
