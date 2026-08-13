<div class="detail-section">
    <div class="row">
        <div class="col-md-6 mb-2">
            <div class="detail-label">Title</div>
            <div class="detail-value">{{ $book->title }}</div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">Accession No</div>
            <div class="detail-value">{{ $book->accession_no ?? 'N/A' }}</div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">ISBN</div>
            <div class="detail-value">{{ $book->isbn ?? 'N/A' }}</div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">Author</div>
            <div class="detail-value">{{ $book->author->author_name ?? 'N/A' }}</div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">Category / Subject</div>
            <div class="detail-value">{{ $book->category->category_name ?? 'Uncategorized' }}</div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">Publisher</div>
            <div class="detail-value">{{ $book->publisher->publisher_name ?? 'N/A' }}</div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">Publication Year</div>
            <div class="detail-value">{{ $book->publication_year ?? 'N/A' }}</div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">Edition</div>
            <div class="detail-value">{{ $book->edition ?? 'N/A' }}</div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">Language</div>
            <div class="detail-value">{{ $book->language ?? 'N/A' }}</div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">Pages</div>
            <div class="detail-value">{{ $book->pages ?? 'N/A' }}</div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">Total Quantity</div>
            <div class="detail-value">{{ $book->quantity ?? 'N/A' }}</div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">Available Quantity</div>
            <div class="detail-value">{{ $book->available_quantity ?? 'N/A' }}</div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">Shelf Location</div>
            <div class="detail-value">{{ $book->shelf_location ?? 'N/A' }}</div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">Status</div>
            <div class="detail-value">
                <span class="badge bg-{{ ($book->available_quantity > 0 && $book->status === 'Available') ? 'success' : 'danger' }}">
                    {{ $book->status ?? 'N/A' }}
                </span>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">Added By</div>
            <div class="detail-value">{{ $book->added_by ?? 'N/A' }}</div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">Edited By</div>
            <div class="detail-value">{{ $book->edited_by ?? 'N/A' }}</div>
        </div>
    </div>
</div>

@if($book->description)
    <div class="detail-section">
        <div class="detail-label">Description</div>
        <div class="abstract-box">{{ nl2br(e($book->description)) }}</div>
    </div>
@endif

@if(Auth::check() && Auth::user()->role === 'Member')
    <div class="detail-section mt-3">
        <div class="d-flex gap-2">
            <form action="{{ route('member.borrow.store') }}" method="POST" onsubmit="return confirm('Request to borrow {{ addslashes($book->title) }}?');">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <input type="hidden" name="borrow_date" value="{{ date('Y-m-d') }}">
                <input type="hidden" name="due_date" value="{{ date('Y-m-d', strtotime('+3 days')) }}">
                <button type="submit" class="btn btn-success" @if($book->available_quantity <= 0 || $book->status !== 'Available') disabled @endif>
                    <i class="bi bi-journal-arrow-down"></i> Borrow
                </button>
            </form>
            <form action="{{ route('member.reservation.store') }}" method="POST" onsubmit="return confirm('Request to reserve {{ addslashes($book->title) }}?');">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <input type="hidden" name="reservation_date" value="{{ date('Y-m-d') }}">
                <input type="hidden" name="expiration_date" value="{{ date('Y-m-d', strtotime('+7 days')) }}">
                <button type="submit" class="btn btn-warning" @if($book->available_quantity <= 0 || $book->status !== 'Available') disabled @endif>
                    <i class="bi bi-calendar-check"></i> Reserve
                </button>
            </form>
        </div>
    </div>
@endif
