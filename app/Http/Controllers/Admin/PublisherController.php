<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin,Librarian,Working-Student');
    }

    public function index()
    {
        $publishers = Publisher::all();
        return view('admin.publishers.index', compact('publishers'));
    }

    public function create()
    {
        $this->middleware('role:Admin');
        return view('admin.publishers.create');
    }

    public function store(Request $request)
    {
        $this->middleware('role:Admin');
        $validated = $request->validate([
            'publisher_name' => 'required|string|max:150',
            'address' => 'nullable|string',
            'contact_number' => 'nullable|string|max:30',
        ]);

        Publisher::create($validated);

        return redirect()->route('publishers.index')->with('success', 'Publisher created successfully.');
    }

    public function show($id)
    {
        $publisher = Publisher::findOrFail($id);
        return view('admin.publishers.show', compact('publisher'));
    }

    public function edit($id)
    {
        $this->middleware('role:Admin');
        $publisher = Publisher::findOrFail($id);
        return view('admin.publishers.edit', compact('publisher'));
    }

    public function update(Request $request, $id)
    {
        $this->middleware('role:Admin');
        $publisher = Publisher::findOrFail($id);
        $validated = $request->validate([
            'publisher_name' => 'required|string|max:150',
            'address' => 'nullable|string',
            'contact_number' => 'nullable|string|max:30',
        ]);

        $publisher->update($validated);

        return redirect()->route('publishers.index')->with('success', 'Publisher updated successfully.');
    }

    public function destroy($id)
    {
        $this->middleware('role:Admin');
        $publisher = Publisher::findOrFail($id);
        $publisher->delete();

        return redirect()->route('publishers.index')->with('success', 'Publisher deleted successfully.');
    }
}
