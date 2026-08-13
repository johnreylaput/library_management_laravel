@extends('layout.app')

@section('title', 'Browse Resources')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0"><i class="bi bi-search"></i> Browse Resources</h2>
    <a href="{{ route('e-periodical.index') }}" class="btn btn-outline-primary">
        <i class="bi bi-journal-arrow-down"></i> E-Periodical Index
    </a>
</div>

<form action="{{ route('search.index') }}" method="GET" class="mb-4">
    <div class="row g-3">
        <div class="col-md-5">
            <input type="text" name="q" class="form-control" placeholder="Search by title, author, ISBN, DOI, subject, or institution..." value="{{ $query ?? '' }}">
        </div>
        <div class="col-md-3">
            <select name="type" class="form-select">
                <option value="all" {{ ($type ?? 'all') == 'all' ? 'selected' : '' }}>All Resources</option>
                <option value="books" {{ ($type ?? '') == 'books' ? 'selected' : '' }}>Books</option>
                <option value="journals" {{ ($type ?? '') == 'journals' ? 'selected' : '' }}>Journals</option>
                <option value="theses" {{ ($type ?? '') == 'theses' ? 'selected' : '' }}>Theses</option>
            </select>
        </div>
        <div class="col-md-2">
            <select name="category" class="form-select">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ ($categoryId ?? '') == $category->id ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i> Search</button>
        </div>
    </div>
</form>

@if($noResult)
    <div class="alert alert-info">
        <h5>No exact match found for "<strong>{{ $query }}</strong>"</h5>
        @if($relatedBooks->count() > 0)
            <p>But here are some books you might like:</p>
        @endif
    </div>
@endif

@php
    $totalResults = ($books->count() ?? 0) + ($journals->count() ?? 0) + ($theses->count() ?? 0);
@endphp

