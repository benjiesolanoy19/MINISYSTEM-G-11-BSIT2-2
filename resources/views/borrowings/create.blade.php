@extends('layouts.dashboard')

@section('title', 'Borrow Equipment')

@push('styles')
<style>
.page-title { 
  font-size: 28px; 
  font-weight: 700; 
  color: #1e293b;
  display: flex;
  align-items: center;
  gap: 12px;
}

.page-title i {
  background: linear-gradient(135deg, #0ea5e9, #10b981);
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

.equipment-grid { 
  display: grid; 
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); 
  gap: 25px;
  margin-bottom: 30px;
}

.equipment-card { 
  background: white; 
  border-radius: 16px; 
  overflow: hidden; 
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08); 
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  cursor: pointer; 
  border: 3px solid transparent;
  position: relative;
}

.equipment-card:hover { 
  transform: translateY(-8px);
  box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12); 
}

.equipment-card.selected { 
  border-color: #0ea5e9; 
  background: #f0f9ff;
  box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.15);
}

.equipment-card.selected::before {
  content: '✓';
  position: absolute;
  top: 10px;
  right: 10px;
  width: 32px;
  height: 32px;
  background: linear-gradient(135deg, #0ea5e9, #10b981);
  color: white;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
  font-size: 18px;
  box-shadow: 0 2px 8px rgba(14, 165, 233, 0.3);
}

.equipment-img { 
  width: 100%; 
  height: 160px; 
  object-fit: cover; 
  background: #e2e8f0; 
}

.equipment-body { 
  padding: 18px; 
}

.equipment-name { 
  font-size: 16px; 
  font-weight: 600; 
  color: #1e293b; 
  margin-bottom: 8px; 
}

.equipment-category { 
  display: inline-block; 
  padding: 4px 10px; 
  background: linear-gradient(135deg, #e0f2fe, #dbeafe);
  color: #0284c7; 
  border-radius: 20px; 
  font-size: 12px; 
  font-weight: 600; 
  margin-bottom: 10px; 
}

.equipment-details { 
  display: flex; 
  justify-content: space-between; 
  align-items: center; 
  margin-bottom: 12px; 
}

.equipment-quantity { 
  font-size: 14px; 
  color: #64748b; 
}

.quantity-badge { 
  padding: 4px 10px; 
  border-radius: 20px; 
  font-size: 12px; 
  font-weight: 600; 
}

.quantity-available { 
  background: #d1fae5; 
  color: #059669; 
}

.quantity-limited { 
  background: #fef3c7; 
  color: #d97706; 
}

.quantity-empty { 
  background: #fee2e2; 
  color: #dc2626; 
  cursor: not-allowed;
  opacity: 0.7;
}

.equipment-desc { 
  font-size: 13px; 
  color: #64748b; 
  line-height: 1.5;
  margin: 0;
}

.selected-equipment { 
  background: white; 
  border-radius: 16px; 
  padding: 25px; 
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
  border-left: 4px solid #0ea5e9;
}

.selected-title { 
  font-size: 18px; 
  font-weight: 600; 
  color: #1e293b; 
  margin-bottom: 20px; 
  display: flex; 
  align-items: center; 
  gap: 10px; 
}

.selected-img { 
  width: 80px; 
  height: 80px; 
  border-radius: 12px; 
  object-fit: cover; 
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.form-label { 
  font-weight: 600; 
  color: #1e293b; 
  margin-bottom: 8px;
  display: flex;
  align-items: center;
  gap: 8px;
}

.form-label i {
  color: #0ea5e9;
  font-size: 16px;
}

.form-control { 
  border: 2px solid #e2e8f0; 
  border-radius: 10px; 
  padding: 12px 16px;
  transition: all 0.3s ease;
  font-size: 0.95rem;
}

.form-control:focus { 
  border-color: #0ea5e9; 
  box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.1); 
  outline: none;
}

.btn-submit { 
  background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%); 
  border: none; 
  padding: 14px 32px; 
  border-radius: 12px; 
  font-weight: 600; 
  color: white;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  display: inline-flex;
  align-items: center;
  gap: 8px;
}

.btn-submit:hover { 
  transform: translateY(-2px); 
  box-shadow: 0 8px 20px rgba(14, 165, 233, 0.3);
  color: white;
}

.btn-submit:disabled {
  opacity: 0.6;
  cursor: not-allowed;
  transform: none;
}

.no-equipment { 
  text-align: center; 
  padding: 60px 20px; 
  color: #64748b; 
}

.no-equipment i { 
  font-size: 48px; 
  margin-bottom: 15px; 
  color: #cbd5e1; 
}

.page-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 30px;
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
  color: #dc2626;
}
</style>
@endpush

