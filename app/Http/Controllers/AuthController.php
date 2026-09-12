<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display the login page.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    /**
     * Handle user login.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where(
            'username',
            $credentials['username']
        )->first();

        if (
            ! $user ||
            ! Hash::check(
                $credentials['password'],
                $user->password
            )
        ) {
            return back()
                ->withErrors([
                    'username' => 'Invalid username or password.',
                ])
                ->withInput();
        }

        if ($user->status !== 'Active') {
            return back()
                ->withErrors([
                    'username' => 'Your account is not active. Please contact the administrator.',
                ])
                ->withInput();
        }

        Auth::login($user);

        $request->session()->regenerate();

        ActivityLog::create([
            'user_id' => $user->id,
            'username' => $this->formatActivityUsername($user),
            'role' => $user->role,
            'action' => 'Login',
            'description' => 'Logged in successfully',
            'ip_address' => $request->ip(),
            'session_id' => $request->session()->getId(),
        ]);

        return redirect()->route('dashboard');
    }

    /**
     * Display the registration page.
     */
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.register');
    }

    /**
     * Register a new user.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:150'],

            'email' => [
                'required',
                'string',
                'email',
                'max:100',
                'unique:users,email',
            ],

            'username' => [
                'required',
                'string',
                'max:50',
                'unique:users,username',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        DB::transaction(function () use ($validated, $request, &$user) {

            $user = User::create([
                'full_name' => $validated['full_name'],
                'username' => $validated['username'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'Member',
                'status' => 'Active',
            ]);

            Member::create([
                'user_id' => $user->id,
                'member_no' => 'MEM-' . str_pad($user->id, 6, '0', STR_PAD_LEFT),
            ]);

            ActivityLog::create([
                'user_id' => $user->id,
                'username' => $this->formatActivityUsername($user),
                'role' => $user->role,
                'action' => 'Register',
                'description' => 'Registered new account',
                'ip_address' => $request->ip(),
            ]);
        });

        Auth::login($user);

        $request->session()->regenerate();

        $request->session()->put('welcome_type', 'new');

        return redirect()->route('e-periodical.index');
    }

    /**
     * Handle user logout.
     */
    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            ActivityLog::create([
                'user_id' => $user->id,
                'username' => $this->formatActivityUsername($user),
                'role' => $user->role,
                'action' => 'Logout',
                'description' => 'Logged out successfully',
                'ip_address' => $request->ip(),
                'session_id' => $request->session()->getId(),
            ]);
        }

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('landing');
    }

    /**
     * Format the username for the activity log.
     */
    private function formatActivityUsername(User $user): string
    {
        if (! empty($user->section)) {
            return $user->username . '-' . $user->section;
        }

        return $user->username;
    }
}