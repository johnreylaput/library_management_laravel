@extends('layout.app')

@section('title', 'Publishers')

@section('content')
<h2 class="mb-4">Publishers</h2>
<a href="{{ route('publishers.create') }}" class="btn btn-primary mb-3"><i class="bi bi-plus-circle"></i> Add Publisher</a>

<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Contact</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($publishers as $publisher)
            <tr>
                <td>{{ $publisher->publisher_name }}</td>
                <td>{{ $publisher->address ?? '-' }}</td>
                <td>{{ $publisher->contact_number ?? '-' }}</td>
                <td>
                    <a href="{{ route('publishers.show', $publisher->id) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('publishers.edit', $publisher->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('publishers.destroy', $publisher->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this publisher?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
