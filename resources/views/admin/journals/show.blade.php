@extends('layout.app')

@section('title', $journal->title)

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                @if($journal->cover_image)
                    <img src="{{ asset('storage/' . $journal->cover_image) }}" alt="Journal Cover" class="img-fluid border rounded" style="max-height: 300px; max-width: 100%; object-fit: contain; object-position: center;">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height:250px;font-size:4rem;color:#aaa;">
                        <i class="bi bi-journal-arrow-down"></i>
                    </div>
                @endif
            </div>
            <div class="col-md-9">
                <h2>{{ $journal->title }}</h2>
                <p class="mb-1"><strong>Author of the Article:</strong> {{ $journal->authors ?? '-' }}</p>
                <p class="mb-1"><strong>Title of the Article:</strong> {{ $journal->title }}</p>
                <p class="mb-1"><strong>Source:</strong> {{ $journal->source ?? '-' }}</p>
                <p class="mb-1"><strong>Title of the Journal:</strong> {{ $journal->journal_name }}</p>
                <p class="mb-1"><strong>Volume:</strong> {{ $journal->volume ?? '-' }}</p>
                <p class="mb-1"><strong>Issue:</strong> {{ $journal->issue ?? '-' }}</p>
                <p class="mb-1"><strong>Pages:</strong> {{ $journal->pages ?? '-' }}</p>
                <p class="mb-1"><strong>Publication Date:</strong> {{ $journal->publication_date ?? '-' }}</p>
                <p class="mb-1"><strong>DOI:</strong> {{ $journal->doi ?? '-' }}</p>
                <p class="mb-1"><strong>ISSN:</strong> {{ $journal->issn ?? '-' }}</p>
                <p class="mb-1"><strong>Availability:</strong>
                    <span class="badge bg-{{ $journal->availability === 'Available' ? 'success' : 'danger' }}">
                        {{ $journal->availability ?? 'N/A' }}
                    </span>
                </p>
                <p class="mb-1"><strong>Publisher:</strong> {{ $journal->publisher_text ?? '-' }}</p>
                <p class="mb-1"><strong>Database / Collection:</strong> {{ $journal->database_collection ?? '-' }}</p>
                @if($journal->abstract)
                    <p class="mt-3"><strong>Abstract:</strong><br>{{ nl2br(e($journal->abstract)) }}</p>
                @endif
                @if($journal->description)
                    <p class="mt-3"><strong>Note:</strong><br>{{ nl2br(e($journal->description)) }}</p>
                @endif
                @if($journal->subjects)
                    <p class="mt-3"><strong>Subject:</strong> {{ $journal->subjects }}</p>
                @endif
                @if($journal->keyword)
                    <p class="mt-3"><strong>Keyword:</strong> {{ $journal->keyword }}</p>
                @endif
                @if($journal->link)
                    <p class="mt-3"><strong>Link of the Periodical:</strong> <a href="{{ $journal->link }}" target="_blank">{{ $journal->link }}</a></p>
                @endif
                <p class="mt-3"><strong>Added By:</strong> {{ $journal->added_by ?? '-' }}</p>
                <p class="mb-1"><strong>Edited By:</strong>
                    @php
                        $editorText = $journal->edited_by ?? '-';
                        preg_match('/^(.+) \(([^)]+)\)$/', $editorText, $editorMatches);
                    @endphp
                    {{ $editorMatches[1] ?? $editorText }}
                    @if(isset($editorMatches[2]))
                        <span class="badge bg-info">{{ $editorMatches[2] }}</span>
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>

@if(Auth::check() && Auth::user()->role === 'Member')
    <div class="card mt-4">
        <div class="card-body">
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
                    <input type="hidden" name="due_date" value="{{ date('Y-m-d', strtotime('+3 days')) }}">
                    <button type="submit" class="btn btn-warning" @if($journal->availability !== 'Available') disabled @endif>
                        <i class="bi bi-calendar-check"></i> Reserve
                    </button>
                </form>
            </div>
        </div>
    </div>
@endif

<a href="{{ route('search.index', ['type' => 'journals']) }}" class="btn btn-secondary">Back to Periodicals</a>
@endsection
