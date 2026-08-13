@extends('layout.app')

@section('title', 'Add Member')

@section('content')
<h2 class="mb-4">Add Member</h2>
<form method="POST" action="{{ route('members.store') }}">
    @csrf
    <div class="mb-3">
        <label>User</label>
        <select name="user_id" class="form-select" required>
            <option value="">Select User</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->full_name }} ({{ $user->username }})</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Member No</label>
        <input type="text" name="member_no" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Course</label>
        <input type="text" name="course" class="form-control">
    </div>
    <div class="mb-3">
        <label>Year Level</label>
        <input type="text" name="year_level" class="form-control">
    </div>
    <div class="mb-3">
        <label>Contact Number</label>
        <input type="text" name="contact_number" class="form-control">
    </div>
    <div class="mb-3">
        <label>Address</label>
        <textarea name="address" class="form-control" rows="2"></textarea>
    </div>
    <button type="submit" class="btn btn-success">Save Member</button>
    <a href="{{ route('members.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
