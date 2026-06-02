

<?php $__env->startSection('title', 'Messenger'); ?>

<?php $__env->startSection('styles'); ?>
<style>
.messenger-shell {
  display: grid;
  grid-template-columns: minmax(340px, 380px) 1fr;
  gap: 24px;
}

.messenger-sidebar {
  border-radius: 28px;
  overflow: hidden;
  background: rgba(255, 255, 255, 0.95);
  border: 1px solid rgba(226, 232, 240, 0.95);
  box-shadow: 0 24px 70px rgba(15, 23, 42, 0.08);
}

.sidebar-header {
  padding: 24px;
  background: linear-gradient(180deg, rgba(59, 130, 246, 0.95), rgba(96, 165, 250, 0.96));
  color: white;
}

.sidebar-header h2 {
  margin-bottom: 8px;
  font-size: 1.4rem;
}

.sidebar-search {
  padding: 18px 24px;
}

.sidebar-search input {
  width: 100%;
  border-radius: 16px;
  border: 1px solid rgba(226,232,240,0.95);
  padding: 14px 16px;
}

.sidebar-section {
  padding: 0 24px 24px;
}

.sidebar-section h6 {
  margin-bottom: 16px;
  color: #475569;
  font-size: 0.82rem;
  letter-spacing: 0.12em;
  text-transform: uppercase;
}

.conversation-list {
  display: grid;
  gap: 12px;
}

