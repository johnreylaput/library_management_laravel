@extends('layout.app')

@section('title', 'Add Book')

@section('content')
<h2 class="mb-4">Add Book</h2>
<form method="POST" action="{{ route('books.store') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label fw-bold">Author:</label>
        <input type="text" name="author" class="form-control" placeholder="e.g. John Smith" required>
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Subject:</label>
        <input type="text" name="subject" class="form-control" placeholder="e.g. Computer Science" required>
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Year:</label>
        <input type="text" name="year" class="form-control" placeholder="e.g. 2024" required>
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Publication:</label>
        <select name="publication" class="form-select" required>
            <option value="">-- Select Publication --</option>
            <option value="Foreign">Foreign</option>
            <option value="Local">Local</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Save Book</button>
    <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
