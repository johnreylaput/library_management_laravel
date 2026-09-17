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
                    <div class="bg-light d-flex align-items-center justify-content-center rounded mx-auto" style="height:200px;width:140px;font-size:3rem;color:#aaa;">
                        <i class="bi bi-book"></i>
                    </div>
                </div>
                <div class="col-md-9">
                    <p class="mb-1"><strong>Author:</strong> {{ $selectedBook->author ?? '-' }}</p>
                    <p class="mb-1"><strong>Title:</strong> {{ $selectedBook->title }}</p>
                    <p class="mb-1"><strong>Edition:</strong> {{ $selectedBook->edition ?? '-' }}</p>
                    <p class="mb-1"><strong>Year:</strong> {{ $selectedBook->year ?? '-' }}</p>
                    <p class="mb-1"><strong>Subject:</strong> {{ $selectedBook->subject ?? '-' }}</p>
                    <p class="mb-1"><strong>Publication:</strong> {{ $selectedBook->publication ?? '-' }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer bg-white">
            <form action="{{ route('member.reservation.store') }}" method="POST" onsubmit="return confirm('Request to reserve {{ addslashes($selectedBook->title) }}?');">
                @csrf
                <input type="hidden" name="book_id" value="{{ $selectedBook->id }}">
                <input type="hidden" name="reservation_date" value="{{ date('Y-m-d') }}">
                <input type="hidden" name="due_date" value="{{ date('Y-m-d', strtotime('+3 days')) }}">
                <button type="submit" class="btn btn-warning">
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
                        <th>Edition</th>
                        <th>Year</th>
                        <th>Subject</th>
                        <th>Publication</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author ?? 'N/A' }}</td>
                            <td>{{ $book->edition ?? '-' }}</td>
                            <td>{{ $book->year ?? '-' }}</td>
                            <td>{{ $book->subject ?? '-' }}</td>
                            <td>{{ $book->publication ?? '-' }}</td>
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