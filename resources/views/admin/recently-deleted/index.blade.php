@extends('layout.app')

@section('title', 'Recently Deleted')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h2 class="mb-1">Recently Deleted</h2>
        <p class="text-muted mb-0">Restore catalog items to return them to their original sections.</p>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0"><i class="bi bi-book me-2"></i>Books</h5>
        <span class="badge bg-secondary">{{ $books->count() }}</span>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover mb-0">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>ISBN</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Available</th>
                    <th>Status</th>
                    <th>Deleted At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->isbn ?? '-' }}</td>
                        <td>{{ $book->author->author_name ?? '-' }}</td>
                        <td>{{ $book->category->category_name ?? '-' }}</td>
                        <td>{{ $book->available_quantity ?? '-' }}</td>
                        <td>
                            <span class="badge bg-{{ $book->status === 'Available' ? 'success' : 'secondary' }}">
                                {{ $book->status ?? '-' }}
                            </span>
                        </td>
                        <td>{{ $book->deleted_at?->format('M d, Y h:i A') ?? '-' }}</td>
                        <td>
                            <form action="{{ route('recently-deleted.restore', ['type' => 'book', 'item' => $book->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="bi bi-arrow-counterclockwise"></i> Restore
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">No recently deleted books.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0"><i class="bi bi-journal-arrow-down me-2"></i>Periodicals</h5>
        <span class="badge bg-secondary">{{ $journals->count() }}</span>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover mb-0">
            <thead>
                <tr>
                    <th>Article Title</th>
                    <th>Journal Name</th>
                    <th>Authors</th>
                    <th>ISSN</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Deleted At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($journals as $journal)
                    <tr>
                        <td>{{ $journal->title }}</td>
                        <td>{{ $journal->journal_name ?? '-' }}</td>
                        <td>{{ $journal->authors ?? '-' }}</td>
                        <td>{{ $journal->issn ?? '-' }}</td>
                        <td>{{ $journal->category->category_name ?? '-' }}</td>
                        <td>
                            <span class="badge bg-{{ $journal->status === 'Available' ? 'success' : 'secondary' }}">
                                {{ $journal->status ?? '-' }}
                            </span>
                        </td>
                        <td>{{ $journal->deleted_at?->format('M d, Y h:i A') ?? '-' }}</td>
                        <td>
                            <form action="{{ route('recently-deleted.restore', ['type' => 'journal', 'item' => $journal->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="bi bi-arrow-counterclockwise"></i> Restore
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">No recently deleted periodicals.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0"><i class="bi bi-file-earmark-text me-2"></i>Theses</h5>
        <span class="badge bg-secondary">{{ $theses->count() }}</span>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover mb-0">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Authors</th>
                    <th>Institution</th>
                    <th>Thesis Type</th>
                    <th>Year</th>
                    <th>Category</th>
                    <th>Deleted At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($theses as $thesis)
                    <tr>
                        <td>{{ $thesis->title }}</td>
                        <td>{{ $thesis->authors ?? '-' }}</td>
                        <td>{{ $thesis->institution ?? '-' }}</td>
                        <td>{{ $thesis->thesis_type ?? '-' }}</td>
                        <td>{{ $thesis->year ?? '-' }}</td>
                        <td>{{ $thesis->category->category_name ?? '-' }}</td>
                        <td>{{ $thesis->deleted_at?->format('M d, Y h:i A') ?? '-' }}</td>
                        <td>
                            <form action="{{ route('recently-deleted.restore', ['type' => 'thesis', 'item' => $thesis->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="bi bi-arrow-counterclockwise"></i> Restore
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">No recently deleted theses.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
