@extends('layout.app')

@section('title', 'Fine Details')

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <h2>Fine #{{ $fine->id }}</h2>
        <p class="mt-3"><strong>Borrow ID:</strong> #{{ $fine->borrow_id }}</p>
        <p><strong>Member:</strong> {{ $fine->borrow->member->user->full_name ?? '-' }}</p>
        <p><strong>Book:</strong> {{ $fine->borrow->book->title ?? '-' }}</p>
        <p><strong>Amount:</strong> {{ number_format($fine->amount, 2) }}</p>
        <p><strong>Reason:</strong> {{ $fine->reason ?? '-' }}</p>
        <p><strong>Paid:</strong> {{ $fine->paid }}</p>
    </div>
</div>
<a href="{{ route('fines.index') }}" class="btn btn-secondary">Back to Fines</a>
@endsection
