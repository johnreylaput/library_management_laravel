@extends('layout.app')

@section('title', 'Thesis')

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height:250px;font-size:4rem;color:#aaa;">
                    <i class="bi bi-journal-arrow-down"></i>
                </div>
            </div>
            <div class="col-md-9">
                <h2>{{ $thesis->author }}</h2>
                <p class="mb-1"><strong>Research:</strong> {{ $thesis->research ?? '-' }}</p>
                <p class="mb-1"><strong>Date Published:</strong> {{ $thesis->date_published ? \Carbon\Carbon::parse($thesis->date_published)->format('F j, Y') : '-' }}</p>
                <p class="mb-1"><strong>Subjects / Keywords:</strong> {{ $thesis->subjects_keywords ?? '-' }}</p>
                @if($thesis->summary)
                    <p class="mt-3"><strong>Summary:</strong><br>{{ nl2br(e($thesis->summary)) }}</p>
                @endif
                <p class="mt-3"><strong>Added By:</strong> {{ $thesis->added_by ?? '-' }}</p>
                <p class="mb-1"><strong>Edited By:</strong>
                    @php
                        $editorText = $thesis->edited_by ?? '-';
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

<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Thesis Information</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Author</label>
                <input type="text" class="form-control" value="{{ $thesis->author ?? '-' }}" readonly>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Research</label>
                <input type="text" class="form-control" value="{{ $thesis->research ?? '-' }}" readonly>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Date Published</label>
                <input type="text" class="form-control" value="{{ $thesis->date_published ? \Carbon\Carbon::parse($thesis->date_published)->format('F j, Y') : '-' }}" readonly>
            </div>
            <div class="col-md-12 mb-3">
                <label class="form-label fw-bold">Subjects / Keywords</label>
                <input type="text" class="form-control" value="{{ $thesis->subjects_keywords ?? '-' }}" readonly>
            </div>
            <div class="col-12 mb-3">
                <label class="form-label fw-bold">Summary</label>
                <textarea class="form-control" rows="4" readonly>{{ $thesis->summary ?? '-' }}</textarea>
            </div>
            <div class="col-md-12 mb-3">
                <label class="form-label fw-bold">Status</label>
                <input type="text" class="form-control" value="{{ $thesis->status }}" readonly>
            </div>
        </div>
    </div>
</div>

<a href="{{ route('search.index', ['type' => 'theses']) }}" class="btn btn-secondary">Back to Theses</a>
@endsection
