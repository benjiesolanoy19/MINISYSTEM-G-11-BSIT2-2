<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show welcome page
    public function welcome()
    {
        return view('welcome');
    }

    // Show login form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'login' => 'required|string',
                'password' => 'required|string'
            ]);

            // Find user by email or username
            $user = User::where('email', $credentials['login'])
                ->orWhere('username', $credentials['login'])
                ->first();

            // Verify password
            if (!$user || !Hash::check($credentials['password'], $user->password)) {
                return back()
                    ->withErrors(['email' => 'Invalid credentials.'])
                    ->onlyInput('login')
                    ->with('status', 'Login failed');
            }

            // Log the user in
            Auth::login($user, true);
            $request->session()->regenerate();

            // Redirect to dashboard
            return redirect()->route('dashboard')
                ->with('success', 'Logged in successfully!');

        } catch (\Exception $e) {
            \Log::error('Login error: ' . $e->getMessage());
            return back()
                ->withErrors(['email' => 'An error occurred. Please try again.'])
                ->onlyInput('login');
        }
    }

    // Show register form
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:50|unique:users|alpha_dash',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6'
            ]);

            $user = User::create([
                'name' => $validated['name'],
                'username' => $validated['username'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'student'
            ]);

            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->route('dashboard')
                ->with('success', 'Account created and logged in successfully!');

        } catch (\Exception $e) {
            \Log::error('Register error: ' . $e->getMessage());
            return back()
                ->withErrors(['email' => 'Registration failed. Please try again.'])
                ->withInput();
        }
    }


    // Handle logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
