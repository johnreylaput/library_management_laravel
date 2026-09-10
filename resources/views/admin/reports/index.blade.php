@extends('layout.app')

@section('title', 'Reports')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h2 class="mb-1">Reports</h2>
        <p class="text-muted mb-0">Complete library statistics and detailed records.</p>
    </div>
    <button onclick="window.print()" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-printer"></i> Print Reports
    </button>
</div>

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
        <div class="card bg-info text-white">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-journal-arrow-down"></i> Periodicals</h5>
                <h2>{{ $stats['total_periodicals'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-file-earmark-text"></i> Theses</h5>
                <h2>{{ $stats['total_theses'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-secondary text-white">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-people"></i> Members</h5>
                <h2>{{ $stats['total_members'] }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
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
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-calendar-check"></i> Pending Reservations</h5>
                <h2>{{ $stats['total_reservations'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-dark text-white">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-cash-coin"></i> Fines</h5>
                <h2>{{ $stats['total_fines'] }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card bg-light">
            <div class="card-body">
                <h5 class="card-title text-primary"><i class="bi bi-clock-history"></i> Pending Borrow Requests</h5>
                <h2>{{ $stats['total_pending_borrow_requests'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-light">
            <div class="card-body">
                <h5 class="card-title text-success"><i class="bi bi-check-circle"></i> Returned</h5>
                <h2>{{ $stats['total_returned'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-light">
            <div class="card-body">
                <h5 class="card-title text-warning"><i class="bi bi-x-circle"></i> Cancelled Reservations</h5>
                <h2>{{ $stats['total_cancelled_reservations'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-light">
            <div class="card-body">
                <h5 class="card-title text-danger"><i class="bi bi-trash"></i> Approved Deletions</h5>
                <h2>{{ $stats['total_approved_deletions'] }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Category Distribution</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Total Books</th>
                            <th>Percentage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalCategoryBooks = $categoryStats->sum('books_count');
                        @endphp
                        @foreach($categoryStats as $category)
                            <tr>
                                <td>{{ $category->category_name ?? 'Uncategorized' }}</td>
                                <td>{{ $category->books_count }}</td>
                                <td>
                                    @if($totalCategoryBooks > 0)
                                        {{ round(($category->books_count / $totalCategoryBooks) * 100, 1) }}%
                                    @else
                                        0%
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @if($categoryStats->isEmpty())
                            <tr><td colspan="3" class="text-center text-muted">No categories available.</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Top 10 Borrowed Books</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>ISBN</th>
                            <th>Category</th>
                            <th>Borrows</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topBooks as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item['book']->title ?? 'Unknown' }}</td>
                                <td>{{ $item['book']->author->author_name ?? '-' }}</td>
                                <td>{{ $item['book']->isbn ?? '-' }}</td>
                                <td>{{ $item['book']->category->category_name ?? '-' }}</td>
                                <td><span class="badge bg-primary">{{ $item['count'] }}</span></td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-muted">No borrowing records yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Top 10 Borrowed Periodicals</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Journal</th>
                            <th>ISSN</th>
                            <th>Category</th>
                            <th>Borrows</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topPeriodicals as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item['journal']->title ?? 'Unknown' }}</td>
                                <td>{{ $item['journal']->journal_name ?? '-' }}</td>
                                <td>{{ $item['journal']->issn ?? '-' }}</td>
                                <td>{{ $item['journal']->category->category_name ?? '-' }}</td>
                                <td><span class="badge bg-info">{{ $item['count'] }}</span></td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-muted">No borrowing records yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Top 10 Borrowed Theses</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Author(s)</th>
                            <th>Institution</th>
                            <th>Category</th>
                            <th>Borrows</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topTheses as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item['thesis']->title ?? 'Unknown' }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($item['thesis']->authors ?? '-', 20) }}</td>
                                <td>{{ $item['thesis']->institution ?? '-' }}</td>
                                <td>{{ $item['thesis']->category->category_name ?? '-' }}</td>
                                <td><span class="badge bg-success">{{ $item['count'] }}</span></td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-muted">No borrowing records yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0">Overdue Items - Complete Details</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Type</th>
                            <th>Borrower</th>
                            <th>Borrow Date</th>
                            <th>Due Date</th>
                            <th>Days Overdue</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($overdueBorrows as $borrow)
                            @php
                                $itemTitle = $borrow->book?->title ?? $borrow->journal?->title ?? $borrow->thesis?->title ?? 'Unknown Item';
                                $itemType = $borrow->book ? 'Book' : ($borrow->journal ? 'Periodical' : ($borrow->thesis ? 'Thesis' : 'Unknown'));
                                $borrower = $borrow->member->user->full_name ?? 'Unknown';
                                $daysOverdue = \Carbon\Carbon::parse($borrow->due_date)->diffInDays(now());
                            @endphp
                            <tr>
                                <td>{{ $itemTitle }}</td>
                                <td><span class="badge bg-secondary">{{ $itemType }}</span></td>
                                <td>{{ $borrower }}</td>
                                <td>{{ $borrow->borrowed_at?->format('Y-m-d') ?? '-' }}</td>
                                <td>{{ $borrow->due_date }}</td>
                                <td><span class="badge bg-danger">{{ $daysOverdue }} days</span></td>
                                <td><span class="badge bg-danger">Overdue</span></td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center text-muted">No overdue items.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Recent Borrows - Complete Details</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Type</th>
                            <th>Borrower</th>
                            <th>Borrow Date</th>
                            <th>Due Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentBorrows as $borrow)
                            @php
                                $itemTitle = $borrow->book?->title ?? $borrow->journal?->title ?? $borrow->thesis?->title ?? 'Unknown Item';
                                $itemType = $borrow->book ? 'Book' : ($borrow->journal ? 'Periodical' : ($borrow->thesis ? 'Thesis' : 'Unknown'));
                                $borrower = $borrow->member->user->full_name ?? 'Unknown';
                            @endphp
                            <tr>
                                <td>{{ $itemTitle }}</td>
                                <td><span class="badge bg-secondary">{{ $itemType }}</span></td>
                                <td>{{ $borrower }}</td>
                                <td>{{ $borrow->borrowed_at?->format('Y-m-d') ?? '-' }}</td>
                                <td>{{ $borrow->due_date }}</td>
                                <td>
                                    @if($borrow->status === 'Borrowed')
                                        <span class="badge bg-primary">Borrowed</span>
                                    @elseif($borrow->status === 'Overdue')
                                        <span class="badge bg-danger">Overdue</span>
                                    @elseif($borrow->status === 'Returned')
                                        <span class="badge bg-success">Returned</span>
                                    @elseif($borrow->status === 'Pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $borrow->status }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-muted">No borrow records yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Recent Returns - Complete Details</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Type</th>
                            <th>Borrower</th>
                            <th>Borrow Date</th>
                            <th>Due Date</th>
                            <th>Return Date</th>
                            <th>Condition</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentReturns as $borrow)
                            @php
                                $itemTitle = $borrow->book?->title ?? $borrow->journal?->title ?? $borrow->thesis?->title ?? 'Unknown Item';
                                $itemType = $borrow->book ? 'Book' : ($borrow->journal ? 'Periodical' : ($borrow->thesis ? 'Thesis' : 'Unknown'));
                                $borrower = $borrow->member->user->full_name ?? 'Unknown';
                            @endphp
                            <tr>
                                <td>{{ $itemTitle }}</td>
                                <td><span class="badge bg-secondary">{{ $itemType }}</span></td>
                                <td>{{ $borrower }}</td>
                                <td>{{ $borrow->borrowed_at?->format('Y-m-d') ?? '-' }}</td>
                                <td>{{ $borrow->due_date }}</td>
                                <td>{{ $borrow->updated_at?->format('Y-m-d') ?? '-' }}</td>
                                <td>
                                    @if($borrow->condition_status)
                                        <span class="badge bg-{{ $borrow->condition_status === 'Good' ? 'success' : 'warning' }}">
                                            {{ $borrow->condition_status }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center text-muted">No return records yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Recent Reservations - Complete Details</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Type</th>
                            <th>Member</th>
                            <th>Reservation Date</th>
                            <th>Expiration Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentReservations as $reservation)
                            @php
                                $itemTitle = $reservation->book?->title ?? $reservation->journal?->title ?? $reservation->thesis?->title ?? 'Unknown Item';
                                $itemType = $reservation->book ? 'Book' : ($reservation->journal ? 'Periodical' : ($reservation->thesis ? 'Thesis' : 'Unknown'));
                                $member = $reservation->member->user->full_name ?? 'Unknown';
                            @endphp
                            <tr>
                                <td>{{ $itemTitle }}</td>
                                <td><span class="badge bg-secondary">{{ $itemType }}</span></td>
                                <td>{{ $member }}</td>
                                <td>{{ $reservation->reservation_date ?? '-' }}</td>
                                <td>{{ $reservation->expiration_date ?? '-' }}</td>
                                <td>
                                    @if($reservation->status === 'Pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($reservation->status === 'Approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($reservation->status === 'Cancelled')
                                        <span class="badge bg-danger">Cancelled</span>
                                    @elseif($reservation->status === 'Claimed')
                                        <span class="badge bg-info">Claimed</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $reservation->status }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-muted">No reservations yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">Recent Fines - Complete Details</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Borrower</th>
                            <th>Item</th>
                            <th>Type</th>
                            <th>Fine Amount</th>
                            <th>Status</th>
                            <th>Borrow Date</th>
                            <th>Due Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentFines as $fine)
                            @php
                                $itemTitle = $fine->borrow->book?->title ?? $fine->borrow->journal?->title ?? $fine->borrow->thesis?->title ?? 'Unknown Item';
                                $itemType = $fine->borrow->book ? 'Book' : ($fine->borrow->journal ? 'Periodical' : ($fine->borrow->thesis ? 'Thesis' : 'Unknown'));
                                $borrower = $fine->borrow->member->user->full_name ?? 'Unknown';
                            @endphp
                            <tr>
                                <td>{{ $borrower }}</td>
                                <td>{{ $itemTitle }}</td>
                                <td><span class="badge bg-secondary">{{ $itemType }}</span></td>
                                <td>₱{{ number_format($fine->amount ?? 0, 2) }}</td>
                                <td>
                                    @if($fine->status === 'Paid')
                                        <span class="badge bg-success">Paid</span>
                                    @elseif($fine->status === 'Unpaid')
                                        <span class="badge bg-danger">Unpaid</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $fine->status }}</span>
                                    @endif
                                </td>
                                <td>{{ $fine->borrow->borrowed_at?->format('Y-m-d') ?? '-' }}</td>
                                <td>{{ $fine->borrow->due_date ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center text-muted">No fines recorded.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Top 10 Most Active Members</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Member Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Total Borrows</th>
                            <th>Activity Level</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($memberActivity as $index => $member)
                            @php
                                $activityLevel = $member->borrow_records_count > 10 ? 'Very High' : ($member->borrow_records_count > 5 ? 'High' : ($member->borrow_records_count > 2 ? 'Moderate' : 'Low'));
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $member->user->full_name ?? 'Unknown' }}</td>
                                <td>{{ $member->user->username ?? '-' }}</td>
                                <td>{{ $member->user->email ?? '-' }}</td>
                                <td><span class="badge bg-primary">{{ $member->borrow_records_count }}</span></td>
                                <td>
                                    @if($activityLevel === 'Very High')
                                        <span class="badge bg-danger">Very High</span>
                                    @elseif($activityLevel === 'High')
                                        <span class="badge bg-warning text-dark">High</span>
                                    @elseif($activityLevel === 'Moderate')
                                        <span class="badge bg-info">Moderate</span>
                                    @else
                                        <span class="badge bg-secondary">Low</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-muted">No member activity yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
