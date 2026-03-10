<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - CLFMS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Inter', sans-serif; min-height: 100vh; background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%); display: flex; align-items: center; justify-content: center; padding: 20px; }
    .register-card { background: white; border-radius: 20px; box-shadow: 0 25px 50px rgba(0,0,0,0.25); padding: 40px; width: 100%; max-width: 450px; }
    .register-header { text-align: center; margin-bottom: 30px; }
    .register-header .icon { width: 70px; height: 70px; background: linear-gradient(135deg, #0ea5e9, #10b981); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; }
    .register-header .icon i { font-size: 30px; color: white; }
    .register-header h2 { font-size: 24px; font-weight: 700; color: #1f2937; margin-bottom: 5px; }
    .register-header p { color: #6b7280; font-size: 14px; }
    .form-group { margin-bottom: 20px; }
    .form-label { display: block; font-weight: 600; font-size: 13px; color: #374151; margin-bottom: 8px; }
    .form-control { width: 100%; padding: 12px 16px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 15px; transition: all 0.3s; }
    .form-control:focus { outline: none; border-color: #0ea5e9; box-shadow: 0 0 0 4px rgba(14,165,233,0.1); }
    .btn-submit { width: 100%; padding: 14px; background: linear-gradient(135deg, #0ea5e9, #10b981); color: white; border: none; border-radius: 10px; font-size: 16px; font-weight: 600; cursor: pointer; transition: all 0.3s; }
    .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(14,165,233,0.4); }
    .register-links { text-align: center; margin-top: 20px; }
    .register-links a { color: #0ea5e9; text-decoration: none; font-weight: 600; font-size: 14px; }
    .register-links a:hover { color: #10b981; }
    .divider { display: flex; align-items: center; margin: 20px 0; color: #9ca3af; font-size: 13px; }
    .divider::before, .divider::after { content: ''; flex: 1; height: 1px; background: #e5e7eb; }
    .divider span { padding: 0 15px; }
    .alert-danger { padding: 12px 16px; border-radius: 10px; margin-bottom: 20px; font-size: 14px; background: rgba(239,68,68,0.1); color: #dc2626; border: 1px solid rgba(239,68,68,0.2); }
    .alert-success { padding: 12px 16px; border-radius: 10px; margin-bottom: 20px; font-size: 14px; background: rgba(16,185,129,0.1); color: #059669; border: 1px solid rgba(16,185,129,0.2); }
  </style>
</head>
<body>
  <div class="register-card">
    <div class="register-header">
      <div class="icon"><i class="fas fa-user-plus"></i></div>
      <h2>Create Account</h2>
      <p>Join CLFMS and manage your lab resources</p>
    </div>

    @if($errors->any())
      <div class="alert-danger">
        <i class="fas fa-exclamation-circle"></i>
        @foreach($errors->all() as $error) {{ $error }} @endforeach
      </div>
    @endif

    @if(session('error'))
      <div class="alert-danger"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
    @endif

    @if(session('success'))
      <div class="alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('register') }}">
      @csrf
      <div class="form-group">
        <label class="form-label">Full Name</label>
        <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
      </div>
      <div class="form-group">
        <label class="form-label">Email Address</label>
        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
      </div>
      <div class="form-group">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Create a password" required>
      </div>
      <div class="form-group">
        <label class="form-label">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm your password" required>
      </div>
      <button type="submit" class="btn-submit"><i class="fas fa-user-plus me-2"></i>Create Account</button>
    </form>

    <div class="register-links">
      <div class="divider"><span>OR</span></div>
      <p style="color: #6b7280; font-size: 14px;">Already have an account? <a href="{{ route('login') }}">Sign-in</a></p>
    </div>
</body>
</html>
</parameter>
</create_file>
