@extends('layout.app')

@section('title', 'Reserve a Book')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0"><i class="bi bi-calendar-check"></i> Reserve a Book</h2>
    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Back to Dashboard
    </a>
</div>

@if($selectedBook)
    <div class="card mb-4 border-warning">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0"><i class="bi bi-book"></i> {{ $selectedBook->title }}</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 text-center mb-3">
                    @if($selectedBook->book_cover)
                        <img src="{{ asset('storage/' . $selectedBook->book_cover) }}" class="img-fluid rounded" alt="{{ $selectedBook->title }}" style="max-height:200px;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center rounded mx-auto" style="height:200px;width:140px;font-size:3rem;color:#aaa;">
                            <i class="bi bi-book"></i>
                        </div>
                    @endif
                </div>
                <div class="col-md-9">
                    <p class="mb-1"><strong>Accession No:</strong> {{ $selectedBook->accession_no ?? '-' }}</p>
                    <p class="mb-1"><strong>ISBN:</strong> {{ $selectedBook->isbn ?? '-' }}</p>
                    <p class="mb-1"><strong>Author:</strong> {{ $selectedBook->author->author_name ?? '-' }}</p>
                    <p class="mb-1"><strong>Category:</strong> {{ $selectedBook->category->category_name ?? 'Uncategorized' }}</p>
                    <p class="mb-1"><strong>Publisher:</strong> {{ $selectedBook->publisher->publisher_name ?? '-' }}</p>
                    <p class="mb-1"><strong>Publication Year:</strong> {{ $selectedBook->publication_year ?? '-' }}</p>
                    <p class="mb-1"><strong>Edition:</strong> {{ $selectedBook->edition ?? '-' }}</p>
                    <p class="mb-1"><strong>Language:</strong> {{ $selectedBook->language ?? '-' }}</p>
                    <p class="mb-1"><strong>Pages:</strong> {{ $selectedBook->pages ?? '-' }}</p>
                    <p class="mb-1"><strong>Total Quantity:</strong> {{ $selectedBook->quantity ?? '-' }}</p>
                    <p class="mb-1"><strong>Available Quantity:</strong> {{ $selectedBook->available_quantity ?? '-' }}</p>
                    <p class="mb-1"><strong>Shelf Location:</strong> {{ $selectedBook->shelf_location ?? '-' }}</p>
                    <p class="mb-1"><strong>Status:</strong>
                        <span class="badge bg-{{ ($selectedBook->available_quantity > 0 && $selectedBook->status === 'Available') ? 'success' : 'danger' }}">
                            {{ $selectedBook->status ?? 'N/A' }}
                        </span>
                    </p>
                    @if($selectedBook->description)
                        <p class="mt-3 mb-1"><strong>Description:</strong></p>
                        <p class="text-muted">{{ $selectedBook->description }}</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer bg-white">
            <form action="{{ route('member.reservation.store') }}" method="POST" onsubmit="return confirm('Request to reserve {{ addslashes($selectedBook->title) }}?');">
                @csrf
                <input type="hidden" name="book_id" value="{{ $selectedBook->id }}">
                <input type="hidden" name="reservation_date" value="{{ date('Y-m-d') }}">
                <input type="hidden" name="expiration_date" value="{{ date('Y-m-d', strtotime('+7 days')) }}">
                <button type="submit" class="btn btn-warning" @if($selectedBook->available_quantity <= 0 || $selectedBook->status !== 'Available') disabled @endif>
                    <i class="bi bi-calendar-check"></i> Reserve
                </button>
                <a href="{{ route('member.reservation.index') }}" class="btn btn-secondary">Choose Another Book</a>
            </form>
        </div>
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-list"></i> All Books</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Year</th>
                        <th>Status</th>
                        <th>Available</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author->author_name ?? 'N/A' }}</td>
                            <td>{{ $book->category->category_name ?? 'Uncategorized' }}</td>
                            <td>{{ $book->publication_year ?? '-' }}</td>
                            <td>
                                <span class="badge bg-{{ ($book->available_quantity > 0 && $book->status === 'Available') ? 'success' : 'danger' }}">
                                    {{ $book->status ?? 'Unavailable' }}
                                </span>
                            </td>
                            <td>{{ $book->available_quantity ?? 0 }}</td>
                            <td>
                                <a href="{{ route('member.reservation.index', ['book_id' => $book->id]) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-calendar-check"></i> Reserve
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No books available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
