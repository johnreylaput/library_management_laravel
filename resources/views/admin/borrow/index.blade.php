@extends('layout.app')

@section('title', 'Borrow Records')

@section('content')
<h2 class="mb-4">Borrow Records</h2>
<a href="{{ route('borrow.create') }}" class="btn btn-primary mb-3"><i class="bi bi-journal-arrow-down"></i> New Borrow</a>

<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Member</th>
            <th>Item Type</th>
            <th>Item Title</th>
            <th>Borrow Date</th>
            <th>Due Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($borrows as $borrow)
            @php
                $itemTitle = $borrow->book?->title ?? $borrow->journal?->title ?? $borrow->thesis?->title ?? '-';
                $itemType = $borrow->book ? 'Book' : ($borrow->journal ? 'Journal' : ($borrow->thesis ? 'Thesis' : '-'));
            @endphp
            <tr>
                <td>{{ $borrow->member->user->full_name ?? '-' }}</td>
                <td>{{ $itemType }}</td>
                <td>{{ $itemTitle }}</td>
                <td>{{ $borrow->borrow_date }}</td>
                <td>{{ $borrow->due_date }}</td>
                <td>
                    <span class="badge bg-{{ $borrow->status === 'Borrowed' ? 'warning' : ($borrow->status === 'Overdue' ? 'danger' : ($borrow->status === 'Pending' ? 'info' : ($borrow->status === 'Cancelled' ? 'secondary' : 'success'))) }}">
                        {{ $borrow->status }}
                    </span>
                </td>
                <td>
                    @if($borrow->status === 'Pending')
                        <form action="{{ route('borrow.approve', $borrow->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Approve this borrow request?')">
                            @csrf
                            <button class="btn btn-sm btn-success"><i class="bi bi-check"></i> Approve</button>
                        </form>
                        <form action="{{ route('borrow.reject', $borrow->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Reject this borrow request?')">
                            @csrf
                            <button class="btn btn-sm btn-danger"><i class="bi bi-x"></i> Reject</button>
                        </form>
                    @else
                        <a href="{{ route('borrow.show', $borrow->id) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('borrow.edit', $borrow->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('borrow.destroy', $borrow->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this record?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
