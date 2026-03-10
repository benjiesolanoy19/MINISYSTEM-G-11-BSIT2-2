<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $loginField = $request->input('email');
        $password = $request->input('password');
        $isAdmin = $request->input('is_admin');

        // Determine if login is by email or username
        $fieldType = filter_var($loginField, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        $credentials = [
            $fieldType => $loginField,
            'password' => $password,
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // Check if admin login is required
            if ($isAdmin && !$user->isAdmin()) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'You do not have admin privileges!',
                ])->withInput();
            }

            $request->session()->regenerate();
            
            // Redirect based on role
            if ($user->isAdmin()) {
                return redirect()->intended('/admin')->with('success', 'Welcome Admin!');
            }
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials!',
        ])->withInput();
    }

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function verifyForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password_hint' => 'required|min:3|max:3',
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email not found!'])->withInput();
        }

        // Verify the last 3 digits of password
        if ($user->password_hint !== $request->input('password_hint')) {
            return back()->withErrors(['password_hint' => 'Invalid password hint!'])->withInput();
        }

        // If verified, redirect to reset password page
        return redirect()->route('password.reset', ['email' => $user->email]);
    }

    public function showResetPassword(Request $request)
    {
        $email = $request->query('email');
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            return redirect('/login')->with('error', 'Invalid reset request!');
        }
        
        return view('auth.reset-password', ['user' => $user]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found!'])->withInput();
        }

        $user->update([
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect('/login')->with('success', 'Password reset successfully! Please login with your new password.');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'student',
        ]);

        Auth::login($user);

        return redirect('/dashboard')->with('success', 'Registration successful!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
