@extends('layout.app')

@section('title', 'Borrow')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0"><i class="bi bi-journal-arrow-down"></i> Borrow</h2>
    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Back to Dashboard
    </a>
</div>

@if($selectedBook)
    <div class="card mb-4 border-primary">
        <div class="card-header bg-primary text-white">
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
            <form action="{{ route('member.borrow.store') }}" method="POST" onsubmit="return confirm('Request to borrow {{ addslashes($selectedBook->title) }}?');">
                @csrf
                <input type="hidden" name="book_id" value="{{ $selectedBook->id }}">
                <input type="hidden" name="borrow_date" value="{{ date('Y-m-d') }}">
                <input type="hidden" name="due_date" value="{{ date('Y-m-d', strtotime('+3 days')) }}">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-journal-arrow-down"></i> Borrow
                </button>
                <a href="{{ route('member.borrow.index') }}" class="btn btn-secondary">Choose Another Book</a>
            </form>
        </div>
    </div>
@endif

@if($selectedJournal)
    <div class="card mb-4 border-primary">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-journal-arrow-down"></i> {{ $selectedJournal->title }}</h5>
        </div>
        <div class="card-body">
            <p class="mb-1"><strong>Author of the Article:</strong> {{ $selectedJournal->authors ?? '-' }}</p>
            <p class="mb-1"><strong>Title of the Article:</strong> {{ $selectedJournal->title }}</p>
            <p class="mb-1"><strong>Title of the Journal:</strong> {{ $selectedJournal->journal_name ?? '-' }}</p>
            <p class="mb-1"><strong>Availability:</strong>
                <span class="badge bg-{{ $selectedJournal->availability === 'Available' ? 'success' : 'danger' }}">
                    {{ $selectedJournal->availability ?? 'N/A' }}
                </span>
            </p>
        </div>
        <div class="card-footer bg-white">
            <form action="{{ route('member.borrow.store') }}" method="POST" onsubmit="return confirm('Request to borrow {{ addslashes($selectedJournal->title) }}?');">
                @csrf
                <input type="hidden" name="journal_id" value="{{ $selectedJournal->id }}">
                <input type="hidden" name="borrow_date" value="{{ date('Y-m-d') }}">
                <input type="hidden" name="due_date" value="{{ date('Y-m-d', strtotime('+3 days')) }}">
                <button type="submit" class="btn btn-success" @if($selectedJournal->availability !== 'Available') disabled @endif>
                    <i class="bi bi-journal-arrow-down"></i> Borrow
                </button>
                <a href="{{ route('member.borrow.index') }}" class="btn btn-secondary">Choose Another Item</a>
            </form>
        </div>
    </div>
@endif

<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-book"></i> Books</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Author</th>
                        <th>Title</th>
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
                            <td>{{ $book->author ?? 'N/A' }}</td>
                            <td>{{ $book->title ?? '-' }}</td>
                            <td>{{ $book->edition ?? '-' }}</td>
                            <td>{{ $book->year ?? '-' }}</td>
                            <td>{{ $book->subject ?? '-' }}</td>
                            <td>{{ $book->publication ?? '-' }}</td>
                            <td>
                                <a href="{{ route('member.borrow.index', ['book_id' => $book->id]) }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-journal-arrow-down"></i> Borrow
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
