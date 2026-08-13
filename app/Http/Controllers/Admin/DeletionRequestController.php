<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeletionRequest;
use App\Models\Book;
use App\Models\Journal;
use App\Models\Thesis;
use App\Models\ActivityLog;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeletionRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Librarian')->only(['index', 'approve', 'reject']);
        $this->middleware('role:Working-Student')->only(['myRequests']);
    }

    public function index()
    {
        if (Auth::user()->role !== 'Librarian') {
            return redirect()->route('dashboard')->with('error', 'Only librarians can review deletion requests.');
        }

        $pendingRequests = DeletionRequest::with(['user', 'reviewer'])
            ->where('status', 'Pending')
            ->latest()
            ->get();

        $resolvedRequests = DeletionRequest::with(['user', 'reviewer'])
            ->whereIn('status', ['Approved', 'Rejected'])
            ->latest()
            ->take(20)
            ->get();

        return view('admin.deletion-requests.index', compact('pendingRequests', 'resolvedRequests'));
    }

    public function myRequests()
    {
        $requests = DeletionRequest::with(['reviewer'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('admin.deletion-requests.my-requests', compact('requests'));
    }

    public function approve($id)
    {
        if (Auth::user()->role !== 'Librarian') {
            return back()->with('error', 'Only librarians can approve deletion requests.');
        }

        $request = DeletionRequest::findOrFail($id);

        if ($request->status !== 'Pending') {
            return back()->with('error', 'This request has already been processed.');
        }

        $modelClass = $request->item_type;
        $item = $modelClass::find($request->item_id);

        if ($item) {
            $item->delete();
        }

        $request->update([
            'status' => 'Approved',
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'username' => Auth::user()->username,
            'role' => Auth::user()->role,
            'action' => 'Approve Deletion Request',
            'description' => "Approved deletion of {$request->item_type} '{$request->title}' (ID: {$request->item_id})",
            'ip_address' => request()->ip(),
        ]);

        Notification::create([
            'user_id' => $request->user_id,
            'type' => 'deletion_request',
            'title' => 'Deletion Request Approved',
            'message' => "Your deletion request for {$request->item_type} '{$request->title}' has been approved by " . Auth::user()->full_name . ". The item has been removed from the library records.",
            'sent_by' => Auth::id(),
        ]);

        return back()->with('success', "Deletion request for '{$request->title}' has been approved and the item has been deleted.");
    }

    public function reject(Request $request, $id)
    {
        if (Auth::user()->role !== 'Librarian') {
            return back()->with('error', 'Only librarians can reject deletion requests.');
        }

        $requestModel = DeletionRequest::findOrFail($id);

        if ($requestModel->status !== 'Pending') {
            return back()->with('error', 'This request has already been processed.');
        }

        $validated = $request->validate([
            'rejection_reason' => 'nullable|string|max:1000',
        ]);

        $requestModel->update([
            'status' => 'Rejected',
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
            'rejection_reason' => $validated['rejection_reason'],
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'username' => Auth::user()->username,
            'role' => Auth::user()->role,
            'action' => 'Reject Deletion Request',
            'description' => "Rejected deletion of {$requestModel->item_type} '{$requestModel->title}' (ID: {$requestModel->item_id})",
            'ip_address' => request()->ip(),
        ]);

        Notification::create([
            'user_id' => $requestModel->user_id,
            'type' => 'deletion_request',
            'title' => 'Deletion Request Rejected',
            'message' => "Your deletion request for {$requestModel->item_type} '{$requestModel->title}' was rejected by " . Auth::user()->full_name . "." . ($validated['rejection_reason'] ? " Reason: {$validated['rejection_reason']}" : ''),
            'sent_by' => Auth::id(),
        ]);

        return back()->with('success', "Deletion request for '{$requestModel->title}' has been rejected.");
    }
}