<style>
    .browse-section-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1a1a1a;
        border-left: 4px solid #0d6efd;
        padding-left: 0.75rem;
        margin-bottom: 1rem;
    }
    .resource-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 1.25rem;
    }
    .resource-card {
        border: 1px solid #e9ecef;
        border-radius: 12px;
        overflow: hidden;
        background: #fff;
        transition: box-shadow 0.2s ease, transform 0.2s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .resource-card:hover {
        box-shadow: 0 0.75rem 1.5rem rgba(0,0,0,0.08);
        transform: translateY(-2px);
    }
    .resource-card .card-cover {
        height: 160px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        color: #adb5bd;
        font-size: 3.5rem;
        border-bottom: 1px solid #f1f3f5;
    }
    .resource-card .card-cover img {
        height: 100%;
        width: 100%;
        object-fit: cover;
    }
    .resource-card .card-body {
        padding: 1rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .resource-card .card-title {
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .resource-meta {
        font-size: 0.85rem;
        color: #495057;
        margin-bottom: 0.35rem;
    }
    .resource-meta strong {
        color: #212529;
        font-weight: 600;
    }
    .resource-badges {
        margin-top: auto;
        padding-top: 0.5rem;
        display: flex;
        flex-wrap: wrap;
        gap: 0.35rem;
        align-items: center;
    }
    .resource-card .btn {
        margin-top: 0.75rem;
        width: 100%;
    }
    .card-description {
        font-size: 0.85rem;
        color: #6c757d;
        margin-top: 0.5rem;
        padding-top: 0.5rem;
        border-top: 1px solid #f1f3f5;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

@if($totalResults > 0)
    <h4 class="mb-3">Search Results ({{ $totalResults }})</h4>

    @if(($books->count() ?? 0) > 0)
        <div class="browse-section-title"><i class="bi bi-book"></i> Books</div>
        <div class="resource-grid">
            @foreach($books as $book)
                <div class="resource-card">
                    <div class="card-cover">
                        @if($book->book_cover)
                            <img src="{{ asset('storage/' . $book->book_cover) }}" alt="{{ $book->title }}">
                        @else
                            <i class="bi bi-book"></i>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="card-title">{{ $book->title }}</div>
                        <div class="resource-meta"><strong>Author:</strong> {{ $book->author->author_name ?? 'N/A' }}</div>
                        <div class="resource-meta"><strong>ISBN:</strong> {{ $book->isbn ?? 'N/A' }}</div>
                        <div class="resource-meta"><strong>Category:</strong> {{ $book->category->category_name ?? 'Uncategorized' }}</div>
                        <div class="resource-meta"><strong>Year:</strong> {{ $book->publication_year ?? 'N/A' }}</div>
                        <div class="resource-badges">
                            <span class="badge bg-{{ ($book->available_quantity > 0 && $book->status === 'Available') ? 'success' : 'danger' }}">
                                {{ $book->status ?? 'Unavailable' }}
                            </span>
                            @if($book->available_quantity > 0)
                                <span class="badge bg-info">Available ({{ $book->available_quantity }})</span>
                            @endif
                        </div>
                        <a href="{{ route('member.books.show', $book->id) }}" class="btn btn-primary btn-sm">View Details</a>
                    </div>
                    @if($book->description)
                        <div class="px-3 pb-3">
                            <div class="card-description">{{ $book->description }}</div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    @if(($journals->count() ?? 0) > 0)
        <div class="browse-section-title"><i class="bi bi-journal-arrow-down"></i> Journals</div>
        <div class="resource-grid">
            @foreach($journals as $journal)
                <div class="resource-card">
                    <div class="card-cover">
                        <i class="bi bi-journal-arrow-down"></i>
                    </div>
                    <div class="card-body">
                        <div class="card-title">{{ $journal->title }}</div>
                        <div class="resource-meta"><strong>Author(s):</strong> {{ $journal->authors ?? 'N/A' }}</div>
                        <div class="resource-meta"><strong>Journal:</strong> {{ $journal->journal_name ?? 'N/A' }}</div>
                        <div class="resource-meta"><strong>Volume/Issue:</strong> {{ $journal->volume ?? 'N/A' }} / {{ $journal->issue ?? 'N/A' }}</div>
                        <div class="resource-meta"><strong>Pages:</strong> {{ $journal->pages ?? 'N/A' }}</div>
                        <div class="resource-meta"><strong>Publication Date:</strong> {{ $journal->publication_date ? \Carbon\Carbon::parse($journal->publication_date)->format('F Y') : 'N/A' }}</div>
                        <div class="resource-badges">
                            <span class="badge bg-{{ $journal->availability === 'Available' ? 'success' : 'danger' }}">
                                {{ $journal->availability ?? 'N/A' }}
                            </span>
                        </div>
                        <a href="{{ route('member.journals.show', $journal->id) }}" class="btn btn-primary btn-sm">View Details</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if(($theses->count() ?? 0) > 0)
        <div class="browse-section-title"><i class="bi bi-file-earmark-text"></i> Theses</div>
        <div class="resource-grid">
            @foreach($theses as $thesis)
                <div class="resource-card">
                    <div class="card-cover">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <div class="card-body">
                        <div class="card-title">{{ $thesis->title }}</div>
                        <div class="resource-meta"><strong>Author(s):</strong> {{ $thesis->authors ?? 'N/A' }}</div>
                        <div class="resource-meta"><strong>Thesis Type:</strong> {{ $thesis->thesis_type ?? 'N/A' }}</div>
                        <div class="resource-meta"><strong>Institution:</strong> {{ $thesis->institution ?? 'N/A' }}</div>
                        <div class="resource-meta"><strong>Year:</strong> {{ $thesis->year ?? 'N/A' }}</div>
                        <div class="resource-badges">
                            <span class="badge bg-{{ $thesis->availability === 'Available' ? 'success' : 'danger' }}">
                                {{ $thesis->availability ?? 'N/A' }}
                            </span>
                        </div>
                        <a href="{{ route('member.theses.show', $thesis->id) }}" class="btn btn-primary btn-sm">View Details</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@elseif(!empty($query))
    <div class="alert alert-warning">
        <h5>No results found for "<strong>{{ $query }}</strong>"</h5>
        <p>Try refining your search or browse categories above.</p>
    </div>
    <div class="resource-grid">
        @php $featured = \App\Models\Book::take(6)->get(); @endphp
        @foreach($featured as $fb)
            <div class="resource-card">
                <div class="card-cover">
                    @if($fb->book_cover)
                        <img src="{{ asset('storage/' . $fb->book_cover) }}" alt="{{ $fb->title }}">
                    @else
                        <i class="bi bi-book"></i>
                    @endif
                </div>
                <div class="card-body">
                    <div class="card-title">{{ $fb->title }}</div>
                    <div class="resource-meta"><strong>Author:</strong> {{ $fb->author->author_name ?? 'N/A' }}</div>
                    <div class="resource-meta"><strong>ISBN:</strong> {{ $fb->isbn ?? 'N/A' }}</div>
                    <div class="resource-meta"><strong>Category:</strong> {{ $fb->category->category_name ?? 'Uncategorized' }}</div>
                    <div class="resource-meta"><strong>Year:</strong> {{ $fb->publication_year ?? 'N/A' }}</div>
                    <div class="resource-badges">
                        <span class="badge bg-{{ ($fb->available_quantity > 0 && $fb->status === 'Available') ? 'success' : 'danger' }}">
                            {{ $fb->status ?? 'Unavailable' }}
                        </span>
                        @if($fb->available_quantity > 0)
                            <span class="badge bg-info">Available ({{ $fb->available_quantity }})</span>
                        @endif
                    </div>
                    <a href="{{ route('member.books.show', $fb->id) }}" class="btn btn-outline-primary btn-sm">View Details</a>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection