<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\DeletionRequest;
use App\Models\Journal;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JournalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin,Librarian,Working-Student')->except(['create', 'store', 'edit', 'update', 'destroy', 'show']);
        $this->middleware('role:Admin,Librarian,Working-Student')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index(Request $request)
    {
        $search = $request->get('q');
        $categoryId = $request->get('category');

        $query = Journal::with(['category', 'publisher']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('authors', 'like', "%{$search}%")
                    ->orWhere('journal_name', 'like', "%{$search}%")
                    ->orWhere('doi', 'like', "%{$search}%");
            });
        }

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $journals = $query->get();
        $categories = Category::all();

        return view('admin.journals.index', compact('journals', 'categories', 'search', 'categoryId'));
    }

    public function show($id)
    {
        $journal = Journal::with(['category', 'publisher'])->findOrFail($id);

        if (request()->query('ajax') == '1') {
            return view('admin.journals.partials.detail', compact('journal'))->render();
        }

        return view('admin.journals.show', compact('journal'));
    }

    public function create()
    {
        return view('admin.journals.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'journal_name' => 'required|string|max:255',
            'journal_name_source' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'authors' => 'nullable|string',
            'volume' => 'nullable|string|max:50',
            'issue' => 'nullable|string|max:50',
            'pages' => 'nullable|string|max:50',
            'publication_date' => 'nullable|date',
            'doi' => 'nullable|string|max:255',
            'issn' => 'nullable|string|max:20',
            'link' => 'nullable|url|max:500',
            'category_id' => 'nullable|integer',
            'publisher_id' => 'nullable|integer',
            'publisher_text' => 'nullable|string|max:255',
            'abstract' => 'nullable|string',
            'description' => 'nullable|string',
            'database_collection' => 'nullable|string|max:255',
            'availability' => 'nullable|in:Available,Unavailable,Archived',
            'subjects' => 'nullable|string|max:500',
            'keyword' => 'nullable|string|max:255',
        ]);

        $validated['source'] = $validated['journal_name_source'] ?? null;

        // journal_name_source fallback: if journal_name is empty, use journal_name_source
        if (empty($validated['journal_name']) && ! empty($validated['journal_name_source'])) {
            $validated['journal_name'] = $validated['journal_name_source'];
        }
        unset($validated['journal_name_source']);

        $validated['status'] = 'Available';

        Journal::create(array_merge($validated, ['added_by' => Auth::user()->section]));

        return redirect()->route('e-periodical.index', ['view' => 'all-journals'])->with('success', 'Journal created successfully.');
    }

    public function edit($id)
    {
        $journal = Journal::findOrFail($id);

        return view('admin.journals.edit', compact('journal'));
    }

    public function update(Request $request, $id)
    {
        $journal = Journal::findOrFail($id);
        $validated = $request->validate([
            'journal_name' => 'required|string|max:255',
            'journal_name_source' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'authors' => 'nullable|string',
            'volume' => 'nullable|string|max:50',
            'issue' => 'nullable|string|max:50',
            'pages' => 'nullable|string|max:50',
            'publication_date' => 'nullable|date',
            'doi' => 'nullable|string|max:255',
            'issn' => 'nullable|string|max:20',
            'link' => 'nullable|url|max:500',
            'category_id' => 'nullable|integer',
            'publisher_id' => 'nullable|integer',
            'publisher_text' => 'nullable|string|max:255',
            'abstract' => 'nullable|string',
            'description' => 'nullable|string',
            'status' => 'nullable|in:Available,Unavailable,Archived',
            'database_collection' => 'nullable|string|max:255',
            'availability' => 'nullable|in:Available,Unavailable,Archived',
            'subjects' => 'nullable|string|max:500',
            'keyword' => 'nullable|string|max:255',
        ]);

        $validated['source'] = $validated['journal_name_source'] ?? null;

        if (empty($validated['journal_name']) && ! empty($validated['journal_name_source'])) {
            $validated['journal_name'] = $validated['journal_name_source'];
        }
        unset($validated['journal_name_source']);

        $journal->update(array_merge($validated, ['edited_by' => Auth::user()->section]));

        return redirect()->route('e-periodical.index', ['view' => 'all-journals'])->with('success', 'Journal updated successfully.');
    }

    public function destroy($id)
    {
        if (Auth::user()->role === 'Working-Student') {
            $journal = Journal::findOrFail($id);

            $pendingRequest = DeletionRequest::where('item_type', Journal::class)
                ->where('item_id', $journal->id)
                ->where('status', 'Pending')
                ->exists();

            if ($pendingRequest) {
                return back()->with('error', 'A deletion request for this journal is already pending librarian approval.');
            }

            DeletionRequest::create([
                'user_id' => Auth::id(),
                'item_type' => Journal::class,
                'item_id' => $journal->id,
                'title' => $journal->title,
                'status' => 'Pending',
            ]);

            $staffUsers = User::whereIn('role', ['Admin', 'Librarian'])->get();
            foreach ($staffUsers as $staff) {
                Notification::create([
                    'user_id' => $staff->id,
                    'type' => 'deletion_request',
                    'title' => 'New Deletion Request',
                    'message' => Auth::user()->full_name.' (Working-Student) requested deletion of journal "'.$journal->title.'" (ID: '.$journal->id.')',
                    'sent_by' => Auth::id(),
                ]);
            }

            return back()->with('info', 'Deletion request for journal "'.$journal->title.'" has been submitted and is awaiting librarian approval.');
        }

        $journal = Journal::findOrFail($id);
        $journal->delete();

        return redirect()->route('journals.index')->with('success', 'Journal deleted successfully.');
    }
}
