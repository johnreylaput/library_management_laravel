<div class="detail-section">
    <div class="row">
        <div class="col-md-6 mb-2">
            <div class="detail-label">Author of the Article</div>
            <div class="detail-value">{{ $journal->authors ?? 'N/A' }}</div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">Title of the Article</div>
            <div class="detail-value">{{ $journal->title }}</div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">Source</div>
            <div class="detail-value">{{ $journal->source ?? 'N/A' }}</div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">Title of the Journal</div>
            <div class="detail-value">{{ $journal->journal_name ?? 'N/A' }}</div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">Volume</div>
            <div class="detail-value">{{ $journal->volume ?? 'N/A' }}</div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">Issue</div>
            <div class="detail-value">{{ $journal->issue ?? 'N/A' }}</div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">Pages</div>
            <div class="detail-value">{{ $journal->pages ?? 'N/A' }}</div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">Publication Date</div>
            <div class="detail-value">{{ $journal->publication_date ? \Carbon\Carbon::parse($journal->publication_date)->format('F Y') : 'N/A' }}</div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">DOI</div>
            <div class="detail-value">{{ $journal->doi ?? 'N/A' }}</div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">ISSN</div>
            <div class="detail-value">{{ $journal->issn ?? 'N/A' }}</div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">Publisher</div>
            <div class="detail-value">{{ $journal->publisher_text ?? 'N/A' }}</div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">Availability</div>
            <div class="detail-value">
                <span class="badge bg-{{ $journal->availability === 'Available' ? 'success' : 'danger' }}">
                    {{ $journal->availability ?? 'N/A' }}
                </span>
            </div>
        </div>
        @if($journal->link)
            <div class="col-12 mb-2">
                <div class="detail-label">Link of the Journal Article</div>
                <div class="detail-value"><a href="{{ $journal->link }}" target="_blank">{{ $journal->link }}</a></div>
            </div>
        @endif
        @if($journal->subjects)
            <div class="col-md-6 mb-2">
                <div class="detail-label">Subject</div>
                <div class="detail-value">{{ $journal->subjects }}</div>
            </div>
        @endif
        @if($journal->keyword)
            <div class="col-md-6 mb-2">
                <div class="detail-label">Keyword</div>
                <div class="detail-value">{{ $journal->keyword }}</div>
            </div>
        @endif
        @if($journal->database_collection)
            <div class="col-md-6 mb-2">
                <div class="detail-label">Database / Collection</div>
                <div class="detail-value">{{ $journal->database_collection }}</div>
            </div>
        @endif
        <div class="col-md-6 mb-2">
            <div class="detail-label">Added By</div>
            <div class="detail-value">{{ $journal->added_by ?? 'N/A' }}</div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">Edited By</div>
            <div class="detail-value">
                @php
                    $editorText = $journal->edited_by ?? 'N/A';
                    preg_match('/^(.+) \(([^)]+)\)$/', $editorText, $editorMatches);
                @endphp
                {{ $editorMatches[1] ?? $editorText }}
                @if(isset($editorMatches[2]))
                    <span class="badge bg-info">{{ $editorMatches[2] }}</span>
                @endif
            </div>
        </div>
    </div>
</div>

@if($journal->abstract)
    <div class="detail-section">
        <div class="detail-label">Abstract</div>
        <div class="abstract-box">{{ nl2br(e($journal->abstract)) }}</div>
    </div>
@endif

@if($journal->description)
    <div class="detail-section">
        <div class="detail-label">Note</div>
        <div class="detail-value">{{ nl2br(e($journal->description)) }}</div>
    </div>
@endif

@if(Auth::check() && Auth::user()->role === 'Member')
    <div class="detail-section mt-3">
        <div class="d-flex gap-2">
            <form action="{{ route('member.borrow.store') }}" method="POST" onsubmit="return confirm('Request to borrow {{ addslashes($journal->title) }}?');">
                @csrf
                <input type="hidden" name="journal_id" value="{{ $journal->id }}">
                <input type="hidden" name="borrow_date" value="{{ date('Y-m-d') }}">
                <input type="hidden" name="due_date" value="{{ date('Y-m-d', strtotime('+3 days')) }}">
                <button type="submit" class="btn btn-success" @if($journal->availability !== 'Available') disabled @endif>
                    <i class="bi bi-journal-arrow-down"></i> Borrow
                </button>
            </form>
            <form action="{{ route('member.reservation.store') }}" method="POST" onsubmit="return confirm('Request to reserve {{ addslashes($journal->title) }}?');">
                @csrf
                <input type="hidden" name="journal_id" value="{{ $journal->id }}">
                <input type="hidden" name="reservation_date" value="{{ date('Y-m-d') }}">
                <input type="hidden" name="expiration_date" value="{{ date('Y-m-d', strtotime('+7 days')) }}">
                <button type="submit" class="btn btn-warning" @if($journal->availability !== 'Available') disabled @endif>
                    <i class="bi bi-calendar-check"></i> Reserve
                </button>
            </form>
        </div>
    </div>
@endif
