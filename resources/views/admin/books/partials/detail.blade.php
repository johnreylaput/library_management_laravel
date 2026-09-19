<div class="detail-section">
    <div class="row">
        <div class="col-md-4 mb-3 d-flex justify-content-center">
            @if($book->cover_image)
                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Book Cover" class="img-fluid border rounded" style="max-height: 250px; max-width: 170px; object-fit: contain; object-position: center;">
            @else
                <div class="text-center text-muted fst-italic border rounded d-flex align-items-center justify-content-center" style="min-height: 250px; min-width: 170px;">
                    No Cover Available
                </div>
            @endif
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6 mb-2">
                    <div class="detail-label">Author</div>
                    <div class="detail-value">{{ $book->author ?? 'N/A' }}</div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="detail-label">Title</div>
                    <div class="detail-value">{{ $book->title ?? 'N/A' }}</div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="detail-label">Edition</div>
                    <div class="detail-value">{{ $book->edition ?? 'N/A' }}</div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="detail-label">Year</div>
                    <div class="detail-value">{{ $book->year ?? 'N/A' }}</div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="detail-label">Subject</div>
                    <div class="detail-value">{{ $book->subject ?? 'N/A' }}</div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="detail-label">Publication</div>
                    <div class="detail-value">{{ $book->publication ?? 'N/A' }}</div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="detail-label">Added By</div>
                    <div class="detail-value">{{ $book->added_by_name ?? 'N/A' }}</div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="detail-label">Edited By</div>
                    <div class="detail-value">{{ $book->edited_by_name ?? 'N/A' }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
