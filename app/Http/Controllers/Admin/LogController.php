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
        $this->middleware('role:Admin,Librarian,Working-Student');
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

        $logs = $query->latest()->paginate(50);

        return view('admin.logs.index', compact('logs'));
    }

    public function data()
    {
        $logs = ActivityLog::query()
            ->select('id', 'username', 'role', 'action', 'description', 'ip_address', 'created_at')
            ->latest()
            ->limit(50)
            ->get()
            ->map(function ($log) {
                return [
                    'id' => $log->id,
                    'username' => $log->username,
                    'role' => $log->role,
                    'action' => $log->action,
                    'description' => $log->description,
                    'ip_address' => $log->ip_address,
                    'created_at' => $log->created_at ? $log->created_at->format('Y-m-d H:i:s') : null,
                ];
            });

        return response()->json($logs);
    }
}
