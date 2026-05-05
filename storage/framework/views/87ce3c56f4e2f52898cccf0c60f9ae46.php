<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('page-title', 'Dashboard'); ?>

<?php $__env->startSection('styles'); ?>
<style>
/* Enhanced Dashboard Styles */
.hero-banner {
    background: linear-gradient(135deg, #0ea5e9 0%, #10b981 50%, #0284c7 100%);
    border-radius: 20px;
    position: relative;
    overflow: hidden;
}

.hero-stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    margin-top: 20px;
}

.stat-circle {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    width: 80px;
    height: 80px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
}

.stat-number {
    font-size: 1.5rem;
    font-weight: 700;
    color: white;
    line-height: 1;
}

.stat-label {
    font-size: 0.7rem;
    color: rgba(255, 255, 255, 0.8);
    text-align: center;
    margin-top: 2px;
}

.hero-pattern {
    position: absolute;
    top: 0;
    right: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
}

.pattern-circle {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
}

.pattern-circle-1 {
    width: 200px;
    height: 200px;
    top: -100px;
    right: -50px;
}

.pattern-circle-2 {
    width: 150px;
    height: 150px;
    top: 50%;
    right: 10%;
}

.pattern-circle-3 {
    width: 100px;
    height: 100px;
    bottom: -30px;
    right: 20%;
}

.stats-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 15px;
}

.stat-item-modern {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px;
    background: rgba(14, 165, 233, 0.05);
    border-radius: 12px;
    border: 1px solid rgba(14, 165, 233, 0.1);
}

.stat-icon {
    width: 45px;
    height: 45px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

.stat-content {
    flex: 1;
}

.stat-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1e293b;
    line-height: 1;
}

.stat-label {
    font-size: 0.8rem;
    color: #64748b;
    margin-top: 2px;
}

.activity-timeline {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.activity-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px;
    background: #f8fafc;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    transition: all 0.2s ease;
}

.activity-item:hover {
    background: #f1f5f9;
    border-color: #cbd5e1;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: linear-gradient(135deg, #0ea5e9, #10b981);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1rem;
}

.activity-content {
    flex: 1;
}

.activity-title {
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 4px;
}

.activity-meta {
    font-size: 0.8rem;
    color: #64748b;
}

.activity-time {
    font-size: 0.75rem;
    color: #94a3b8;
    white-space: nowrap;
}

.quick-actions-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
}

.quick-action-card {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 15px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    text-decoration: none;
    color: #1e293b;
    transition: all 0.2s ease;
}

.quick-action-card:hover {
    background: #f1f5f9;
    border-color: #0ea5e9;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(14, 165, 233, 0.15);
}

