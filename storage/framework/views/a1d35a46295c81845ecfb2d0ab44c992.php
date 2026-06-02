

<?php $__env->startSection('title', 'Report Bug'); ?>

<?php $__env->startSection('styles'); ?>
<style>
.page-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 30px;
  padding: 30px;
  background: linear-gradient(135deg, #0ea5e9 0%, #2563eb 100%);
  border-radius: 15px;
  box-shadow: 0 8px 25px rgba(14, 165, 233, 0.2);
}

.page-title {
  font-size: 32px;
  font-weight: 700;
  color: white;
  margin: 0;
  display: flex;
  align-items: center;
  gap: 14px;
}

.card {
  border: none;
  border-radius: 20px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  overflow: hidden;
  border-top: 4px solid #0ea5e9;
}

.card-body {
  padding: 40px;
}

.form-label {
  font-weight: 700;
  color: #1e293b;
  margin-bottom: 10px;
  display: flex;
  align-items: center;
  gap: 8px;
}

.form-label i {
  color: #0ea5e9;
  font-size: 18px;
}

.form-control,
.form-select {
  border: 2px solid #e2e8f0;
  border-radius: 10px;
  padding: 12px 16px;
  font-size: 15px;
  transition: all 0.3s ease;
}

.form-control:focus,
.form-select:focus {
  border-color: #0ea5e9;
  box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.12);
  color: #1e293b;
}

.form-control::placeholder {
  color: #94a3b8;
}

.form-group {
  margin-bottom: 25px;
}

.btn-submit {
  background: linear-gradient(135deg, #0ea5e9 0%, #2563eb 100%);
  border: none;
  color: white;
  padding: 12px 32px;
  border-radius: 10px;
  font-weight: 700;
  font-size: 15px;
  cursor: pointer;
  transition: all 0.3s ease;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}

.btn-submit:hover {
  background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(14, 165, 233, 0.3);
  color: white;
}

.btn-cancel {
  background: #e2e8f0;
  border: none;
  color: #64748b;
  padding: 12px 32px;
  border-radius: 10px;
  font-weight: 700;
  font-size: 15px;
  cursor: pointer;
  transition: all 0.3s ease;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}

.btn-cancel:hover {
  background: #cbd5e1;
  color: #475569;
  transform: translateY(-2px);
}

.severity-hint {
  font-size: 13px;
  color: #64748b;
  margin-top: 8px;
  padding: 10px;
  background: #f8fafc;
  border-left: 3px solid #0ea5e9;
  border-radius: 5px;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
  <div class="page-header" data-aos="fade-down" data-aos-duration="600">
    <h1 class="page-title"><i class="fas fa-bug"></i>Report a Bug</h1>
  </div>

  <?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert" data-aos="fade-down">
      <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <?php if($errors->any()): ?>
    <div class="alert alert-danger">
      <ul class="mb-0">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    </div>
  <?php endif; ?>

  <div class="card" data-aos="fade-up" data-aos-duration="700">
    <div class="card-body">
      <form method="POST" action="<?php echo e(route('bug-reports.store')); ?>" enctype="multipart/form-data" x-data="{ loading: false }" @submit="loading = true">
        <?php echo csrf_field(); ?>

        <div class="form-group" data-aos="fade-up" data-aos-delay="100">
          <label for="title" class="form-label">
            <i class="fas fa-heading"></i>Bug Title
          </label>
          <input type="text" name="title" id="title" class="form-control" value="<?php echo e(old('title')); ?>" placeholder="Summarize the issue" required>
        </div>

        <div class="form-group" data-aos="fade-up" data-aos-delay="150">
          <label for="description" class="form-label">
            <i class="fas fa-align-left"></i>Description
          </label>
          <textarea name="description" id="description" class="form-control" rows="6" placeholder="Describe the bug, steps to reproduce, and expected behavior" required><?php echo e(old('description')); ?></textarea>
        </div>

        <div class="form-group" data-aos="fade-up" data-aos-delay="200">
          <label for="affected_page" class="form-label">
            <i class="fas fa-map-marker-alt"></i>Page / Module Affected
          </label>
          <input type="text" name="affected_page" id="affected_page" class="form-control" value="<?php echo e(old('affected_page')); ?>" placeholder="E.g. Dashboard, Equipment page, Login" required>
        </div>

        <div class="form-group" data-aos="fade-up" data-aos-delay="250">
          <label for="priority" class="form-label">
            <i class="fas fa-exclamation-circle"></i>Priority Level
          </label>
          <select name="priority" id="priority" class="form-select" required>
            <option value="">-- Select Priority --</option>
            <option value="low" <?php echo e(old('priority') === 'low' ? 'selected' : ''); ?>>Low</option>
            <option value="medium" <?php echo e(old('priority') === 'medium' ? 'selected' : ''); ?>>Medium</option>
            <option value="high" <?php echo e(old('priority') === 'high' ? 'selected' : ''); ?>>High</option>
            <option value="critical" <?php echo e(old('priority') === 'critical' ? 'selected' : ''); ?>>Critical</option>
          </select>
        </div>

        <div class="form-group" data-aos="fade-up" data-aos-delay="300">
          <label for="screenshot" class="form-label">
            <i class="fas fa-image"></i>Screenshot Upload
          </label>
          <input type="file" name="screenshot" id="screenshot" class="form-control" accept="image/*">
        </div>

        <div class="btn-group" data-aos="fade-up" data-aos-delay="350">
          <button type="submit" class="btn btn-submit" x-bind:disabled="loading">
            <span x-show="!loading"><i class="fas fa-paper-plane"></i>Submit Bug Report</span>
            <span x-show="loading" style="display: none;"><span class="spinner-border spinner-border-sm me-2"></span>Submitting...</span>
          </button>
          <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-cancel"><i class="fas fa-times"></i>Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\CLMFS_GROUP11 - Copy (2)\resources\views/bug_reports/create.blade.php ENDPATH**/ ?>