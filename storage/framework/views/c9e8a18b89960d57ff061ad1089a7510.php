

<?php $__env->startSection('title', 'Report Incident'); ?>

<?php $__env->startSection('styles'); ?>
<style>
.page-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 30px;
  padding: 30px;
  background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
  border-radius: 15px;
  box-shadow: 0 8px 25px rgba(239, 68, 68, 0.2);
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

.card {
  border: none;
  border-radius: 20px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  overflow: hidden;
  border-top: 4px solid #ef4444;
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
  color: #ef4444;
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
  border-color: #ef4444;
  box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
  color: #1e293b;
}

.form-control::placeholder {
  color: #94a3b8;
}

.form-group {
  margin-bottom: 25px;
}

.btn-submit {
  background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
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
  background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(239, 68, 68, 0.3);
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

.btn-group {
  display: flex;
  gap: 15px;
  margin-top: 30px;
}

.severity-hint {
  font-size: 13px;
  color: #64748b;
  margin-top: 8px;
  padding: 10px;
  background: #f8fafc;
  border-left: 3px solid #ef4444;
  border-radius: 5px;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
  <div class="page-header" data-aos="fade-down" data-aos-duration="600">
    <h1 class="page-title"><i class="fas fa-exclamation-circle"></i>Report an Incident</h1>
  </div>

  <?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert" data-aos="fade-down">
      <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <div class="card" data-aos="fade-up" data-aos-duration="700">
    <div class="card-body">
      <form method="POST" action="<?php echo e(route('incidents.store')); ?>" x-data="{ loading: false }" @submit="loading = true">
        <?php echo csrf_field(); ?>
        
        <div class="form-group" data-aos="fade-up" data-aos-delay="100">
          <label for="equipment_id" class="form-label">
            <i class="fas fa-microchip"></i>Related Equipment
            <span style="color: #94a3b8; font-weight: 400;">(Optional)</span>
          </label>
          <select name="equipment_id" id="equipment_id" class="form-select">
            <option value="">-- Select Equipment --</option>
            <?php $__currentLoopData = $equipment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?> (<?php echo e($item->category); ?>)</option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>
        
        <div class="form-group" data-aos="fade-up" data-aos-delay="150">
          <label for="description" class="form-label">
            <i class="fas fa-align-left"></i>Incident Description
          </label>
          <textarea name="description" id="description" class="form-control" rows="6" placeholder="Provide detailed information about the incident..." required></textarea>
        </div>
        
        <div class="form-group" data-aos="fade-up" data-aos-delay="200">
          <label for="severity" class="form-label">
            <i class="fas fa-fire"></i>Severity Level
          </label>
          <select name="severity" id="severity" class="form-select" required>
            <option value="">-- Select Severity --</option>
            <option value="low">🟢 Low - Minor issue with no impact</option>
            <option value="medium">🟡 Medium - Moderate issue affecting usage</option>
            <option value="high">🔴 High - Serious issue affecting multiple users</option>
            <option value="critical">⚫ Critical - Equipment non-functional</option>
          </select>
          <div class="severity-hint">
            <i class="fas fa-info-circle me-2"></i>Select the appropriate severity level to help prioritize the incident.
          </div>
        </div>
        
        <div class="btn-group" data-aos="fade-up" data-aos-delay="250">
          <button type="submit" class="btn btn-submit" x-bind:disabled="loading">
            <span x-show="!loading"><i class="fas fa-paper-plane"></i>Submit Report</span>
            <span x-show="loading" style="display: none;"><span class="spinner-border spinner-border-sm me-2"></span>Submitting...</span>
          </button>
          <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-cancel"><i class="fas fa-times"></i>Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\MINISYSTEM-G-11-BSIT2-2\resources\views/incidents/report.blade.php ENDPATH**/ ?>