

<?php $__env->startSection('title', 'ICTFE - Home'); ?>
<?php $__env->startSection('page-title', 'ICTFE Home'); ?>

<?php $__env->startSection('styles'); ?>
<style>
.dashboard-hero {
    border-radius: 28px;
    background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(235,245,255,0.95));
    padding: 1.4rem;
    border: 1px solid rgba(226,232,240,0.95);
}
.dashboard-header-grid {
    display: grid;
    gap: 1rem;
    align-items: stretch;
    margin-bottom: 1.5rem;
}
@media (min-width: 992px) {
    .dashboard-header-grid {
        grid-template-columns: minmax(240px, 320px) minmax(260px, 360px) 1fr;
    }
}
.time-widget,
.status-widget,
.quick-overview-card,
.hero-status-card {
    min-height: 168px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.time-widget,
.status-widget,
.quick-overview-card {
    background: rgba(255,255,255,0.95);
    border-radius: 24px;
    border: 1px solid rgba(226,232,240,0.95);
    box-shadow: 0 20px 45px rgba(15, 23, 42, 0.05);
}
.widget-head {
    display: flex;
    align-items: center;
    gap: 0.85rem;
    color: #0c4a6e;
    font-weight: 700;
    letter-spacing: 0.03em;
    margin-bottom: 0.95rem;
}
.widget-value {
    font-size: 2rem;
    font-weight: 800;
    color: #0f172a;
    line-height: 1.05;
}
.widget-meta,
.widget-role,
.widget-note {
    color: #475569;
}
.widget-meta {
    margin-top: 0.45rem;
    font-size: 0.95rem;
}
.widget-role {
    margin-top: 0.7rem;
    font-size: 0.92rem;
    font-weight: 600;
    color: #334155;
}
.status-pill {
    display: inline-flex;
    align-items: center;
    gap: 0.55rem;
    font-weight: 700;
    color: #0f172a;
    margin-top: 0.75rem;
}
.status-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #22c55e;
    box-shadow: 0 0 0 4px rgba(34,197,94,0.12);
}
.quick-overview-list {
    display: grid;
    gap: 0.9rem;
    margin-top: 1rem;
}
.quick-overview-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.95rem 1rem;
    border-radius: 18px;
    background: rgba(248,250,252,0.85);
    border: 1px solid rgba(226,232,240,0.9);
}
.quick-overview-item span:first-child {
    color: #475569;
    font-size: 0.92rem;
}
.quick-overview-item span:last-child {
    font-size: 1.15rem;
    font-weight: 700;
    color: #0f172a;
}
.section-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.45rem;
    color: #0c4a6e;
    text-transform: uppercase;
    letter-spacing: 0.18em;
    font-weight: 700;
    font-size: 0.75rem;
}
.hero-status-card {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 168px;
    background: rgba(255,255,255,0.96);
    border-radius: 24px;
    border: 1px solid rgba(226,232,240,0.95);
    padding: 1.4rem;
    box-shadow: 0 20px 45px rgba(15, 23, 42, 0.05);
}
.hero-status-label {
    font-size: 0.8rem;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: #0ea5e9;
    font-weight: 700;
}
.hero-status-value {
    font-size: 1.1rem;
    font-weight: 700;
    color: #0f172a;
}
.stats-grid {
    display: grid;
    grid-template-columns: repeat(1, minmax(0, 1fr));
    gap: 1rem;
    margin-top: 1.8rem;
}
@media (min-width: 768px) {
    .stats-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}
