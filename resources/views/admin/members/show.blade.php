@extends('layout.app')

@section('title', 'Member Details')

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <h2>{{ $member->user->full_name ?? 'Unknown Member' }}</h2>
        <p class="mt-3"><strong>Member No:</strong> {{ $member->member_no }}</p>
        <p><strong>Course:</strong> {{ $member->course ?? '-' }}</p>
        <p><strong>Year Level:</strong> {{ $member->year_level ?? '-' }}</p>
        <p><strong>Contact:</strong> {{ $member->contact_number ?? '-' }}</p>
        <p><strong>Address:</strong> {{ $member->address ?? '-' }}</p>
    </div>
</div>
<a href="{{ route('members.index') }}" class="btn btn-secondary">Back to Members</a>
@endsection
