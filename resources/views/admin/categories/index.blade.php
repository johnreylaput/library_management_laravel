@extends('layout.app')

@section('title', 'Categories')

@section('content')
<h2 class="mb-4">Categories</h2>
<a href="{{ route('categories.create') }}" class="btn btn-primary mb-3"><i class="bi bi-plus-circle"></i> Add Category</a>

<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->category_name }}</td>
                <td>{{ $category->description ?? '-' }}</td>
                <td>
                    <a href="{{ route('categories.show', $category->id) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this category?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
