@extends('layout.app')

@section('title', 'Return Details')

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <h2>Return Record #{{ $return->id }}</h2>
        <p class="mt-3"><strong>Borrow ID:</strong> #{{ $return->borrow_id }}</p>
        <p><strong>Book:</strong> {{ $return->borrow->book->title ?? '-' }}</p>
        <p><strong>Member:</strong> {{ $return->borrow->member->user->full_name ?? '-' }}</p>
        <p><strong>Return Date:</strong> {{ $return->return_date ?? '-' }}</p>
        <p><strong>Condition:</strong> {{ $return->condition_status }}</p>
        <p><strong>Remarks:</strong> {{ $return->remarks ?? '-' }}</p>
    </div>
</div>
<a href="{{ route('return.index') }}" class="btn btn-secondary">Back to Returns</a>
@endsection
