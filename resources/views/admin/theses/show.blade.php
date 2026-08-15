@extends('layout.app')

@section('title', $thesis->title)

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
                <h2>{{ $thesis->title }}</h2>
                <p class="mb-1"><strong>Author(s):</strong> {{ $thesis->authors ?? '-' }}</p>
                <p class="mb-1"><strong>Thesis Type:</strong> {{ $thesis->thesis_type ?? '-' }}</p>
                <p class="mb-1"><strong>Institution:</strong> {{ $thesis->institution ?? '-' }}</p>
                <p class="mb-1"><strong>Year:</strong> {{ $thesis->year ?? '-' }}</p>
                <p class="mb-1"><strong>Pages:</strong> {{ $thesis->pages ?? '-' }}</p>
                <p class="mb-1"><strong>Category:</strong> {{ $thesis->category->category_name ?? '-' }}</p>
                <p class="mb-1"><strong>Advisor:</strong> {{ $thesis->author->author_name ?? '-' }}</p>
                <p class="mb-1"><strong>Publisher:</strong> {{ $thesis->publisher->publisher_name ?? '-' }}</p>
                <p class="mb-1"><strong>Status:</strong>
                    <span class="badge bg-{{ $thesis->status === 'Available' ? 'success' : 'danger' }}">
                        {{ $thesis->status }}
                    </span>
                </p>
                @if($thesis->abstract)
                    <p class="mt-3"><strong>Abstract:</strong><br>{{ nl2br(e($thesis->abstract)) }}</p>
                @endif
                 @if($thesis->description)
                    <p class="mt-3"><strong>Description:</strong><br>{{ nl2br(e($thesis->description)) }}</p>
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
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Title of the Thesis</label>
                <input type="text" class="form-control" value="{{ $thesis->title }}" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Author(s)</label>
                <input type="text" class="form-control" value="{{ $thesis->authors ?? '-' }}" readonly>
            </div>
            <div class="col-12 mb-3">
                <label class="form-label fw-bold">Full Record</label>
                <textarea class="form-control" rows="3" readonly>{{ $thesis->authors ?? '' }} ({{ $thesis->year ?? '' }}). {{ $thesis->title }}. {{ $thesis->institution ?? '' }}. {{ $thesis->thesis_type ?? '' }}.</textarea>
            </div>
            <div class="col-12 mb-3">
                <label class="form-label fw-bold">Abstract / Summary</label>
                <textarea class="form-control" rows="4" readonly>{{ $thesis->abstract ?? '-' }}</textarea>
            </div>
            <div class="col-12 mb-3">
                <label class="form-label fw-bold">Thesis Information</label>
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <label class="form-label">Institution</label>
                        <input type="text" class="form-control" value="{{ $thesis->institution ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label class="form-label">Thesis Type</label>
                        <input type="text" class="form-control" value="{{ $thesis->thesis_type ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-2 mb-2">
                        <label class="form-label">Year</label>
                        <input type="text" class="form-control" value="{{ $thesis->year ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-2 mb-2">
                        <label class="form-label">Pages</label>
                        <input type="text" class="form-control" value="{{ $thesis->pages ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-2 mb-2">
                        <label class="form-label">Status</label>
                        <input type="text" class="form-control" value="{{ $thesis->status }}" readonly>
                    </div>
                </div>
            </div>
            @if($thesis->link)
                <div class="col-12 mb-3">
                    <label class="form-label fw-bold">Link</label>
                    <a href="{{ $thesis->link }}" target="_blank" class="btn btn-primary">{{ $thesis->link }}</a>
                </div>
            @endif
        </div>
    </div>
</div>

<a href="{{ route('search.index', ['type' => 'theses']) }}" class="btn btn-secondary">Back to Theses</a>
@endsection
