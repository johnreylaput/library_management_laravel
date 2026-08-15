<div class="detail-section">
    <div class="row">
        <div class="col-md-6 mb-2">
            <div class="detail-label">Author(s)</div>
            <div class="detail-value">{{ $thesis->authors ?? 'N/A' }}</div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">Title of Thesis</div>
            <div class="detail-value">{{ $thesis->title }}</div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">Institution</div>
            <div class="detail-value">{{ $thesis->institution ?? 'N/A' }}</div>
        </div>
        <div class="col-md-3 mb-2">
            <div class="detail-label">Thesis Type</div>
            <div class="detail-value">{{ $thesis->thesis_type ?? 'N/A' }}</div>
        </div>
        <div class="col-md-3 mb-2">
            <div class="detail-label">Year</div>
            <div class="detail-value">{{ $thesis->year ?? 'N/A' }}</div>
        </div>
        <div class="col-md-3 mb-2">
            <div class="detail-label">Pages</div>
            <div class="detail-value">{{ $thesis->pages ?? 'N/A' }}</div>
        </div>
        <div class="col-md-3 mb-2">
            <div class="detail-label">Availability</div>
            <div class="detail-value">
                <span class="badge bg-{{ $thesis->availability === 'Available' ? 'success' : 'danger' }}">
                    {{ $thesis->availability ?? 'N/A' }}
                </span>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">Publisher</div>
            <div class="detail-value">{{ $thesis->publisher->publisher_name ?? 'N/A' }}</div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">Advisor</div>
            <div class="detail-value">{{ $thesis->author->author_name ?? 'N/A' }}</div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">Subject / Keywords</div>
            <div class="detail-value">{{ $thesis->subjects ?? ($thesis->category->category_name ?? 'N/A') }}</div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">Database / Collection</div>
            <div class="detail-value">{{ $thesis->database_collection ?? 'N/A' }}</div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">Added By</div>
            <div class="detail-value">{{ $thesis->added_by ?? 'N/A' }}</div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="detail-label">Edited By</div>
            <div class="detail-value">
                @php
                    $editorText = $thesis->edited_by ?? 'N/A';
                    preg_match('/^(.+) \(([^)]+)\)$/', $editorText, $editorMatches);
                @endphp
                {{ $editorMatches[1] ?? $editorText }}
                @if(isset($editorMatches[2]))
                    <span class="badge bg-info">{{ $editorMatches[2] }}</span>
                @endif
            </div>
        </div>
        @if($thesis->link)
            <div class="col-12 mb-2">
                <div class="detail-label">URL / External Link</div>
                <div class="detail-value"><a href="{{ $thesis->link }}" target="_blank">{{ $thesis->link }}</a></div>
            </div>
        @endif
    </div>
</div>

@if($thesis->abstract)
    <div class="detail-section">
        <div class="detail-label">Abstract</div>
        <div class="abstract-box">{{ nl2br(e($thesis->abstract)) }}</div>
    </div>
@endif

@if($thesis->description)
    <div class="detail-section">
        <div class="detail-label">Article Description</div>
        <div class="detail-value">{{ nl2br(e($thesis->description)) }}</div>
    </div>
@endif

@if(Auth::check() && Auth::user()->role === 'Member')
    <div class="detail-section mt-3">
        <div class="d-flex gap-2">
            <form action="{{ route('member.borrow.store') }}" method="POST" onsubmit="return confirm('Request to borrow {{ addslashes($thesis->title) }}?');">
                @csrf
                <input type="hidden" name="thesis_id" value="{{ $thesis->id }}">
                <input type="hidden" name="borrow_date" value="{{ date('Y-m-d') }}">
                <input type="hidden" name="due_date" value="{{ date('Y-m-d', strtotime('+3 days')) }}">
                <button type="submit" class="btn btn-success" @if($thesis->availability !== 'Available') disabled @endif>
                    <i class="bi bi-journal-arrow-down"></i> Borrow
                </button>
            </form>
            <form action="{{ route('member.reservation.store') }}" method="POST" onsubmit="return confirm('Request to reserve {{ addslashes($thesis->title) }}?');">
                @csrf
                <input type="hidden" name="thesis_id" value="{{ $thesis->id }}">
                <input type="hidden" name="reservation_date" value="{{ date('Y-m-d') }}">
                <input type="hidden" name="expiration_date" value="{{ date('Y-m-d', strtotime('+7 days')) }}">
                <button type="submit" class="btn btn-warning" @if($thesis->availability !== 'Available') disabled @endif>
                    <i class="bi bi-calendar-check"></i> Reserve
                </button>
            </form>
        </div>
    </div>
@endif
