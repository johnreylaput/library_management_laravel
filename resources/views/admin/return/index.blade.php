@extends('layout.app')

@section('title', 'Return Records')

@section('content')
<h2 class="mb-4">Return Records</h2>
<a href="{{ route('return.create') }}" class="btn btn-primary mb-3"><i class="bi bi-arrow-return-left"></i> New Return</a>

<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Borrow ID</th>
            <th>Book</th>
            <th>Member</th>
            <th>Return Date</th>
            <th>Condition</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($returns as $return)
            <tr>
                <td>#{{ $return->borrow_id }}</td>
                <td>{{ $return->borrow->book->title ?? '-' }}</td>
                <td>{{ $return->borrow->member->user->full_name ?? '-' }}</td>
                <td>{{ $return->return_date ?? '-' }}</td>
                <td>{{ $return->condition_status }}</td>
                <td>
                    <a href="{{ route('return.show', $return->id) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('return.edit', $return->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('return.destroy', $return->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this record?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
