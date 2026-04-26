@extends('layouts.app')

@section('title', 'Login - CLFMS')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="{{ asset('css/material-design.css') }}" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #0284c7, #0ea5e9, #10b981);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        .login-container {
            width: 100%;
            max-width: 560px;
            padding: 0 1rem;
            margin: 0 auto;
        }

        .login-card {
            background: white;
            border-radius: 28px;
            box-shadow: 0 35px 80px rgba(15, 23, 42, 0.12);
            padding: 45px 40px;
            width: 100%;
            max-width: 560px;
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -40%;
            width: 420px;
            height: 420px;
            background: radial-gradient(circle, rgba(14, 165, 233, 0.14), transparent 55%);
            border-radius: 50%;
            z-index: 0;
        }

        .login-card .form-select {
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 16 16' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M4.646 6.646a.5.5 0 0 1 .708 0L8 9.293l2.646-2.647a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 0-.708z' fill='%23343a40'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            background-size: 14px;
            padding-right: 3rem;
        }

        .auth-header-actions {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .signup-link {
            margin-top: 28px;
            text-align: center;
            color: #475569;
            font-size: 0.95rem;
        }

        .signup-link p {
            margin-bottom: 14px;
        }

        .signup-link a {
            min-width: 170px;
            color: #0ea5e9;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .signup-link a:hover {
            color: #0284c7;
            text-decoration: underline;
        }

        .login-card > * {
            position: relative;
            z-index: 1;
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-header h2 {
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 10px;
            font-size: 2rem;
            background: linear-gradient(135deg, #0ea5e9, #10b981);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .login-header p {
            color: #64748b;
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px 16px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            background-color: #ffffff;
            color: #1e293b;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        .form-select {
            width: 100%;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px 16px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            background-color: #ffffff;
            color: #1e293b;
            appearance: auto;
            -webkit-appearance: auto;
            -moz-appearance: auto;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0ea5e9;
            box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.1);
            outline: none;
        }

        .form-label {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 10px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-login {
            background: linear-gradient(135deg, #0ea5e9, #10b981);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 14px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(14, 165, 233, 0.3);
            color: white;
        }

        .signup-link {
            text-align: center;
            margin-top: 25px;
            color: #64748b;
        }

        .signup-link a {
            color: #0ea5e9;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .signup-link a:hover {
            color: #0284c7;
            text-decoration: underline;
        }

        .error-message {
            animation: slideInDown 0.4s ease;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection

@section('content')
    <div class="login-container" data-aos="fade-in" data-aos-duration="800">
        <div class="login-card">
            <div class="login-header">
                <h2 data-aos="zoom-in" data-aos-delay="100"><i class="fas fa-laptop-code me-2"></i>CLFMS</h2>
                <p data-aos="fade-up" data-aos-delay="150">Sign in to your account</p>
                <div class="auth-header-actions" data-aos="fade-up" data-aos-delay="170">
                    <a href="{{ route('welcome') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left me-2"></i>Back to Home
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-user-plus me-2"></i>Create Account
                    </a>
                </div>
            </div>

            @if($errors->any())
                <div class="alert alert-danger error-message" data-aos="fade-in">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group" data-aos="fade-up" data-aos-delay="200">
                    <label class="form-label" for="login-input">
                        <i class="fas fa-user me-2" style="color: #0ea5e9;"></i>Username or Email
                    </label>
                    <input 
                        id="login-input"
                        type="text" 
                        name="login" 
                        class="form-control" 
                        placeholder="Enter username or email"
                        required
                        autocomplete="username"
                        value="{{ old('login') }}"
                    >
                    @error('login')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group" data-aos="fade-up" data-aos-delay="250">
                    <label class="form-label" for="login-role">
                        <i class="fas fa-user-tag me-2" style="color: #0ea5e9;"></i>Login As
                    </label>
                    <select id="login-role" name="role" class="form-select" required>
                        <option value="student" {{ old('role') === 'student' ? 'selected' : '' }}>Student</option>
                        <option value="staff" {{ old('role') === 'staff' ? 'selected' : '' }}>Teacher / Staff</option>
                        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrator</option>
                    </select>
                    @error('role')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group" data-aos="fade-up" data-aos-delay="300">
                    <label class="form-label" for="login-password">
                        <i class="fas fa-lock me-2" style="color: #10b981;"></i>Password
                    </label>
                    <input 
                        id="login-password"
                        type="password" 
                        name="password" 
                        class="form-control" 
                        placeholder="Enter your password"
                        required
                        autocomplete="current-password"
                    >
                    @error('password')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button 
                    type="submit" 
                    class="btn btn-login"
                    data-aos="fade-up"
                    data-aos-delay="300"
                >
                    <i class="fas fa-sign-in-alt me-2"></i>Sign In
                </button>
            </form>

            <div class="signup-link" data-aos="fade-up" data-aos-delay="350">
                <p>Not registered yet? Create a new account now.</p>
                <a class="btn btn-primary btn-sm" href="{{ route('register') }}">
                    <i class="fas fa-user-plus me-2"></i>Sign up now
                </a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        // Initialize AOS (Animate On Scroll)
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out-quart',
                once: true,
                offset: 100
            });
        });
    </script>
@endsection

