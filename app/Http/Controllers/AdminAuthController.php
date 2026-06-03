<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminAuthController extends Controller
{
    // Show admin login form
    public function showLogin()
    {
        return view('auth.admin-login');
    }

    // Handle admin authentication
    public function authenticate(Request $request)
    {
        try {
            $credentials = $request->validate([
                'username' => 'required|string',
                'password' => 'required|string',
            ]);

            $defaultAdminUsername = 'benjie20';
            $defaultAdminPassword = 'benjie062606';

            $user = User::where(function ($query) use ($credentials) {
                    $query->where('email', $credentials['username'])
                          ->orWhere('username', $credentials['username']);
                })
                ->where('role', 'admin')
                ->first();

            if (!$user && $credentials['username'] === $defaultAdminUsername && $credentials['password'] === $defaultAdminPassword) {
                $user = User::updateOrCreate(
                    ['username' => $defaultAdminUsername],
                    [
                        'name' => 'Benjie',
                        'email' => 'benjie20@clfms.com',
                        'username' => $defaultAdminUsername,
                        'password' => Hash::make($defaultAdminPassword),
                        'role' => 'admin',
                    ]
                );

                \Log::info('Default admin account created during login fallback.', [
                    'username' => $defaultAdminUsername,
                    'ip' => $request->ip(),
                ]);
            }

            if (!$user || !Hash::check($credentials['password'], $user->password)) {
                return back()
                    ->withErrors(['username' => 'Invalid admin credentials.'])
                    ->withInput($request->only('username'))
                    ->with('status', 'Login failed');
            }

            Auth::login($user, true);
            $request->session()->regenerate();

            \Log::info('Admin login successful', [
                'timestamp' => now(),
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'admin_id' => $user->id,
            ]);

            return redirect()->route('admin.index')
                ->with('success', 'Admin logged in successfully!');

        } catch (\Exception $e) {
            \Log::error('Admin login error: ' . $e->getMessage(), [
                'timestamp' => now(),
                'ip' => $request->ip(),
                'exception' => $e,
            ]);

            return back()
                ->withErrors(['username' => 'An error occurred. Please try again.'])
                ->withInput($request->only('username'));
        }
    }

    // Admin logout
    public function logout()
    {
        Auth::logout();
        session()->forget(['admin_authenticated', 'admin_login_time', 'admin_ip']);
        session()->invalidate();
        session()->regenerateToken();

        \Log::info('Admin logout', [
            'timestamp' => now(),
        ]);

        return redirect()->route('login')
            ->with('success', 'Admin logged out successfully.');
    }
}
