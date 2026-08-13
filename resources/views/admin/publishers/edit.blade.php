@extends('layout.app')

@section('title', 'Edit Publisher')

@section('content')
<h2 class="mb-4">Edit Publisher</h2>
<form method="POST" action="{{ route('publishers.update', $publisher->id) }}">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Publisher Name</label>
        <input type="text" name="publisher_name" class="form-control" value="{{ $publisher->publisher_name }}" required>
    </div>
    <div class="mb-3">
        <label>Address</label>
        <input type="text" name="address" class="form-control" value="{{ $publisher->address ?? '' }}">
    </div>
    <div class="mb-3">
        <label>Contact Number</label>
        <input type="text" name="contact_number" class="form-control" value="{{ $publisher->contact_number ?? '' }}">
    </div>
    <button type="submit" class="btn btn-success">Update Publisher</button>
    <a href="{{ route('publishers.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
