@extends('layout.app')

@section('title', $category->category_name)

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <h2>{{ $category->category_name }}</h2>
        <p class="mt-3">{{ $category->description ?? 'No description available.' }}</p>
    </div>
</div>
<a href="{{ route('categories.index') }}" class="btn btn-secondary">Back to Categories</a>
@endsection