.action-icon {
    width: 35px;
    height: 35px;
    border-radius: 8px;
    background: linear-gradient(135deg, #0ea5e9, #10b981);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.9rem;
}

.action-content {
    flex: 1;
}

.action-title {
    font-weight: 600;
    font-size: 0.9rem;
    margin-bottom: 2px;
}

.action-subtitle {
    font-size: 0.75rem;
    color: #64748b;
}

.notifications-preview {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.notification-preview-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
    background: #f8fafc;
    border-radius: 10px;
    border: 1px solid #e2e8f0;
}

.notification-preview-item.unread {
    background: rgba(16, 185, 129, 0.05);
    border-color: rgba(16, 185, 129, 0.2);
}

.notification-icon {
    width: 30px;
    height: 30px;
    border-radius: 8px;
    background: rgba(14, 165, 233, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #0ea5e9;
    font-size: 0.8rem;
}

.notification-content {
    flex: 1;
}

.notification-title {
    font-size: 0.85rem;
    font-weight: 500;
    color: #1e293b;
    margin-bottom: 2px;
}

.notification-time {
    font-size: 0.7rem;
    color: #64748b;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .hero-stats-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }

    .stat-circle {
        width: 60px;
        height: 60px;
    }

    .stat-number {
        font-size: 1.2rem;
    }

    .stat-label {
        font-size: 0.6rem;
    }

    .quick-actions-grid {
        grid-template-columns: 1fr;
    }
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <!-- Welcome Hero Section -->
    <div class="row g-4 align-items-center mb-5">
        <div class="col-xl-9">
            <div class="card-modern p-4 hero-banner position-relative overflow-hidden">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <span class="badge bg-white text-primary mb-3 px-3 py-2 rounded-pill">Welcome back</span>
                        <h1 class="display-5 text-white mb-3 fw-bold">Hello, <?php echo e($user->name); ?>.</h1>
                        <?php if($user->role === 'staff'): ?>
                            <p class="text-white-75 fs-5 mb-4">Quickly oversee equipment approvals, track usage, and manage incident response with clarity.</p>
                        <?php else: ?>
                            <p class="text-white-75 fs-5 mb-4">Access borrowings, equipment availability, and alerts in one clean, organized dashboard.</p>
                        <?php endif; ?>
                        <div class="d-flex flex-wrap gap-3">
                            <?php if($user->role === 'staff'): ?>
                                <a href="<?php echo e(route('borrowings.index')); ?>" class="btn btn-light btn-lg px-4 py-3 rounded-pill fw-semibold">
                                    <i class="fas fa-clipboard-check me-2"></i>Review Borrowings
                                </a>
                                <a href="<?php echo e(route('equipment.index')); ?>" class="btn btn-light btn-lg px-4 py-3 rounded-pill fw-semibold">
                                    <i class="fas fa-cogs me-2"></i>Manage Equipment
                                </a>
                            <?php else: ?>
                                <a href="<?php echo e(route('borrowings.create')); ?>" class="btn btn-light btn-lg px-4 py-3 rounded-pill fw-semibold">
                                    <i class="fas fa-plus me-2"></i>Borrow Equipment
                                </a>
                                <a href="<?php echo e(route('equipment.index')); ?>" class="btn btn-light btn-lg px-4 py-3 rounded-pill fw-semibold">
                                    <i class="fas fa-list me-2"></i>View Equipment
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-5 mt-4 mt-lg-0 text-center">
                        <div class="hero-stats-grid">
                            <div class="stat-circle">
                                <div class="stat-number"><?php echo e($borrowings->count()); ?></div>
                                <div class="stat-label">Active Borrowings</div>
                            </div>
                            <div class="stat-circle">
                                <div class="stat-number"><?php echo e($unreadCount); ?></div>
                                <div class="stat-label">Notifications</div>
                            </div>
                            <div class="stat-circle">
                                <div class="stat-number"><?php echo e($incidents->count()); ?></div>
                                <div class="stat-label">Incidents</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Background Pattern -->
                <div class="hero-pattern">
                    <div class="pattern-circle pattern-circle-1"></div>
                    <div class="pattern-circle pattern-circle-2"></div>
                    <div class="pattern-circle pattern-circle-3"></div>
                </div>
            </div>
        </div>

        <!-- Quick Stats Card -->
        <div class="col-xl-3">
            <div class="card-modern p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="mb-1 fw-bold">System Overview</h5>
                        <p class="text-muted small mb-0">Real-time statistics</p>
                    </div>
                    <span class="badge bg-primary bg-opacity-15 text-primary py-2 px-3 rounded-pill">Live</span>
                </div>

                <div class="stats-grid">
                    <div class="stat-item-modern">
                        <div class="stat-icon">
                            <i class="fas fa-laptop text-primary"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value"><?php echo e(\App\Models\Equipment::count()); ?></div>
                            <div class="stat-label">Total Equipment</div>
                        </div>
                    </div>
                    <div class="stat-item-modern">
                        <div class="stat-icon">
                            <i class="fas fa-users text-success"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value"><?php echo e(\App\Models\User::count()); ?></div>
                            <div class="stat-label">Active Users</div>
                        </div>
                    </div>
                    <div class="stat-item-modern">
                        <div class="stat-icon">
                            <i class="fas fa-clock text-warning"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value"><?php echo e($borrowings->where('status', 'pending')->count()); ?></div>
                            <div class="stat-label">Pending Requests</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Dashboard Grid -->
    <div class="row g-4">
        <!-- Recent Activity -->
        <div class="col-xl-8">
            <div class="card-modern p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="mb-1 fw-bold">
                            <i class="fas fa-history text-primary me-2"></i>Recent Activity
                        </h5>
                        <p class="text-muted small mb-0">Your latest borrowings and system updates</p>
                    </div>
                    <a href="<?php echo e(route('borrowings.index')); ?>" class="btn btn-outline-primary btn-sm rounded-pill">
                        View All
                    </a>
                </div>

                <div class="activity-timeline">
                    <?php $__empty_1 = true; $__currentLoopData = $borrowings->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $borrowing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-laptop text-primary"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">
                                Borrowed <?php echo e($borrowing->equipment->name); ?>

                                <span class="badge bg-<?php echo e($borrowing->status === 'approved' ? 'success' : ($borrowing->status === 'pending' ? 'warning' : 'secondary')); ?> bg-opacity-15 text-<?php echo e($borrowing->status === 'approved' ? 'success' : ($borrowing->status === 'pending' ? 'warning' : 'secondary')); ?> ms-2">
                                    <?php echo e(ucfirst($borrowing->status)); ?>

                                </span>
                            </div>
                            <div class="activity-meta">
                                <span><?php echo e($borrowing->borrow_date->format('M d, Y')); ?></span>
                                <?php if($borrowing->purpose): ?>
                                <span class="mx-2">•</span>
                                <span><?php echo e(Str::limit($borrowing->purpose, 40)); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="activity-time">
                            <?php echo e($borrowing->borrow_date->diffForHumans()); ?>

                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <h6 class="text-muted">No recent activity</h6>
                        <p class="text-muted small">Your borrowing history will appear here</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Quick Actions & Notifications -->
        <div class="col-xl-4">
            <div class="row g-4">
                <!-- Quick Actions -->
                <div class="col-12">
                    <div class="card-modern p-4">
                        <h5 class="mb-1 fw-bold">
                            <i class="fas fa-bolt text-warning me-2"></i>Quick Actions
                        </h5>
                        <p class="text-muted small mb-4">Frequently used features</p>

                        <div class="quick-actions-grid">
                            <?php if($user->role === 'staff'): ?>
                                <a href="<?php echo e(route('borrowings.index')); ?>" class="quick-action-card">
                                    <div class="action-icon">
                                        <i class="fas fa-clipboard-check"></i>
                                    </div>
                                    <div class="action-content">
                                        <div class="action-title">Review Requests</div>
                                        <div class="action-subtitle">Approve borrowings</div>
                                    </div>
                                </a>
                                <a href="<?php echo e(route('equipment.index')); ?>" class="quick-action-card">
                                    <div class="action-icon">
                                        <i class="fas fa-cogs"></i>
                                    </div>
                                    <div class="action-content">
                                        <div class="action-title">Equipment</div>
                                        <div class="action-subtitle">Manage inventory</div>
                                    </div>
                                </a>
                                <a href="<?php echo e(route('incidents.index')); ?>" class="quick-action-card">
                                    <div class="action-icon">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <div class="action-content">
                                        <div class="action-title">Incidents</div>
                                        <div class="action-subtitle">Handle reports</div>
                                    </div>
                                </a>
                                <a href="<?php echo e(route('logs.index')); ?>" class="quick-action-card">
                                    <div class="action-icon">
                                        <i class="fas fa-history"></i>
                                    </div>
                                    <div class="action-content">
                                        <div class="action-title">Activity Logs</div>
                                        <div class="action-subtitle">System history</div>
                                    </div>
                                </a>
                            <?php else: ?>
                                <a href="<?php echo e(route('borrowings.create')); ?>" class="quick-action-card">
                                    <div class="action-icon">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                    <div class="action-content">
                                        <div class="action-title">New Borrowing</div>
                                        <div class="action-subtitle">Request equipment</div>
                                    </div>
                                </a>
                                <a href="<?php echo e(route('borrowings.index')); ?>" class="quick-action-card">
                                    <div class="action-icon">
                                        <i class="fas fa-list"></i>
                                    </div>
                                    <div class="action-content">
                                        <div class="action-title">My Borrowings</div>
                                        <div class="action-subtitle">Track requests</div>
                                    </div>
                                </a>
                                <a href="<?php echo e(route('incidents.report')); ?>" class="quick-action-card">
                                    <div class="action-icon">
                                        <i class="fas fa-exclamation-circle"></i>
                                    </div>
                                    <div class="action-content">
                                        <div class="action-title">Report Issue</div>
                                        <div class="action-subtitle">Equipment problems</div>
                                    </div>
                                </a>
                                <a href="<?php echo e(route('profile.index')); ?>" class="quick-action-card">
                                    <div class="action-icon">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="action-content">
                                        <div class="action-title">Profile</div>
                                        <div class="action-subtitle">Account settings</div>
                                    </div>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Recent Notifications -->
                <div class="col-12">
                    <div class="card-modern p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h5 class="mb-1 fw-bold">
                                    <i class="fas fa-bell text-info me-2"></i>Notifications
                                </h5>
                                <p class="text-muted small mb-0">Latest updates</p>
                            </div>
                            <a href="<?php echo e(route('notifications.index')); ?>" class="btn btn-outline-info btn-sm rounded-pill">
                                View All
                            </a>
                        </div>

                        <div class="notifications-preview">
                            <?php $__empty_1 = true; $__currentLoopData = $notifications->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="notification-preview-item <?php echo e($notification->is_read ? '' : 'unread'); ?>">
                                <div class="notification-icon">
                                    <i class="fas fa-info-circle text-info"></i>
                                </div>
                                <div class="notification-content">
                                    <div class="notification-title"><?php echo e(Str::limit($notification->message, 50)); ?></div>
                                    <div class="notification-time"><?php echo e($notification->created_at->diffForHumans()); ?></div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="text-center py-3">
                                <i class="fas fa-bell-slash fa-2x text-muted mb-2"></i>
                                <p class="text-muted small mb-0">No new notifications</p>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\CLMFS_GROUP11 - Copy - Copy\resources\views/dashboard/home.blade.php ENDPATH**/ ?>