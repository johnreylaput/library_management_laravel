<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin,Librarian,Working-Student');
    }

    public function index()
    {
        $members = Member::with('user')->get();
        return view('admin.members.index', compact('members'));
    }

    public function create()
    {
        $this->middleware('role:Admin');
        $users = User::where('role', 'Member')->whereDoesntHave('member')->get();
        return view('admin.members.create', compact('users'));
    }

    public function store(Request $request)
    {
        $this->middleware('role:Admin');
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:members,user_id',
            'member_no' => 'required|string|max:30|unique:members,member_no',
            'course' => 'nullable|string|max:100',
            'year_level' => 'nullable|string|max:20',
            'contact_number' => 'nullable|string|max:30',
            'address' => 'nullable|string',
        ]);

        Member::create($validated);

        return redirect()->route('members.index')->with('success', 'Member created successfully.');
    }

    public function show($id)
    {
        $member = Member::with('user')->findOrFail($id);
        return view('admin.members.show', compact('member'));
    }

    public function edit($id)
    {
        $this->middleware('role:Admin');
        $member = Member::with('user')->findOrFail($id);
        return view('admin.members.edit', compact('member'));
    }

    public function update(Request $request, $id)
    {
        $this->middleware('role:Admin');
        $member = Member::findOrFail($id);
        $validated = $request->validate([
            'member_no' => 'required|string|max:30|unique:members,member_no,' . $member->id,
            'course' => 'nullable|string|max:100',
            'year_level' => 'nullable|string|max:20',
            'contact_number' => 'nullable|string|max:30',
            'address' => 'nullable|string',
        ]);

        $member->update($validated);

        return redirect()->route('members.index')->with('success', 'Member updated successfully.');
    }

    public function destroy($id)
    {
        $this->middleware('role:Admin');
        $member = Member::findOrFail($id);
        $member->delete();

        return redirect()->route('members.index')->with('success', 'Member deleted successfully.');
    }
}
