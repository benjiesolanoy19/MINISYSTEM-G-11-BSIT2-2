

<?php $__env->startSection('title', 'Bug Report #' . $bug_report->id); ?>

<?php $__env->startSection('styles'); ?>
<style>
.page-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 30px;
  padding: 30px;
  background: linear-gradient(135deg, #1d4ed8 0%, #0ea5e9 100%);
  border-radius: 15px;
  box-shadow: 0 8px 25px rgba(14, 165, 233, 0.16);
}

.page-title {
  font-size: 32px;
  font-weight: 700;
  color: white;
  margin: 0;
  display: flex;
  align-items: center;
  gap: 12px;
}

.card-modern {
  border-radius: 24px;
  border: 1px solid rgba(226,232,240,0.95);
  background: white;
  box-shadow: 0 20px 45px rgba(15, 23, 42, 0.04);
}

.bug-detail-grid {
  display: grid;
  gap: 24px;
}

.bug-detail-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  gap: 16px;
  flex-wrap: wrap;
}

.bug-detail-label {
  font-weight: 700;
  color: #334155;
  margin-bottom: 6px;
}

.bug-detail-value {
  color: #475569;
}

.badge-status,
.badge-priority,
.badge-assign {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 0.6rem 0.85rem;
  border-radius: 999px;
  font-weight: 700;
  font-size: 0.8rem;
  text-transform: uppercase;
}

