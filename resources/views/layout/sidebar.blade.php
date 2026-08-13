<nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar">
    <div class="position-sticky top-0 pt-3">
        <div class="px-3 mb-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('images/uc-library-logo.png') }}"
                         alt="UC Banilad Library Logo"
                         class="sidebar-logo me-2">
                    <div>
                        <h6 class="text-white fw-bold mb-0">
                            UC BANILAD
                        </h6>
                        <small class="text-light">
                            LIBRARY INVENTORY SYSTEM
                        </small>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-3 mb-3">
            <div id="clock-widget" class="text-white text-end" style="font-size:0.85rem; line-height:1.3;">
                <div id="clock-time" class="fw-semibold">--:--:-- --</div>
                <div id="clock-day" class="small text-light">Loading...</div>
                <div id="clock-date" class="small text-light">Loading...</div>
            </div>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('e-periodical.index') }}"><i class="bi bi-journal-arrow-down"></i> E-Periodical Index</a></li>
            @if(Auth::check() && Auth::user()->role === 'Member')
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('search.index') }}"><i class="bi bi-search"></i> Browse Books</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('member.borrow.index') }}"><i class="bi bi-book"></i> Borrow Book</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('member.reservation.index') }}"><i class="bi bi-calendar-check"></i> Reserve Book</a></li>
            @else
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('search.index') }}"><i class="bi bi-search"></i> Browse Books</a></li>
            @endif
            @if(Auth::check() && in_array(Auth::user()->role, ['Admin', 'Librarian', 'Working-Student']))

                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('members.index') }}">
                        <i class="bi bi-people"></i> Members
                    </a>
                </li>

                <li class="nav-item"><a class="nav-link text-white" href="{{ route('categories.index') }}"><i class="bi bi-tag"></i> Categories</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('authors.index') }}"><i class="bi bi-person"></i> Authors</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('publishers.index') }}"><i class="bi bi-building"></i> Publishers</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('books.index') }}"><i class="bi bi-book"></i> Books</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('journals.index') }}"><i class="bi bi-journal-arrow-down"></i> Journals</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('theses.index') }}"><i class="bi bi-file-earmark-text"></i> Theses</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('borrow.index') }}"><i class="bi bi-journal-arrow-down"></i> Borrow</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('return.index') }}"><i class="bi bi-arrow-return-left"></i> Return</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('reservations.index') }}"><i class="bi bi-calendar-check"></i> Reservations</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('fines.index') }}"><i class="bi bi-cash-coin"></i> Fines</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('reports.index') }}"><i class="bi bi-file-earmark-bar-graph"></i> Reports</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('logs.index') }}"><i class="bi bi-list-ul"></i> Activity Logs</a></li>
            @endif
            @if(Auth::check() && Auth::user()->role === 'Admin')
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('users.index') }}"><i class="bi bi-people"></i> Users</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('librarians.index') }}"><i class="bi bi-person-badge"></i> Librarians</a></li>
            @endif
            @if(Auth::check() && Auth::user()->role === 'Librarian')
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('users.index') }}"><i class="bi bi-people"></i> Users</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('deletion-requests.index') }}"><i class="bi bi-trash"></i> Review Deletion Requests</a></li>
            @endif
            @if(Auth::check() && Auth::user()->role === 'Working-Student')
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('users.index') }}"><i class="bi bi-people"></i> Users</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('deletion-requests.my-requests') }}"><i class="bi bi-list-check"></i> My Deletion Requests</a></li>
            @endif
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('profile.index') }}"><i class="bi bi-person"></i> Profile</a></li>
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to log out?');">
                    @csrf
                    <button type="submit" class="nav-link btn btn-link text-white"><i class="bi bi-box-arrow-right"></i> Logout ({{ Auth::user()->username }})</button>
                </form>
            </li>
        </ul>
    </div>
</nav>

@push('scripts')
<script>
(function() {
    const timeEl = document.getElementById('clock-time');
    const dayEl = document.getElementById('clock-day');
    const dateEl = document.getElementById('clock-date');
    const options = { timeZone: 'Asia/Manila' };

    function updateClock() {
        const now = new Date();
        const timeStr = now.toLocaleTimeString('en-PH', { ...options, hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true });
        const dayStr = now.toLocaleDateString('en-PH', { ...options, weekday: 'long' });
        const dateStr = now.toLocaleDateString('en-PH', { ...options, month: 'long', day: 'numeric', year: 'numeric' });

        if (timeEl) timeEl.textContent = timeStr;
        if (dayEl) dayEl.textContent = dayStr;
        if (dateEl) dateEl.textContent = dateStr;
    }

    updateClock();
    setInterval(updateClock, 1000);
})();
</script>
@endpush
