<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  public function login(Request $request)
{
    $credentials = $request->validate([
        'username' => ['required', 'string'],
        'password' => ['required', 'string'],
    ]);

    $user = User::where('username', $credentials['username'])->first();

    if ($user && Hash::check($credentials['password'], $user->password)) {
        Auth::login($user);

        $request->session()->regenerate();

        return redirect('/');
    }

    return back()->withErrors([
        'username' => 'Invalid username or password.',
    ]);
}
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'course' => ['nullable', 'string', 'max:100'],
            'year_level' => ['nullable', 'string', 'max:50'],
            'contact_number' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);

        $user = User::create([
            'full_name' => $validated['full_name'],
            'username' => explode('@', $validated['email'])[0],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'Member',
            'status' => 'Active',
        ]);

        Member::create([
            'user_id' => $user->id,
            'member_no' => 'MEM-' . str_pad($user->id, 6, '0', STR_PAD_LEFT),
            'course' => $validated['course'],
            'year_level' => $validated['year_level'],
            'contact_number' => $validated['contact_number'],
            'address' => $validated['address'],
        ]);

        Auth::login($user);

        $request->session()->put('welcome_type', 'new');

        ActivityLog::create([
            'user_id' => $user->id,
            'username' => $this->formatActivityUsername($user),
            'role' => $user->role,
            'action' => 'Register',
            'description' => 'Registered new account',
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('e-periodical.index');
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            ActivityLog::create([
                'user_id' => $user->id,
                'username' => $this->formatActivityUsername($user),
                'role' => $user->role,
                'action' => 'Logout',
                'description' => 'Logged out',
                'ip_address' => $request->ip(),
            ]);
        }
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    private function formatActivityUsername(User $user): string
    {
        return $user->section ? $user->username . '-' . $user->section : $user->username;
    }
}
