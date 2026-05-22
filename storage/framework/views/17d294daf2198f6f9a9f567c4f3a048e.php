

<?php $__env->startSection('title', 'Add Equipment'); ?>

<?php $__env->startSection('styles'); ?>
<style>
.page-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 30px;
}

.page-title {
  font-size: 28px;
  font-weight: 700;
  color: #1e293b;
  margin: 0;
  display: flex;
  align-items: center;
  gap: 12px;
}

.page-title i {
  background: linear-gradient(135deg, #f59e0b, #d97706);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  font-size: 32px;
}

.page-subtitle {
  color: #64748b;
  font-size: 0.95rem;
  margin-top: 8px;
}

.card {
  border: none;
  border-radius: 16px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  overflow: hidden;
  transition: all 0.3s ease;
}

.card-header {
  background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
  color: white;
  padding: 20px;
  border: none;
}

.form-group {
  display: flex;
  flex-direction: column;
}

.form-label {
  font-weight: 600;
  color: #1e293b;
  margin-bottom: 8px;
  font-size: 14px;
}

.form-control, .form-select {
  padding: 12px 15px;
  border: 2px solid #e2e8f0;
  border-radius: 10px;
  font-size: 14px;
  transition: all 0.3s ease;
  background: white;
}

.form-control:focus, .form-select:focus {
  outline: none;
  border-color: #f59e0b;
  box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
}

.form-control::placeholder {
  color: #94a3b8;
}

.icon-select {
  display: flex;
  gap: 8px;
  flex-wrap: wrap;
  margin-top: 10px;
}

.icon-select label {
  display: flex;
  align-items: center;
  padding: 12px 16px;
  border: 2px solid #e2e8f0;
  border-radius: 10px;
  cursor: pointer;
  transition: all 0.3s ease;
  background: white;
  font-weight: 500;
  gap: 6px;
}

.icon-select input[type="radio"] {
  appearance: none;
  -webkit-appearance: none;
  width: 18px;
  height: 18px;
  border: 2px solid #cbd5e1;
  border-radius: 50%;
  cursor: pointer;
  transition: all 0.3s ease;
}

.icon-select input[type="radio"]:checked {
  background: linear-gradient(135deg, #f59e0b, #d97706);
  border-color: #f59e0b;
}

.icon-select input[type="radio"]:checked + span {
  color: #f59e0b;
  font-weight: 700;
}

.icon-select label:has(input:checked) {
  border-color: #f59e0b;
  background: rgba(245, 158, 11, 0.05);
}

.button-group {
  display: flex;
  gap: 12px;
  margin-top: 30px;
}

.btn {
  padding: 12px 28px;
  border-radius: 10px;
  font-weight: 600;
  border: none;
  transition: all 0.3s ease;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}

.btn-primary {
  background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
  color: white;
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(245, 158, 11, 0.3);
  color: white;
}

.btn-primary:disabled {
  opacity: 0.6;
  cursor: not-allowed;
  transform: none;
}

.btn-secondary {
  background: #f1f5f9;
  color: #475569;
}

.btn-secondary:hover {
  background: #e2e8f0;
  color: #1e293b;
}

.loading-spinner {
  display: inline-block;
  width: 14px;
  height: 14px;
  border: 2px solid rgba(255, 255, 255, 0.3);
  border-top-color: white;
  border-radius: 50%;
  animation: spin 0.8s linear infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

.alert {
  border-radius: 12px;
  border-left: 4px solid;
  padding: 15px 20px;
}

.alert-success {
  border-left-color: #10b981;
  background: rgba(16, 185, 129, 0.1);
  color: #059669;
}

.alert-danger {
  border-left-color: #ef4444;
  background: rgba(239, 68, 68, 0.1);
  color: #991b1b;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
  <div class="page-header" data-aos="fade-down" data-aos-duration="600">
    <div>
      <h1 class="page-title" data-aos="fade-right" data-aos-delay="100">
        <i class="fas fa-plus-circle"></i>Add New Equipment
      </h1>
      <p class="page-subtitle" data-aos="fade-right" data-aos-delay="150">
        Register a new piece of equipment to the inventory
      </p>
    </div>
  </div>

  <?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" data-aos="slide-in-right" role="alert">
      <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <?php if($errors->any()): ?>
    <div class="alert alert-danger alert-dismissible fade show" data-aos="slide-in-right" role="alert">
      <i class="fas fa-exclamation-circle me-2"></i>
      <strong>Please fix the following errors:</strong>
      <ul class="mb-0 mt-2">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <div class="card" data-aos="fade-up" data-aos-duration="700">
    <div class="card-header">
      <h5 style="margin: 0;"><i class="fas fa-wrench me-2"></i>Equipment Details</h5>
    </div>
    <div class="card-body p-4">
      <form method="POST" action="<?php echo e(route('equipment.store')); ?>" x-data="{ loading: false }" @submit="loading = true">
        <?php echo csrf_field(); ?>
        
        <div class="row">
          <div class="col-md-6 mb-4" data-aos="fade-in" data-aos-delay="100">
            <div class="form-group">
              <label for="name" class="form-label"><i class="fas fa-box me-1" style="color: #f59e0b;"></i>Equipment Name</label>
              <input 
                type="text" 
                name="name" 
                id="name" 
                class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                placeholder="e.g., Dell Laptop XPS 13"
                value="<?php echo e(old('name')); ?>"
                required>
              <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <small class="text-danger mt-2"><i class="fas fa-exclamation-circle"></i> <?php echo e($message); ?></small>
              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
          </div>
          
          <div class="col-md-6 mb-4" data-aos="fade-in" data-aos-delay="150">
            <div class="form-group">
              <label for="category" class="form-label"><i class="fas fa-tag me-1" style="color: #f59e0b;"></i>Category</label>
              <select name="category" id="category" class="form-select <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                <option value="">Select Category</option>
                <option value="Computer" <?php echo e(old('category') === 'Computer' ? 'selected' : ''); ?>>
                  <i class="fas fa-laptop"></i> Computer
                </option>
                <option value="Projector" <?php echo e(old('category') === 'Projector' ? 'selected' : ''); ?>>
                  <i class="fas fa-projector"></i> Projector
                </option>
                <option value="Keyboard" <?php echo e(old('category') === 'Keyboard' ? 'selected' : ''); ?>>
                  <i class="fas fa-keyboard"></i> Keyboard
                </option>
                <option value="Mouse" <?php echo e(old('category') === 'Mouse' ? 'selected' : ''); ?>>
                  <i class="fas fa-mouse"></i> Mouse
                </option>
                <option value="Headset" <?php echo e(old('category') === 'Headset' ? 'selected' : ''); ?>>
                  <i class="fas fa-headset"></i> Headset
                </option>
                <option value="Other" <?php echo e(old('category') === 'Other' ? 'selected' : ''); ?>>
                  <i class="fas fa-cube"></i> Other
                </option>
              </select>
              <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <small class="text-danger mt-2"><i class="fas fa-exclamation-circle"></i> <?php echo e($message); ?></small>
              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-6 mb-4" data-aos="fade-in" data-aos-delay="200">
            <div class="form-group">
              <label for="quantity" class="form-label"><i class="fas fa-cubes me-1" style="color: #f59e0b;"></i>Quantity</label>
              <input 
                type="number" 
                name="quantity" 
                id="quantity" 
                class="form-control <?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                placeholder="0"
                value="<?php echo e(old('quantity')); ?>"
                required 
                min="1">
              <?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <small class="text-danger mt-2"><i class="fas fa-exclamation-circle"></i> <?php echo e($message); ?></small>
              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
          </div>
          
          <div class="col-md-6 mb-4" data-aos="fade-in" data-aos-delay="250">
            <div class="form-group">
              <label for="status" class="form-label"><i class="fas fa-circle me-1" style="color: #f59e0b;"></i>Status</label>
              <select name="status" id="status" class="form-select <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                <option value="available" <?php echo e(old('status') === 'available' ? 'selected' : ''); ?>>
                  Available
                </option>
                <option value="borrowed" <?php echo e(old('status') === 'borrowed' ? 'selected' : ''); ?>>
                  Borrowed
                </option>
                <option value="maintenance" <?php echo e(old('status') === 'maintenance' ? 'selected' : ''); ?>>
                  Maintenance
                </option>
              </select>
              <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <small class="text-danger mt-2"><i class="fas fa-exclamation-circle"></i> <?php echo e($message); ?></small>
              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
          </div>
        </div>
        
        <div class="mb-4" data-aos="fade-in" data-aos-delay="300">
          <div class="form-group">
            <label for="description" class="form-label"><i class="fas fa-align-left me-1" style="color: #f59e0b;"></i>Description</label>
            <textarea 
              name="description" 
              id="description" 
              class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
              rows="3" 
              placeholder="Add equipment specifications, model number, or any additional notes..."><?php echo e(old('description')); ?></textarea>
            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <small class="text-danger mt-2"><i class="fas fa-exclamation-circle"></i> <?php echo e($message); ?></small>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>
        </div>
        
        <div class="button-group" data-aos="fade-in" data-aos-delay="350">
          <button type="submit" class="btn btn-primary" x-bind:disabled="loading">
            <span x-show="!loading"><i class="fas fa-check"></i> Add Equipment</span>
            <span x-show="loading">
              <span class="loading-spinner"></span> Processing...
            </span>
          </button>
          <a href="<?php echo e(route('equipment.index')); ?>" class="btn btn-secondary">
            <i class="fas fa-times"></i> Cancel
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\CLMFS_GROUP11 - Copy (2)\resources\views/equipment/create.blade.php ENDPATH**/ ?>