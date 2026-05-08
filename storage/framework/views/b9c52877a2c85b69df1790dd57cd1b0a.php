<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'ICTFE - ICT Facilities and Equipment'); ?></title>
    
    <!-- Material UI CSS from CDN -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    
    <!-- AOS (Animate On Scroll) CSS -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --mdc-primary: #0ea5e9;
            --mdc-primary-dark: #0284c7;
            --mdc-secondary: #10b981;
            --mdc-error: #ef4444;
            --mdc-warning: #f59e0b;
            --mdc-info: #3b82f6;
            --mdc-success: #10b981;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --light-bg: #f8fafc;
            --card-bg: #ffffff;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 20px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 12px 40px rgba(0, 0, 0, 0.12);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html, body {
            height: 100%;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--light-bg);
            color: var(--text-dark);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        /* Material Design Elevation/Shadow Styles */
        .mdc-elevation-1 {
            box-shadow: var(--shadow-sm);
        }
        
        .mdc-elevation-2 {
            box-shadow: var(--shadow-md);
        }
        
        .mdc-elevation-3 {
            box-shadow: var(--shadow-lg);
        }
        
        /* Navbar Enhancement */
        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(20px);
            box-shadow: var(--shadow-sm);
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            z-index: 100;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .navbar:hover {
            box-shadow: var(--shadow-md);
        }
        
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--mdc-primary) 0%, var(--mdc-secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            transition: transform 0.3s ease;
        }
        
        .navbar-brand:hover {
            transform: scale(1.05);
        }
        
        .nav-link {
            color: var(--text-dark) !important;
            font-weight: 500;
            padding: 10px 20px !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            margin: 0 5px;
            border-radius: 8px;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--mdc-primary), var(--mdc-secondary));
            transition: all 0.3s ease;
            transform: translateX(-50%);
            border-radius: 1px;
        }
        
        .nav-link:hover {
            color: var(--mdc-primary) !important;
            background: rgba(14, 165, 233, 0.1);
            transform: translateY(-2px);
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        /* Material Design Buttons */
        .btn {
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }
        
        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }
        
        .btn:hover::before {
            width: 300px;
            height: 300px;
        }
        
        .btn-primary {
            background-color: var(--mdc-primary);
            color: white;
            box-shadow: 0 4px 15px rgba(14, 165, 233, 0.3);
        }
        
        .btn-primary:hover {
            background-color: var(--mdc-primary-dark);
            box-shadow: 0 8px 25px rgba(14, 165, 233, 0.4);
            transform: translateY(-3px);
        }
        
        .btn-success {
            background-color: var(--mdc-secondary);
            color: white;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }
        
        .btn-success:hover {
            background-color: #059669;
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
            transform: translateY(-3px);
        }
        
        .btn-outline-primary {
            color: var(--mdc-primary);
            border: 2px solid var(--mdc-primary);
            background: transparent;
        }
        
        .btn-outline-primary:hover {
            background: var(--mdc-primary);
            color: white;
            transform: translateY(-3px);
        }
        
        /* Card Styling */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: var(--shadow-md);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            background: var(--card-bg);
            position: relative;
        }
        
        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--mdc-primary), var(--mdc-secondary));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
        }
        
        .card:hover::before {
            transform: scaleX(1);
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--mdc-primary) 0%, var(--mdc-secondary) 100%);
            color: white;
            border: none;
            padding: 20px;
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        .card-body {
            padding: 20px;
        }
        
        /* Form Controls */
        .form-control {
            border: 2px solid var(--border-color);
            border-radius: 8px;
            padding: 12px 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 0.95rem;
            font-family: 'Inter', sans-serif;
        }
        
        .form-control:focus {
            border-color: var(--mdc-primary);
            box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.1);
            outline: none;
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--text-dark);
            font-size: 0.95rem;
        }
        
        /* Material Design Chips */
        .chip {
            display: inline-block;
            padding: 6px 12px;
            background: rgba(14, 165, 233, 0.1);
            color: var(--mdc-primary);
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 1px solid var(--mdc-primary);
        }
        
        .chip:hover {
            background: var(--mdc-primary);
            color: white;
            transform: scale(1.05);
        }
        
        /* Badge Styling */
        .badge {
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
        }
        
        .badge-primary {
            background: linear-gradient(135deg, var(--mdc-primary), var(--mdc-primary-dark));
            color: white;
        }
        
        .badge-success {
            background: linear-gradient(135deg, var(--mdc-secondary), #059669);
            color: white;
        }
        
        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--text-dark) 0%, #0f172a 100%);
            color: #fff;
            padding: 40px 0 20px;
            margin-top: 60px;
            position: relative;
        }
        
        footer a {
            color: var(--mdc-primary);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        footer a:hover {
            color: var(--mdc-secondary);
        }
        
        /* Animations for scroll and entrance */
        [data-scroll] {
            opacity: 0;
            transform: translateY(20px);
        }
        
        /* Loading Spinner */
        .spinner-gradient {
            background: linear-gradient(135deg, var(--mdc-primary) 0%, var(--mdc-secondary) 100%);
        }
        
        /* Alert Styling */
        .alert {
            border: none;
            border-radius: 10px;
            border-left: 4px solid;
            padding: 15px 20px;
            animation: slideInDown 0.4s ease;
        }
        
        .alert-primary {
            background: rgba(14, 165, 233, 0.1);
            border-left-color: var(--mdc-primary);
            color: var(--mdc-primary);
        }
        
        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border-left-color: var(--mdc-secondary);
            color: var(--mdc-secondary);
        }
        
        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            border-left-color: var(--mdc-error);
            color: var(--mdc-error);
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
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        
        /* Utility Classes */
        .gradient-text {
            background: linear-gradient(135deg, var(--mdc-primary) 0%, var(--mdc-secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, var(--mdc-primary) 0%, var(--mdc-secondary) 100%);
        }
        
        .ripple-effect {
            position: relative;
            overflow: hidden;
        }
        
        .ripple-effect::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1);
            transform-origin: 50% 50%;
        }
        
        @keyframes ripple {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            100% {
                transform: scale(20);
                opacity: 0;
            }
        }
        
        .ripple-effect:active::after {
            animation: ripple 0.6s ease-out;
        }
    </style>
    
    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>
    <?php echo $__env->yieldContent('content'); ?>
    
    <!-- AOS (Animate On Scroll) JS -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    
    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.0/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.0/ScrollTrigger.min.js"></script>
    
    <!-- Initialize AOS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS
            AOS.init({
                duration: 800,
                easing: 'ease-in-out-quart',
                once: true,
                offset: 100,
                delay: 0
            });

            // Register GSAP ScrollTrigger
            gsap.registerPlugin(ScrollTrigger);
        });
    </script>
    
    <?php echo $__env->yieldContent('scripts'); ?>
    
    
    
</body>
</html>
</parameter>
</create_file>
<?php /**PATH C:\xampp\htdocs\CLMFS_GROUP11 - Copy - Copy - Copy\resources\views/layouts/app.blade.php ENDPATH**/ ?>