<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Book;
use App\Models\Journal;
use App\Models\Thesis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RecentlyDeletedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            $isAllowed = $user && (
                in_array($user->role, ['Admin', 'Librarian', 'Working.Student'], true)
            );

            if (! $isAllowed) {
                abort(403, 'Unauthorized action.');
            }

            return $next($request);
        });
    }

    public function index()
    {
        $books = Book::onlyTrashed()
            ->latest('deleted_at')
            ->latest('id')
            ->get();

        $journals = Journal::onlyTrashed()
            ->with(['category', 'publisher'])
            ->latest('deleted_at')
            ->latest('id')
            ->get();

        $theses = Thesis::onlyTrashed()
            ->latest('deleted_at')
            ->latest('id')
            ->get();

        return view('admin.recently-deleted.index', compact('books', 'journals', 'theses'));
    }

    public function restore(string $type, int $id)
    {
        $model = match ($type) {
            'book' => Book::class,
            'journal' => Journal::class,
            'thesis' => Thesis::class,
            default => null,
        };

        if (! $model) {
            abort(404);
        }

        $item = $model::withTrashed()->findOrFail($id);
        $item->restore();

        $label = ucfirst($type);

        $itemLabel = $type === 'book' ? $item->author : $item->title;
        $itemLabel = $itemLabel ?: '#' . $item->id;

        ActivityLog::create([
            'user_id' => Auth::id(),
            'username' => Auth::user()->username,
            'role' => Auth::user()->role,
            'action' => 'Restore Deleted Item',
            'description' => "Restored {$label} '{$itemLabel}' (ID: {$item->id})",
            'ip_address' => request()->ip(),
        ]);

        $destination = match ($type) {
            'book' => 'books.index',
            'journal' => 'journals.index',
            'thesis' => 'theses.index',
        };

        return redirect()
            ->route($destination)
            ->with('success', "{$label} restored successfully and returned to its catalog section.");
    }

    public function destroy(string $type, int $id)
    {
        $model = match ($type) {
            'book' => Book::class,
            'journal' => Journal::class,
            'thesis' => Thesis::class,
            default => null,
        };

        if (! $model) {
            abort(404);
        }

        $item = $model::withTrashed()->findOrFail($id);
        $label = ucfirst($type);
        $itemLabel = $type === 'book' ? $item->author : $item->title;
        $itemLabel = $itemLabel ?: '#' . $item->id;

        ActivityLog::create([
            'user_id' => Auth::id(),
            'username' => Auth::user()->username,
            'role' => Auth::user()->role,
            'action' => 'Permanently Delete Item',
            'description' => "Permanently deleted {$label} '{$itemLabel}' (ID: {$item->id})",
            'ip_address' => request()->ip(),
        ]);

        $item->forceDelete();

        if ($type === 'book' && $item->cover_image && Storage::disk('public')->exists($item->cover_image)) {
            Storage::disk('public')->delete($item->cover_image);
        }

        return redirect()
            ->route('recently-deleted.index')
            ->with('success', "{$label} has been permanently deleted.");
    }
}