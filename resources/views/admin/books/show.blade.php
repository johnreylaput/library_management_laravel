@extends('layout.app')

@section('title', $book->title)

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                @if($book->book_cover)
                    <img src="{{ asset('storage/' . $book->book_cover) }}" class="img-fluid rounded" alt="{{ $book->title }}">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height:250px;font-size:4rem;color:#aaa;">
                        <i class="bi bi-book"></i>
                    </div>
                @endif
            </div>
            <div class="col-md-9">
                <h2>{{ $book->title }}</h2>
                <p class="mb-1"><strong>Accession No:</strong> {{ $book->accession_no ?? '-' }}</p>
                <p class="mb-1"><strong>ISBN:</strong> {{ $book->isbn ?? '-' }}</p>
                <p class="mb-1"><strong>Author:</strong> {{ $book->author->author_name ?? '-' }}</p>
                <p class="mb-1"><strong>Category:</strong> {{ $book->category->category_name ?? '-' }}</p>
                <p class="mb-1"><strong>Publisher:</strong> {{ $book->publisher->publisher_name ?? '-' }}</p>
                <p class="mb-1"><strong>Publication Year:</strong> {{ $book->publication_year ?? '-' }}</p>
                <p class="mb-1"><strong>Edition:</strong> {{ $book->edition ?? '-' }}</p>
                <p class="mb-1"><strong>Language:</strong> {{ $book->language ?? '-' }}</p>
                <p class="mb-1"><strong>Pages:</strong> {{ $book->pages ?? '-' }}</p>
                <p class="mb-1"><strong>Total Quantity:</strong> {{ $book->quantity }}</p>
                <p class="mb-1"><strong>Available Quantity:</strong> {{ $book->available_quantity }}</p>
                <p class="mb-1"><strong>Shelf Location:</strong> {{ $book->shelf_location ?? '-' }}</p>
                <p class="mb-1"><strong>Status:</strong>
                    <span class="badge bg-{{ ($book->available_quantity > 0 && $book->status === 'Available') ? 'success' : 'danger' }}">
                        {{ $book->status }}
                    </span>
                </p>
                @if($book->description)
                    <p class="mt-3"><strong>Description:</strong><br>{{ nl2br(e($book->description)) }}</p>
                @endif
                <p class="mt-3"><strong>Added By:</strong> {{ $book->added_by ?? '-' }}</p>
                <p class="mb-1"><strong>Edited By:</strong> {{ $book->edited_by ?? '-' }}</p>
            </div>
        </div>
    </div>
</div>

@if($book->available_quantity > 0 && $book->status === 'Available')
    <div class="alert alert-success">
        <i class="bi bi-check-circle"></i> This book is available for borrowing.
    </div>
@else
    <div class="alert alert-warning">
        <i class="bi bi-exclamation-circle"></i> This book is currently unavailable. Here are some recommendations:
        @if($relatedBooks->count() > 0)
            <div class="row mt-3">
                @foreach($relatedBooks as $rb)
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">{{ $rb->title }}</h5>
                                <p class="card-text mb-1"><strong>Author:</strong> {{ $rb->author->author_name ?? 'N/A' }}</p>
                                <p class="card-text mb-1"><strong>Category:</strong> {{ $rb->category->category_name ?? 'Uncategorized' }}</p>
                                <span class="badge bg-success mb-2">Available ({{ $rb->available_quantity }})</span>
                                 <a href="{{ route('member.books.show', $rb->id) }}" class="btn btn-outline-primary btn-sm w-100">View</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>No related books available at the moment.</p>
        @endif
    </div>
@endif

<a href="{{ route('search.index', ['type' => 'books']) }}" class="btn btn-secondary">Back to Books</a>
@endsection
