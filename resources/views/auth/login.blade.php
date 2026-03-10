<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - CLFMS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Inter', sans-serif; min-height: 100vh; background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%); display: flex; align-items: center; justify-content: center; padding: 20px; }
    .login-card { background: white; border-radius: 20px; box-shadow: 0 25px 50px rgba(0,0,0,0.25); padding: 40px; width: 100%; max-width: 420px; }
    .login-header { text-align: center; margin-bottom: 30px; }
    .login-header .icon { width: 70px; height: 70px; background: linear-gradient(135deg, #0ea5e9, #10b981); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; }
    .login-header .icon i { font-size: 30px; color: white; }
    .login-header h2 { font-size: 24px; font-weight: 700; color: #1f2937; margin-bottom: 5px; }
    .login-header p { color: #6b7280; font-size: 14px; }
    .form-group { margin-bottom: 20px; }
    .form-label { display: block; font-weight: 600; font-size: 13px; color: #374151; margin-bottom: 8px; }
    .form-control { width: 100%; padding: 12px 16px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 15px; transition: all 0.3s; }
    .form-control:focus { outline: none; border-color: #0ea5e9; box-shadow: 0 0 0 4px rgba(14,165,233,0.1); }
    .btn-submit { width: 100%; padding: 14px; background: linear-gradient(135deg, #0ea5e9, #10b981); color: white; border: none; border-radius: 10px; font-size: 16px; font-weight: 600; cursor: pointer; transition: all 0.3s; }
    .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(14,165,233,0.4); }
    .admin-toggle { background: linear-gradient(135deg, #f0fdf4, #ecfeff); border: 2px solid #10b981; border-radius: 10px; padding: 15px; margin-bottom: 20px; }
    .form-check { display: flex; align-items: center; margin-bottom: 10px; }
    .form-check input { width: 18px; height: 18px; margin-right: 10px; }
    .form-check label { font-size: 14px; color: #4b5563; cursor: pointer; }
    .login-links { text-align: center; margin-top: 20px; }
    .login-links a { color: #0ea5e9; text-decoration: none; font-weight: 600; font-size: 14px; }
    .login-links a:hover { color: #10b981; }
    .divider { display: flex; align-items: center; margin: 20px 0; color: #9ca3af; font-size: 13px; }
    .divider::before, .divider::after { content: ''; flex: 1; height: 1px; background: #e5e7eb; }
    .divider span { padding: 0 15px; }
    .alert-danger { padding: 12px 16px; border-radius: 10px; margin-bottom: 20px; font-size: 14px; background: rgba(239,68,68,0.1); color: #dc2626; border: 1px solid rgba(239,68,68,0.2); }
  </style>
</head>
<body>
  <div class="login-card">
    <div class="login-header">
      <div class="icon"><i class="fas fa-user-circle"></i></div>
      <h2>Welcome Back</h2>
      <p>Sign in to access your dashboard</p>
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

    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="form-group">
        <label class="form-label">Email Address</label>
        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
      </div>
      <div class="form-group">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
      </div>
      <div class="admin-toggle">
        <div class="form-check">
          <input type="checkbox" name="is_admin" id="is_admin">
          <label for="is_admin"><i class="fas fa-user-shield me-2"></i>Login as Administrator</label>
        </div>
      <div class="form-check">
        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Remember me</label>
      </div>
      <button type="submit" class="btn-submit"><i class="fas fa-sign-in-alt me-2"></i>Sign In</button>
    </form>

    <div class="login-links">
      <a href="{{ route('password.forgot') }}"><i class="fas fa-key me-1"></i>Forgot your password?</a>
      <div class="divider"><span>OR</span></div>
      <p style="color: #6b7280; font-size: 14px;">Don't have an account? <a href="{{ route('register') }}">Create one</a></p>
    </div>
</body>
</html>
</parameter>
</create_file>
