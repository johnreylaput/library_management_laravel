@extends('layout.app')

@section('title', 'Activity Logs')

@section('content')
<h2 class="mb-4">Activity Logs</h2>

<form method="GET" action="{{ route('logs.index') }}" class="row g-2 mb-3">
    <div class="col-md-6">
        <input type="text" name="q" class="form-control" placeholder="Search logs..." value="{{ request('q') }}">
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-dark w-100"><i class="bi bi-search"></i> Search</button>
    </div>
</form>

<div class="d-flex justify-content-between align-items-center mb-2">
    <span class="text-muted small" id="log-status">Live updating...</span>
    <span class="badge bg-success" id="new-badge" style="display:none;">New entries</span>
</div>

<table class="table table-striped table-bordered" id="logs-table">
    <thead class="table-dark">
        <tr>
            <th>User</th>
            <th>Role</th>
            <th>IP Address</th>
            <th>Time-In</th>
            <th>Time-Out</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sessions as $session)
            <tr data-log-id="{{ $session['id'] }}">
                <td>{{ $session['username'] }}</td>
                <td>{{ $session['role'] }}</td>
                <td>{{ $session['ip_address'] }}</td>
                <td class="time-in">{{ $session['time_in'] ? $session['time_in']->format('Y-m-d h:i:s A') : '-' }}</td>
                <td class="time-out">{{ $session['time_out'] ? $session['time_out']->format('Y-m-d h:i:s A') : 'Active' }}</td>
                <td>
                    @if($session['time_out'])
                        <span class="badge bg-secondary">Logged Out</span>
                    @else
                        <span class="badge bg-success">Active</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-3">
    @if(method_exists($sessions, 'links'))
        {{ $sessions->links() }}
    @endif
</div>
@endsection

@push('scripts')
<script>
let knownLogIds = new Set([
    @foreach($sessions as $session)
        {{ $session['id'] }},
    @endforeach
]);

function formatDateTime(dateStr) {
    if (!dateStr) return '-';
    const d = new Date(dateStr.replace(' ', 'T') + '+08:00');
    if (isNaN(d.getTime())) return dateStr;
    return d.toLocaleString('en-PH', {
        timeZone: 'Asia/Manila',
        year: 'numeric',
        month: 'short',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: true
    });
}

function highlightRow(row) {
    row.classList.add('table-warning');
    setTimeout(() => row.classList.remove('table-warning'), 3000);
}

async function fetchLogs() {
    try {
        const response = await fetch('{{ route('logs.data') }}', {
            headers: { 'Accept': 'application/json' }
        });
        if (!response.ok) throw new Error('Failed to fetch logs');
        const sessions = await response.json();

        const tbody = document.querySelector('#logs-table tbody');
        if (!tbody) return;

        const currentIds = new Set();
        let newCount = 0;

        sessions.forEach((session, index) => {
            currentIds.add(session.id);
            let row = document.querySelector(`tr[data-log-id="${session.id}"]`);

            if (!row) {
                row = document.createElement('tr');
                row.setAttribute('data-log-id', session.id);
                row.innerHTML = `
                    <td>${session.username || ''}</td>
                    <td>${session.role || ''}</td>
                    <td>${session.ip_address || ''}</td>
                    <td class="time-in">${formatDateTime(session.time_in)}</td>
                    <td class="time-out">${session.time_out ? formatDateTime(session.time_out) : 'Active'}</td>
                    <td>${session.time_out ? '<span class="badge bg-secondary">Logged Out</span>' : '<span class="badge bg-success">Active</span>'}</td>
                `;
                tbody.insertBefore(row, tbody.firstChild);
                highlightRow(row);
                newCount++;
            } else {
                const timeInCell = row.querySelector('.time-in');
                const timeOutCell = row.querySelector('.time-out');
                if (timeInCell && session.time_in) {
                    timeInCell.textContent = formatDateTime(session.time_in);
                }
                if (timeOutCell) {
                    timeOutCell.textContent = session.time_out ? formatDateTime(session.time_out) : 'Active';
                }
            }
        });

        document.querySelectorAll('#logs-table tbody tr').forEach(row => {
            const id = parseInt(row.getAttribute('data-log-id'));
            if (!currentIds.has(id)) {
                row.remove();
            }
        });

        knownLogIds = currentIds;

        const badge = document.getElementById('new-badge');
        if (newCount > 0 && badge) {
            badge.style.display = 'inline-block';
            badge.textContent = `${newCount} new log${newCount > 1 ? 's' : ''}`;
        }
    } catch (error) {
        console.error('Error fetching logs:', error);
    }
}

setInterval(fetchLogs, 3000);
fetchLogs();
</script>
@endpush
