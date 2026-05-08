@extends('layouts.app')

@section('title', 'Register - ICTFE')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 800"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(255,255,255,0.08)" stroke-width="1"/></pattern></defs><rect width="1200" height="800" fill="url(%23grid)"/></svg>');
            pointer-events: none;
            z-index: 0;
        }

        .register-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            padding: 20px;
        }

        .register-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            min-height: 700px;
        }

        .register-left {
            background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%);
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .register-left::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 500px;
            height: 500px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .register-left-content {
            position: relative;
            z-index: 1;
        }

        .logo-section {
            margin-bottom: 50px;
        }

        .logo-icon {
            font-size: 48px;
            margin-bottom: 20px;
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            width: 70px;
            height: 70px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-text h3 {
            font-size: 32px;
            font-weight: 700;
            margin: 0;
            letter-spacing: -0.5px;
        }

        .logo-text p {
            font-size: 14px;
            margin: 8px 0 0 0;
            opacity: 0.8;
        }

        .benefits-list {
            list-style: none;
            margin-top: 40px;
        }

        .benefits-list li {
            margin-bottom: 24px;
            display: flex;
            align-items: flex-start;
            gap: 15px;
            font-size: 15px;
        }

        .benefits-list .icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 18px;
        }

        .benefits-list .text {
            flex: 1;
        }

        .benefits-list .title {
            font-weight: 600;
            display: block;
            margin-bottom: 4px;
        }

        .benefits-list .desc {
            font-size: 13px;
            opacity: 0.8;
        }

        .register-right {
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow-y: auto;
            max-height: 700px;
        }

        .register-right::-webkit-scrollbar {
            width: 6px;
        }

        .register-right::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .register-right::-webkit-scrollbar-thumb {
            background: #0ea5e9;
            border-radius: 10px;
        }

        .register-header {
            margin-bottom: 30px;
        }

        .register-header h2 {
            font-size: 32px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 12px;
            letter-spacing: -0.5px;
        }

        .register-header p {
            color: #64748b;
            font-size: 15px;
            margin: 0;
        }

        .form-section {
            width: 100%;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-group label i {
            color: #0ea5e9;
            font-size: 16px;
        }

        .form-control,
        .form-select {
            width: 100%;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 14px;
            color: #1e293b;
            background: #f8fafc;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .form-control::placeholder {
            color: #94a3b8;
        }

        .form-control:focus,
        .form-select:focus {
            outline: none;
            border-color: #0ea5e9;
            background: white;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.12);
        }

        .form-control:hover,
        .form-select:hover {
            border-color: #cbd5e1;
        }

        .form-select {
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%230ea5e9' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 18px;
            padding-right: 40px;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        .btn-register {
            background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 14px 24px;
            font-size: 15px;
            font-weight: 600;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 8px;
            box-shadow: 0 4px 15px rgba(14, 165, 233, 0.3);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(14, 165, 233, 0.4);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .error-alert {
            background: #fee2e2;
            border: 2px solid #fecaca;
            border-radius: 10px;
            padding: 14px 16px;
            margin-bottom: 20px;
            color: #991b1b;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideInDown 0.4s ease;
        }

        .error-alert i {
            font-size: 16px;
            flex-shrink: 0;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-error {
            color: #dc2626;
            font-size: 12px;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
        }


        .login-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            color: #64748b;
            font-size: 14px;
        }

        .login-link a {
            color: #0ea5e9;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .login-link a:hover {
            color: #0284c7;
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .register-container {
                grid-template-columns: 1fr;
                min-height: auto;
            }

            .register-left {
                padding: 40px 30px;
                min-height: 300px;
            }

            .register-right {
                padding: 40px 30px;
                max-height: none;
            }

            .logo-text h3 {
                font-size: 24px;
            }

            .register-header h2 {
                font-size: 24px;
            }

            .benefits-list {
                display: none;
            }
        }
    </style>
@endsection

@section('content')
    <div class="register-wrapper" data-aos="fade-in" data-aos-duration="1000">
        <div class="register-container">
            <!-- Left Side - Branding -->
            <div class="register-left" data-aos="fade-right" data-aos-duration="1000">
                <div class="register-left-content">
                    <div class="logo-section">
                        <div class="logo-icon">
                            <i class="fas fa-flask-vial"></i>
                        </div>
                        <div class="logo-text">
                            <h3>ICTFE</h3>
                            <p>ICT Facilities and Equipment</p>
                        </div>
                    </div>

                    <ul class="benefits-list">
                        <li data-aos="fade-up" data-aos-delay="100">
                            <div class="icon">
                                <i class="fas fa-rocket"></i>
                            </div>
                            <div class="text">
                                <span class="title">Get Started Fast</span>
                                <span class="desc">Create account in just 2 minutes</span>
                            </div>
                        </li>
                        <li data-aos="fade-up" data-aos-delay="200">
                            <div class="icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div class="text">
                                <span class="title">Secure & Safe</span>
                                <span class="desc">Your data is protected with industry standards</span>
                            </div>
                        </li>
                        <li data-aos="fade-up" data-aos-delay="300">
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="text">
                                <span class="title">Join Community</span>
                                <span class="desc">Connect with students, teachers, and staff</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Right Side - Register Form -->
            <div class="register-right" data-aos="fade-left" data-aos-duration="1000">
                <div class="register-header">
                    <h2>Create Account</h2>
                    <p>Join ICTFE and manage facilities efficiently</p>
                </div>

                @if($errors->any())
                    <div class="error-alert" data-aos="fade-in">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="form-section">
                    @csrf

                    <div class="form-group" data-aos="fade-up" data-aos-delay="100">
                        <label for="register-name">
                            <i class="fas fa-user"></i> Full Name
                        </label>
                        <input 
                            id="register-name"
                            type="text" 
                            name="name" 
                            class="form-control" 
                            placeholder="Enter your full name"
                            required
                            value="{{ old('name') }}"
                        >
                        @error('name')
                            <div class="form-error"><i class="fas fa-times-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group" data-aos="fade-up" data-aos-delay="150">
                        <label for="register-username">
                            <i class="fas fa-at"></i> Username
                        </label>
                        <input 
                            id="register-username"
                            type="text" 
                            name="username" 
                            class="form-control" 
                            placeholder="Choose a unique username"
                            required
                            value="{{ old('username') }}"
                        >
                        @error('username')
                            <div class="form-error"><i class="fas fa-times-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group" data-aos="fade-up" data-aos-delay="200">
                        <label for="register-email">
                            <i class="fas fa-envelope"></i> Email Address
                        </label>
                        <input 
                            id="register-email"
                            type="email" 
                            name="email" 
                            class="form-control" 
                            placeholder="Enter your email address"
                            required
                            value="{{ old('email') }}"
                        >
                        @error('email')
                            <div class="form-error"><i class="fas fa-times-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group" data-aos="fade-up" data-aos-delay="250">
                        <label for="register-role">
                            <i class="fas fa-user-tag"></i> Account Type
                        </label>
                        <select id="register-role" name="role" class="form-select" required>
                            <option value="">Select your account type</option>
                            <option value="student" {{ old('role') === 'student' ? 'selected' : '' }}>Student</option>
                            <option value="staff" {{ old('role') === 'staff' ? 'selected' : '' }}>Teacher / Staff</option>
                        </select>
                        @error('role')
                            <div class="form-error"><i class="fas fa-times-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group" data-aos="fade-up" data-aos-delay="300">
                        <label for="register-password">
                            <i class="fas fa-lock"></i> Password
                        </label>
                        <input 
                            id="register-password"
                            type="password" 
                            name="password" 
                            class="form-control" 
                            placeholder="Create a strong password"
                            required
                            autocomplete="new-password"
                        >
                        @error('password')
                            <div class="form-error"><i class="fas fa-times-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <button 
                        type="submit" 
                        class="btn-register"
                        data-aos="fade-up"
                        data-aos-delay="350"
                    >
                        <i class="fas fa-user-plus"></i> Create Account
                    </button>
                </form>

                <div class="login-link" data-aos="fade-up" data-aos-delay="400">
                    <p>Already have an account? <a href="{{ route('login') }}">Sign in here</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
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