@section('content')
<div class="container-fluid" x-data="borrowingForm()">
  <div class="page-header" data-aos="fade-down" data-aos-duration="600">
    <div>
      <h1 class="page-title" data-aos="fade-right" data-aos-delay="100">
        <i class="fas fa-shopping-cart"></i>Borrow Equipment
      </h1>
      <p class="page-subtitle" data-aos="fade-right" data-aos-delay="150">
        Select equipment and choose your borrowing dates
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

  @if($equipment->isEmpty())
    <div class="no-equipment" data-aos="fade-in">
      <i class="fas fa-inbox"></i>
      <h3>No Equipment Available</h3>
      <p>There are no equipment items available for borrowing at the moment.</p>
      <p style="color: #a1a1a1; font-size: 0.9rem;">Please check back later or contact an administrator.</p>
    </div>
  @else
    <form method="POST" action="{{ route('borrowings.store') }}" id="borrowingForm" x-ref="form">
      @csrf
      <input type="hidden" name="equipment_id" id="selectedEquipmentId" x-model="selectedId" required>
      
      <h4 class="mb-4 mt-4" data-aos="fade-up" data-aos-delay="200" style="font-size: 1.25rem; font-weight: 600; color: #1e293b;">
        <i class="fas fa-cube me-2" style="color: #0ea5e9;"></i>Step 1: Select Equipment
      </h4>
      <div class="equipment-grid">
        @foreach($equipment as $item)
        <div 
          class="equipment-card" 
          data-id="{{ $item->id }}" 
          data-name="{{ $item->name }}" 
          data-image="{{ $item->image ?? 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=400&h=300&fit=crop' }}"
          data-category="{{ $item->category }}"
          data-quantity="{{ $item->available_quantity }}"
          @click="selectEquipment($event)"
          data-aos="zoom-in" 
          data-aos-delay="{{ $loop->index * 50 }}"
          style="cursor: {{ $item->available_quantity > 0 ? 'pointer' : 'not-allowed' }}; opacity: {{ $item->available_quantity > 0 ? '1' : '0.6' }};"
        >
          <img src="{{ $item->image ?? 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=400&h=300&fit=crop' }}" alt="{{ $item->name }}" class="equipment-img">
          <div class="equipment-body">
            <div class="equipment-category">{{ $item->category }}</div>
            <h5 class="equipment-name">{{ $item->name }}</h5>
            <div class="equipment-details">
              <span class="equipment-quantity">Available:</span>
              @if($item->available_quantity > 5)
                <span class="quantity-badge quantity-available">{{ $item->available_quantity }} units</span>
              @elseif($item->available_quantity > 0)
                <span class="quantity-badge quantity-limited">{{ $item->available_quantity }} left</span>
              @else
                <span class="quantity-badge quantity-empty">Out of stock</span>
              @endif
            </div>
            <p class="equipment-desc">{{ $item->description ?? 'High-quality ' . $item->name . ' for laboratory use.' }}</p>
          </div>
        </div>
        @endforeach
      </div>

      <div class="row" x-show="selectedId" x-transition.duration.300ms>
        <div class="col-lg-8">
          <h4 class="mb-4" data-aos="fade-up" data-aos-delay="300" style="font-size: 1.25rem; font-weight: 600; color: #1e293b;">
            <i class="fas fa-calendar me-2" style="color: #10b981;"></i>Step 2: Choose Dates
          </h4>
          <div class="selected-equipment" data-aos="fade-up" data-aos-delay="350">
            <h5 class="selected-title"><i class="fas fa-check-circle text-success"></i> Selected Equipment</h5>
            <div class="row align-items-center mb-4">
              <div class="col-md-3">
                <img :src="selectedImage" alt="" id="selectedImage" class="selected-img">
              </div>
              <div class="col-md-9">
                <h4 x-text="selectedName" id="selectedName" class="mb-1"></h4>
                <p class="text-muted" x-text="'Category: ' + selectedCategory" style="margin: 0;"></p>
              </div>
            </div>

            <div class="form-group mb-4" data-aos="fade-up" data-aos-delay="400">
              <label class="form-label">
                <i class="fas fa-calendar-alt"></i>Borrow Date
              </label>
              <input 
                type="date" 
                name="borrow_date" 
                id="borrow_date" 
                class="form-control" 
                required 
                :min="today"
                x-model="borrowDate"
                @change="updateExpectedReturn()"
              >
            </div>

            <div class="form-group mb-4" data-aos="fade-up" data-aos-delay="450">
              <label class="form-label">
                <i class="fas fa-hourglass-end"></i>Expected Return Date
              </label>
              <input 
                type="date" 
                name="expected_return" 
                id="expected_return" 
                class="form-control" 
                required
                :min="borrowDate"
                x-model="expectedReturn"
              >
            </div>

            <div class="form-group" data-aos="fade-up" data-aos-delay="500">
              <label class="form-label">
                <i class="fas fa-sticky-note"></i>Purpose / Notes (Optional)
              </label>
              <textarea 
                name="notes" 
                id="notes" 
                class="form-control" 
                rows="4"
                placeholder="Why do you need this equipment?"
                x-model="notes"
              ></textarea>
            </div>

            <button 
              type="submit" 
              class="btn btn-submit mt-4"
              data-aos="fade-up"
              data-aos-delay="550"
              @click="isSubmitting = true"
              x-bind:disabled="isSubmitting || !selectedId"
            >
              <span x-show="!isSubmitting">
                <i class="fas fa-check"></i>Submit Borrowing Request
              </span>
              <span x-show="isSubmitting">
                <i class="fas fa-spinner fa-spin"></i>Submitting...
              </span>
            </button>
          </div>
        </div>
      </div>
    </form>
  @endif
