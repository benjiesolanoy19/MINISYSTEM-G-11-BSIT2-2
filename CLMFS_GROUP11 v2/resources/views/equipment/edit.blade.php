@extends('layouts.dashboard')

@section('title', 'Edit Equipment')

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
  background: linear-gradient(135deg, #ec4899, #db2777);
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
  background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);
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
  border-color: #ec4899;
  box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.1);
}

.form-control::placeholder {
  color: #94a3b8;
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
  background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);
  color: white;
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(236, 72, 153, 0.3);
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

.form-text {
  font-size: 12px;
  color: #94a3b8;
  margin-top: 6px;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
  <div class="page-header" data-aos="fade-down" data-aos-duration="600">
    <div>
      <h1 class="page-title" data-aos="fade-right" data-aos-delay="100">
        <i class="fas fa-edit"></i>Edit Equipment
      </h1>
      <p class="page-subtitle" data-aos="fade-right" data-aos-delay="150">
        Update equipment details: {{ $equipment->name }}
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
      <h5 style="margin: 0;"><i class="fas fa-wrench me-2"></i>Equipment Information</h5>
    </div>
    <div class="card-body p-4">
      <form method="POST" action="{{ route('equipment.update', $equipment->id) }}" x-data="{ loading: false }" @submit="loading = true">
        @csrf
        @method('PUT')
        
        <div class="row">
          <div class="col-md-6 mb-4" data-aos="fade-in" data-aos-delay="100">
            <div class="form-group">
              <label for="name" class="form-label"><i class="fas fa-box me-1" style="color: #ec4899;"></i>Equipment Name</label>
              <input 
                type="text" 
                name="name" 
                id="name" 
                class="form-control @error('name') is-invalid @enderror"
                value="{{ $equipment->name }}"
                required>
              @error('name')
                <small class="text-danger mt-2"><i class="fas fa-exclamation-circle"></i> {{ $message }}</small>
              @enderror
            </div>
          </div>
          
          <div class="col-md-6 mb-4" data-aos="fade-in" data-aos-delay="150">
            <div class="form-group">
              <label for="category" class="form-label"><i class="fas fa-tag me-1" style="color: #ec4899;"></i>Category</label>
              <select name="category" id="category" class="form-select @error('category') is-invalid @enderror" required>
                <option value="Computer" {{ $equipment->category === 'Computer' ? 'selected' : '' }}>
                  Computer
                </option>
                <option value="Projector" {{ $equipment->category === 'Projector' ? 'selected' : '' }}>
                  Projector
                </option>
                <option value="Keyboard" {{ $equipment->category === 'Keyboard' ? 'selected' : '' }}>
                  Keyboard
                </option>
                <option value="Mouse" {{ $equipment->category === 'Mouse' ? 'selected' : '' }}>
                  Mouse
                </option>
                <option value="Headset" {{ $equipment->category === 'Headset' ? 'selected' : '' }}>
                  Headset
                </option>
                <option value="Other" {{ $equipment->category === 'Other' ? 'selected' : '' }}>
                  Other
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
              <label for="quantity" class="form-label"><i class="fas fa-cubes me-1" style="color: #ec4899;"></i>Quantity</label>
              <input 
                type="number" 
                name="quantity" 
                id="quantity" 
                class="form-control @error('quantity') is-invalid @enderror"
                value="{{ $equipment->quantity }}"
                required 
                min="1">
              @error('quantity')
                <small class="text-danger mt-2"><i class="fas fa-exclamation-circle"></i> {{ $message }}</small>
              @enderror
            </div>
          </div>
          
          <div class="col-md-6 mb-4" data-aos="fade-in" data-aos-delay="250">
            <div class="form-group">
              <label for="status" class="form-label"><i class="fas fa-circle me-1" style="color: #ec4899;"></i>Status</label>
              <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                <option value="available" {{ $equipment->status === 'available' ? 'selected' : '' }}>
                  Available
                </option>
                <option value="borrowed" {{ $equipment->status === 'borrowed' ? 'selected' : '' }}>
                  Borrowed
                </option>
                <option value="maintenance" {{ $equipment->status === 'maintenance' ? 'selected' : '' }}>
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
            <label for="description" class="form-label"><i class="fas fa-align-left me-1" style="color: #ec4899;"></i>Description</label>
            <textarea 
              name="description" 
              id="description" 
              class="form-control @error('description') is-invalid @enderror"
              rows="3">{{ $equipment->description }}</textarea>
            @error('description')
              <small class="text-danger mt-2"><i class="fas fa-exclamation-circle"></i> {{ $message }}</small>
            @enderror
          </div>
        </div>
        
        <div class="button-group" data-aos="fade-in" data-aos-delay="350">
          <button type="submit" class="btn btn-primary" x-bind:disabled="loading">
            <span x-show="!loading"><i class="fas fa-save"></i> Update Equipment</span>
            <span x-show="loading">
              <span class="loading-spinner"></span> Updating...
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
