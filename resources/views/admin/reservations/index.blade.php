@extends('layout.app')

@section('title', 'Reservations')

@section('content')
<h2 class="mb-4">Reservations</h2>
<a href="{{ route('reservations.create') }}" class="btn btn-primary mb-3"><i class="bi bi-calendar-check"></i> New Reservation</a>

<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Member</th>
            <th>Item Type</th>
            <th>Item Title</th>
            <th>Reservation Date</th>
            <th>Expiration Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reservations as $reservation)
            @php
                $itemTitle = $reservation->book?->title ?? $reservation->journal?->title ?? $reservation->thesis?->title ?? '-';
                $itemType = $reservation->book ? 'Book' : ($reservation->journal ? 'Journal' : ($reservation->thesis ? 'Thesis' : '-'));
            @endphp
            <tr>
                <td>{{ $reservation->member->user->full_name ?? '-' }}</td>
                <td>{{ $itemType }}</td>
                <td>{{ $itemTitle }}</td>
                <td>{{ $reservation->reservation_date ?? '-' }}</td>
                <td>{{ $reservation->expiration_date ?? '-' }}</td>
                <td>
                    <span class="badge bg-{{ $reservation->status === 'Pending' ? 'warning' : ($reservation->status === 'Approved' ? 'info' : ($reservation->status === 'Claimed' ? 'success' : 'danger')) }}">
                        {{ $reservation->status }}
                    </span>
                </td>
                <td>
                    @if($reservation->status === 'Pending')
                        <form action="{{ route('reservations.approve', $reservation->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Approve this reservation?')">
                            @csrf
                            <button class="btn btn-sm btn-success"><i class="bi bi-check"></i> Approve</button>
                        </form>
                        <form action="{{ route('reservations.reject', $reservation->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Reject this reservation?')">
                            @csrf
                            <button class="btn btn-sm btn-danger"><i class="bi bi-x"></i> Reject</button>
                        </form>
                    @else
                        <a href="{{ route('reservations.show', $reservation->id) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this reservation?')">
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
