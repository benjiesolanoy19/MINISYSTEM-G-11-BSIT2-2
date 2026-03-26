@extends('layouts.dashboard')

@section('title', 'My Profile')

@section('styles')
<style>
.password-input-group {
  position: relative;
}

.password-input-group .form-control {
  padding-right: 48px;
}

.password-input-group i {
  position: absolute;
  left: 14px;
  top: 50%;
  transform: translateY(-50%);
  color: #9ca3af;
}

.password-toggle {
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-50%);
  background: none;
  border: none;
  color: #9ca3af;
  cursor: pointer;
  padding: 5px;
}

.password-toggle:hover {
  color: #0ea5e9;
}

.card {
  border: none;
  border-radius: 16px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.card:hover {
  transform: none;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.card-header {
  background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%);
  color: #fff;
  font-weight: 600;
  border-radius: 16px 16px 0 0 !important;
  padding: 15px 20px;
}

.form-label {
  font-weight: 600;
  color: #374151;
  margin-bottom: 8px;
}

.form-control {
  border: 2px solid #e5e7eb;
  border-radius: 10px;
  padding: 12px 16px;
}

.form-control:focus {
  border-color: #0ea5e9;
  box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.1);
}

.btn-primary {
  background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%);
  border: none;
  padding: 12px 24px;
  border-radius: 10px;
  font-weight: 600;
}

.btn-primary:hover {
  background: linear-gradient(135deg, #0284c7 0%, #059669 100%);
}
</style>
@endsection

@section('content')
<div class="container-fluid">
  <h2 class="mb-4">My Profile</h2>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="row">
    <div class="col-md-6">
      <div class="card mb-4">
        <div class="card-header">
          <i class="fa-solid fa-user me-2"></i> Profile Information
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
              <label for="name" class="form-label">Full Name</label>
              <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
            </div>
            
            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
            </div>
            
            <div class="mb-3">
              <label class="form-label">Role</label>
              <input type="text" class="form-control" value="{{ ucfirst($user->role) }}" readonly>
            </div>
            
            <button type="submit" class="btn btn-primary">Update Profile</button>
          </form>
        </div>
    </div>

    <div class="col-md-6">
      <div class="card mb-4">
        <div class="card-header">
          <i class="fa-solid fa-lock me-2"></i> Change Password
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('profile.password') }}">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
              <label for="current_password" class="form-label">Current Password</label>
              <div class="password-input-group">
                <input type="password" name="current_password" id="current_password" class="form-control" required>
                <i class="fa-solid fa-lock"></i>
                <button type="button" class="password-toggle" onclick="togglePassword('current_password', 'toggleIcon1')">
                  <i class="fa-solid fa-eye" id="toggleIcon1"></i>
                </button>
              </div>
            
            <div class="mb-3">
              <label for="password" class="form-label">New Password</label>
              <div class="password-input-group">
                <input type="password" name="password" id="password" class="form-control" required>
                <i class="fa-solid fa-lock"></i>
                <button type="button" class="password-toggle" onclick="togglePassword('password', 'toggleIcon2')">
                  <i class="fa-solid fa-eye" id="toggleIcon2"></i>
                </button>
              </div>
            
            <div class="mb-3">
              <label for="password_confirmation" class="form-label">Confirm New Password</label>
              <div class="password-input-group">
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                <i class="fa-solid fa-lock"></i>
                <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', 'toggleIcon3')">
                  <i class="fa-solid fa-eye" id="toggleIcon3"></i>
                </button>
              </div>
            
            <button type="submit" class="btn btn-primary">Change Password</button>
          </form>
        </div>
    </div>
</div>

<script>
function togglePassword(inputId, iconId) {
  const passwordInput = document.getElementById(inputId);
  const toggleIcon = document.getElementById(iconId);
  
  if (passwordInput.type === 'password') {
    passwordInput.type = 'text';
    toggleIcon.classList.remove('fa-eye');
    toggleIcon.classList.add('fa-eye-slash');
  } else {
    passwordInput.type = 'password';
    toggleIcon.classList.remove('fa-eye-slash');
    toggleIcon.classList.add('fa-eye');
  }
}
</script>
@endsection
</parameter>
</create_file>
