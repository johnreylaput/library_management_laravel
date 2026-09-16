<div class="detail-section">
    <div class="row">
        <div class="col-md-6 mb-2">
            <div class="detail-label">Author</div>
            <div class="detail-value">{{ $book->author ?? 'N/A' }}</div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">Title</div>
            <div class="detail-value">{{ $book->title }}</div>
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
    </div>
</div>