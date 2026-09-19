@extends('layout.app')

@section('title', 'Books')

@section('content')
<h2 class="mb-4">Books</h2>
<a href="{{ route('books.create') }}" class="btn btn-primary mb-3"><i class="bi bi-plus-circle"></i> Add Book</a>

<form method="GET" action="{{ route('books.index') }}" class="row g-2 mb-3">
    <div class="col-md-4">
        <input type="text" name="q" class="form-control" placeholder="Search books..." value="{{ $search ?? '' }}">
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-dark w-100"><i class="bi bi-search"></i> Search</button>
    </div>
</form>

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
    @forelse($books as $book)
        <div class="col">
            <div class="card h-100 shadow-sm">
                <div class="card-img-top text-center p-2" style="min-height: 200px; display: flex; align-items: center; justify-content: center;">
                    @if($book->cover_image)
                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Book Cover" class="img-fluid border rounded" style="max-height: 200px; max-width: 150px; object-fit: contain; object-position: center;">
                    @else
                        <div class="text-center text-muted fst-italic" style="min-height: 150px; min-width: 120px; display: flex; align-items: center; justify-content: center;">
                            No Cover Available
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <span class="fw-bold">Author:</span> {{ $book->author ?? '-' }}
                    </div>
                    <div class="mb-2">
                        <span class="fw-bold">Title:</span> {{ $book->title ?? '-' }}
                    </div>
                    <div class="mb-2">
                        <span class="fw-bold">Edition:</span> {{ $book->edition ?? '-' }}
                    </div>
                    <div class="mb-2">
                        <span class="fw-bold">Year:</span> {{ $book->year ?? '-' }}
                    </div>
                    <div class="mb-2">
                        <span class="fw-bold">Subject:</span> {{ $book->subject ?? '-' }}
                    </div>
                    <div class="mb-3">
                        <span class="fw-bold">Publication:</span> {{ $book->publication ?? '-' }}
                    </div>
                    <div class="text-center mb-3">
                        <span class="badge rounded-pill bg-secondary">{{ $book->publication ?? 'Local' }}</span>
                    </div>
                    <a href="{{ route('member.books.show', $book->id) }}" class="btn btn-outline-primary w-100">View Details</a>
                    <div class="d-flex gap-2 mt-2">
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm w-50">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="w-50" onsubmit="return confirm('Delete this book?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm w-100">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <p class="text-muted">No books found.</p>
        </div>
    @endforelse
</div>
@endsection
