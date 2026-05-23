@extends('layouts.dashboard')

@section('title', 'Add Equipment')

@section('styles')
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

.upload-area {
  border: 2px dashed #cbd5e1;
  border-radius: 16px;
  padding: 40px 20px;
  background: rgba(248, 250, 252, 0.5);
  text-align: center;
  cursor: pointer;
  transition: all 0.3s ease;
  position: relative;
}

.upload-area:hover {
  border-color: #f59e0b;
  background: rgba(245, 158, 11, 0.05);
  box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
}

.upload-area.drag-over {
  border-color: #f59e0b;
  background: rgba(245, 158, 11, 0.1);
  box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.2);
  transform: scale(1.02);
}

.upload-icon {
  font-size: 48px;
  color: #cbd5e1;
  transition: all 0.3s ease;
}

.upload-area:hover .upload-icon,
.upload-area.drag-over .upload-icon {
  color: #f59e0b;
  transform: translateY(-5px);
}

.image-preview-container {
  position: relative;
  display: inline-block;
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 8px 24px rgba(15, 23, 42, 0.12);
  border: 2px solid #e2e8f0;
}

.image-preview {
  max-width: 400px;
  max-height: 300px;
  width: 100%;
  height: auto;
  display: block;
  object-fit: cover;
  border-radius: 14px;
}

.btn-remove-image {
  position: absolute;
  top: 8px;
  right: 8px;
  width: 40px;
  height: 40px;
  background: rgba(239, 68, 68, 0.9);
  border: none;
  border-radius: 50%;
  color: white;
  cursor: pointer;
  font-size: 16px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
  z-index: 10;
}

.btn-remove-image:hover {
  background: rgba(239, 68, 68, 1);
  transform: scale(1.1);
}

.upload-content {
  animation: slideUp 0.3s ease;
}

