<?php $__env->startSection('title', 'Login - ICTFE'); ?>

<?php $__env->startSection('styles'); ?>
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

        .login-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            padding: 20px;
        }

        .login-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            min-height: 600px;
        }

        .login-left {
            background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%);
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .login-left::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 500px;
            height: 500px;
            background: rgba(255, 255, 255, 0.12);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .login-left-content {
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

        .features-list {
            list-style: none;
            margin-top: 40px;
        }

        .features-list li {
            margin-bottom: 24px;
            display: flex;
            align-items: flex-start;
            gap: 15px;
            font-size: 15px;
        }

        .features-list .icon {
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

        .features-list .text {
            flex: 1;
        }

        .features-list .title {
            font-weight: 600;
            display: block;
            margin-bottom: 4px;
        }

        .features-list .desc {
            font-size: 13px;
            opacity: 0.8;
        }

        .login-right {
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-header {
            margin-bottom: 40px;
        }

        .login-header h2 {
            font-size: 32px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 12px;
            letter-spacing: -0.5px;
        }

        .login-header p {
            color: #64748b;
            font-size: 15px;
            margin: 0;
        }

        .form-section {
            width: 100%;
        }

        .form-group {
            margin-bottom: 24px;
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
            padding: 14px 16px;
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
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23667eea' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 18px;
            padding-right: 40px;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        .btn-login {
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

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(14, 165, 233, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .forgot-password {
            text-align: right;
            margin-bottom: 24px;
        }

        .forgot-password a {
            color: #0ea5e9;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .forgot-password a:hover {
            color: #0284c7;
            text-decoration: underline;
        }

        .signup-link {
            text-align: center;
            margin-top: 30px;
            padding-top: 24px;
            border-top: 1px solid #e2e8f0;
            color: #64748b;
            font-size: 14px;
        }

        .signup-link a {
            color: #0ea5e9;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .signup-link a:hover {
            color: #0284c7;
            text-decoration: underline;
        }

        .error-alert {
            background: #fee2e2;
            border: 2px solid #fecaca;
            border-radius: 10px;
            padding: 14px 16px;
            margin-bottom: 24px;
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

        .admin-portal-divider {
            margin: 32px 0 24px 0;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #cbd5e1;
        }

        .admin-portal-divider::before,
        .admin-portal-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #cbd5e1;
        }

        .admin-portal-divider span {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            color: #94a3b8;
            letter-spacing: 0.5px;
        }

        .btn-admin-portal {
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 16px 24px;
            font-size: 14px;
            font-weight: 700;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(14, 165, 233, 0.35);
            text-transform: uppercase;
            letter-spacing: 0.6px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            position: relative;
            overflow: hidden;
        }

        .btn-admin-portal::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.15);
            transition: left 0.4s ease;
        }

        .btn-admin-portal:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 12px 35px rgba(14, 165, 233, 0.45);
        }

        .btn-admin-portal:hover::before {
            left: 100%;
        }

        .btn-admin-portal:active {
            transform: translateY(-1px) scale(1);
        }

        .btn-admin-portal i {
            font-size: 16px;
            position: relative;
            z-index: 1;
        }

        .btn-admin-portal span {
            position: relative;
            z-index: 1;
        }

        .admin-portal-subtitle {
            text-align: center;
            color: #64748b;
            font-size: 12px;
            margin-top: 8px;
            font-weight: 500;
            letter-spacing: 0.3px;
        }

        /* Square Admin button (left panel) */
        .admin-square-wrapper {
            position: absolute;
            top: -120px;
            left: -36px; /* sit mostly outside the left panel */
            width: auto;
            height: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: auto;
            z-index: 50;
            transform: translateX(-6px);
        }

        .btn-admin-square {
            width: 72px;
            height: 72px;
            border-radius: 10px;
            background: rgba(14,165,233,0.12);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            box-shadow: 0 6px 18px rgba(2,132,199,0.12);
            transition: transform 0.18s ease, box-shadow 0.18s ease, background 0.18s ease;
            text-decoration: none;
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            border: 1px solid rgba(255,255,255,0.06);
            opacity: 0.95;
        }

        .btn-admin-square:hover {
            transform: translateY(-4px) scale(1.04);
            box-shadow: 0 10px 28px rgba(2,132,199,0.22);
            background: rgba(14,165,233,0.16);
        }

        .admin-square-icon {
            width: 44px;
            height: 44px;
            display: block;
        }

        @media (max-width: 768px) {
            /* On small screens bring the icon inside the panel so it's accessible */
            .admin-square-wrapper {
                top: 12px;
                left: 12px;
                transform: none;
            }

            .btn-admin-square {
                width: 64px;
                height: 64px;
                border-radius: 9px;
            }
        }

        @media (max-width: 768px) {
            .login-container {
                grid-template-columns: 1fr;
                min-height: auto;
            }

            .login-left {
                padding: 40px 30px;
                min-height: 300px;
            }

            .login-right {
                padding: 40px 30px;
            }

            .logo-text h3 {
                font-size: 24px;
            }

            .login-header h2 {
                font-size: 24px;
            }

            .features-list {
                display: none;
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="login-wrapper" data-aos="fade-in" data-aos-duration="1000">
        <div class="login-container">
            <!-- Left Side - Branding -->
            <div class="login-left" data-aos="fade-right" data-aos-duration="1000">
                <div class="login-left-content">
                    <div class="logo-section">
                        <div class="logo-icon">
                            <i class="fas fa-flask-vial"></i>
                        </div>
                        <div class="logo-text">
                            <h3>ICTFE</h3>
                            <p>ICT Facilities and Equipment</p>
                        </div>
                    </div>

                    <ul class="features-list">
                        <li data-aos="fade-up" data-aos-delay="100">
                            <div class="icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="text">
                                <span class="title">Track & Monitor</span>
                                <span class="desc">Real-time equipment and borrowing management</span>
                            </div>
                        </li>
                        <li data-aos="fade-up" data-aos-delay="200">
                            <div class="icon">
                                <i class="fas fa-lock"></i>
                            </div>
                            <div class="text">
                                <span class="title">Secure Access</span>
                                <span class="desc">Role-based authentication for all users</span>
                            </div>
                        </li>
                        <li data-aos="fade-up" data-aos-delay="300">
                            <div class="icon">
                                <i class="fas fa-bell"></i>
                            </div>
                            <div class="text">
                                <span class="title">Smart Alerts</span>
                                <span class="desc">Get notified about important events instantly</span>
                            </div>
                        </li>
                    </ul>

                    <div class="admin-square-wrapper" data-aos="fade-up" data-aos-delay="360">
                        <a href="<?php echo e(route('admin.login')); ?>" class="btn-admin-square" aria-hidden="true">
                            <img src="/images/admin-lock.png" alt="Admin Login" class="admin-square-icon">
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="login-right" data-aos="fade-left" data-aos-duration="1000">
                <div class="login-header">
                    <h2>Welcome Back!</h2>
                    <p>Sign in to continue to your account</p>
                </div>

                <?php if($errors->any()): ?>
                    <div class="error-alert" data-aos="fade-in">
                        <i class="fas fa-exclamation-circle"></i>
                        <span><?php echo e($errors->first()); ?></span>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('login')); ?>" class="form-section">
                    <?php echo csrf_field(); ?>

                    <div class="form-group" data-aos="fade-up" data-aos-delay="100">
                        <label for="login-input">
                            <i class="fas fa-user"></i> Username or Email
                        </label>
                        <input 
                            id="login-input"
                            type="text" 
                            name="login" 
                            class="form-control" 
                            placeholder="Enter your username or email"
                            required
                            autocomplete="username"
                            value="<?php echo e(old('login')); ?>"
                        >
                        <?php $__errorArgs = ['login'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="form-error"><i class="fas fa-times-circle"></i> <?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group" data-aos="fade-up" data-aos-delay="150">
                        <label for="login-role">
                            <i class="fas fa-user-tag"></i> Login As
                        </label>
                        <select id="login-role" name="role" class="form-select" required>
                            <option value="">Select your role</option>
                            <option value="student" <?php echo e(old('role') === 'student' ? 'selected' : ''); ?>>Student</option>
                            <option value="staff" <?php echo e(old('role') === 'staff' ? 'selected' : ''); ?>>Teacher / Staff</option>
                        </select>
                        <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="form-error"><i class="fas fa-times-circle"></i> <?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group" data-aos="fade-up" data-aos-delay="200">
                        <label for="login-password">
                            <i class="fas fa-lock"></i> Password
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
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="form-error"><i class="fas fa-times-circle"></i> <?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="forgot-password" data-aos="fade-up" data-aos-delay="250">
                        <a href="#">Forgot password?</a>
                    </div>

                    <button 
                        type="submit" 
                        class="btn-login"
                        data-aos="fade-up"
                        data-aos-delay="300"
                    >
                        <i class="fas fa-sign-in-alt"></i> Sign In Now
                    </button>

                    <!-- Admin portal moved to left panel as a compact icon button -->
                </form>

                <div class="signup-link" data-aos="fade-up" data-aos-delay="350">
                    <p>Don't have an account? <a href="<?php echo e(route('register')); ?>">Create one now</a></p>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
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
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\MINISYSTEM-G-11-BSIT2-2\resources\views/auth/login.blade.php ENDPATH**/ ?>