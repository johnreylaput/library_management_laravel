@extends('layout.app')

@section('title', 'Edit Member')

@section('content')
<h2 class="mb-4">Edit Member</h2>
<form method="POST" action="{{ route('members.update', $member->id) }}">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Member No</label>
        <input type="text" name="member_no" class="form-control" value="{{ $member->member_no }}" required>
    </div>
    <div class="mb-3">
        <label>Course</label>
        <input type="text" name="course" class="form-control" value="{{ $member->course ?? '' }}">
    </div>
    <div class="mb-3">
        <label>Year Level</label>
        <input type="text" name="year_level" class="form-control" value="{{ $member->year_level ?? '' }}">
    </div>
    <div class="mb-3">
        <label>Contact Number</label>
        <input type="text" name="contact_number" class="form-control" value="{{ $member->contact_number ?? '' }}">
    </div>
    <div class="mb-3">
        <label>Address</label>
        <textarea name="address" class="form-control" rows="2">{{ $member->address ?? '' }}</textarea>
    </div>
    <button type="submit" class="btn btn-success">Update Member</button>
    <a href="{{ route('members.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