@media (min-width: 1200px) {
    .stats-grid {
        grid-template-columns: repeat(4, minmax(0, 1fr));
    }
}
@media (min-width: 1200px) {
    .stats-grid {
        grid-template-columns: repeat(4, minmax(0, 1fr));
    }
}
.stat-card {
    background: rgba(255,255,255,0.85);
    border: 1px solid rgba(226,232,240,0.9);
    border-radius: 16px;
    padding: 0.9rem 1rem;
    transition: transform 0.18s ease, box-shadow 0.18s ease;
    backdrop-filter: blur(6px);
}
.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 22px 54px rgba(15, 23, 42, 0.08);
}
.stat-card-title {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 0.85rem;
    color: #475569;
    margin-bottom: 0.75rem;
}
.stat-card-value {
    font-size: 1.6rem;
    font-weight: 800;
    color: #0f172a;
}
.stat-card-note {
    color: #64748b;
    margin-top: 0.7rem;
    font-size: 0.88rem;
}
.stat-card-soft {
    background: #f8fbff;
}
.section-title {
    font-size: 1.05rem;
    font-weight: 700;
    color: #0f172a;
}
.badge-pill {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.55rem 1rem;
    border-radius: 999px;
    font-size: 0.78rem;
    font-weight: 700;
}
.badge-primary {
    background: rgba(14, 165, 233, 0.12);
    color: #0c4a6e;
}
.badge-soft {
    background: rgba(15, 23, 42, 0.06);
    color: #334155;
}
.mini-metric-card {
    display: flex;
    align-items: center;
    gap: 0.85rem;
    background: #f8fbff;
    border-radius: 20px;
    padding: 1rem;
    border: 1px solid rgba(226,232,240,0.95);
}
.bg-blue-soft {
    background: rgba(14,165,233,0.08);
}
.bg-warning-soft {
    background: rgba(251,191,36,0.12);
}
.mini-metric-icon {
    width: 44px;
    height: 44px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
}
.mini-metric-label {
    font-size: 0.82rem;
    color: #475569;
    margin-bottom: 0.2rem;
}
.mini-metric-value {
    font-size: 1.6rem;
    font-weight: 700;
    color: #0f172a;
}
.chart-card {
    background: white;
    border-radius: 24px;
    border: 1px solid rgba(226,232,240,0.95);
    box-shadow: 0 20px 45px rgba(15, 23, 42, 0.04);
}
.chart-card-header {
    align-items: center;
}
.timeline-card {
    border-radius: 24px;
    border: 1px solid rgba(226,232,240,0.95);
    background: white;
    padding: 1.25rem;
    box-shadow: 0 20px 45px rgba(15, 23, 42, 0.04);
}
.timeline-step {
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 1rem;
    padding: 1rem 0;
    border-bottom: 1px solid rgba(226,232,240,0.95);
}
.timeline-step:last-child {
    border-bottom: none;
}
.timeline-dot {
    width: 14px;
    height: 14px;
    border-radius: 50%;
    margin-top: 6px;
    flex-shrink: 0;
}
.timeline-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: rgba(14,165,233,0.12);
    color: #0e7490;
    font-weight: 700;
    font-size: 0.95rem;
}
.quick-action-grid {
    display: grid;
    grid-template-columns: repeat(1, minmax(0, 1fr));
    gap: 1rem;
}
@media (min-width: 768px) {
    .quick-action-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}
