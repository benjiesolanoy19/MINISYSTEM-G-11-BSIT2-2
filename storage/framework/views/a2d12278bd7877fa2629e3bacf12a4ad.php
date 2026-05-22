

<?php $__env->startSection('title', 'Notifications - ICTFE'); ?>

<?php $__env->startSection('styles'); ?>
<style>
.page-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 30px;
  padding: 30px;
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  border-radius: 15px;
  box-shadow: 0 8px 25px rgba(16, 185, 129, 0.2);
}

.page-title {
  font-size: 32px;
  font-weight: 700;
  color: white;
  margin: 0;
  display: flex;
  align-items: center;
  gap: 15px;
}

.page-title i {
  font-size: 36px;
  opacity: 0.95;
}

.page-subtitle {
  color: rgba(255, 255, 255, 0.8);
  font-size: 14px;
  margin-top: 5px;
}

.notification-controls {
  display: flex;
  gap: 12px;
  flex-wrap: wrap;
}

.btn-mark-all-read {
  background: rgba(255, 255, 255, 0.2);
  border: 2px solid white;
  color: white;
  padding: 10px 24px;
  border-radius: 10px;
  font-weight: 700;
  font-size: 14px;
  cursor: pointer;
  transition: all 0.3s ease;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}

.btn-mark-all-read:hover {
  background: white;
  color: #10b981;
}

.filter-tabs {
  display: flex;
  gap: 8px;
  margin-bottom: 20px;
  flex-wrap: wrap;
}

.filter-tab {
  padding: 8px 16px;
  border-radius: 8px;
  font-size: 0.85rem;
  font-weight: 600;
  text-decoration: none;
  color: #64748b;
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  transition: all 0.2s ease;
}

.filter-tab:hover,
.filter-tab.active {
  background: #10b981;
  color: white;
  border-color: #10b981;
}

.card {
  border: none;
  border-radius: 20px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  overflow: hidden;
  border-top: 4px solid #10b981;
}

.notification-item {
  padding: 20px;
  border-bottom: 1px solid #f1f5f9;
  transition: all 0.3s ease;
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  gap: 15px;
}

.notification-icon {
  width: 40px;
  height: 40px;
  border-radius: 10px;
  background: rgba(16, 185, 129, 0.1);
  display: flex;
  align-items: center;
  justify-content: center;
  color: #10b981;
  flex-shrink: 0;
}

.notification-item:hover {
  background: #f0fdf4;
}

.notification-item:last-child {
  border-bottom: none;
}

.notification-item.unread {
  background: #f0fdf4;
  border-left: 4px solid #10b981;
  padding-left: 16px;
}

.notification-content {
  flex: 1;
}

.notification-badge-new {
  display: inline-block;
  padding: 6px 12px;
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  color: white;
  border-radius: 20px;
  font-size: 11px;
  font-weight: 700;
  margin-bottom: 8px;
}

.notification-message {
  margin: 0;
  font-size: 15px;
  color: #1e293b;
  line-height: 1.6;
  font-weight: 500;
}

.notification-time {
  font-size: 13px;
  color: #64748b;
  margin-top: 8px;
  display: flex;
  align-items: center;
  gap: 6px;
}

.notification-time i {
  opacity: 0.7;
}

.btn-mark-read {
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  border: none;
  color: white;
  padding: 8px 16px;
  border-radius: 8px;
  font-weight: 700;
  font-size: 12px;
  cursor: pointer;
  transition: all 0.3s ease;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  white-space: nowrap;
}

.btn-mark-read:hover {
  background: linear-gradient(135deg, #059669 0%, #047857 100%);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
  color: white;
}

.notification-stats {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
  gap: 12px;
  margin-bottom: 20px;
}

.stat-badge {
  background: #f8fafc;
  padding: 12px 16px;
  border-radius: 12px;
  border: 1px solid #e2e8f0;
  text-align: center;
}

.stat-value {
  font-size: 1.5rem;
  font-weight: 700;
  color: #1e293b;
}

.stat-label {
  font-size: 0.8rem;
  color: #64748b;
  margin-top: 4px;
}

.empty-state {
  text-align: center;
  padding: 80px 20px;
  color: #64748b;
}

.empty-state i {
  font-size: 64px;
  color: #d1fae5;
  margin-bottom: 20px;
  opacity: 0.6;
}

.empty-state h4 {
  font-size: 24px;
  font-weight: 700;
  color: #1e293b;
  margin: 20px 0 10px 0;
}

.empty-state p {
  margin-bottom: 10px;
  font-size: 15px;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
  <div class="page-header" data-aos="fade-down" data-aos-duration="600">
    <div>
      <h1 class="page-title"><i class="fas fa-bell"></i>Notifications</h1>
      <p class="page-subtitle">ICTFE - Facility Management System</p>
    </div>
    <div class="notification-controls">
      <?php if($notifications->where('is_read', false)->count() > 0): ?>
      <form method="POST" action="<?php echo e(route('notifications.readAll')); ?>">
        <?php echo csrf_field(); ?>
        <button type="submit" class="btn-mark-all-read"><i class="fas fa-check-double"></i>Mark All as Read</button>
      </form>
      <?php endif; ?>
    </div>
  </div>

  <?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert" data-aos="fade-down">
      <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <!-- Notification Statistics -->
  <div class="notification-stats" data-aos="fade-up">
    <div class="stat-badge">
      <div class="stat-value"><?php echo e($notifications->where('is_read', false)->count()); ?></div>
      <div class="stat-label">Unread</div>
    </div>
    <div class="stat-badge">
      <div class="stat-value"><?php echo e($notifications->count()); ?></div>
      <div class="stat-label">Total</div>
    </div>
    <div class="stat-badge">
      <div class="stat-value"><?php echo e($notifications->where('is_read', true)->count()); ?></div>
      <div class="stat-label">Read</div>
    </div>
  </div>

  <div class="card" data-aos="fade-up" data-aos-duration="700">
    <?php if($notifications->count() > 0): ?>
        <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="notification-item <?php echo e($notification->is_read ? '' : 'unread'); ?>" data-aos="fade-up" data-aos-delay="<?php echo e($loop->index * 50); ?>">
          <div class="notification-icon">
            <i class="fas fa-info-circle"></i>
          </div>
          <div class="notification-content">
            <?php if(!$notification->is_read): ?>
              <span class="notification-badge-new"><i class="fas fa-star me-1"></i>New</span>
            <?php endif; ?>
            <p class="notification-message"><?php echo e($notification->message); ?></p>
            <p class="notification-time">
              <i class="fas fa-clock"></i>
              <?php echo e(\Carbon\Carbon::parse($notification->created_at)->format('M d, Y - h:i A')); ?>

            </p>
          </div>
          <?php if(!$notification->is_read): ?>
          <form method="POST" action="<?php echo e(route('notifications.read', $notification->id)); ?>" style="margin-left: 20px;">
            <?php echo csrf_field(); ?>
            <button type="submit" class="btn-mark-read"><i class="fas fa-check"></i>Mark Read</button>
          </form>
          <?php endif; ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <div class="empty-state">
          <i class="fas fa-inbox"></i>
          <h4>No Notifications</h4>
          <p>You're all caught up! No new notifications at this time.</p>
        </div>
    <?php endif; ?>
  </div>
</div>
<?php $__env->stopSection(); ?>
</parameter>
</create_file>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\CLMFS_GROUP11 - Copy (2)\resources\views/notifications/list.blade.php ENDPATH**/ ?>