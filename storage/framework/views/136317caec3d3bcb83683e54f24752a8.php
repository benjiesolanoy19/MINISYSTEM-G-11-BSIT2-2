<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'ITMSF Dashboard'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0ea5e9;
            --primary-dark: #0284c7;
            --secondary: #10b981;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --light-bg: #f8fafc;
            --border-color: #e2e8f0;
            --sidebar-width: 220px;
            --sidebar-collapsed: 70px;
            --topbar-height: 70px;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        /* Top Navigation */
        .top-navbar {
            background: white !important;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            height: var(--topbar-height);
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            z-index: 1000;
            transition: left 0.3s ease;
        }
        
        .top-navbar.sidebar-collapsed {
            left: var(--sidebar-collapsed);
        }
        
        .navbar-brand-custom {
            font-size: 1.25rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
        }

        .search-wrapper {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: #f8fafc;
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-radius: 14px;
            padding: 0.45rem 0.9rem;
        }

        .search-input {
            border: none;
            background: transparent;
            outline: none;
            width: 280px;
            color: var(--text-dark);
            font-size: 0.95rem;
        }

        .topbar-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: rgba(15, 23, 42, 0.04);
            color: var(--text-dark);
            position: relative;
            transition: background 0.2s ease;
        }

        .topbar-icon:hover {
            background: rgba(14, 165, 233, 0.12);
            color: var(--primary-dark);
        }

        .notification-badge {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: var(--secondary);
            color: white;
            font-size: 0.68rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .notification-badge.pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .dropdown-menu.notifications {
            min-width: 340px;
            max-width: 420px;
            border-radius: 22px;
            padding: 0;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .notification-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid rgba(226, 232, 240, 0.9);
            background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
        }

        .notification-list {
            background: #ffffff;
        }

        .notification-item {
            padding: 1rem 1.5rem;
            border-radius: 0;
            transition: all 0.2s ease;
            border-left: 4px solid transparent;
        }

        .notification-item:hover {
            background: rgba(14, 165, 233, 0.06);
            border-left-color: var(--primary);
        }

        .notification-item.unread {
            background: rgba(14, 165, 233, 0.08);
            border-left-color: var(--primary);
        }

        .notification-item.unread:hover {
            background: rgba(14, 165, 233, 0.12);
        }

        .notification-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .notification-icon i {
            color: white;
        }

        .notification-title {
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .notification-message {
            font-size: 0.8rem;
            line-height: 1.4;
            margin-bottom: 0.5rem !important;
        }

        .notification-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(226, 232, 240, 0.9);
            background: #f8fafc;
        }

        .hover-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .hover-lift:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .sidebar.sidebar-collapsed .sidebar-toggle i {
            transform: rotate(180deg);
        }

        .sidebar.sidebar-collapsed .sidebar-header h4,
        .sidebar.sidebar-collapsed .sidebar-subtitle,
        .sidebar.sidebar-collapsed .sidebar-menu-title,
        .sidebar.sidebar-collapsed .sidebar-divider {
            opacity: 0;
            visibility: hidden;
            width: 0;
            margin: 0;
            padding: 0;
        }

        .sidebar.sidebar-collapsed .sidebar-menu li a {
            justify-content: center;
            padding: 14px 0;
        }

        .sidebar.sidebar-collapsed .sidebar-menu li a i {
            margin-right: 0;
        }

        .sidebar.sidebar-collapsed .sidebar-menu li a span {
            display: none;
        }

        .sidebar.sidebar-collapsed .sidebar-header {
            padding: 20px 0;
        }

        .sidebar.sidebar-collapsed .sidebar-menu {
            padding: 10px 0;
        }

        .search-wrapper .form-control:focus {
            box-shadow: none;
            border-color: transparent;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--primary-dark), var(--primary));
            color: white;
            z-index: 1001;
            transition: width 0.3s ease;
            overflow-y: auto;
        }
        
        .sidebar.sidebar-collapsed {
            width: var(--sidebar-collapsed);
        }
        
        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-header h4 {
            font-weight: 700;
            margin: 0;
        }
        
        .sidebar-toggle {
            position: absolute;
            top: 20px;
            right: -15px;
            width: 30px;
            height: 30px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            color: var(--primary);
            z-index: 1002;
        }
        
        .sidebar-menu {
            list-style: none;
            padding: 15px 10px;
            margin: 0;
        }
        
        .sidebar-menu li {
            margin-bottom: 5px;
        }
        
        .sidebar-menu li a {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        .sidebar-menu li a:hover,
        .sidebar-menu li a.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }
        
        .sidebar-menu li a i {
            width: 20px;
            text-align: center;
            margin-right: 12px;
        }
        
        .sidebar-divider {
            height: 1px;
            background: rgba(255, 255, 255, 0.15);
            margin: 15px 0;
        }
        
        .sidebar-menu-title {
            padding: 10px 15px 5px;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: rgba(255, 255, 255, 0.5);
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--topbar-height);
            padding: 30px;
            min-height: calc(100vh - var(--topbar-height));
            transition: margin-left 0.3s ease;
            background: linear-gradient(180deg, rgba(248,250,252,0.95), rgba(224,242,254,0.75));
        }
        
        .main-content.sidebar-collapsed {
            margin-left: var(--sidebar-collapsed);
        }

        /* Modern cards */
        .card-modern {
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 24px;
            box-shadow: 0 24px 70px rgba(15, 23, 42, 0.08);
        }

        .card-modern .card-body {
            padding: 1.8rem;
        }

        .hero-banner {
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.92), rgba(16, 185, 129, 0.92));
            color: white;
            border-radius: 24px;
            box-shadow: 0 30px 80px rgba(14, 165, 233, 0.2);
            overflow: hidden;
        }

        .hero-banner h1,
        .hero-banner p {
            color: white;
        }

        .metric-card {
            background: rgba(255,255,255,0.98);
            border: 1px solid rgba(226,232,240,0.85);
            border-radius: 20px;
            box-shadow: 0 14px 35px rgba(15, 23, 42, 0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .metric-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 22px 55px rgba(15, 23, 42, 0.12);
        }

        .metric-card .card-body {
            padding: 1.5rem;
        }

        .metric-label {
            text-transform: uppercase;
            letter-spacing: 0.14em;
            font-size: 0.78rem;
            color: #64748b;
            margin-bottom: 0.75rem;
        }

        .metric-value {
            font-size: 2.4rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .quick-actions .btn {
            min-height: 52px;
            border-radius: 16px;
            font-weight: 600;
        }

        .btn-primary,
        .btn-success,
        .btn-info,
        .btn-secondary {
            border-radius: 16px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            box-shadow: 0 14px 35px rgba(14, 165, 233, 0.18);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0c8ac1, #0da76e);
        }

        .btn-secondary {
            background: #f8fafc;
            color: var(--text-dark);
            border: 1px solid rgba(226,232,240,0.9);
        }

        .btn-secondary:hover {
            background: white;
        }

        .lab-card {
            background: rgba(255,255,255,0.95);
            border-radius: 24px;
            border: 1px solid rgba(226,232,240,0.95);
            overflow: hidden;
            box-shadow: 0 24px 70px rgba(15, 23, 42, 0.06);
        }

        .lab-card .card-body {
            padding: 1.75rem;
        }

        .lab-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 0.8rem;
            margin-right: 6px;
            margin-bottom: 8px;
        }

        .badge-building { background: rgba(14, 165, 233, 0.12); color: #0369a1; }
        .badge-floor { background: rgba(16, 185, 129, 0.12); color: #047857; }
        .badge-capacity { background: rgba(249, 115, 22, 0.12); color: #c2410c; }

        .btn-reserve {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            border-radius: 16px;
            padding: 0.95rem 1.25rem;
            font-weight: 700;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-reserve:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 40px rgba(14, 165, 233, 0.18);
        }

        .form-control {
            border-radius: 14px;
            border: 1px solid rgba(226,232,240,0.95);
            background: #ffffff;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.15rem rgba(14, 165, 233, 0.12);
        }

        .modal-content {
            border-radius: 24px;
            overflow: hidden;
            border: none;
            box-shadow: 0 30px 80px rgba(15, 23, 42, 0.12);
        }

        .modal-header {
            border-bottom: 1px solid rgba(226,232,240,0.95);
        }

        .modal-footer {
            border-top: 1px solid rgba(226,232,240,0.95);
        }

        .empty-state {
            border: 1px dashed rgba(148,163,184,0.6);
            border-radius: 24px;
            padding: 3rem;
            text-align: center;
            background: rgba(255,255,255,0.95);
            box-shadow: 0 20px 50px rgba(15, 23, 42, 0.06);
        }

        .empty-state i {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }
    </style>
    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>

<?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php
    $globalNotifications = \App\Models\Notification::where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->get();
    $globalUnreadCount = \App\Models\Notification::where('user_id', Auth::id())
        ->where('is_read', false)
        ->count();
?>

<!-- Top Navigation -->
<nav class="top-navbar navbar navbar-expand" id="topNavbar">
    <div class="container-fluid px-4 d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-3 w-100">
            <a class="navbar-brand-custom" href="<?php echo e(route('dashboard')); ?>">
                <i class="fas fa-laptop-code me-2"></i>ITMSF
            </a>

            <div class="search-wrapper d-none d-lg-flex">
                <i class="fas fa-search text-muted"></i>
                <input type="search" class="form-control form-control-sm search-input" placeholder="Search labs, reservations, incidents...">
            </div>
        </div>

        <div class="d-flex align-items-center gap-3">
            <div class="dropdown">
                <button class="topbar-icon btn btn-sm p-0 dropdown-toggle" type="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-bell"></i>
                    <?php if($globalUnreadCount > 0): ?>
                        <span class="notification-badge pulse"><?php echo e($globalUnreadCount); ?></span>
                    <?php endif; ?>
                </button>
                <div class="dropdown-menu dropdown-menu-end notifications shadow-lg border-0 mt-3" aria-labelledby="notificationDropdown" style="width: 380px; max-height: 500px;">
                    <div class="notification-header d-flex align-items-center justify-content-between p-3 border-bottom">
                        <div>
                            <h6 class="mb-1 fw-bold text-dark">
                                <i class="fas fa-bell text-primary me-2"></i>Notifications
                            </h6>
                            <p class="text-muted small mb-0">
                                <?php if($globalUnreadCount > 0): ?>
                                    <?php echo e($globalUnreadCount); ?> unread <?php echo e($globalUnreadCount === 1 ? 'notification' : 'notifications'); ?>

                                <?php else: ?>
                                    All caught up!
                                <?php endif; ?>
                            </p>
                        </div>
                        <?php if($globalUnreadCount > 0): ?>
                            <button class="btn btn-sm btn-outline-primary rounded-pill px-3" onclick="markAllAsRead()">
                                <i class="fas fa-check-double me-1"></i>Mark all read
                            </button>
                        <?php endif; ?>
                    </div>

                    <div class="notification-list" style="max-height: 350px; overflow-y: auto;">
                        <?php $__empty_1 = true; $__currentLoopData = $globalNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="notification-item <?php echo e($notification->is_read ? '' : 'unread'); ?> p-3 border-bottom hover-lift" onclick="markAsRead(<?php echo e($notification->id); ?>)" style="cursor: pointer;">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="notification-icon">
                                        <?php if(str_contains($notification->message, 'approved')): ?>
                                            <i class="fas fa-check-circle text-success"></i>
                                        <?php elseif(str_contains($notification->message, 'returned')): ?>
                                            <i class="fas fa-undo text-info"></i>
                                        <?php elseif(str_contains($notification->message, 'incident')): ?>
                                            <i class="fas fa-exclamation-triangle text-warning"></i>
                                        <?php else: ?>
                                            <i class="fas fa-info-circle text-primary"></i>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start mb-1">
                                            <h6 class="notification-title mb-0 fw-semibold text-dark">
                                                <?php echo e(\Illuminate\Support\Str::limit($notification->title ?? 'Notification', 35)); ?>

                                            </h6>
                                            <small class="text-muted"><?php echo e($notification->created_at->diffForHumans()); ?></small>
                                        </div>
                                        <p class="notification-message text-muted small mb-2">
                                            <?php echo e(\Illuminate\Support\Str::limit($notification->message ?? 'No details available.', 85)); ?>

                                        </p>
                                        <?php if(!$notification->is_read): ?>
                                            <span class="badge bg-primary bg-opacity-15 text-primary small px-2 py-1 rounded-pill">
                                                <i class="fas fa-circle me-1" style="font-size: 6px;"></i>New
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="text-center py-5">
                                <i class="fas fa-bell-slash fa-3x text-muted mb-3"></i>
                                <h6 class="text-muted mb-2">No notifications yet</h6>
                                <p class="text-muted small">We'll notify you when there's something new</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="notification-footer p-3 border-top bg-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="<?php echo e(route('notifications.index')); ?>" class="btn btn-primary btn-sm rounded-pill px-3">
                                <i class="fas fa-eye me-1"></i>View All
                            </a>
                            <small class="text-muted">
                                <i class="fas fa-clock me-1"></i><?php echo e(now()->format('g:i A')); ?>

                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dropdown">
                <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <div class="user-avatar me-3">
                        <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

                    </div>
                    <div class="d-none d-md-block text-end">
                        <div class="fw-semibold"><?php echo e(Auth::user()->name); ?></div>
                        <small class="text-muted"><?php echo e(ucfirst(Auth::user()->role)); ?></small>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3 mt-3">
                    <li><a class="dropdown-item py-2" href="<?php echo e(route('profile.index')); ?>">
                        <i class="fas fa-user me-2"></i>My Profile
                    </a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="<?php echo e(route('logout')); ?>" class="m-0">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="dropdown-item py-2 text-danger">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- Main Content -->
<main class="main-content" id="mainContent">
    <?php echo $__env->yieldContent('content'); ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.0/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.0/ScrollTrigger.min.js"></script>

<?php echo $__env->yieldContent('scripts'); ?>

<script>
    // Initialize AOS (Animate On Scroll)
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out-quart',
            once: true,
            offset: 100,
            delay: 0
        });

        // Register GSAP ScrollTrigger
        if (typeof gsap !== 'undefined') {
            gsap.registerPlugin(ScrollTrigger);
        }
    });

    const sidebar = document.getElementById('sidebar');
    const topNavbar = document.getElementById('topNavbar');
    const mainContent = document.getElementById('mainContent');
    const toggleBtn = document.getElementById('sidebarToggle');

    if (toggleBtn) {
        const toggleIcon = toggleBtn.querySelector('i');
        toggleBtn.addEventListener('click', () => {
            const collapsed = sidebar.classList.toggle('sidebar-collapsed');
            topNavbar.classList.toggle('sidebar-collapsed');
            mainContent.classList.toggle('sidebar-collapsed');
            if (collapsed) {
                toggleIcon.classList.remove('fa-chevron-left');
                toggleIcon.classList.add('fa-chevron-right');
            } else {
                toggleIcon.classList.remove('fa-chevron-right');
                toggleIcon.classList.add('fa-chevron-left');
            }
        });
    }

    // Notification functions
    function markAsRead(notificationId) {
        fetch(`/notifications/${notificationId}/read`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update UI
                const notificationItem = document.querySelector(`[onclick="markAsRead(${notificationId})"]`);
                if (notificationItem) {
                    notificationItem.classList.remove('unread');
                    const badge = notificationItem.querySelector('.badge');
                    if (badge) badge.remove();

                    // Update notification count
                    const badgeElement = document.querySelector('.notification-badge');
                    if (badgeElement) {
                        const currentCount = parseInt(badgeElement.textContent) - 1;
                        if (currentCount > 0) {
                            badgeElement.textContent = currentCount;
                        } else {
                            badgeElement.remove();
                        }
                    }
                }
            }
        })
        .catch(error => console.error('Error marking notification as read:', error));
    }

    function markAllAsRead() {
        fetch('/notifications/read-all', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update UI
                document.querySelectorAll('.notification-item.unread').forEach(item => {
                    item.classList.remove('unread');
                    const badge = item.querySelector('.badge');
                    if (badge) badge.remove();
                });

                // Remove notification badge
                const badgeElement = document.querySelector('.notification-badge');
                if (badgeElement) badgeElement.remove();

                // Close dropdown
                const dropdown = bootstrap.Dropdown.getInstance(document.getElementById('notificationDropdown'));
                if (dropdown) dropdown.hide();
            }
        })
        .catch(error => console.error('Error marking all notifications as read:', error));
    }
</script>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\CLMFS_GROUP11 - Copy - Copy\resources\views/layouts/dashboard.blade.php ENDPATH**/ ?>