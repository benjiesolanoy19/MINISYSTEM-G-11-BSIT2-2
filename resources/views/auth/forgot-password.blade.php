@extends('layouts.app')

@section('title', 'Forgot Password - CLFMS')

@section('styles')
<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
  min-height: 100vh;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
  display: flex;
  flex-direction: column;
}

.bg-shapes {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
  z-index: 0;
}

.shape {
  position: absolute;
  background: rgba(255, 255, 255, 0.1);
  border-radius: 50%;
  animation: float 6s ease-in-out infinite;
}

.shape-1 { width: 300px; height: 300px; top: -100px; left: -100px; animation-delay: 0s; }
.shape-2 { width: 200px; height: 200px; bottom: -50px; right: -50px; animation-delay: 1s; }

@keyframes float {
 0%, 100% { transform: translateY(0) rotate(0deg); }
 50% { transform: translateY(-20px) rotate(10deg); }
}

.navbar {
  background: rgba(255, 255, 255, 0.1) !important;
  backdrop-filter: blur(20px);
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  padding: 15px 0;
  position: relative;
  z-index: 10;
}

.navbar-brand {
  font-size: 1.8rem;
  font-weight: 800;
  background: linear-gradient(135deg, #fff 0%, #f0f0f0 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.nav-link {
  color: rgba(255, 255, 255, 0.9) !important;
  font-weight: 500;
  padding: 8px 20px !important;
}

.btn-login-nav {
  background: white;
  color: #667eea !important;
  padding: 8px 24px;
  border-radius: 25px;
  font-weight: 600;
}

.forgot-container {
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 40px 20px;
  position: relative;
  z-index: 1;
}

.forgot-card {
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(20px);
  border-radius: 24px;
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
  padding: 50px 40px;
  width: 100%;
  max-width: 440px;
  animation: fadeInUp 0.6s ease;
}

@keyframes fadeInUp {
  from { opacity: 0; transform: translateY(30px); }
  to { opacity: 1; transform: translateY(0); }
}

.forgot-header {
  text-align: center;
  margin-bottom: 35px;
}

.forgot-header .icon {
  width: 70px;
  height: 70px;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  border-radius: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 20px;
  box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
}

.forgot-header .icon i { font-size: 30px; color: white; }
.forgot-header h2 { font-size: 28px; font-weight: 700; color: #1f2937; margin-bottom: 8px; }
.forgot-header p { color: #6b7280; font-size: 14px; }

.form-group { margin-bottom: 20px; }

.form-label {
  display: block;
  font-weight: 600;
  font-size: 13px;
  color: #374151;
  margin-bottom: 8px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.form-control {
  width: 100%;
  padding: 14px 18px;
  border: 2px solid #e5e7eb;
  border-radius: 12px;
  font-size: 15px;
  font-family: inherit;
  transition: all 0.3s ease;
  background: #f9fafb;
}

.form-control:focus {
  outline: none;
  border-color: #667eea;
  background: white;
  box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
}

.btn-submit {
  width: 100%;
  padding: 16px;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  border: none;
  border-radius: 12px;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
}

.btn-submit:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
}

.alert-custom {
  padding: 14px 18px;
  border-radius: 12px;
  margin-bottom: 20px;
  font-size: 14px;
}

.alert-danger {
  background: rgba(239, 68, 68, 0.1);
  color: #dc2626;
  border: 1px solid rgba(239, 68, 68, 0.2);
}

.alert-success {
  background: rgba(16, 185, 129, 0.1);
  color: #059669;
  border: 1px solid rgba(16, 185, 129, 0.2);
}

.forgot-links {
  text-align: center;
  margin-top: 25px;
}

.forgot-links a {
  color: #667eea;
  text-decoration: none;
  font-weight: 600;
  font-size: 14px;
}

.auth-footer {
  text-align: center;
  padding: 20px;
  color: rgba(255, 255, 255, 0.7);
  font-size: 14px;
  position: relative;
  z-index: 1;
}

.input-group {
  position: relative;
}

.input-group i {
  position: absolute;
  left: 16px;
  top: 50%;
  transform: translateY(-50%);
  color: #9ca3af;
  font-size: 18px;
}

.input-group .form-control { padding-left: 48px; }
</style>
@endsection

@section('content')
<div class="bg-shapes">
  <div class="shape shape-1"></div>
  <div class="shape shape-2"></div>
</div>

<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">CLFMS</a>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav align-items-center">
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}" class="btn-login-nav">Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="forgot-container">
  <div class="forgot-card">
    <div class="forgot-header">
      <div class="icon"><i class="fas fa-key"></i></div>
      <h2>Forgot Password?</h2>
      <p>Enter your email and last 3 digits of your password</p>
    </div>

    @if($errors->any())
      <div class="alert-custom alert-danger">
        <i class="fas fa-exclamation-circle"></i>
        @foreach($errors->all() as $error){{ $error }}@endforeach
      </div>
    @endif

    @if(session('error'))
      <div class="alert-custom alert-danger"><i class="fas fa-exclamation-circle"></i>{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('password.verify') }}">
      @csrf
      <div class="form-group">
        <label class="form-label">Email Address</label>
        <div class="input-group">
          <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
          <i class="fas fa-envelope"></i>
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">Password Hint (Last 3 Digits)</label>
        <div class="input-group">
          <input type="text" name="password_hint" class="form-control" placeholder="e.g. 606" maxlength="3" required>
          <i class="fas fa-lock"></i>
        </div>
      </div>
      <button type="submit" class="btn-submit"><i class="fas fa-check me-2"></i>Verify</button>
    </form>

    <div class="forgot-links">
      <p style="color: #6b7280; font-size: 14px;">Remember your password? <a href="{{ route('login') }}">Sign in</a></p>
    </div>
  </div>
</div>

<footer class="auth-footer">
  <p>© 2026 CLFMS | Computer Laboratory Facilities Management System</p>
</footer>
@endsection