.badge-status.pending { background: #f8fafc; color: #475569; }
.badge-status.under_review { background: #f8fafc; color: #815d18; }
.badge-status.in_progress { background: #eff6ff; color: #1d4ed8; }
.badge-status.testing { background: #f0f9ff; color: #0c4a6e; }
.badge-status.resolved { background: #ecfdf5; color: #15803d; }
.badge-status.closed { background: #f1f5f9; color: #334155; }
.badge-priority.low { background: #e0f2fe; color: #0369a1; }
.badge-priority.medium { background: #fef3c7; color: #b45309; }
.badge-priority.high { background: #fee2e2; color: #b91c1c; }
.badge-priority.critical { background: #fdf2f8; color: #831843; }
.badge-assign { background: #f8fafc; color: #475569; }

.bug-thread {
  display: grid;
  gap: 18px;
  padding-top: 20px;
}

.message-block {
  display: grid;
  gap: 10px;
  max-width: 90%;
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
  max-width: 100%;
  border-radius: 20px;
  overflow: hidden;
  border: 1px solid rgba(226,232,240,0.95);
}

.image-preview img {
  width: 100%;
  display: block;
}

.action-card {
  border-radius: 24px;
  border: 1px solid rgba(226,232,240,0.95);
  padding: 24px;
  background: #ffffff;
}

.action-card h5 {
  margin-bottom: 18px;
}

.action-card .form-control,
.action-card .form-select,
.action-card textarea {
  border-radius: 16px;
  border: 1px solid rgba(226,232,240,0.95);
  padding: 14px 16px;
}

.btn-primary, .btn-success {
  border-radius: 16px;
  padding: 12px 24px;
  font-weight: 700;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
  <div class="page-header" data-aos="fade-down" data-aos-duration="600">
    <div>
      <h1 class="page-title"><i class="fas fa-bug"></i> Bug Report #<?php echo e($bug_report->id); ?></h1>
      <p class="text-white-75 mb-0">This ticket is private to the reporter, assigned staff, and administrators.</p>
    </div>
    <a href="<?php echo e(route('bug-reports.index')); ?>" class="btn btn-light btn-lg border rounded-pill"><i class="fas fa-arrow-left me-2"></i>Back to tickets</a>
  </div>

  <?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert" data-aos="fade-down">
      <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <div class="row g-4">
    <div class="col-xl-7">
      <div class="card-modern p-4" data-aos="fade-up" data-aos-duration="700">
        <div class="bug-detail-header">
          <div>
            <div class="bug-detail-label">Title</div>
            <div class="bug-detail-value h5"><?php echo e($bug_report->title); ?></div>
          </div>
          <div class="text-end">
            <span class="badge-status <?php echo e($bug_report->status); ?>"><?php echo e(str_replace('_', ' ', ucfirst($bug_report->status))); ?></span>
          </div>
        </div>

        <div class="mb-4">
          <div class="bug-detail-label">Reporter</div>
          <div class="bug-detail-value"><?php echo e(optional($bug_report->reporter)->name); ?> (<?php echo e(optional($bug_report->reporter)->role); ?>)</div>
        </div>

        <div class="mb-4">
          <div class="bug-detail-label">Affected page</div>
          <div class="bug-detail-value"><?php echo e($bug_report->affected_page); ?></div>
        </div>

        <div class="mb-4">
          <div class="bug-detail-label">Priority</div>
          <span class="badge-priority <?php echo e($bug_report->priority); ?>"><?php echo e(ucfirst($bug_report->priority)); ?></span>
        </div>

        <div class="mb-4">
          <div class="bug-detail-label">Description</div>
          <div class="bug-detail-value"><?php echo nl2br(e($bug_report->description)); ?></div>
        </div>

        <?php if($bug_report->screenshot): ?>
          <div class="mb-4">
            <div class="bug-detail-label">Screenshot</div>
            <div class="image-preview mb-2">
              <a href="<?php echo e(asset('storage/' . $bug_report->screenshot)); ?>" target="_blank">
                <img src="<?php echo e(asset('storage/' . $bug_report->screenshot)); ?>" alt="Bug screenshot">
              </a>
            </div>
          </div>
        <?php endif; ?>

        <div class="bug-detail-grid">
          <div>
            <div class="bug-detail-label">Current status</div>
            <div class="bug-detail-value"><?php echo e($bug_report->updated_at->diffForHumans()); ?></div>
          </div>
          <div>
            <div class="bug-detail-label">Assigned to</div>
            <div class="bug-detail-value"><?php echo e(optional($bug_report->assignedTo)->name ?? 'Unassigned'); ?></div>
          </div>
        </div>

        <div class="bug-thread mt-5">
          <h5>Ticket conversation</h5>
          <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="message-block <?php echo e($message->sender_id === Auth::id() ? 'sent' : 'received'); ?>">
              <div class="message-bubble"><?php echo nl2br(e($message->message)); ?></div>
              <?php if($message->attachment && preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $message->attachment)): ?>
                <div class="image-preview mt-3"><a href="<?php echo e(asset('storage/' . $message->attachment)); ?>" target="_blank"><img src="<?php echo e(asset('storage/' . $message->attachment)); ?>" alt="Attachment"></a></div>
              <?php elseif($message->attachment): ?>
                <div class="mt-3"><a href="<?php echo e(asset('storage/' . $message->attachment)); ?>" target="_blank" class="text-primary"><i class="fas fa-paperclip me-2"></i>Download attachment</a></div>
              <?php endif; ?>
              <div class="message-meta"><?php echo e($message->created_at->format('M d, Y h:i A')); ?> • <?php echo e($message->sender->name); ?></div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-center py-5 text-muted">
              <i class="fas fa-comments fa-3x mb-3"></i>
              <p class="mb-0">No ticket comments yet. Use the form to continue the support thread.</p>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <div class="col-xl-5">
      <div class="action-card" data-aos="fade-up" data-aos-duration="700">
        <h5>Post an update</h5>
        <form method="POST" action="<?php echo e(route('bug-reports.comment', $bug_report)); ?>" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>
          <div class="mb-4">
            <label for="message" class="form-label bug-detail-label">Message</label>
            <textarea id="message" name="message" class="form-control" rows="5" placeholder="Add a note to this ticket" required></textarea>
          </div>
          <div class="mb-4">
            <label for="attachment" class="form-label bug-detail-label">Attachment</label>
            <input type="file" id="attachment" name="attachment" class="form-control" accept="image/*,.pdf,.doc,.docx,.xls,.xlsx">
          </div>
          <button type="submit" class="btn btn-primary w-100">Post comment</button>
        </form>
      </div>

      <?php if(Auth::user()->isAdmin()): ?>
      <div class="action-card mt-4" data-aos="fade-up" data-aos-duration="700">
        <h5>Update ticket</h5>
        <form method="POST" action="<?php echo e(route('bug-reports.update', $bug_report)); ?>">
          <?php echo csrf_field(); ?>
          <?php echo method_field('PUT'); ?>
          <div class="mb-4">
            <label for="status" class="form-label bug-detail-label">Status</label>
            <select id="status" name="status" class="form-select" required>
              <option value="pending" <?php echo e($bug_report->status === 'pending' ? 'selected' : ''); ?>>Pending</option>
              <option value="approved" <?php echo e($bug_report->status === 'approved' ? 'selected' : ''); ?>>Approved</option>
              <option value="under_review" <?php echo e($bug_report->status === 'under_review' ? 'selected' : ''); ?>>Under Review</option>
              <option value="in_progress" <?php echo e($bug_report->status === 'in_progress' ? 'selected' : ''); ?>>In Progress</option>
              <option value="testing" <?php echo e($bug_report->status === 'testing' ? 'selected' : ''); ?>>Testing</option>
              <option value="rejected" <?php echo e($bug_report->status === 'rejected' ? 'selected' : ''); ?>>Rejected</option>
              <option value="resolved" <?php echo e($bug_report->status === 'resolved' ? 'selected' : ''); ?>>Resolved</option>
              <option value="closed" <?php echo e($bug_report->status === 'closed' ? 'selected' : ''); ?>>Closed</option>
            </select>
          </div>
          <div class="mb-4">
            <label for="reply" class="form-label bug-detail-label">Reply</label>
            <textarea id="reply" name="reply" class="form-control" rows="4" placeholder="Optional status update note"><?php echo e(old('reply', $bug_report->reply)); ?></textarea>
          </div>
          <div class="mb-4">
            <label for="admin_reason" class="form-label bug-detail-label">Admin reason (optional, used for rejection)</label>
            <textarea id="admin_reason" name="admin_reason" class="form-control" rows="3" placeholder="Add a rejection reason or internal note"><?php echo e(old('admin_reason')); ?></textarea>
          </div>
          <button type="submit" class="btn btn-success w-100 mb-3">Update status</button>
        </form>

        <h5 class="mt-4">Assign staff</h5>
        <form method="POST" action="<?php echo e(route('bug-reports.assign', $bug_report)); ?>">
          <?php echo csrf_field(); ?>
          <?php echo method_field('PUT'); ?>
          <div class="mb-4">
            <label for="assigned_to" class="form-label bug-detail-label">Assign to</label>
            <select id="assigned_to" name="assigned_to" class="form-select" required>
              <option value="">Select staff</option>
              <?php $__currentLoopData = $staffMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($staff->id); ?>" <?php echo e($bug_report->assigned_to === $staff->id ? 'selected' : ''); ?>><?php echo e($staff->name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
          <button type="submit" class="btn btn-primary w-100">Assign ticket</button>
        </form>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\CLMFS_GROUP11 - Copy (2)\resources\views/bug_reports/show.blade.php ENDPATH**/ ?>