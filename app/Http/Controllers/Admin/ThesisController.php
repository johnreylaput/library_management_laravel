<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use App\Models\User;
use App\Models\DeletionRequest;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThesisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin,Librarian,Working.Student');
    }

    public function index(Request $request)
    {
        $search = $request->get('q');

        $query = Thesis::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('author', 'like', "%{$search}%")
                  ->orWhere('research', 'like', "%{$search}%")
                  ->orWhere('subjects_keywords', 'like', "%{$search}%");
            });
        }

        $theses = $query->get();

        return view('admin.theses.index', compact('theses', 'search'));
    }

    public function show($id)
    {
        $thesis = Thesis::findOrFail($id);

        if (request()->query('ajax') == '1') {
            return view('admin.theses.partials.detail', compact('thesis'))->render();
        }

        return view('admin.theses.show', compact('thesis'));
    }

    public function create()
    {
        return view('admin.theses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'author' => 'required|string|max:255',
            'research' => 'required|in:Thesis,Capstone,Feasibility Study,Marketing Research,Undergraduate Thesis,Masteral Thesis,Doctoral Thesis,University Research',
            'date_published' => 'required|date',
            'subjects_keywords' => 'required|string|max:500',
            'summary' => 'required|string',
        ]);

        $validated['status'] = 'Available';

        Thesis::create(array_merge($validated, ['added_by' => Auth::user()->section]));

        return redirect()->route('theses.index')->with('success', 'Thesis created successfully.');
    }

    public function edit($id)
    {
        $thesis = Thesis::findOrFail($id);
        return view('admin.theses.edit', compact('thesis'));
    }

    public function update(Request $request, $id)
    {
        $thesis = Thesis::findOrFail($id);

        $validated = $request->validate([
            'author' => 'required|string|max:255',
            'research' => 'required|in:Thesis,Capstone,Feasibility Study,Marketing Research,Undergraduate Thesis,Masteral Thesis,Doctoral Thesis,University Research',
            'date_published' => 'required|date',
            'subjects_keywords' => 'required|string|max:500',
            'summary' => 'required|string',
        ]);

        $thesis->update(array_merge($validated, ['edited_by' => Auth::user()->full_name . ' (' . Auth::user()->role . ')']));

        return redirect()->route('theses.index')->with('success', 'Thesis updated successfully.');
    }

    public function destroy($id)
    {
        if (Auth::user()->role === 'Working.Student') {
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
                'title' => $thesis->author . ' - ' . $thesis->research,
                'status' => 'Pending',
            ]);

            $librarians = User::where('role', 'Librarian')->get();

            foreach ($librarians as $librarian) {
                Notification::create([
                    'user_id' => $librarian->id,
                    'type' => 'deletion_request',
                    'title' => 'New Deletion Request',
                    'message' => Auth::user()->full_name . ' (Working.Student) requested deletion of thesis "' . $thesis->author . ' - ' . $thesis->research . '" (ID: ' . $thesis->id . ')',
                    'sent_by' => Auth::id(),
                ]);
            }

            return back()->with('info', 'Deletion request for thesis "' . $thesis->author . ' - ' . $thesis->research . '" has been submitted for librarian review.');
        }

        $thesis = Thesis::findOrFail($id);
        $thesis->delete();

        return redirect()->route('theses.index')->with('success', 'Thesis moved to Recently Deleted successfully.');
    }
}
