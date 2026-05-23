<!-- Sidebar -->
<nav class="sidebar" id="sidebar">
    <div class="sidebar-toggle" id="sidebarToggle" title="Toggle sidebar">
        <i class="fas fa-chevron-left"></i>
    </div>
    
    <div class="sidebar-header">
        <h4><i class="fas fa-laptop-code me-2"></i>ICTFE</h4>
        <p class="sidebar-subtitle">ICT Facilities Management</p>
    </div>
    
    <ul class="sidebar-menu">
        <!-- Common Menu Items -->
<li class="sidebar-item">
            <a href="<?php echo e(route('dashboard')); ?>" class="sidebar-link <?php echo e(Request::is('dashboard') ? 'active' : ''); ?>">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a>
        </li>
        
        <li class="sidebar-item">
            <a href="<?php echo e(route('logs.index')); ?>" class="sidebar-link <?php echo e(Request::is('logs') ? 'active' : ''); ?>">
                <i class="fas fa-clock"></i>
                <span>Time In / Out</span>
            </a>
        </li>
        
        <li class="sidebar-item">
            <a href="<?php echo e(route('borrowings.create')); ?>" class="sidebar-link <?php echo e(Request::is('borrowings/create') ? 'active' : ''); ?>">
                <i class="fas fa-dolly"></i>
                <span>Borrow Equipment</span>
            </a>
        </li>
        
        <li class="sidebar-item">
            <a href="<?php echo e(route('borrowings.index')); ?>" class="sidebar-link <?php echo e(Request::is('borrowings*') ? 'active' : ''); ?>">
                <i class="fas fa-inbox"></i>
                <span>My Borrowings</span>
            </a>
        </li>
        
        <li class="sidebar-item">
            <a href="<?php echo e(route('incidents.report')); ?>" class="sidebar-link <?php echo e(Request::is('incidents/report') ? 'active' : ''); ?>">
                <i class="fas fa-triangle-exclamation"></i>
                <span>Report Incident</span>
            </a>
        </li>
        
        <li class="sidebar-item">
            <a href="<?php echo e(route('incidents.index')); ?>" class="sidebar-link <?php echo e(Request::is('incidents*') ? 'active' : ''); ?>">
                <i class="fas fa-file-text"></i>
                <span>My Reports</span>
            </a>
        </li>
        
        <li class="sidebar-item">
            <a href="<?php echo e(route('notifications.index')); ?>" class="sidebar-link <?php echo e(Request::is('notifications*') ? 'active' : ''); ?>">
                <i class="fas fa-bell"></i>
                <span>Notifications</span>
            </a>
        </li>
        
        <div class="sidebar-divider"></div>
        
        <!-- Staff/Admin Only -->
        <?php if(Auth::user()->role === 'admin' || Auth::user()->role === 'staff'): ?>
            <div class="sidebar-menu-title">Staff & Admin</div>
            
            <li class="sidebar-item">
                <a href="<?php echo e(route('equipment.index')); ?>" class="sidebar-link <?php echo e(Request::is('equipment*') ? 'active' : ''); ?>">
                    <i class="fas fa-computer"></i>
                    <span>Equipment Inventory</span>
                </a>
            </li>
            
            <li class="sidebar-item">
                <a href="<?php echo e(route('equipment.create')); ?>" class="sidebar-link <?php echo e(Request::is('equipment/create') ? 'active' : ''); ?>">
                    <i class="fas fa-plus-circle"></i>
                    <span>Add Equipment</span>
                </a>
            </li>
            
            <li class="sidebar-item">
                <a href="<?php echo e(route('logs.index')); ?>" class="sidebar-link <?php echo e(Request::is('logs') ? 'active' : ''); ?>">
                    <i class="fas fa-history"></i>
                    <span>Time Logs</span>
                </a>
            </li>
            
            <li class="sidebar-item">
                <a href="<?php echo e(route('reports.usage')); ?>" class="sidebar-link <?php echo e(Request::is('reports*') ? 'active' : ''); ?>">
                    <i class="fas fa-chart-line"></i>
                    <span>Reports</span>
                </a>
            </li>
        <?php endif; ?>
        
        <!-- Admin Only -->
        <?php if(Auth::user()->role === 'admin'): ?>
            <div class="sidebar-divider"></div>
            <div class="sidebar-menu-title">Administrator</div>
            
            <li class="sidebar-item">
                <a href="<?php echo e(route('admin.index')); ?>" class="sidebar-link <?php echo e(Request::is('admin*') ? 'active' : ''); ?>">
                    <i class="fas fa-cog"></i>
                    <span>Admin Panel</span>
                </a>
            </li>
        <?php endif; ?>
        
        <div class="sidebar-divider"></div>
        
        <li class="sidebar-item">
            <a href="<?php echo e(route('profile.index')); ?>" class="sidebar-link <?php echo e(Request::is('profile*') ? 'active' : ''); ?>">
                <i class="fas fa-user"></i>
                <span>My Profile</span>
            </a>
        </li>
        
        <li class="sidebar-item">
            <form method="POST" action="<?php echo e(route('logout')); ?>" class="w-100">
                <?php echo csrf_field(); ?>
                <button type="submit" class="sidebar-link w-100 text-start logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </li>
    </ul>
</nav>

<style>
    .sidebar-subtitle {
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.6);
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .sidebar-item {
        margin-bottom: 3px;
    }

    .sidebar-link {
        display: flex;
        align-items: center;
        padding: 14px 18px;
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        border-radius: 12px;
        transition: all 0.28s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        font-weight: 500;
        font-size: 0.95rem;
    }

    .sidebar-link:hover {
        background: rgba(255, 255, 255, 0.15);
        color: white;
        padding-left: 22px;
    }

    .sidebar-link.active {
        background: rgba(255, 255, 255, 0.25);
        color: white;
        box-shadow: inset 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .sidebar-link i {
        width: 24px;
        text-align: center;
        margin-right: 14px;
        font-size: 1.05rem;
    }

    .logout-btn {
        color: rgba(255, 255, 255, 0.7);
        border: none;
        background: none;
        cursor: pointer;
        font-family: inherit;
    }

    .logout-btn:hover {
        color: #ff6b6b;
    }
</style>
<?php /**PATH C:\xampp\htdocs\CLMFS_GROUP11 - Copy (2)\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>