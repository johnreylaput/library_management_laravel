@extends('layout.app')

@section('title', 'New Reservation')

@section('content')
<h2 class="mb-4">New Reservation</h2>

@if(session('error'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @if(session('recommendations') && session('recommendations')->count() > 0)
        <div class="card mb-3">
            <div class="card-header bg-warning"><h5>Recommended Books</h5></div>
            <div class="card-body">
                <div class="row">
                    @foreach(session('recommendations') as $rec)
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $rec->title }}</h5>
                                    <p class="card-text mb-1"><strong>Author:</strong> {{ $rec->author->author_name ?? 'N/A' }}</p>
                                    <p class="card-text mb-1"><strong>Category:</strong> {{ $rec->category->category_name ?? 'Uncategorized' }}</p>
                                    <p class="card-text mb-2"><strong>Available:</strong> {{ $rec->available_quantity }}</p>
                                    <form method="POST" action="{{ route('reservations.store') }}" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="member_input" value="{{ old('member_input') }}">
                                        <input type="hidden" name="book_input" value="{{ $rec->title }}">
                                        <input type="hidden" name="reservation_date" value="{{ old('reservation_date', date('Y-m-d')) }}">
                                        <input type="hidden" name="expiration_date" value="{{ old('expiration_date') }}">
                                        <button type="submit" class="btn btn-outline-primary btn-sm w-100">Reserve This</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endif

<form method="POST" action="{{ route('reservations.store') }}">
    @csrf
    <div class="mb-3">
        <label>Member Name / Member No</label>
        <input type="text" name="member_input" class="form-control" value="{{ old('member_input') }}" required placeholder="Enter member name or member number">
    </div>
    <div class="mb-3">
        <label>Book Title</label>
        <input type="text" name="book_input" class="form-control" value="{{ old('book_input') }}" required placeholder="Enter book title">
    </div>
    <div class="mb-3">
        <label>Reservation Date</label>
        <input type="date" name="reservation_date" class="form-control" value="{{ old('reservation_date', date('Y-m-d')) }}">
    </div>
    <div class="mb-3">
        <label>Expiration Date</label>
        <input type="date" name="expiration_date" class="form-control" value="{{ old('expiration_date') }}">
    </div>
    <button type="submit" class="btn btn-success">Save Reservation</button>
    <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