@media (min-width: 1200px) {
    .quick-action-grid {
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }
}
.quick-action-card {
    border-radius: 22px;
    padding: 1.2rem;
    background: rgba(255,255,255,0.95);
    border: 1px solid rgba(226,232,240,0.95);
    transition: transform 0.18s ease, box-shadow 0.18s ease, border-color 0.18s ease;
    text-decoration: none;
    min-height: 160px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.quick-action-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 24px 60px rgba(15, 23, 42, 0.08);
    border-color: rgba(14, 165, 233, 0.3);
}
.quick-action-card .action-icon {
    width: 44px;
    height: 44px;
    border-radius: 16px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: white;
    margin-bottom: 1rem;
}
.quick-action-card .action-title {
    font-weight: 700;
    font-size: 1rem;
    margin-bottom: 0.5rem;
    color: #0f172a;
}
.quick-action-card .action-subtitle {
    color: #475569;
    font-size: 0.92rem;
    line-height: 1.5;
}
.notification-avatar {
    min-width: 42px;
    min-height: 42px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: rgba(14,165,233,0.12);
    color: #0c4a6e;
    font-weight: 700;
    font-size: 0.95rem;
}
.notification-preview-item {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.notification-preview-item:hover {
    transform: translateY(-1px);
    box-shadow: 0 14px 35px rgba(15, 23, 42, 0.06);
}
.notification-preview-item.unread {
    border-color: rgba(14,165,233,0.3);
    background: rgba(14,165,233,0.06);
}
.empty-state {
    padding: 2.5rem;
    text-align: center;
    border-radius: 24px;
    border: 1px dashed rgba(148,163,184,0.5);
    background: rgba(255,255,255,0.95);
}
.empty-state i {
    font-size: 2.5rem;
    color: #0ea5e9;
}
.table-responsive {
    overflow-x: auto;
}
.table th,
.table td {
    vertical-align: middle;
}
.hero-meta-pill i,
.stat-card-title i,
.mini-metric-icon i {
    width: 18px;
    text-align: center;
}
@media (max-width: 767.98px) {
    .hero-status-card {
        width: 100%;
    }
    .quick-action-grid {
        grid-template-columns: 1fr;
    }
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="card-modern dashboard-hero hover-lift">
                <div class="dashboard-header-grid">
                    <div class="time-widget p-4 hover-lift">
                        <div class="widget-head"><i class="fas fa-clock text-primary"></i> Current Time</div>
                        <div class="widget-value" id="compactTime"><?php echo e(now()->format('g:i A')); ?></div>
                        <div class="widget-meta"><i class="fas fa-calendar-day"></i> <span id="compactDate"><?php echo e(now()->format('F j, Y')); ?></span></div>
                        <div class="widget-role"><i class="fas fa-user-tag"></i> <?php echo e(ucfirst($user->role)); ?></div>
                    </div>
                    <div class="status-widget p-4 hover-lift">
                        <div class="widget-head"><i class="fas fa-desktop text-success"></i> System Status</div>
                        <div class="status-pill"><span class="status-dot"></span> Live & Smooth</div>
                        <p class="widget-note"><?php echo e($reasonMessage); ?></p>
                    </div>
                    <div class="quick-overview-card p-4 hover-lift">
                        <div class="widget-head"><i class="fas fa-chart-simple text-info"></i> Quick Overview</div>
                        <div class="quick-overview-list">
                            <div class="quick-overview-item"><span>Total equipment</span><span><?php echo e($totalEquipment); ?></span></div>
                            <div class="quick-overview-item"><span>Available</span><span><?php echo e($availableEquipment); ?></span></div>
                            <div class="quick-overview-item"><span>Pending requests</span><span><?php echo e($pendingApprovals); ?></span></div>
                            <div class="quick-overview-item"><span>Overdue items</span><span><?php echo e($overdueEquipment); ?></span></div>
                        </div>
                    </div>
                </div>

                <div class="stats-grid">
                    <div class="stat-card stat-card-soft">
                        <div class="stat-card-title"><i class="fas fa-boxes"></i> Total equipment</div>
                        <div class="stat-card-value"><?php echo e($totalEquipment); ?></div>
                        <div class="stat-card-note">Full inventory in the system</div>
                    </div>
                    <div class="stat-card stat-card-soft">
                        <div class="stat-card-title"><i class="fas fa-check-circle"></i> Available</div>
                        <div class="stat-card-value"><?php echo e($availableEquipment); ?></div>
                        <div class="stat-card-note">Ready to borrow</div>
                    </div>
                    <div class="stat-card stat-card-soft">
                        <div class="stat-card-title"><i class="fas fa-hand-holding-box"></i> Borrowed</div>
                        <div class="stat-card-value"><?php echo e($borrowedEquipment); ?></div>
                        <div class="stat-card-note">Currently in use</div>
                    </div>
                    <div class="stat-card stat-card-soft">
                        <div class="stat-card-title"><i class="fas fa-hourglass-half"></i> Pending requests</div>
                        <div class="stat-card-value"><?php echo e($pendingApprovals); ?></div>
                        <div class="stat-card-note">Awaiting staff action</div>
                    </div>
                    <div class="stat-card stat-card-soft">
                        <div class="stat-card-title"><i class="fas fa-undo-alt"></i> Return requests</div>
                        <div class="stat-card-value"><?php echo e($returnRequests); ?></div>
                        <div class="stat-card-note">Processing returns</div>
                    </div>
                    <div class="stat-card stat-card-soft">
                        <div class="stat-card-title"><i class="fas fa-user-friends"></i> Active users</div>
                        <div class="stat-card-value"><?php echo e($activeUsers); ?></div>
                        <div class="stat-card-note">Participants in the system</div>
                    </div>
                    <div class="stat-card stat-card-soft">
                        <div class="stat-card-title"><i class="fas fa-bug"></i> Incident reports</div>
                        <div class="stat-card-value"><?php echo e($incidentReports); ?></div>
                        <div class="stat-card-note">Open and logged issues</div>
                    </div>
                    <div class="stat-card stat-card-soft">
                        <div class="stat-card-title"><i class="fas fa-exclamation-triangle"></i> Overdue items</div>
                        <div class="stat-card-value"><?php echo e($overdueEquipment); ?></div>
                        <div class="stat-card-note">Need follow-up</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-3">
        <div class="col-xl-8">
            <div class="card-modern p-4 hover-lift">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
                    <div>
                        <h5 class="section-title mb-1">Analytics overview</h5>
                        <p class="text-muted small mb-0">Fresh insight into borrowing and incident patterns.</p>
                    </div>
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <span class="badge-pill badge-primary">Trends</span>
                        <span class="badge-pill badge-soft">Updated now</span>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-sm-6">
                        <div class="mini-metric-card bg-blue-soft">
                            <div class="mini-metric-icon text-primary"><i class="fas fa-hourglass-half"></i></div>
                            <div>
                                <div class="mini-metric-label">Pending requests</div>
                                <div class="mini-metric-value"><?php echo e($pendingApprovals); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mini-metric-card bg-warning-soft">
                            <div class="mini-metric-icon text-warning"><i class="fas fa-undo-alt"></i></div>
                            <div>
                                <div class="mini-metric-label">Return requests</div>
                                <div class="mini-metric-value"><?php echo e($returnRequests); ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-lg-12">
                        <div class="chart-card p-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h6 class="mb-1 fw-semibold">System insights</h6>
                                    <p class="text-muted small mb-0">Quick operational snapshot</p>
                                </div>
                                <span class="badge-pill badge-soft">Updated now</span>
                            </div>
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <div class="mini-metric-card bg-blue-soft h-100">
                                        <div class="mini-metric-icon text-primary"><i class="fas fa-clipboard-check"></i></div>
                                        <div>
                                            <div class="mini-metric-label">Recent borrow requests</div>
                                            <div class="mini-metric-value"><?php echo e($recentBorrowRequestsCount ?? 0); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mini-metric-card bg-warning-soft h-100">
                                        <div class="mini-metric-icon text-warning"><i class="fas fa-people-group"></i></div>
                                        <div>
                                            <div class="mini-metric-label">Active users</div>
                                            <div class="mini-metric-value"><?php echo e($activeUsers); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mini-metric-card bg-blue-soft h-100">
                                        <div class="mini-metric-icon text-primary"><i class="fas fa-boxes"></i></div>
                                        <div>
                                            <div class="mini-metric-label">Available equipment</div>
                                            <div class="mini-metric-value"><?php echo e($availableEquipment); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mini-metric-card bg-warning-soft h-100">
                                        <div class="mini-metric-icon text-warning"><i class="fas fa-exclamation-triangle"></i></div>
                                        <div>
                                            <div class="mini-metric-label">Recent incident reports</div>
                                            <div class="mini-metric-value"><?php echo e($recentIncidentReportsCount ?? 0); ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-modern p-4 hover-lift mt-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="section-title mb-1">Recent activity</h5>
                        <p class="text-muted small mb-0">Your latest requests and borrow updates.</p>
                    </div>
                    <a href="<?php echo e(route('borrowings.index')); ?>" class="btn btn-sm btn-outline-primary rounded-pill">View all</a>
                </div>
                <div class="timeline-card">
                    <?php $__empty_1 = true; $__currentLoopData = $borrowings->take(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $borrowing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="timeline-step">
                            <div class="timeline-dot bg-<?php echo e($borrowing->status === 'approved' ? 'success' : ($borrowing->status === 'pending' ? 'warning' : ($borrowing->status === 'overdue' ? 'danger' : 'secondary'))); ?>"></div>
                            <div>
                                <div class="d-flex justify-content-between align-items-start gap-3 mb-1">
                                    <div>
                                        <div class="fw-semibold"><?php echo e($borrowing->equipment->name); ?></div>
                                        <small class="text-muted"><?php echo e(optional($borrowing->borrow_date)->format('M d, Y') ?? 'N/A'); ?></small>
                                    </div>
                                    <span class="badge badge-pill badge-<?php echo e($borrowing->status === 'approved' ? 'success' : ($borrowing->status === 'pending' ? 'warning' : ($borrowing->status === 'overdue' ? 'danger' : 'secondary'))); ?>"><?php echo e(ucfirst($borrowing->status)); ?></span>
                                </div>
                                <p class="text-muted mb-2"><?php echo e(Str::limit($borrowing->purpose ?? 'No purpose provided', 90)); ?></p>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="timeline-avatar"><?php echo e(strtoupper(substr(optional($borrowing->student)->name ?? $user->name, 0, 1))); ?></span>
                                    <small class="text-muted"><?php echo e(optional($borrowing->borrow_date)->diffForHumans() ?? 'Just now'); ?></small>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="empty-state">
                            <i class="fas fa-history"></i>
                            <h5 class="mt-3">No recent activity yet</h5>
                            <p class="text-muted">Your borrowing history and actions will appear here.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card-modern p-4 hover-lift mb-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="section-title mb-1">Quick actions</h5>
                        <p class="text-muted small mb-0">Jump into core workflows.</p>
                    </div>
                </div>
                <div class="quick-action-grid">
                    <?php if($user->role === 'staff'): ?>
                        <a href="<?php echo e(route('staff.pending-requests')); ?>" class="quick-action-card">
                            <div class="action-icon bg-primary"><i class="fas fa-clipboard-check"></i></div>
                            <div>
                                <div class="action-title">Review requests</div>
                                <div class="action-subtitle">Approve borrowings</div>
                            </div>
                        </a>
                        <a href="<?php echo e(route('equipment.index')); ?>" class="quick-action-card">
                            <div class="action-icon bg-info"><i class="fas fa-cogs"></i></div>
                            <div>
                                <div class="action-title">View inventory</div>
                                <div class="action-subtitle">Manage equipment</div>
                            </div>
                        </a>
                        <a href="<?php echo e(route('incidents.index')); ?>" class="quick-action-card">
                            <div class="action-icon bg-warning"><i class="fas fa-exclamation-triangle"></i></div>
                            <div>
                                <div class="action-title">Incident reports</div>
                                <div class="action-subtitle">Review issues</div>
                            </div>
                        </a>
                        <a href="<?php echo e(route('borrowings.return-equipment')); ?>" class="quick-action-card">
                            <div class="action-icon bg-success"><i class="fas fa-undo"></i></div>
                            <div>
                                <div class="action-title">Return management</div>
                                <div class="action-subtitle">Verify returns</div>
                            </div>
                        </a>
                        <a href="<?php echo e(route('notifications.index')); ?>" class="quick-action-card">
                            <div class="action-icon bg-secondary"><i class="fas fa-chart-line"></i></div>
                            <div>
                                <div class="action-title">Reports</div>
                                <div class="action-subtitle">View analytics</div>
                            </div>
                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(route('borrowings.create')); ?>" class="quick-action-card">
                            <div class="action-icon bg-primary"><i class="fas fa-plus"></i></div>
                            <div>
                                <div class="action-title">Request equipment</div>
                                <div class="action-subtitle">Create a borrowing</div>
                            </div>
                        </a>
                        <a href="<?php echo e(route('borrowings.index')); ?>" class="quick-action-card">
                            <div class="action-icon bg-info"><i class="fas fa-list"></i></div>
                            <div>
                                <div class="action-title">My borrowings</div>
                                <div class="action-subtitle">Track progress</div>
                            </div>
                        </a>
                        <a href="<?php echo e(route('incidents.report')); ?>" class="quick-action-card">
                            <div class="action-icon bg-warning"><i class="fas fa-exclamation-circle"></i></div>
                            <div>
                                <div class="action-title">Report issue</div>
                                <div class="action-subtitle">Log equipment faults</div>
                            </div>
                        </a>
                        <a href="<?php echo e(route('bug-reports.create')); ?>" class="quick-action-card">
                            <div class="action-icon bg-danger"><i class="fas fa-bug"></i></div>
                            <div>
                                <div class="action-title">Report bug</div>
                                <div class="action-subtitle">Send feedback to admin</div>
                            </div>
                        </a>
                        <a href="<?php echo e(route('notifications.index')); ?>" class="quick-action-card">
                            <div class="action-icon bg-success"><i class="fas fa-bell"></i></div>
                            <div>
                                <div class="action-title">Notifications</div>
                                <div class="action-subtitle">Recent updates</div>
                            </div>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card-modern p-4 hover-lift">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="section-title mb-1">Notifications</h5>
                        <p class="text-muted small mb-0">Latest alerts and unread updates.</p>
                    </div>
                    <a href="<?php echo e(route('notifications.index')); ?>" class="text-primary small">See all</a>
                </div>
                <div class="notifications-preview">
                    <?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="notification-preview-item <?php echo e($notification->is_read ? '' : 'unread'); ?>">
                            <div class="notification-avatar"><?php echo e(strtoupper(substr($notification->title ?? 'N', 0, 1))); ?></div>
                            <div class="grow">
                                <div class="d-flex justify-content-between align-items-start gap-2 mb-1">
                                    <div>
                                        <div class="notification-title"><?php echo e(Str::limit($notification->title ?? 'Notification', 45)); ?></div>
                                    </div>
                                    <small class="notification-time"><?php echo e($notification->created_at->diffForHumans()); ?></small>
                                </div>
                                <p class="text-muted small mb-0"><?php echo e(Str::limit($notification->message, 80)); ?></p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="empty-state">
                            <i class="fas fa-bell-slash"></i>
                            <h5 class="mt-3">No notifications yet</h5>
                            <p class="text-muted">We will show important updates here.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-2">
        <div class="col-lg-6">
            <div class="card-modern p-4 hover-lift">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="section-title mb-1">Active borrowings</h5>
                        <p class="text-muted small mb-0">Track the most recent loans.</p>
                    </div>
                    <a href="<?php echo e(route('borrowings.index')); ?>" class="btn btn-sm btn-outline-primary rounded-pill">View all</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-borderless align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="text-muted small">Equipment</th>
                                <th class="text-muted small">Status</th>
                                <th class="text-muted small">Due date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $borrowings->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $borrowing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><span class="fw-semibold"><?php echo e($borrowing->equipment->name); ?></span></td>
                                    <td><span class="badge bg-<?php echo e($borrowing->status === 'approved' ? 'success' : ($borrowing->status === 'pending' ? 'warning' : 'secondary')); ?> bg-opacity-15 text-<?php echo e($borrowing->status === 'approved' ? 'success' : ($borrowing->status === 'pending' ? 'warning' : 'secondary')); ?> rounded-pill"><?php echo e(ucfirst($borrowing->status)); ?></span></td>
                                    <td><small class="text-muted"><?php echo e(optional($borrowing->return_date)->format('M d, Y') ?? 'N/A'); ?></small></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">No active borrowings</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card-modern p-4 hover-lift">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="section-title mb-1">Recent incidents</h5>
                        <p class="text-muted small mb-0">Latest equipment issue reports.</p>
                    </div>
                    <a href="<?php echo e(route('incidents.index')); ?>" class="btn btn-sm btn-outline-danger rounded-pill">View all</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-borderless align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="text-muted small">Type</th>
                                <th class="text-muted small">Severity</th>
                                <th class="text-muted small">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $incidents->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $incident): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><span class="fw-semibold"><?php echo e($incident->type); ?></span></td>
                                    <td><span class="badge bg-<?php echo e($incident->severity === 'high' ? 'danger' : ($incident->severity === 'medium' ? 'warning' : 'info')); ?> bg-opacity-15 text-<?php echo e($incident->severity === 'high' ? 'danger' : ($incident->severity === 'medium' ? 'warning' : 'info')); ?> rounded-pill"><?php echo e(ucfirst($incident->severity)); ?></span></td>
                                    <td><span class="badge bg-<?php echo e($incident->status === 'closed' ? 'success' : 'warning'); ?> bg-opacity-15 text-<?php echo e($incident->status === 'closed' ? 'success' : 'warning'); ?> rounded-pill"><?php echo e(ucfirst($incident->status)); ?></span></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">No incidents reported</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    function getGreeting(hour) {
        if (hour < 12) return 'Good Morning';
        if (hour < 17) return 'Good Afternoon';
        return 'Good Evening';
    }

    function updateDashboardHeader() {
        const now = new Date();
        const timeEl = document.getElementById('compactTime');
        const dateEl = document.getElementById('compactDate');
        if (timeEl) timeEl.textContent = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        if (dateEl) dateEl.textContent = now.toLocaleDateString([], { month: 'long', day: 'numeric', year: 'numeric' });
    }

    function renderChart(id, labels, data, color) {
        const ctx = document.getElementById(id);
        if (!ctx) return;

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels.length ? labels : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Count',
                    data: data.length ? data : [0, 0, 0, 0, 0, 0],
                    borderColor: color,
                    backgroundColor: color.replace('rgb(', 'rgba(').replace(')', ', 0.16)'),
                    fill: true,
                    tension: 0.32,
                    pointRadius: 4,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: color,
                }]
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: '#64748b' }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(226,232,240,0.9)' },
                        ticks: { color: '#64748b', precision: 0 }
                    }
                }
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        updateDashboardHeader();
        setInterval(updateDashboardHeader, 1000);


    });
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\CLMFS_GROUP11 - Copy (2)\resources\views/dashboard/home.blade.php ENDPATH**/ ?>