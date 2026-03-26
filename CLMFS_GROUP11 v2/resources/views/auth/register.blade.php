@extends('layouts.app')

@section('title', 'Register - CLFMS')

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

        .register-container {
            width: 100%;
            max-width: 500px;
        }

        .register-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
            padding: 50px;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        .register-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 500px;
            height: 500px;
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.1), rgba(16, 185, 129, 0.05));
            border-radius: 50%;
            z-index: 0;
        }

        .register-card > * {
            position: relative;
            z-index: 1;
        }

        .register-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .register-header h2 {
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 10px;
            font-size: 2rem;
            background: linear-gradient(135deg, #0ea5e9, #10b981);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .register-header p {
            color: #64748b;
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 14px 16px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .form-control:focus {
            border-color: #0ea5e9;
            box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.1);
        }

        .form-label {
            font-weight: 500;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .btn-register {
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

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(14, 165, 233, 0.3);
            color: white;
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            color: #64748b;
        }

        .login-link a {
            color: #0ea5e9;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
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
    <div class="register-container" data-aos="fade-in" data-aos-duration="800">
        <div class="register-card">
            <div class="register-header">
                <h2 data-aos="zoom-in" data-aos-delay="100"><i class="fas fa-laptop-code me-2"></i>Create Account</h2>
                <p data-aos="fade-up" data-aos-delay="150">Join CLFMS today</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger error-message" data-aos="fade-in">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group" data-aos="fade-up" data-aos-delay="200">
                    <label class="form-label">
                        <i class="fas fa-user me-2" style="color: #0ea5e9;"></i>Full Name
                    </label>
                    <input 
                        type="text" 
                        name="name" 
                        class="form-control" 
                        placeholder="Enter your full name"
                        required
                    >
                </div>

                <div class="form-group" data-aos="fade-up" data-aos-delay="250">
                    <label class="form-label">
                        <i class="fas fa-at me-2" style="color: #10b981;"></i>Username
                    </label>
                    <input 
                        type="text" 
                        name="username" 
                        class="form-control" 
                        placeholder="Enter username"
                        required
                    >
                </div>

                <div class="form-group" data-aos="fade-up" data-aos-delay="300">
                    <label class="form-label">
                        <i class="fas fa-envelope me-2" style="color: #0ea5e9;"></i>Email Address
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        class="form-control" 
                        placeholder="Enter your email"
                        required
                    >
                </div>

                <div class="form-group" data-aos="fade-up" data-aos-delay="350">
                    <label class="form-label">
                        <i class="fas fa-lock me-2" style="color: #10b981;"></i>Password
                    </label>
                    <input 
                        type="password" 
                        name="password" 
                        class="form-control" 
                        placeholder="Create a password"
                        required
                    >
                </div>

                <button 
                    type="submit" 
                    class="btn btn-register"
                    data-aos="fade-up"
                    data-aos-delay="400"
                >
                    <i class="fas fa-user-plus me-2"></i>Create Account
                </button>
            </form>

            <div class="login-link" data-aos="fade-up" data-aos-delay="450">
                <p>Already have an account? <a href="{{ route('login') }}">Sign in here</a></p>
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

