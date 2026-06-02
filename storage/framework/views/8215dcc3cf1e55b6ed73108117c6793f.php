

<?php $__env->startSection('title', 'Chat with ' . $user->name); ?>

<?php $__env->startSection('styles'); ?>
<style>
.messenger-shell {
  display: grid;
  grid-template-columns: minmax(320px, 360px) 1fr;
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

.messenger-main {
  border-radius: 28px;
  background: rgba(255,255,255,0.95);
  border: 1px solid rgba(226,232,240,0.95);
  box-shadow: 0 24px 70px rgba(15,23,42,0.08);
  min-height: 720px;
  display: grid;
  grid-template-rows: auto 1fr auto;
}

.chat-header {
  padding: 28px 34px 16px;
  border-bottom: 1px solid rgba(226,232,240,0.95);
}

.chat-summary {
  display: flex;
  align-items: center;
  gap: 16px;
  flex-wrap: wrap;
}

.chat-summary .avatar {
  width: 56px;
  height: 56px;
  border-radius: 50%;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  background: rgba(59, 130, 246, 0.14);
  color: #1e3a8a;
  font-weight: 800;
  font-size: 1rem;
}

.chat-summary h4 {
  margin: 0;
}

.chat-summary p {
  margin: 0;
  color: #64748b;
}

.message-thread {
  padding: 24px 34px 0;
  overflow-y: auto;
  display: grid;
  gap: 18px;
}

.message-block {
  display: grid;
  gap: 10px;
  max-width: 78%;
}

.message-block.sent {
  justify-self: end;
  text-align: right;
}

.message-bubble {
  padding: 18px 20px;
  border-radius: 26px;
  line-height: 1.7;
  font-size: 0.95rem;
}

.message-block.sent .message-bubble {
  background: #e0f2fe;
  color: #0f172a;
  border-bottom-right-radius: 6px;
}

.message-block.received .message-bubble {
  background: #f8fafc;
  color: #334155;
  border-bottom-left-radius: 6px;
}

.message-meta {
  font-size: 0.8rem;
  color: #64748b;
}

.image-preview {
  max-width: 320px;
  border-radius: 20px;
  overflow: hidden;
  border: 1px solid rgba(226,232,240,0.95);
}

.image-preview img {
  width: 100%;
  display: block;
}

.chat-footer {
  padding: 24px 34px;
  border-top: 1px solid rgba(226,232,240,0.95);
}

.chat-footer .form-control,
.chat-footer .form-select {
  border-radius: 16px;
  border: 1px solid rgba(226,232,240,0.95);
  padding: 14px 16px;
}

.btn-send {
  background: linear-gradient(135deg, #8b5cf6 0%, #3b82f6 100%);
  border: none;
  color: white;
  padding: 14px 24px;
  border-radius: 16px;
  font-weight: 700;
}

.btn-send:hover {
  background: linear-gradient(135deg, #3b82f6 0%, #6366f1 100%);
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
  <div class="d-flex align-items-center justify-content-between mb-4" data-aos="fade-down" data-aos-duration="600">
    <div>
      <h1 class="h3 mb-1"><i class="fas fa-comments"></i> Messenger</h1>
      <p class="text-muted mb-0">Private chat only — student, staff, and admin conversations.</p>
    </div>
    <a href="<?php echo e(route('messages.index')); ?>" class="btn btn-light btn-lg border rounded-pill"><i class="fas fa-arrow-left me-2"></i>Back to Inbox</a>
  </div>

  <?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert" data-aos="fade-down">
      <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <div class="messenger-shell" data-aos="fade-up" data-aos-duration="700">
    <aside class="messenger-sidebar">
      <div class="sidebar-header">
        <h2>Contacts</h2>
        <p>Quickly switch to another conversation.</p>
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

    <section class="messenger-main">
      <div class="chat-header">
        <div class="chat-summary">
          <div class="d-flex align-items-center gap-4">
            <div class="avatar"><?php echo e(strtoupper(substr($user->name, 0, 1))); ?></div>
            <div>
              <h4 class="mb-1"><?php echo e($user->name); ?></h4>
              <p class="mb-0 text-muted"><?php echo e(ucfirst($user->role)); ?></p>
            </div>
          </div>
        </div>
      </div>

      <div class="message-thread">
        <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <div class="message-block <?php echo e($message->sender_id === Auth::id() ? 'sent' : 'received'); ?>">
            <div class="message-bubble"><?php echo nl2br(e($message->message)); ?></div>
            <?php if($message->attachment && preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $message->attachment)): ?>
              <div class="image-preview mt-3">
                <a href="<?php echo e(asset('storage/' . $message->attachment)); ?>" target="_blank">
                  <img src="<?php echo e(asset('storage/' . $message->attachment)); ?>" alt="Attachment preview">
                </a>
              </div>
            <?php elseif($message->attachment): ?>
              <div class="message-attachment mt-3"><a href="<?php echo e(asset('storage/' . $message->attachment)); ?>" target="_blank"><i class="fas fa-paperclip me-2"></i>Download attachment</a></div>
            <?php endif; ?>
            <div class="message-meta"><?php echo e($message->created_at->format('M d, Y h:i A')); ?></div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <div class="text-center py-5 text-muted">
            <i class="fas fa-comments fa-3x mb-3"></i>
            <p class="mb-1">No messages yet.</p>
            <p>Select a contact or send the first message to start the chat.</p>
          </div>
        <?php endif; ?>
      </div>

      <div class="chat-footer">
        <form method="POST" action="<?php echo e(route('messages.store')); ?>" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>
          <input type="hidden" name="receiver_id" value="<?php echo e($user->id); ?>">
          <div class="mb-3">
            <textarea name="message" class="form-control" rows="4" placeholder="Type your message..." required></textarea>
          </div>
          <div class="row gx-3 align-items-center">
            <div class="col-md-8 mb-3 mb-md-0">
              <input type="file" name="attachment" class="form-control" accept="image/*,.pdf,.doc,.docx,.xls,.xlsx">
            </div>
            <div class="col-md-4 text-md-end">
              <button type="submit" class="btn-send"><i class="fas fa-paper-plane me-2"></i>Send Message</button>
            </div>
          </div>
        </form>
      </div>
    </section>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\CLMFS_GROUP11 - Copy (2)\resources\views/messages/show.blade.php ENDPATH**/ ?>