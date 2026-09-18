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
                    <th>Author</th>
                    <th>Title</th>
                    <th>Edition</th>
                    <th>Year</th>
                    <th>Subject</th>
                    <th>Publication</th>
                    <th>Deleted At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                    <tr>
                        <td>{{ $book->author ?? '-' }}</td>
                        <td>{{ $book->title ?? '-' }}</td>
                        <td>{{ $book->edition ?? '-' }}</td>
                        <td>{{ $book->year ?? '-' }}</td>
                        <td>{{ $book->subject ?? '-' }}</td>
                        <td>{{ $book->publication ?? '-' }}</td>
                        <td>{{ $book->deleted_at?->format('M d, Y h:i A') ?? '-' }}</td>
                        <td>
                            <form action="{{ route('recently-deleted.restore', ['type' => 'book', 'id' => $book->id]) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="bi bi-arrow-counterclockwise"></i> Restore
                                </button>
                            </form>
                            <form action="{{ route('recently-deleted.destroy', ['type' => 'book', 'id' => $book->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Permanently delete this book? This action cannot be undone.')">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i> Delete
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
                        <td>{{ $journal->title ?? '-' }}</td>
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
                            <form action="{{ route('recently-deleted.restore', ['type' => 'journal', 'id' => $journal->id]) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="bi bi-arrow-counterclockwise"></i> Restore
                                </button>
                            </form>
                            <form action="{{ route('recently-deleted.destroy', ['type' => 'journal', 'id' => $journal->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Permanently delete this journal? This action cannot be undone.')">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i> Delete
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
                    <th>Author</th>
                    <th>Research</th>
                    <th>Date Published</th>
                    <th>Subjects / Keywords</th>
                    <th>Status</th>
                    <th>Deleted At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($theses as $thesis)
                    <tr>
                        <td>{{ $thesis->author ?? '-' }}</td>
                        <td>{{ $thesis->research ?? '-' }}</td>
                        <td>{{ $thesis->date_published ? \Carbon\Carbon::parse($thesis->date_published)->format('F j, Y') : '-' }}</td>
                        <td>{{ $thesis->subjects_keywords ?? '-' }}</td>
                        <td>
                            <span class="badge bg-{{ $thesis->status === 'Available' ? 'success' : 'danger' }}">
                                {{ $thesis->status }}
                            </span>
                        </td>
                        <td>{{ $thesis->deleted_at?->format('M d, Y h:i A') ?? '-' }}</td>
                        <td>
                            <form action="{{ route('recently-deleted.restore', ['type' => 'thesis', 'id' => $thesis->id]) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="bi bi-arrow-counterclockwise"></i> Restore
                                </button>
                            </form>
                            <form action="{{ route('recently-deleted.destroy', ['type' => 'thesis', 'id' => $thesis->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Permanently delete this thesis? This action cannot be undone.')">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted py-4">No recently deleted theses.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
