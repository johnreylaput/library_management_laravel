<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('e-periodical.index');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('username', $credentials['username'])->first();

        $authenticated = false;

        if ($user && $user->password === $credentials['password']) {
            $user->update(['password' => bcrypt($credentials['password'])]);
            Auth::login($user);
            $authenticated = true;
        } elseif (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            $authenticated = true;
        }

        if ($authenticated) {
            $request->session()->regenerate();

            ActivityLog::create([
                'user_id' => Auth::id(),
                'username' => $this->formatActivityUsername(Auth::user()),
                'role' => Auth::user()->role,
                'action' => 'Login',
                'description' => 'Logged in successfully',
                'ip_address' => $request->ip(),
            ]);

            return redirect()->route('e-periodical.index');
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
            'username' => ['required', 'string', 'max:50', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'course' => ['nullable', 'string', 'max:100'],
            'year_level' => ['nullable', 'string', 'max:50'],
            'contact_number' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);

        if ($validated['username'] !== 'Work.stud') {
            return back()->withErrors([
                'username' => 'Only Work.stud is allowed to register.',
            ])->withInput();
        }

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

    public function redirectToGoogle()
    {
        try {
            return Socialite::driver('google')->redirect();
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Google login is not configured. Please contact the administrator.');
        }
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Google login failed. Please try again.');
        }

        $user = User::where('google_id', $googleUser->getId())->first();

        if (!$user) {
            $existingUser = User::where('email', $googleUser->getEmail())->first();

            if ($existingUser) {
                $existingUser->update([
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                ]);
                $user = $existingUser;
            } else {
                $username = explode('@', $googleUser->getEmail())[0];
                if ($username !== 'Work.stud') {
                    return redirect('/login')->with('error', 'Only Work.stud is allowed to log in via Google.');
                }

                $user = User::create([
                    'full_name' => $googleUser->getName(),
                    'username' => $username,
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt(uniqid()),
                    'role' => 'Member',
                    'status' => 'Active',
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                ]);

                Member::create([
                    'user_id' => $user->id,
                    'member_no' => 'MEM-' . str_pad($user->id, 6, '0', STR_PAD_LEFT),
                ]);

                $request->session()->put('welcome_type', 'new');
            }
        }

        Auth::login($user, true);

        ActivityLog::create([
            'user_id' => $user->id,
            'username' => $this->formatActivityUsername($user),
            'role' => $user->role,
            'action' => 'Login',
            'description' => 'Logged in via Google',
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
