<div class="detail-section">
    <div class="row">
        <div class="col-md-4 mb-3 d-flex justify-content-center">
            @if($thesis->cover_image)
                <img src="{{ asset('storage/' . $thesis->cover_image) }}" alt="Thesis Cover" class="img-fluid border rounded" style="max-height: 250px; max-width: 100%; object-fit: contain; object-position: center;">
            @else
                <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height:200px;font-size:3rem;color:#aaa;width:100%;max-width:200px;">
                    <i class="bi bi-file-earmark-text"></i>
                </div>
            @endif
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-12 mb-2">
                    <div class="detail-label">Author:</div>
                    <div class="detail-value">{{ $thesis->author ?? 'N/A' }}</div>
                </div>
                <div class="col-12 mb-2">
                    <div class="detail-label">Research:</div>
                    <div class="detail-value">{{ $thesis->research ?? 'N/A' }}</div>
                </div>
                <div class="col-12 mb-2">
                    <div class="detail-label">Date Published:</div>
                    <div class="detail-value">{{ $thesis->date_published ? \Carbon\Carbon::parse($thesis->date_published)->format('F j, Y') : 'N/A' }}</div>
                </div>
                <div class="col-12 mb-2">
                    <div class="detail-label">Subject/Keyword:</div>
                    <div class="detail-value">{{ $thesis->subjects_keywords ?? 'N/A' }}</div>
                </div>
                <div class="col-12 mb-2">
                    <div class="detail-label">Summary:</div>
                    <div class="detail-value">{{ $thesis->summary ?? 'N/A' }}</div>
                </div>
                <div class="col-12 mb-2">
                    <div class="detail-label">Added By:</div>
                    <div class="detail-value">{{ $thesis->added_by ?? 'N/A' }}</div>
                </div>
                <div class="col-12 mb-2">
                    <div class="detail-label">Edited By:</div>
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
            </div>
        </div>
    </div>
</div>

@if($thesis->summary)
    <div class="detail-section">
        <div class="detail-label">Abstract</div>
        <div class="abstract-box">{{ nl2br(e($thesis->summary)) }}</div>
    </div>
@endif

@if(Auth::check() && Auth::user()->role === 'Member')
    <div class="detail-section mt-3">
        <div class="d-flex gap-2">
            <form action="{{ route('member.borrow.store') }}" method="POST" onsubmit="return confirm('Request to borrow this thesis?');">
                @csrf
                <input type="hidden" name="thesis_id" value="{{ $thesis->id }}">
                <input type="hidden" name="borrow_date" value="{{ date('Y-m-d') }}">
                <input type="hidden" name="due_date" value="{{ date('Y-m-d', strtotime('+3 days')) }}">
                <button type="submit" class="btn btn-success" @if($thesis->status !== 'Available') disabled @endif>
                    <i class="bi bi-journal-arrow-down"></i> Borrow
                </button>
            </form>
            <form action="{{ route('member.reservation.store') }}" method="POST" onsubmit="return confirm('Request to reserve this thesis?');">
                @csrf
                <input type="hidden" name="thesis_id" value="{{ $thesis->id }}">
                <input type="hidden" name="reservation_date" value="{{ date('Y-m-d') }}">
                <input type="hidden" name="due_date" value="{{ date('Y-m-d', strtotime('+3 days')) }}">
                <button type="submit" class="btn btn-warning" @if($thesis->status !== 'Available') disabled @endif>
                    <i class="bi bi-calendar-check"></i> Reserve
                </button>
            </form>
        </div>
    </div>
@endif
