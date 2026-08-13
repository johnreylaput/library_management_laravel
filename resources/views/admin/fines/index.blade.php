@extends('layout.app')

@section('title', 'Fines')

@section('content')
<h2 class="mb-4">Fines</h2>
<a href="{{ route('fines.create') }}" class="btn btn-primary mb-3"><i class="bi bi-cash-coin"></i> New Fine</a>

<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Borrow ID</th>
            <th>Member</th>
            <th>Book</th>
            <th>Amount</th>
            <th>Reason</th>
            <th>Paid</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($fines as $fine)
            <tr>
                <td>#{{ $fine->borrow_id }}</td>
                <td>{{ $fine->borrow->member->user->full_name ?? '-' }}</td>
                <td>{{ $fine->borrow->book->title ?? '-' }}</td>
                <td>{{ number_format($fine->amount, 2) }}</td>
                <td>{{ $fine->reason ?? '-' }}</td>
                <td>
                    <span class="badge bg-{{ $fine->paid === 'Yes' ? 'success' : 'danger' }}">
                        {{ $fine->paid }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('fines.show', $fine->id) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('fines.edit', $fine->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('fines.destroy', $fine->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this fine?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