.conversation-item {
  display: grid;
  grid-template-columns: 1fr auto;
  gap: 12px;
  align-items: center;
  width: 100%;
  padding: 16px 18px;
  border-radius: 18px;
  border: 1px solid rgba(226,232,240,0.95);
  background: white;
  text-decoration: none;
  color: inherit;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.conversation-item:hover {
  transform: translateY(-2px);
  box-shadow: 0 14px 32px rgba(15,23,42,0.08);
}

.conversation-avatar {
  width: 46px;
  height: 46px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(59, 130, 246, 0.12);
  color: #1e3a8a;
  font-weight: 700;
  font-size: 1rem;
  flex-shrink: 0;
}

.conversation-details {
  min-width: 0;
}

.conversation-name {
  font-weight: 700;
  margin-bottom: 4px;
}

.conversation-preview {
  color: #64748b;
  font-size: 0.9rem;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.conversation-meta {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  gap: 6px;
  text-align: right;
}

.conversation-meta .timestamp {
  font-size: 0.78rem;
  color: #94a3b8;
}

.badge-role,
.badge-unread {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 0.35rem 0.7rem;
  border-radius: 999px;
  font-size: 0.78rem;
  font-weight: 700;
}

.badge-role.admin { background: #eff6ff; color: #1d4ed8; }
.badge-role.staff { background: #ecfdf5; color: #166534; }
.badge-role.student { background: #f8fafc; color: #334155; }
.badge-unread {
  background: #e0f2fe;
  color: #1d4ed8;
}

.online-dot {
  width: 10px;
  height: 10px;
  border-radius: 50%;
  background: #22c55e;
  margin-right: 8px;
}

.messenger-main {
  border-radius: 28px;
  background: rgba(255,255,255,0.95);
  border: 1px solid rgba(226,232,240,0.95);
  box-shadow: 0 24px 70px rgba(15,23,42,0.08);
  padding: 40px;
  min-height: 720px;
}

.messenger-placeholder {
  min-height: 520px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
  color: #64748b;
}

.messenger-placeholder i {
  font-size: 4rem;
  color: #cbd5e1;
  margin-bottom: 20px;
}

.messenger-placeholder h4 {
  font-size: 1.75rem;
  margin-bottom: 12px;
}

.messenger-placeholder p {
  max-width: 520px;
}

.btn-report-bug {
  background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%);
  border: none;
  color: white;
  padding: 14px 24px;
  border-radius: 16px;
  font-weight: 700;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
  <div class="d-flex align-items-center justify-content-between mb-4" data-aos="fade-down" data-aos-duration="600">
    <div>
      <h1 class="h3 mb-1"><i class="fas fa-comments"></i> Messenger</h1>
      <p class="text-muted mb-0">Direct conversations between students, staff, and administrators only.</p>
    </div>
    <a href="<?php echo e(route('bug-reports.create')); ?>" class="btn-report-bug btn btn-lg"><i class="fas fa-bug me-2"></i>Report a Bug</a>
  </div>

  <div class="messenger-shell" data-aos="fade-up" data-aos-duration="700">
    <aside class="messenger-sidebar">
      <div class="sidebar-header">
        <h2>Chats</h2>
        <p>Search contacts and continue your private conversations.</p>
      </div>

      <div class="sidebar-search">
        <form method="GET" action="<?php echo e(route('messages.index')); ?>">
          <input type="search" name="search" value="<?php echo e($search ?? ''); ?>" placeholder="Search contacts...">
        </form>
      </div>

      <div class="sidebar-section">
        <h6>Administrators</h6>
        <div class="conversation-list">
          <?php $__empty_1 = true; $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <a href="<?php echo e(route('messages.show', $item['contact']->id)); ?>" class="conversation-item">
              <div class="d-flex align-items-center gap-3">
                <div class="online-dot"></div>
                <div class="conversation-avatar"><?php echo e(strtoupper(substr($item['contact']->name, 0, 1))); ?></div>
                <div class="conversation-details">
                  <div class="conversation-name"><?php echo e($item['contact']->name); ?></div>
                  <div class="conversation-preview"><?php echo e($item['preview']); ?></div>
                </div>
              </div>
              <div class="conversation-meta">
                <?php if($item['time']): ?><div class="timestamp"><?php echo e($item['time']); ?></div><?php endif; ?>
                <?php if($item['unread'] > 0): ?><span class="badge-unread"><?php echo e($item['unread']); ?></span><?php endif; ?>
              </div>
            </a>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-muted">No administrators available.</div>
          <?php endif; ?>
        </div>
      </div>

      <div class="sidebar-section">
        <h6>Staff</h6>
        <div class="conversation-list">
          <?php $__empty_1 = true; $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <a href="<?php echo e(route('messages.show', $item['contact']->id)); ?>" class="conversation-item">
              <div class="d-flex align-items-center gap-3">
                <div class="online-dot"></div>
                <div class="conversation-avatar"><?php echo e(strtoupper(substr($item['contact']->name, 0, 1))); ?></div>
                <div class="conversation-details">
                  <div class="conversation-name"><?php echo e($item['contact']->name); ?></div>
                  <div class="conversation-preview"><?php echo e($item['preview']); ?></div>
                </div>
              </div>
              <div class="conversation-meta">
                <?php if($item['time']): ?><div class="timestamp"><?php echo e($item['time']); ?></div><?php endif; ?>
                <?php if($item['unread'] > 0): ?><span class="badge-unread"><?php echo e($item['unread']); ?></span><?php endif; ?>
              </div>
            </a>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-muted">No staff contacts available.</div>
          <?php endif; ?>
        </div>
      </div>

      <?php if(Auth::user()->role !== 'student'): ?>
      <div class="sidebar-section">
        <h6>Students</h6>
        <div class="conversation-list">
          <?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <a href="<?php echo e(route('messages.show', $item['contact']->id)); ?>" class="conversation-item">
              <div class="d-flex align-items-center gap-3">
                <div class="online-dot"></div>
                <div class="conversation-avatar"><?php echo e(strtoupper(substr($item['contact']->name, 0, 1))); ?></div>
                <div class="conversation-details">
                  <div class="conversation-name"><?php echo e($item['contact']->name); ?></div>
                  <div class="conversation-preview"><?php echo e($item['preview']); ?></div>
                </div>
              </div>
              <div class="conversation-meta">
                <?php if($item['time']): ?><div class="timestamp"><?php echo e($item['time']); ?></div><?php endif; ?>
                <?php if($item['unread'] > 0): ?><span class="badge-unread"><?php echo e($item['unread']); ?></span><?php endif; ?>
              </div>
            </a>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-muted">No students available.</div>
          <?php endif; ?>
        </div>
      </div>
      <?php endif; ?>
    </aside>

    <main class="messenger-main">
      <div class="messenger-placeholder">
        <i class="fas fa-comment-alt-lines"></i>
        <h4>Select a chat</h4>
        <p>Choose a contact from the left panel to open the conversation and continue your private chat.</p>
      </div>
    </main>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\CLMFS_GROUP11 - Copy (2)\resources\views/messages/index.blade.php ENDPATH**/ ?>