</div>
@endsection

@section('scripts')
<script>
function borrowingForm() {
  return {
    selectedId: '',
    selectedName: '',
    selectedImage: '',
    selectedCategory: '',
    selectedQuantity: 0,
    borrowDate: '',
    expectedReturn: '',
    notes: '',
    isSubmitting: false,
    today: new Date().toISOString().split('T')[0],

    selectEquipment(event) {
      const card = event.currentTarget;
      const quantity = parseInt(card.getAttribute('data-quantity'));
      
      if (quantity <= 0) return;

      // Remove selection from all cards
      document.querySelectorAll('.equipment-card').forEach(c => c.classList.remove('selected'));
      
      // Add selection to clicked card
      card.classList.add('selected');

      // Update form data
      this.selectedId = card.getAttribute('data-id');
      this.selectedName = card.getAttribute('data-name');
      this.selectedImage = card.getAttribute('data-image');
      this.selectedCategory = card.getAttribute('data-category');
      this.selectedQuantity = quantity;

      // Scroll to form
      setTimeout(() => {
        document.querySelector('.selected-equipment').scrollIntoView({ behavior: 'smooth' });
      }, 100);
    },

    updateExpectedReturn() {
      if (!this.borrowDate) return;

      const borrowDate = new Date(this.borrowDate);
      const expectedReturn = new Date(borrowDate);
      expectedReturn.setDate(expectedReturn.getDate() + 7); // Default to 7 days

      this.expectedReturn = expectedReturn.toISOString().split('T')[0];
    }
  }
}
</script>
@endsection

