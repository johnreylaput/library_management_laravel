@extends('layout.app')

@section('title', 'Theses')

@section('content')
<h2 class="mb-4">Theses</h2>
<div class="mb-3">
    <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-plus-circle"></i> Add Thesis
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('theses.create') }}"><i class="bi bi-plus-circle"></i> Add New Thesis</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><span class="dropdown-item-text text-muted">Quick Actions</span></li>
        </ul>
    </div>
</div>

<form method="GET" action="{{ route('theses.index') }}" class="row g-2 mb-3">
    <div class="col-md-4">
        <input type="text" name="q" class="form-control" placeholder="Search theses..." value="{{ $search ?? '' }}">
    </div>
</form>

<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Author</th>
            <th>Research</th>
            <th>Date Published</th>
            <th>Subjects / Keywords</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($theses as $thesis)
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
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-gear"></i> Actions
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('member.theses.show', $thesis->id) }}">
                                    <i class="bi bi-eye text-info"></i> View
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('theses.edit', $thesis->id) }}">
                                    <i class="bi bi-pencil text-warning"></i> Edit
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('theses.destroy', $thesis->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm(@if(Auth::check() && Auth::user()->role === 'Working.Student')'Submit a deletion request for this thesis? The librarian will review it.'@else'Move this thesis to Recently Deleted? It can be restored later.'@endif)">
                                        @if(Auth::check() && Auth::user()->role === 'Working.Student')
                                            <i class="bi bi-send"></i> Request Deletion
                                        @else
                                            <i class="bi bi-trash"></i> Move to Recently Deleted
                                        @endif
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
