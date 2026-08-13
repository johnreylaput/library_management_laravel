@extends('layout.app')

@section('title', 'Add Publisher')

@section('content')
<h2 class="mb-4">Add Publisher</h2>
<form method="POST" action="{{ route('publishers.store') }}">
    @csrf
    <div class="mb-3">
        <label>Publisher Name</label>
        <input type="text" name="publisher_name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Address</label>
        <input type="text" name="address" class="form-control">
    </div>
    <div class="mb-3">
        <label>Contact Number</label>
        <input type="text" name="contact_number" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Save Publisher</button>
    <a href="{{ route('publishers.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
