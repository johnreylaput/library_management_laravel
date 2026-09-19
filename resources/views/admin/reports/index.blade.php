@extends('layout.app')

@section('title', 'Reports')

@push('styles')
<style>
    .report-table th {
        white-space: nowrap;
        font-weight: 600;
        font-size: 0.85rem;
        border-bottom: 2px solid #dee2e6;
    }
    .report-table td {
        vertical-align: top;
        word-wrap: break-word;
        word-break: break-word;
        white-space: normal;
    }
    .report-table-sm td,
    .report-table-sm th {
        white-space: nowrap;
    }
    .table-badge {
        display: inline-block;
        min-width: 70px;
        text-align: center;
    }
    .report-card-header h5 {
        margin-bottom: 0;
        font-size: 1rem;
    }
    .stats-card h5 {
        font-size: 0.9rem;
        font-weight: 500;
        margin-bottom: 0.25rem;
    }
    .stats-card h2 {
        font-size: 1.75rem;
        font-weight: 600;
        margin-bottom: 0;
    }
    @media (max-width: 768px) {
        .stats-card h2 { font-size: 1.4rem; }
        .stats-card h5 { font-size: 0.8rem; }
    }
</style>
@endpush

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
        <div class="card bg-primary text-white stats-card h-100">
            <div class="card-body text-center">
                <h5><i class="bi bi-book"></i> Total Books</h5>
                <h2>{{ $stats['total_books'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white stats-card h-100">
            <div class="card-body text-center">
                <h5><i class="bi bi-journal-arrow-down"></i> Periodicals</h5>
                <h2>{{ $stats['total_periodicals'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white stats-card h-100">
            <div class="card-body text-center">
                <h5><i class="bi bi-file-earmark-text"></i> Theses</h5>
                <h2>{{ $stats['total_theses'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-secondary text-white stats-card h-100">
            <div class="card-body text-center">
                <h5><i class="bi bi-people"></i> Members</h5>
                <h2>{{ $stats['total_members'] }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card bg-warning text-dark stats-card h-100">
            <div class="card-body text-center">
                <h5><i class="bi bi-journal-arrow-down"></i> Borrowed</h5>
                <h2>{{ $stats['total_borrowed'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-danger text-white stats-card h-100">
            <div class="card-body text-center">
                <h5><i class="bi bi-exclamation-triangle"></i> Overdue</h5>
                <h2>{{ $stats['total_overdue'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white stats-card h-100">
            <div class="card-body text-center">
                <h5><i class="bi bi-calendar-check"></i> Pending Reservations</h5>
                <h2>{{ $stats['total_reservations'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-dark text-white stats-card h-100">
            <div class="card-body text-center">
                <h5><i class="bi bi-cash-coin"></i> Fines</h5>
                <h2>{{ $stats['total_fines'] }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card bg-light stats-card h-100">
            <div class="card-body text-center">
                <h5 class="text-primary"><i class="bi bi-clock-history"></i> Pending Borrow Requests</h5>
                <h2>{{ $stats['total_pending_borrow_requests'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-light stats-card h-100">
            <div class="card-body text-center">
                <h5 class="text-success"><i class="bi bi-check-circle"></i> Returned</h5>
                <h2>{{ $stats['total_returned'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-light stats-card h-100">
            <div class="card-body text-center">
                <h5 class="text-warning"><i class="bi bi-x-circle"></i> Cancelled Reservations</h5>
                <h2>{{ $stats['total_cancelled_reservations'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-light stats-card h-100">
            <div class="card-body text-center">
                <h5 class="text-danger"><i class="bi bi-trash"></i> Approved Deletions</h5>
                <h2>{{ $stats['total_approved_deletions'] }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-dark text-white report-card-header">
                <h5 class="mb-0">Categories</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped report-table report-table-sm mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th style="width: 45%;">Category</th>
                                <th style="width: 50%;">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categoryStats as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->category_name ?? 'Uncategorized' }}</td>
                                    <td>{{ $category->description ?? '-' }}</td>
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
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white report-card-header">
                <h5 class="mb-0">Top 10 Borrowed Books</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped report-table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 3%;">#</th>
                                <th style="width: 12%;">Author</th>
                                <th style="width: 18%;">Title</th>
                                <th style="width: 8%;">Edition</th>
                                <th style="width: 6%;">Year</th>
                                <th style="width: 15%;">Subject</th>
                                <th style="width: 18%;">Publication</th>
                                <th style="width: 6%;">Borrows</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($topBooks as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item['book']->author ?? '-' }}</td>
                                    <td>{{ $item['book']->title ?? 'Unknown' }}</td>
                                    <td>{{ $item['book']->edition ?? '-' }}</td>
                                    <td>{{ $item['book']->year ?? '-' }}</td>
                                    <td>{{ $item['book']->subject ?? '-' }}</td>
                                    <td>{{ $item['book']->publication ?? '-' }}</td>
                                    <td><span class="badge bg-primary table-badge">{{ $item['count'] }}</span></td>
                                </tr>
                            @empty
                                <tr><td colspan="8" class="text-center text-muted">No borrowing records yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-info text-white report-card-header">
                <h5 class="mb-0">Top 10 Borrowed Periodicals</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped report-table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 3%;">#</th>
                                <th style="width: 18%;">Title</th>
                                <th style="width: 18%;">Journal</th>
                                <th style="width: 10%;">ISSN</th>
                                <th style="width: 15%;">Category</th>
                                <th style="width: 15%;">Authors</th>
                                <th style="width: 6%;">Year</th>
                                <th style="width: 6%;">Borrows</th>
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
                                    <td>{{ $item['journal']->authors ?? '-' }}</td>
                                    <td>{{ $item['journal']->publication_date ? \Carbon\Carbon::parse($item['journal']->publication_date)->year : '-' }}</td>
                                    <td><span class="badge bg-info table-badge">{{ $item['count'] }}</span></td>
                                </tr>
                            @empty
                                <tr><td colspan="8" class="text-center text-muted">No borrowing records yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-success text-white report-card-header">
                <h5 class="mb-0">Top 10 Borrowed Theses</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped report-table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 3%;">#</th>
                                <th style="width: 25%;">Author</th>
                                <th style="width: 25%;">Research Type</th>
                                <th style="width: 25%;">Date Published</th>
                                <th style="width: 15%;">Subjects / Keywords</th>
                                <th style="width: 6%;">Borrows</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($topTheses as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item['thesis']->author ?? 'Unknown' }}</td>
                                    <td>{{ $item['thesis']->research ?? '-' }}</td>
                                    <td>{{ $item['thesis']->date_published ? \Carbon\Carbon::parse($item['thesis']->date_published)->format('M d, Y') : '-' }}</td>
                                    <td>{{ $item['thesis']->subjects_keywords ?? '-' }}</td>
                                    <td><span class="badge bg-success table-badge">{{ $item['count'] }}</span></td>
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
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header bg-danger text-white report-card-header">
                <h5 class="mb-0">Overdue Items - Complete Details</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped report-table report-table-sm mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="min-width: 140px;">Item</th>
                                <th style="min-width: 80px;">Type</th>
                                <th style="min-width: 120px;">Borrower</th>
                                <th style="min-width: 90px;">Borrow Date</th>
                                <th style="min-width: 90px;">Due Date</th>
                                <th style="min-width: 90px;">Days Overdue</th>
                                <th style="min-width: 80px;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($overdueBorrows as $borrow)
                                @php
                                    $itemTitle = $borrow->book?->title ?? $borrow->journal?->title ?? $borrow->thesis?->author ?? 'Unknown Item';
                                    $itemType = $borrow->book ? 'Book' : ($borrow->journal ? 'Periodical' : ($borrow->thesis ? 'Thesis' : 'Unknown'));
                                    $borrower = $borrow->member->user->full_name ?? 'Unknown';
                                    $daysOverdue = \Carbon\Carbon::parse($borrow->due_date)->diffInDays(now());
                                @endphp
                                <tr>
                                    <td>{{ $itemTitle }}</td>
                                    <td><span class="badge bg-secondary table-badge">{{ $itemType }}</span></td>
                                    <td>{{ $borrower }}</td>
                                    <td>{{ $borrow->borrowed_at?->format('Y-m-d') ?? '-' }}</td>
                                    <td>{{ $borrow->due_date }}</td>
                                    <td><span class="badge bg-danger table-badge">{{ $daysOverdue }} days</span></td>
                                    <td><span class="badge bg-danger table-badge">Overdue</span></td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="text-center text-muted">No overdue items.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header bg-success text-white report-card-header">
                <h5 class="mb-0">Recent Borrows - Complete Details</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped report-table report-table-sm mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="min-width: 140px;">Item</th>
                                <th style="min-width: 80px;">Type</th>
                                <th style="min-width: 120px;">Borrower</th>
                                <th style="min-width: 90px;">Borrow Date</th>
                                <th style="min-width: 90px;">Due Date</th>
                                <th style="min-width: 80px;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentBorrows as $borrow)
                                @php
                                    $itemTitle = $borrow->book?->title ?? $borrow->journal?->title ?? $borrow->thesis?->author ?? 'Unknown Item';
                                    $itemType = $borrow->book ? 'Book' : ($borrow->journal ? 'Periodical' : ($borrow->thesis ? 'Thesis' : 'Unknown'));
                                    $borrower = $borrow->member->user->full_name ?? 'Unknown';
                                @endphp
                                <tr>
                                    <td>{{ $itemTitle }}</td>
                                    <td><span class="badge bg-secondary table-badge">{{ $itemType }}</span></td>
                                    <td>{{ $borrower }}</td>
                                    <td>{{ $borrow->borrowed_at?->format('Y-m-d') ?? '-' }}</td>
                                    <td>{{ $borrow->due_date }}</td>
                                    <td>
                                        @if($borrow->status === 'Borrowed')
                                            <span class="badge bg-primary table-badge">Borrowed</span>
                                        @elseif($borrow->status === 'Overdue')
                                            <span class="badge bg-danger table-badge">Overdue</span>
                                        @elseif($borrow->status === 'Returned')
                                            <span class="badge bg-success table-badge">Returned</span>
                                        @elseif($borrow->status === 'Pending')
                                            <span class="badge bg-warning text-dark table-badge">Pending</span>
                                        @else
                                            <span class="badge bg-secondary table-badge">{{ $borrow->status }}</span>
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
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header bg-success text-white report-card-header">
                <h5 class="mb-0">Recent Returns - Complete Details</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped report-table report-table-sm mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="min-width: 140px;">Item</th>
                                <th style="min-width: 80px;">Type</th>
                                <th style="min-width: 120px;">Borrower</th>
                                <th style="min-width: 90px;">Borrow Date</th>
                                <th style="min-width: 90px;">Due Date</th>
                                <th style="min-width: 90px;">Return Date</th>
                                <th style="min-width: 80px;">Condition</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentReturns as $borrow)
                                @php
                                    $itemTitle = $borrow->book?->title ?? $borrow->journal?->title ?? $borrow->thesis?->author ?? 'Unknown Item';
                                    $itemType = $borrow->book ? 'Book' : ($borrow->journal ? 'Periodical' : ($borrow->thesis ? 'Thesis' : 'Unknown'));
                                    $borrower = $borrow->member->user->full_name ?? 'Unknown';
                                @endphp
                                <tr>
                                    <td>{{ $itemTitle }}</td>
                                    <td><span class="badge bg-secondary table-badge">{{ $itemType }}</span></td>
                                    <td>{{ $borrower }}</td>
                                    <td>{{ $borrow->borrowed_at?->format('Y-m-d') ?? '-' }}</td>
                                    <td>{{ $borrow->due_date }}</td>
                                    <td>{{ $borrow->updated_at?->format('Y-m-d') ?? '-' }}</td>
                                    <td>
                                        @if($borrow->condition_status)
                                            <span class="badge bg-{{ $borrow->condition_status === 'Good' ? 'success' : 'warning' }} table-badge">
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
    </div>

    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header bg-info text-white report-card-header">
                <h5 class="mb-0">Recent Reservations - Complete Details</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped report-table report-table-sm mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="min-width: 140px;">Item</th>
                                <th style="min-width: 80px;">Type</th>
                                <th style="min-width: 120px;">Member</th>
                                <th style="min-width: 110px;">Reservation Date</th>
                                <th style="min-width: 110px;">Due Date</th>
                                <th style="min-width: 90px;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentReservations as $reservation)
                                @php
                                    $itemTitle = $reservation->book?->title ?? $reservation->journal?->title ?? $reservation->thesis?->author ?? 'Unknown Item';
                                    $itemType = $reservation->book ? 'Book' : ($reservation->journal ? 'Periodical' : ($reservation->thesis ? 'Thesis' : 'Unknown'));
                                    $member = $reservation->member->user->full_name ?? 'Unknown';
                                @endphp
                                <tr>
                                    <td>{{ $itemTitle }}</td>
                                    <td><span class="badge bg-secondary table-badge">{{ $itemType }}</span></td>
                                    <td>{{ $member }}</td>
                                    <td>{{ $reservation->reservation_date ?? '-' }}</td>
                                    <td>{{ $reservation->due_date ?? '-' }}</td>
                                    <td>
                                        @if($reservation->status === 'Pending')
                                            <span class="badge bg-warning text-dark table-badge">Pending</span>
                                        @elseif($reservation->status === 'Approved')
                                            <span class="badge bg-success table-badge">Approved</span>
                                        @elseif($reservation->status === 'Cancelled')
                                            <span class="badge bg-danger table-badge">Cancelled</span>
                                        @elseif($reservation->status === 'Claimed')
                                            <span class="badge bg-info table-badge">Claimed</span>
                                        @else
                                            <span class="badge bg-secondary table-badge">{{ $reservation->status }}</span>
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
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-warning text-dark report-card-header">
                <h5 class="mb-0">Recent Fines - Complete Details</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped report-table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="min-width: 120px;">Borrower</th>
                                <th style="min-width: 140px;">Item</th>
                                <th style="min-width: 80px;">Type</th>
                                <th style="min-width: 90px;">Fine Amount</th>
                                <th style="min-width: 80px;">Status</th>
                                <th style="min-width: 90px;">Borrow Date</th>
                                <th style="min-width: 90px;">Due Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentFines as $fine)
                                @php
                                    $itemTitle = $fine->borrow->book?->title ?? $fine->borrow->journal?->title ?? $fine->borrow->thesis?->author ?? 'Unknown Item';
                                    $itemType = $fine->borrow->book ? 'Book' : ($fine->borrow->journal ? 'Periodical' : ($fine->borrow->thesis ? 'Thesis' : 'Unknown'));
                                    $borrower = $fine->borrow->member->user->full_name ?? 'Unknown';
                                @endphp
                                <tr>
                                    <td>{{ $borrower }}</td>
                                    <td>{{ $itemTitle }}</td>
                                    <td><span class="badge bg-secondary table-badge">{{ $itemType }}</span></td>
                                    <td>₱{{ number_format($fine->amount ?? 0, 2) }}</td>
                                    <td>
                                        @if($fine->paid === 'Yes')
                                            <span class="badge bg-success table-badge">Paid</span>
                                        @elseif($fine->paid === 'No')
                                            <span class="badge bg-danger table-badge">Unpaid</span>
                                        @else
                                            <span class="badge bg-secondary table-badge">{{ $fine->paid ?? 'Unknown' }}</span>
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
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white report-card-header">
                <h5 class="mb-0">Top 10 Most Active Members</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped report-table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th style="width: 20%;">Member Name</th>
                                <th style="width: 15%;">Username</th>
                                <th style="width: 25%;">Email</th>
                                <th style="width: 10%;">Total Borrows</th>
                                <th style="width: 10%;">Activity Level</th>
                                <th style="width: 15%;">Member ID</th>
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
                                    <td><span class="badge bg-primary table-badge">{{ $member->borrow_records_count }}</span></td>
                                    <td>
                                        @if($activityLevel === 'Very High')
                                            <span class="badge bg-danger table-badge">Very High</span>
                                        @elseif($activityLevel === 'High')
                                            <span class="badge bg-warning text-dark table-badge">High</span>
                                        @elseif($activityLevel === 'Moderate')
                                            <span class="badge bg-info table-badge">Moderate</span>
                                        @else
                                            <span class="badge bg-secondary table-badge">Low</span>
                                        @endif
                                    </td>
                                    <td>{{ $member->member_no ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="text-center text-muted">No member activity yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
