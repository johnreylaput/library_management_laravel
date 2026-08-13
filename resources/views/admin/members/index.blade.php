@extends('layout.app')

@section('title', 'Members')

@section('content')
<h2 class="mb-4">Members</h2>
<a href="{{ route('members.create') }}" class="btn btn-primary mb-3"><i class="bi bi-plus-circle"></i> Add Member</a>

<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Member No</th>
            <th>Name</th>
            <th>Course</th>
            <th>Year Level</th>
            <th>Contact</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($members as $member)
            <tr>
                <td>{{ $member->member_no }}</td>
                <td>{{ $member->user->full_name ?? '-' }}</td>
                <td>{{ $member->course ?? '-' }}</td>
                <td>{{ $member->year_level ?? '-' }}</td>
                <td>{{ $member->contact_number ?? '-' }}</td>
                <td>
                    <a href="{{ route('members.show', $member->id) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('members.edit', $member->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this member?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