@keyframes slideUp {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

</style>
@endsection

@section('content')
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

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" data-aos="slide-in-right" role="alert">
      <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" data-aos="slide-in-right" role="alert">
      <i class="fas fa-exclamation-circle me-2"></i>
      <strong>Please fix the following errors:</strong>
      <ul class="mb-0 mt-2">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="card" data-aos="fade-up" data-aos-duration="700">
    <div class="card-header">
      <h5 style="margin: 0;"><i class="fas fa-wrench me-2"></i>Equipment Details</h5>
    </div>
    <div class="card-body p-4">
      <form method="POST" action="{{ route('equipment.store') }}" enctype="multipart/form-data" x-data="equipmentForm()" @submit="loading = true">
        @csrf
        
        <!-- Image Upload Section -->
        <div class="mb-4" data-aos="fade-in" data-aos-delay="100">
          <div class="form-group">
            <label class="form-label"><i class="fas fa-image me-1" style="color: #f59e0b;"></i>Equipment Image</label>
            <div class="mt-3">
              <div 
                class="upload-area" 
                :class="{ 'drag-over': isDragging }"
                @dragover.prevent="isDragging = true"
                @dragleave.prevent="isDragging = false"
                @drop.prevent="
                  isDragging = false;
                  if ($event.dataTransfer.files.length) {
                    const input = document.getElementById('imageInput');
                    input.files = $event.dataTransfer.files;
                    handleImageSelect($event);
                  }
                "
              >
                <input 
                  type="file" 
                  id="imageInput"
                  name="image"
                  class="d-none"
                  accept="image/jpeg,image/png,image/jpg,image/webp"
                  @change="handleImageSelect($event)"
                >
                <div class="upload-content">
                  <i class="fas fa-cloud-upload-alt upload-icon"></i>
                  <h6 class="mt-3 mb-2">Drag and drop your image here</h6>
                  <p class="text-muted mb-3">or</p>
                  <button type="button" class="btn btn-sm btn-outline-primary rounded-pill" @click="document.getElementById('imageInput').click()">
                    <i class="fas fa-folder-open me-1"></i> Choose Image
                  </button>
                  <p class="text-muted small mt-3 mb-0">JPG, PNG, JPEG, WEBP up to 2MB</p>
                </div>
              </div>

              <!-- Image Preview -->
              <template x-if="imagePreview">
                <div class="mt-4">
                  <div class="image-preview-container">
                    <img :src="imagePreview" alt="Preview" class="image-preview">
                    <button type="button" class="btn-remove-image" @click.prevent="removeImage()">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </div>
                  <p class="text-muted small mt-2">Image preview - click trash icon to change</p>
                </div>
              </template>

              @error('image')
                <small class="text-danger d-block mt-2"><i class="fas fa-exclamation-circle"></i> {{ $message }}</small>
              @enderror
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-6 mb-4" data-aos="fade-in" data-aos-delay="100">
            <div class="form-group">
              <label for="name" class="form-label"><i class="fas fa-box me-1" style="color: #f59e0b;"></i>Equipment Name</label>
              <input 
                type="text" 
                name="name" 
                id="name" 
                class="form-control @error('name') is-invalid @enderror"
                placeholder="e.g., Dell Laptop XPS 13"
                value="{{ old('name') }}"
                required>
              @error('name')
                <small class="text-danger mt-2"><i class="fas fa-exclamation-circle"></i> {{ $message }}</small>
              @enderror
            </div>
          </div>
          
          <div class="col-md-6 mb-4" data-aos="fade-in" data-aos-delay="150">
            <div class="form-group">
              <label for="category" class="form-label"><i class="fas fa-tag me-1" style="color: #f59e0b;"></i>Category</label>
              <select name="category" id="category" class="form-select @error('category') is-invalid @enderror" required>
                <option value="">Select Category</option>
                <option value="Computer" {{ old('category') === 'Computer' ? 'selected' : '' }}>
                  <i class="fas fa-laptop"></i> Computer
                </option>
                <option value="Projector" {{ old('category') === 'Projector' ? 'selected' : '' }}>
                  <i class="fas fa-projector"></i> Projector
                </option>
                <option value="Keyboard" {{ old('category') === 'Keyboard' ? 'selected' : '' }}>
                  <i class="fas fa-keyboard"></i> Keyboard
                </option>
                <option value="Mouse" {{ old('category') === 'Mouse' ? 'selected' : '' }}>
                  <i class="fas fa-mouse"></i> Mouse
                </option>
                <option value="Headset" {{ old('category') === 'Headset' ? 'selected' : '' }}>
                  <i class="fas fa-headset"></i> Headset
                </option>
                <option value="Other" {{ old('category') === 'Other' ? 'selected' : '' }}>
                  <i class="fas fa-cube"></i> Other
                </option>
              </select>
              @error('category')
                <small class="text-danger mt-2"><i class="fas fa-exclamation-circle"></i> {{ $message }}</small>
              @enderror
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
                class="form-control @error('quantity') is-invalid @enderror"
                placeholder="0"
                value="{{ old('quantity') }}"
                required 
                min="1">
              @error('quantity')
                <small class="text-danger mt-2"><i class="fas fa-exclamation-circle"></i> {{ $message }}</small>
              @enderror
            </div>
          </div>
          
          <div class="col-md-6 mb-4" data-aos="fade-in" data-aos-delay="250">
            <div class="form-group">
              <label for="status" class="form-label"><i class="fas fa-circle me-1" style="color: #f59e0b;"></i>Status</label>
              <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                <option value="available" {{ old('status') === 'available' ? 'selected' : '' }}>
                  Available
                </option>
                <option value="borrowed" {{ old('status') === 'borrowed' ? 'selected' : '' }}>
                  Borrowed
                </option>
                <option value="maintenance" {{ old('status') === 'maintenance' ? 'selected' : '' }}>
                  Maintenance
                </option>
              </select>
              @error('status')
                <small class="text-danger mt-2"><i class="fas fa-exclamation-circle"></i> {{ $message }}</small>
              @enderror
            </div>
          </div>
        </div>
        
        <div class="mb-4" data-aos="fade-in" data-aos-delay="300">
          <div class="form-group">
            <label for="description" class="form-label"><i class="fas fa-align-left me-1" style="color: #f59e0b;"></i>Description</label>
            <textarea 
              name="description" 
              id="description" 
              class="form-control @error('description') is-invalid @enderror"
              rows="3" 
              placeholder="Add equipment specifications, model number, or any additional notes...">{{ old('description') }}</textarea>
            @error('description')
              <small class="text-danger mt-2"><i class="fas fa-exclamation-circle"></i> {{ $message }}</small>
            @enderror
          </div>
        </div>
        
        <div class="button-group" data-aos="fade-in" data-aos-delay="350">
          <button type="submit" class="btn btn-primary" x-bind:disabled="loading">
            <span x-show="!loading"><i class="fas fa-check"></i> Add Equipment</span>
            <span x-show="loading">
              <span class="loading-spinner"></span> Processing...
            </span>
          </button>
          <a href="{{ route('equipment.index') }}" class="btn btn-secondary">
            <i class="fas fa-times"></i> Cancel
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
function equipmentForm() {
  return {
    loading: false,
    imagePreview: null,
    isDragging: false,

    handleImageSelect(event) {
      const file = event.target.files[0];
      if (!file) return;

      // Validate file type
      const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
      if (!validTypes.includes(file.type)) {
        alert('Please select a valid image file (JPG, PNG, JPEG, WEBP)');
        document.getElementById('imageInput').value = '';
        return;
      }

      // Validate file size (2MB max)
      const maxSize = 2 * 1024 * 1024;
      if (file.size > maxSize) {
        alert('File size must be less than 2MB');
        document.getElementById('imageInput').value = '';
        return;
      }

      // Create preview
      const reader = new FileReader();
      reader.onload = (e) => {
        this.imagePreview = e.target.result;
      };
      reader.readAsDataURL(file);
    },

    removeImage() {
      this.imagePreview = null;
      document.getElementById('imageInput').value = '';
    }
  };
}
</script>
@endsection

