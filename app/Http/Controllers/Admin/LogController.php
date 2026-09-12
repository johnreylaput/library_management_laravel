<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin,Librarian,Working.Student');
    }

    public function index(Request $request)
    {
        $query = ActivityLog::query();

        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                  ->orWhere('action', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $sessions = $this->buildSessions($query->orderBy('created_at', 'desc')->get());

        if ($search) {
            $sessions = $sessions->filter(function ($session) use ($search) {
                return str_contains(strtolower($session['username']), strtolower($search))
                    || str_contains(strtolower($session['action']), strtolower($search))
                    || str_contains(strtolower($session['description']), strtolower($search));
            })->values();
        }

        return view('admin.logs.index', [
            'sessions' => $sessions,
        ]);
    }

    public function data()
    {
        $logs = ActivityLog::query()
            ->select('id', 'username', 'role', 'action', 'description', 'ip_address', 'session_id', 'created_at')
            ->latest()
            ->limit(50)
            ->get();

        $sessions = $this->buildSessions($logs);

        return response()->json($sessions);
    }

    private function buildSessions($logs)
    {
        $sessions = [];
        $openSessions = [];

        foreach ($logs->sortBy('created_at') as $log) {
            $sessionId = $log->session_id;

            if (! $sessionId) {
                continue;
            }

            if ($log->action === 'Login') {
                $openSessions[$sessionId] = [
                    'id' => $log->id,
                    'session_id' => $sessionId,
                    'username' => $log->username,
                    'role' => $log->role,
                    'ip_address' => $log->ip_address,
                    'time_in' => $log->created_at,
                    'time_out' => null,
                    'action' => 'Login',
                    'description' => $log->description,
                ];
            } elseif ($log->action === 'Logout' && isset($openSessions[$sessionId])) {
                $openSessions[$sessionId]['time_out'] = $log->created_at;
                $openSessions[$sessionId]['description'] = $log->description;
                $sessions[] = $openSessions[$sessionId];
                unset($openSessions[$sessionId]);
            }
        }

        foreach ($openSessions as $session) {
            $sessions[] = $session;
        }

        return collect($sessions)->sortByDesc(function ($session) {
            return $session['time_in'];
        })->values();
    }
}
