@extends('layout.app')

@section('title', 'Reports')

@section('content')
<h2 class="mb-4">Reports</h2>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-book"></i> Total Books</h5>
                <h2>{{ $stats['total_books'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-people"></i> Members</h5>
                <h2>{{ $stats['total_members'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-dark">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-journal-arrow-down"></i> Borrowed</h5>
                <h2>{{ $stats['total_borrowed'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-exclamation-triangle"></i> Overdue</h5>
                <h2>{{ $stats['total_overdue'] }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header"><h5>Top Borrowed Books</h5></div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr><th>Book</th><th>Times Borrowed</th></tr>
                    </thead>
                    <tbody>
                        @foreach($topBooks as $item)
                            <tr>
                                <td>{{ $item['book']->title ?? 'Unknown' }}</td>
                                <td>{{ $item['count'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header"><h5>Overdue Books</h5></div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr><th>Book</th><th>Member</th><th>Due Date</th></tr>
                    </thead>
                    <tbody>
                        @foreach($overdueBorrows as $borrow)
                            <tr>
                                <td>{{ $borrow->book->title ?? '-' }}</td>
                                <td>{{ $borrow->member->user->full_name ?? '-' }}</td>
                                <td>{{ $borrow->due_date }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
