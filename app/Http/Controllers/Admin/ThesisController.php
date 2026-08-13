<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use App\Models\Category;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\DeletionRequest;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThesisController extends Controller
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

        $query = Thesis::with(['category', 'author', 'publisher']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('authors', 'like', "%{$search}%")
                  ->orWhere('institution', 'like', "%{$search}%");
            });
        }

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $theses = $query->get();
        $categories = Category::all();

        return view('admin.theses.index', compact('theses', 'categories', 'search', 'categoryId'));
    }

    public function show($id)
    {
        $thesis = Thesis::with(['category', 'author', 'publisher'])->findOrFail($id);

        if (request()->query('ajax') == '1') {
            return view('admin.theses.partials.detail', compact('thesis'))->render();
        }

        return view('admin.theses.show', compact('thesis'));
    }

    public function create()
    {
        $categories = Category::all();
        $authors = \App\Models\Author::all();
        $publishers = \App\Models\Publisher::all();
        return view('admin.theses.create', compact('categories', 'authors', 'publishers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'authors' => 'nullable|string',
            'thesis_type' => 'nullable|string|max:100',
            'institution' => 'nullable|string|max:255',
            'year' => 'nullable|digits:4|integer',
            'pages' => 'nullable|string|max:50',
            'category_id' => 'nullable|exists:categories,id',
            'author_id' => 'nullable|exists:authors,id',
            'publisher_id' => 'nullable|exists:publishers,id',
            'link' => 'nullable|url|max:500',
            'abstract' => 'nullable|string',
            'description' => 'nullable|string',
            'database_collection' => 'nullable|string|max:255',
            'availability' => 'nullable|in:Available,Unavailable,Archived',
            'subjects' => 'nullable|string|max:500',
        ]);

        $validated['status'] = 'Available';

        Thesis::create(array_merge($validated, ['added_by' => Auth::user()->section]));

        return redirect()->route('theses.index')->with('success', 'Thesis created successfully.');
    }

    public function edit($id)
    {
        $thesis = Thesis::findOrFail($id);
        $categories = Category::all();
        $authors = \App\Models\Author::all();
        $publishers = \App\Models\Publisher::all();
        return view('admin.theses.edit', compact('thesis', 'categories', 'authors', 'publishers'));
    }

    public function update(Request $request, $id)
    {
        $thesis = Thesis::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'authors' => 'nullable|string',
            'thesis_type' => 'nullable|string|max:100',
            'institution' => 'nullable|string|max:255',
            'year' => 'nullable|digits:4|integer',
            'pages' => 'nullable|string|max:50',
            'category_id' => 'nullable|exists:categories,id',
            'author_id' => 'nullable|exists:authors,id',
            'publisher_id' => 'nullable|exists:publishers,id',
            'link' => 'nullable|url|max:500',
            'abstract' => 'nullable|string',
            'description' => 'nullable|string',
            'status' => 'nullable|in:Available,Unavailable,Archived',
            'database_collection' => 'nullable|string|max:255',
            'availability' => 'nullable|in:Available,Unavailable,Archived',
            'subjects' => 'nullable|string|max:500',
        ]);

        $thesis->update(array_merge($validated, ['edited_by' => Auth::user()->section]));

        return redirect()->route('theses.index')->with('success', 'Thesis updated successfully.');
    }

    public function destroy($id)
    {
        if (Auth::user()->role === 'Working-Student') {
            $thesis = Thesis::findOrFail($id);

            $pendingRequest = DeletionRequest::where('item_type', Thesis::class)
                ->where('item_id', $thesis->id)
                ->where('status', 'Pending')
                ->exists();

            if ($pendingRequest) {
                return back()->with('error', 'A deletion request for this thesis is already pending librarian approval.');
            }

            DeletionRequest::create([
                'user_id' => Auth::id(),
                'item_type' => Thesis::class,
                'item_id' => $thesis->id,
                'title' => $thesis->title,
                'status' => 'Pending',
            ]);

            $staffUsers = User::whereIn('role', ['Admin', 'Librarian'])->get();
            foreach ($staffUsers as $staff) {
                Notification::create([
                    'user_id' => $staff->id,
                    'type' => 'deletion_request',
                    'title' => 'New Deletion Request',
                    'message' => Auth::user()->full_name . ' (Working-Student) requested deletion of thesis "' . $thesis->title . '" (ID: ' . $thesis->id . ')',
                    'sent_by' => Auth::id(),
                ]);
            }

            return back()->with('info', 'Deletion request for thesis "' . $thesis->title . '" has been submitted and is awaiting librarian approval.');
        }

        $thesis = Thesis::findOrFail($id);
        $thesis->delete();

        return redirect()->route('theses.index')->with('success', 'Thesis deleted successfully.');
    }
}
