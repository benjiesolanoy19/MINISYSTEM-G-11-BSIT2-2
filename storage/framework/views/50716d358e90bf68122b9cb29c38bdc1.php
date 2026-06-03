

<?php $__env->startSection('title', 'Admin Login - ICTFE'); ?>

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

        .admin-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            padding: 20px;
        }

        .admin-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.4);
            min-height: 600px;
        }

        .admin-left {
            background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%);
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .admin-left::before {
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

        .admin-left-content {
            position: relative;
            z-index: 1;
        }

        .admin-lock-section {
            text-align: center;
            margin-bottom: 50px;
        }

        .admin-lock-icon {
            font-size: 80px;
            margin-bottom: 25px;
            display: inline-block;
            background: rgba(255, 255, 255, 0.15);
            width: 140px;
            height: 140px;
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            animation: float 4s ease-in-out infinite;
        }

        .admin-lock-text h2 {
            font-size: 36px;
            font-weight: 700;
            margin: 0;
            letter-spacing: -0.5px;
        }

        .admin-lock-text p {
            font-size: 15px;
            margin: 12px 0 0 0;
            opacity: 0.9;
        }

        .admin-security-notice {
            background: rgba(255, 255, 255, 0.12);
            border-left: 4px solid rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 12px;
            margin-top: 40px;
            font-size: 14px;
            line-height: 1.6;
        }

        .admin-security-notice i {
            margin-right: 10px;
            font-size: 18px;
        }

        .admin-right {
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .admin-header {
            margin-bottom: 40px;
        }

        .admin-header h2 {
            font-size: 32px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 12px;
            letter-spacing: -0.5px;
        }

        .admin-header p {
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

        .form-control {
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

        .form-control:focus {
            outline: none;
            border-color: #0ea5e9;
            background: white;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.12);
        }

        .form-control:hover {
            border-color: #cbd5e1;
        }

        .btn-admin-login {
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
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-admin-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(14, 165, 233, 0.4);
        }

        .btn-admin-login:active {
            transform: translateY(0);
        }

        .btn-admin-login i {
            font-size: 16px;
        }

        .back-link {
            text-align: center;
            margin-top: 30px;
            padding-top: 24px;
            border-top: 1px solid #e2e8f0;
            color: #64748b;
            font-size: 14px;
        }

        .back-link a {
            color: #0ea5e9;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .back-link a:hover {
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

        .form-error {
            color: #dc2626;
            font-size: 12px;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
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

        @media (max-width: 768px) {
            .admin-container {
                grid-template-columns: 1fr;
                min-height: auto;
            }

            .admin-left {
                padding: 40px 30px;
                min-height: 300px;
            }

            .admin-right {
                padding: 40px 30px;
            }

            .admin-lock-icon {
                font-size: 60px;
                width: 120px;
                height: 120px;
            }

            .admin-lock-text h2 {
                font-size: 24px;
            }

            .admin-header h2 {
                font-size: 24px;
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="admin-wrapper" data-aos="fade-in" data-aos-duration="1000">
        <div class="admin-container">
            <!-- Left Side - Admin Branding -->
            <div class="admin-left" data-aos="fade-right" data-aos-duration="1000">
                <div class="admin-left-content">
                    <div class="admin-lock-section">
                        <div class="admin-lock-icon" data-aos="zoom-in" data-aos-delay="100">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="admin-lock-text">
                            <h2>Admin Portal</h2>
                            <p>Secure Administrator Access</p>
                        </div>
                    </div>

                    <div class="admin-security-notice" data-aos="fade-up" data-aos-delay="200">
                        <i class="fas fa-shield-alt"></i>
                        <span>This portal is restricted to authorized administrators only. All access attempts are logged and monitored for security purposes.</span>
                    </div>
                </div>
            </div>

            <!-- Right Side - Admin Login Form -->
            <div class="admin-right" data-aos="fade-left" data-aos-duration="1000">
                <div class="admin-header">
                    <h2>Administrator Login</h2>
                    <p>Enter your admin credentials to continue</p>
                </div>

                <?php if($errors->any()): ?>
                    <div class="error-alert" data-aos="fade-in">
                        <i class="fas fa-exclamation-circle"></i>
                        <span><?php echo e($errors->first()); ?></span>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('admin.authenticate')); ?>" class="form-section">
                    <?php echo csrf_field(); ?>

                    <div class="form-group" data-aos="fade-up" data-aos-delay="100">
                        <label for="admin-username">
                            <i class="fas fa-user-shield"></i> Admin Username
                        </label>
                        <input 
                            id="admin-username"
                            type="text" 
                            name="username" 
                            class="form-control" 
                            placeholder="Enter your admin username"
                            required
                            autocomplete="username"
                            value="<?php echo e(old('username')); ?>"
                        >
                        <?php $__errorArgs = ['username'];
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
                        <label for="admin-password">
                            <i class="fas fa-lock"></i> Admin Password
                        </label>
                        <input 
                            id="admin-password"
                            type="password" 
                            name="password" 
                            class="form-control" 
                            placeholder="Enter your admin password"
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

                    <button 
                        type="submit" 
                        class="btn-admin-login"
                        data-aos="fade-up"
                        data-aos-delay="200"
                    >
                        <i class="fas fa-sign-in-alt"></i> Access Admin Dashboard
                    </button>
                </form>

                <div class="back-link" data-aos="fade-up" data-aos-delay="250">
                    <a href="<?php echo e(route('login')); ?>">
                        <i class="fas fa-arrow-left"></i>
                        Back to Student/Staff Login
                    </a>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\MINISYSTEM-G-11-BSIT2-2\resources\views/auth/admin-login.blade.php ENDPATH**/ ?>