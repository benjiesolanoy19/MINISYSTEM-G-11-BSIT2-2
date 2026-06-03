<?php $__env->startSection('title', 'My Profile'); ?>

<?php $__env->startSection('styles'); ?>
<style>
.page-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 30px;
  padding: 30px;
  background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
  border-radius: 15px;
  box-shadow: 0 8px 25px rgba(59, 130, 246, 0.2);
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

.password-input-group {
  position: relative;
}

.password-input-group .form-control {
  padding-right: 48px;
  padding-left: 44px;
}

.password-input-group i {
  position: absolute;
  left: 14px;
  top: 50%;
  transform: translateY(-50%);
  color: #3b82f6;
  font-weight: 600;
}

.password-toggle {
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-50%);
  background: none;
  border: none;
  color: #64748b;
  cursor: pointer;
  padding: 5px;
  transition: all 0.3s ease;
}

.password-toggle:hover {
  color: #3b82f6;
}

.card {
  border: none;
  border-radius: 16px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  overflow: hidden;
  border-top: 4px solid #3b82f6;
  transition: all 0.3s ease;
}

.card:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 25px rgba(59, 130, 246, 0.15);
}

.card-header {
  background: linear-gradient(135deg, #eff6ff 0%, #eff6ff 100%);
  color: #1d4ed8;
  font-weight: 700;
  border-radius: 0;
  padding: 20px;
  border-bottom: 2px solid #3b82f6;
  font-size: 16px;
}

.card-header i {
  font-size: 18px;
  margin-right: 10px;
}

.card-body {
  padding: 30px;
}

.form-label {
  font-weight: 700;
  color: #1e293b;
  margin-bottom: 10px;
  display: flex;
  align-items: center;
  gap: 6px;
}

.form-label i {
  color: #3b82f6;
  font-size: 14px;
}

.form-control {
  border: 2px solid #e2e8f0;
  border-radius: 10px;
  padding: 12px 16px;
  font-size: 15px;
  transition: all 0.3s ease;
}

.form-control:focus {
  border-color: #3b82f6;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
  color: #1e293b;
}

.form-control:disabled,
.form-control[readonly] {
  background: #f8fafc;
  color: #64748b;
  border-color: #e2e8f0;
}

.form-control::placeholder {
  color: #94a3b8;
}

.profile-picture-card {
  border: 2px dashed rgba(59, 130, 246, 0.4);
  border-radius: 18px;
  padding: 24px;
  background: rgba(239, 246, 255, 0.9);
  transition: border-color 0.3s ease, transform 0.3s ease, background 0.3s ease;
}

.profile-picture-card:hover {
  border-color: rgba(59, 130, 246, 0.75);
  transform: translateY(-1px);
  background: rgba(239, 246, 255, 1);
}

.profile-avatar-large {
  width: 130px;
  height: 130px;
  border-radius: 50%;
  background: linear-gradient(135deg, #e0f2fe, #dbeafe);
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 20px;
  position: relative;
  overflow: hidden;
  color: #1d4ed8;
  font-size: 3rem;
  font-weight: 800;
}

.profile-avatar-large img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.avatar-badge {
  position: absolute;
  bottom: 8px;
  right: 8px;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background: #1d4ed8;
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 8px 20px rgba(30, 64, 175, 0.18);
}

.upload-zone {
  border: 2px dashed rgba(148, 163, 184, 0.65);
  border-radius: 18px;
  padding: 24px;
  background: #f8fafc;
  text-align: center;
  cursor: pointer;
  transition: border-color 0.3s ease, background 0.3s ease;
}

.upload-zone.dragover {
  border-color: #3b82f6;
  background: rgba(59, 130, 246, 0.08);
}

.upload-zone h5 {
  margin-bottom: 10px;
  font-weight: 700;
}

.upload-zone p {
  color: #475569;
  margin-bottom: 0;
}

.upload-zone small {
  color: #94a3b8;
}

.upload-actions {
  display: flex;
  justify-content: center;
  gap: 12px;
  flex-wrap: wrap;
  margin-top: 18px;
}

.upload-actions .btn {
  border-radius: 999px;
}

.remove-avatar-btn {
  border: 1px solid rgba(239, 68, 68, 0.18);
  color: #dc2626;
}

.btn-primary {
  background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
  border: none;
  padding: 12px 32px;
  border-radius: 10px;
  font-weight: 700;
  font-size: 15px;
  color: white;
  cursor: pointer;
  transition: all 0.3s ease;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}

.btn-primary:hover {
  background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(59, 130, 246, 0.3);
  color: white;
}

.form-group {
  margin-bottom: 25px;
}

.alert {
  border: none;
  border-radius: 12px;
  border-left: 4px solid;
}

.alert-success {
  border-left-color: #10b981;
  background: #f0fdf4;
  color: #065f46;
}

.alert-danger {
  border-left-color: #ef4444;
  background: #fef2f2;
  color: #7f1d1d;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
  <div class="page-header" data-aos="fade-down" data-aos-duration="600">
    <h1 class="page-title"><i class="fas fa-user-circle"></i>My Profile</h1>
  </div>

  <?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert" data-aos="fade-down">
      <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <?php if(session('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert" data-aos="fade-down">
      <i class="fas fa-exclamation-circle me-2"></i><?php echo e(session('error')); ?>

      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <div class="row">
    <div class="col-md-6">
      <div class="card mb-4" data-aos="fade-up" data-aos-delay="100">
        <div class="card-header">
          <i class="fas fa-id-card"></i> Profile Information
        </div>
        <div class="card-body">
          <form method="POST" action="<?php echo e(route('profile.update')); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="text-center mb-4" data-aos="fade-up" data-aos-delay="100">
              <div class="profile-avatar-large">
                <?php if($user->profile_picture_url): ?>
                  <img src="<?php echo e($user->profile_picture_url); ?>" alt="<?php echo e($user->name); ?>">
                <?php else: ?>
                  <?php echo e($user->profile_initial); ?>

                <?php endif; ?>
                <div class="avatar-badge">
                  <i class="fas fa-camera"></i>
                </div>
              </div>
              <div class="upload-zone" id="uploadZone">
                <h5>Upload Profile Picture</h5>
                <p>Drag & drop an image here, or click to browse.</p>
                <small>Supported: JPG, JPEG, PNG, WEBP | Max 2MB</small>
                <input type="file" name="profile_picture" id="profilePictureInput" accept="image/jpeg,image/png,image/webp" style="display: none;">
                <input type="hidden" name="remove_profile_picture" id="removeProfilePictureInput" value="0">
                <?php if($user->profile_picture_url): ?>
                  <div class="upload-actions">
                    <button type="button" class="btn btn-outline-danger remove-avatar-btn" id="removeProfilePictureButton">
                      <i class="fas fa-trash-alt"></i> Remove Picture
                    </button>
                  </div>
                <?php endif; ?>
              </div>

              <?php $__errorArgs = ['profile_picture'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <div class="alert alert-danger mt-3"><?php echo e($message); ?></div>
              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group" data-aos="fade-up" data-aos-delay="150">
              <label for="name" class="form-label"><i class="fas fa-user"></i>Full Name</label>
              <input type="text" name="name" id="name" class="form-control" value="<?php echo e($user->name); ?>" required>
            </div>
            
            <div class="form-group" data-aos="fade-up" data-aos-delay="200">
              <label for="email" class="form-label"><i class="fas fa-envelope"></i>Email Address</label>
              <input type="email" name="email" id="email" class="form-control" value="<?php echo e($user->email); ?>" required>
            </div>
            
            <div class="form-group" data-aos="fade-up" data-aos-delay="250">
              <label class="form-label"><i class="fas fa-shield-alt"></i>Role</label>
              <input type="text" class="form-control" value="<?php echo e(ucfirst($user->role)); ?>" readonly>
            </div>
            
            <button type="submit" class="btn btn-primary" data-aos="fade-up" data-aos-delay="300">
              <i class="fas fa-save"></i>Update Profile
            </button>
          </form>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card mb-4" data-aos="fade-up" data-aos-delay="200">
        <div class="card-header">
          <i class="fas fa-lock"></i> Change Password
        </div>
        <div class="card-body">
          <form method="POST" action="<?php echo e(route('profile.password')); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            
            <div class="form-group" data-aos="fade-up" data-aos-delay="150">
              <label for="current_password" class="form-label"><i class="fas fa-key"></i>Current Password</label>
              <div class="password-input-group">
                <input type="password" name="current_password" id="current_password" class="form-control" required>
                <i class="fas fa-lock"></i>
                <button type="button" class="password-toggle" onclick="togglePassword('current_password', 'toggleIcon1')">
                  <i class="fas fa-eye" id="toggleIcon1"></i>
                </button>
              </div>
            </div>
            
            <div class="form-group" data-aos="fade-up" data-aos-delay="200">
              <label for="password" class="form-label"><i class="fas fa-key"></i>New Password</label>
              <div class="password-input-group">
                <input type="password" name="password" id="password" class="form-control" required>
                <i class="fas fa-lock"></i>
                <button type="button" class="password-toggle" onclick="togglePassword('password', 'toggleIcon2')">
                  <i class="fas fa-eye" id="toggleIcon2"></i>
                </button>
              </div>
            </div>
            
            <div class="form-group" data-aos="fade-up" data-aos-delay="250">
              <label for="password_confirmation" class="form-label"><i class="fas fa-key"></i>Confirm Password</label>
              <div class="password-input-group">
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                <i class="fas fa-lock"></i>
                <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', 'toggleIcon3')">
                  <i class="fas fa-eye" id="toggleIcon3"></i>
                </button>
              </div>
            </div>
            
            <button type="submit" class="btn btn-primary" data-aos="fade-up" data-aos-delay="300">
              <i class="fas fa-check"></i>Change Password
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function togglePassword(inputId, iconId) {
  const passwordInput = document.getElementById(inputId);
  const toggleIcon = document.getElementById(iconId);
  
  if (passwordInput.type === 'password') {
    passwordInput.type = 'text';
    toggleIcon.classList.remove('fa-eye');
    toggleIcon.classList.add('fa-eye-slash');
  } else {
    passwordInput.type = 'password';
    toggleIcon.classList.remove('fa-eye-slash');
    toggleIcon.classList.add('fa-eye');
  }
}

function initProfileUpload() {
  const uploadZone = document.getElementById('uploadZone');
  const fileInput = document.getElementById('profilePictureInput');
  const removeInput = document.getElementById('removeProfilePictureInput');
  const removeButton = document.getElementById('removeProfilePictureButton');

  if (!uploadZone || !fileInput) {
    return;
  }

  uploadZone.addEventListener('click', () => fileInput.click());

  uploadZone.addEventListener('dragover', (event) => {
    event.preventDefault();
    uploadZone.classList.add('dragover');
  });

  uploadZone.addEventListener('dragleave', () => {
    uploadZone.classList.remove('dragover');
  });

  uploadZone.addEventListener('drop', (event) => {
    event.preventDefault();
    uploadZone.classList.remove('dragover');
    const file = event.dataTransfer.files[0];
    if (file) {
      const dataTransfer = new DataTransfer();
      dataTransfer.items.add(file);
      fileInput.files = dataTransfer.files;
      previewSelectedImage(file);
      removeInput.value = '0';
    }
  });

  fileInput.addEventListener('change', () => {
    if (fileInput.files && fileInput.files[0]) {
      previewSelectedImage(fileInput.files[0]);
      removeInput.value = '0';
    }
  });

  if (removeButton) {
    removeButton.addEventListener('click', () => {
      removeInput.value = '1';
      fileInput.value = '';
      const avatar = document.querySelector('.profile-avatar-large');
      if (avatar) {
        avatar.innerHTML = '<span><?php echo e($user->profile_initial); ?></span><div class="avatar-badge"><i class="fas fa-camera"></i></div>';
      }
    });
  }
}

function previewSelectedImage(file) {
  if (!file.type.startsWith('image/')) {
    return;
  }

  const reader = new FileReader();
  reader.onload = function (event) {
    const avatar = document.querySelector('.profile-avatar-large');
    if (avatar) {
      avatar.innerHTML = '<img src="' + event.target.result + '" alt="Preview"><div class="avatar-badge"><i class="fas fa-camera"></i></div>';
    }
  };
  reader.readAsDataURL(file);
}

window.addEventListener('DOMContentLoaded', initProfileUpload);
</script>
<?php $__env->stopSection(); ?>
</parameter>
</create_file>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\MINISYSTEM-G-11-BSIT2-2\resources\views/profile/index.blade.php ENDPATH**/ ?>