@extends('layouts.dashboard')

@section('title', 'Borrow Equipment')

@push('styles')
<style>
.page-title {
  font-size: 30px;
  font-weight: 800;
  color: #0f172a;
  display: flex;
  align-items: center;
  gap: 14px;
}

.page-title i {
  background: linear-gradient(135deg, #0ea5e9, #10b981);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  font-size: 1.4rem;
}

.page-subtitle {
  color: #475569;
  font-size: 0.97rem;
  margin-top: 6px;
}

.borrow-page {
  display: grid;
  gap: 30px;
}

.page-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
  flex-wrap: wrap;
}

.page-summary {
  display: flex;
  gap: 14px;
  flex-wrap: wrap;
}

.summary-chip {
  background: #eff6ff;
  border: 1px solid rgba(14, 165, 233, 0.16);
  border-radius: 18px;
  padding: 16px 20px;
  min-width: 140px;
  display: flex;
  flex-direction: column;
  gap: 4px;
}

.summary-chip strong {
  font-size: 1.35rem;
  color: #0f172a;
}

.summary-chip span {
  color: #475569;
  font-size: 0.92rem;
}

.summary-available {
  background: #ecfdf5;
  border-color: #a7f3d0;
}

.summary-out {
  background: #dbeafe;
  border-color: #93c5fd;
}

.filter-panel {
  display: grid;
  gap: 18px;
  margin-bottom: 22px;
}

.filter-toolbar {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 18px;
}

.filter-field {
  display: grid;
  gap: 10px;
}

.borrow-grid {
  display: grid;
  grid-template-columns: 1.9fr 1fr;
  gap: 28px;
}

@media (max-width: 1199px) {
  .borrow-grid {
    grid-template-columns: 1fr;
  }
}

.step-card {
  background: #ffffff;
  border-radius: 24px;
  padding: 28px;
  border: 1px solid rgba(226, 232, 240, 0.95);
  box-shadow: 0 24px 45px rgba(15, 23, 42, 0.08);
}

.step-card h4 {
  font-size: 1.3rem;
  font-weight: 700;
  margin-bottom: 24px;
}

.equipment-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 22px;
}

.equipment-card {
  position: relative;
  background: #f8fafc;
  border-radius: 24px;
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease, filter 0.3s ease;
  border: 2px solid transparent;
  cursor: pointer;
  display: flex;
  flex-direction: column;
  min-height: 100%;
}

.equipment-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 22px 45px rgba(15, 23, 42, 0.14);
}

.equipment-card.selected {
  background: #eef8ff;
  border-color: #0ea5e9;
}

.equipment-card.selected::before {
  content: '✓';
  position: absolute;
  top: 14px;
  right: 14px;
  width: 34px;
  height: 34px;
  background: linear-gradient(135deg, #0ea5e9, #10b981);
  color: white;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.95rem;
  box-shadow: 0 4px 12px rgba(14, 165, 233, 0.22);
}

.equipment-card.out-of-stock {
  filter: grayscale(0.45);
}

.equipment-img {
  width: 100%;
  height: 180px;
  object-fit: cover;
  background: linear-gradient(180deg, #e2e8f0 0%, #f8fafc 100%);
}

.equipment-body {
  padding: 18px;
  flex: 1;
  display: flex;
  flex-direction: column;
}

.equipment-category {
  display: inline-flex;
  align-items: center;
  padding: 7px 14px;
  border-radius: 999px;
  font-size: 0.78rem;
  font-weight: 700;
  color: #0f172a;
  background: rgba(14, 165, 233, 0.12);
  margin-bottom: 12px;
}

.equipment-name {
  font-size: 1.08rem;
  font-weight: 700;
  color: #0f172a;
  margin-bottom: 10px;
}

.equipment-details {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: space-between;
  gap: 10px;
  margin-bottom: 14px;
}

.equipment-quantity {
  font-size: 0.9rem;
  color: #475569;
}

.quantity-badge {
  padding: 6px 14px;
  border-radius: 999px;
  font-size: 0.78rem;
  font-weight: 700;
}

.quantity-available {
  background: #d1fae5;
  color: #047857;
}

.quantity-limited {
  background: #fef3c7;
  color: #92400e;
}

.quantity-empty {
  background: #fee2e2;
  color: #b91c1c;
}

.equipment-desc {
  font-size: 0.95rem;
  color: #64748b;
  line-height: 1.75;
  margin-top: auto;
}

.selected-equipment {
  background: #ffffff;
  border-radius: 22px;
  padding: 24px;
  border: 1px solid rgba(14, 165, 233, 0.18);
  margin-bottom: 24px;
}

.selected-title {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 1.05rem;
  font-weight: 700;
  margin-bottom: 18px;
}

.selected-img {
  width: 100%;
  max-width: 120px;
  height: 120px;
  border-radius: 20px;
  object-fit: cover;
  border: 1px solid rgba(226, 232, 240, 0.95);
}

.form-label {
  font-weight: 700;
  color: #0f172a;
  margin-bottom: 10px;
  display: inline-flex;
  align-items: center;
  gap: 10px;
}

.form-control {
  border: 1px solid #dbeafe;
  border-radius: 14px;
  padding: 14px 16px;
  transition: border-color 0.25s ease, box-shadow 0.25s ease;
  font-size: 0.95rem;
}

.form-control:focus {
  outline: none;
  border-color: #0ea5e9;
  box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.12);
}

.btn-submit {
  background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%);
  border: none;
  padding: 14px 28px;
  border-radius: 14px;
  color: white;
  font-weight: 700;
  letter-spacing: 0.01em;
  transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.btn-submit:hover {
  transform: translateY(-2px);
  box-shadow: 0 12px 25px rgba(14, 165, 233, 0.22);
}

.btn-submit:disabled {
  opacity: 0.65;
  cursor: not-allowed;
  transform: none;
}

.selection-note {
  background: #eef2ff;
  border: 1px dashed #93c5fd;
  border-radius: 18px;
  padding: 18px 20px;
  color: #475569;
}

.no-equipment {
  text-align: center;
  padding: 60px 30px;
  color: #64748b;
  background: #ffffff;
  border-radius: 24px;
  border: 1px solid rgba(226, 232, 240, 0.95);
  box-shadow: 0 18px 40px rgba(15, 23, 42, 0.04);
}

.no-equipment i {
  font-size: 52px;
  margin-bottom: 18px;
  color: #cbd5e1;
}

.alert {
  border-radius: 16px;
  border-left-width: 5px;
  padding: 18px 22px;
}

.alert-success {
  border-left-color: #10b981;
  background: rgba(16, 185, 129, 0.12);
  color: #064e3b;
}

.alert-danger {
  border-left-color: #ef4444;
  background: rgba(239, 68, 68, 0.12);
  color: #7f1d1d;
}
</style>
@endpush

@section('content')
<div class="container-fluid borrow-page" x-data="borrowingForm()" x-init="initializeSelection()">
  <div class="page-header" data-aos="fade-down" data-aos-duration="600">
    <div>
      <h1 class="page-title" data-aos="fade-right" data-aos-delay="100">
        <i class="fas fa-shopping-cart"></i>Borrow Equipment
      </h1>
      <p class="page-subtitle" data-aos="fade-right" data-aos-delay="150">
        Choose equipment with confidence, then submit your request with clear dates and purpose.
      </p>
    </div>
    <a href="{{ route('borrowings.index') }}" class="btn btn-outline-primary btn-lg rounded-pill px-4" data-aos="fade-left" data-aos-delay="150">
      <i class="fas fa-list me-2"></i>My Borrowings
    </a>
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
      <p>There are no available items for borrowing at the moment. Please check back later or contact your administrator.</p>
    </div>
  @else
    <form method="POST" action="{{ route('borrowings.store') }}" id="borrowingForm">
      @csrf
      <input type="hidden" name="equipment_id" id="selectedEquipmentId" x-model="selectedId" required>

      <div class="borrow-grid">
        <div class="step-card" data-aos="fade-up" data-aos-delay="200">
          <div class="page-summary mb-4">
            <div class="summary-chip">
              <strong x-text="equipmentData.length"></strong>
              <span>Total Items</span>
            </div>
            <div class="summary-chip summary-available">
              <strong x-text="availableCount"></strong>
              <span>Available</span>
            </div>
            <div class="summary-chip summary-out">
              <strong x-text="outOfStockCount"></strong>
              <span>Out of stock</span>
            </div>
          </div>

          <div class="filter-panel mb-4">
            <div class="filter-field">
              <label class="form-label">Search equipment</label>
              <input type="search" class="form-control" placeholder="Search by name, category or description" x-model="searchQuery">
            </div>

            <div class="filter-toolbar">
              <div class="filter-field">
                <label class="form-label">Category</label>
                <select class="form-control" x-model="selectedCategoryFilter">
                  <template x-for="category in categories" :key="category">
                    <option x-text="category"></option>
                  </template>
                </select>
              </div>

              <div class="filter-field">
                <label class="form-label">Sort by</label>
                <select class="form-control" x-model="sortOrder">
                  <option value="latest">Latest</option>
                  <option value="available">Most available</option>
                  <option value="name">Name</option>
                  <option value="category">Category</option>
                </select>
              </div>
            </div>
          </div>

          <div class="equipment-grid">
            <template x-for="item in filteredEquipment" :key="item.id">
              <div
                class="equipment-card"
                :class="{ 'selected': selectedId === item.id, 'out-of-stock': item.available_quantity === 0 }"
                @click="selectEquipment(item)"
                :title="item.description || defaultDescription"
              >
                <img :src="item.image || defaultImage" alt="" class="equipment-img">
                <div class="equipment-body">
                  <span class="equipment-category" x-text="item.category"></span>
                  <h5 class="equipment-name" x-text="item.name"></h5>

                  <div class="equipment-details">
                    <span class="equipment-quantity" x-text="item.available_quantity > 0 ? 'Available now' : 'Not available'"></span>
                    <span
                      class="quantity-badge"
                      :class="{
                        'quantity-available': item.available_quantity > 5,
                        'quantity-limited': item.available_quantity > 0 && item.available_quantity <= 5,
                        'quantity-empty': item.available_quantity === 0
                      }"
                      x-text="item.available_quantity > 0 ? item.available_quantity + ' units' : 'Out of stock'"
                    ></span>
                  </div>

                  <p class="equipment-desc" x-text="item.description || defaultDescription"></p>
                </div>
              </div>
            </template>
          </div>

          <div class="selection-note mt-4" x-show="filteredEquipment.length === 0" x-transition.duration.300ms>
            <p class="mb-0"><strong>No equipment matches your search.</strong> Try a different keyword or reset the filters.</p>
          </div>
        </div>

        <div class="step-card" data-aos="fade-up" data-aos-delay="250">
          <h4><i class="fas fa-calendar-check text-success me-2"></i>Step 2: Confirm Details</h4>

          <div class="selected-equipment" x-show="selectedId" x-transition.duration.300ms>
            <div class="selected-title"><i class="fas fa-check-circle text-success"></i> Selected Equipment</div>
            <div class="row align-items-center gy-3">
              <div class="col-4">
                <img :src="selectedImage" alt="Selected equipment image" class="selected-img">
              </div>
              <div class="col-8">
                <h5 class="mb-1" x-text="selectedName"></h5>
                <p class="text-muted mb-1" x-text="selectedCategory"></p>
                <p class="text-muted small">Quantity available: <span x-text="selectedQuantity"></span></p>
              </div>
            </div>
          </div>

          <div class="selection-note mb-4" x-show="!selectedId" x-transition.duration.300ms>
            <p class="mb-0"><strong>Tip:</strong> Click any equipment card to preview details and unlock the borrowing form.</p>
          </div>

          <div class="form-group mb-4" data-aos="fade-up" data-aos-delay="300">
            <label class="form-label"><i class="fas fa-calendar-alt"></i>Borrow Date</label>
            <input
              type="date"
              name="borrow_date"
              id="borrow_date"
              class="form-control"
              required
              :min="today"
              x-model="borrowDate"
              @change="updateReturnDate()"
              :disabled="!selectedId"
            >
          </div>

          <div class="form-group mb-4" data-aos="fade-up" data-aos-delay="340">
            <label class="form-label"><i class="fas fa-hourglass-end"></i>Return Date</label>
            <input
              type="date"
              name="return_date"
              id="return_date"
              class="form-control"
              required
              :min="borrowDate || today"
              x-model="returnDate"
              :disabled="!selectedId"
            >
          </div>

          <div class="form-group mb-4" data-aos="fade-up" data-aos-delay="380">
            <label class="form-label"><i class="fas fa-question-circle"></i>Purpose <span class="text-danger">*</span></label>
            <input
              type="text"
              name="purpose"
              id="purpose"
              class="form-control"
              required
              placeholder="Describe why you need this equipment"
              maxlength="255"
              x-model="purpose"
              :disabled="!selectedId"
            >
          </div>

          <div class="form-group mb-4" data-aos="fade-up" data-aos-delay="420">
            <label class="form-label"><i class="fas fa-sticky-note"></i>Additional Notes</label>
            <textarea
              name="notes"
              id="notes"
              class="form-control"
              rows="4"
              placeholder="Optional notes for the administrator"
              x-model="notes"
              :disabled="!selectedId"
            ></textarea>
          </div>

          <button
            type="submit"
            class="btn btn-submit w-100"
            data-aos="fade-up"
            data-aos-delay="460"
            :disabled="isSubmitting || !selectedId || !borrowDate || !returnDate || !purpose"
          >
            <span x-show="!isSubmitting">
              <i class="fas fa-check"></i> Submit Borrowing Request
            </span>
            <span x-show="isSubmitting">
              <i class="fas fa-spinner fa-spin"></i> Submitting...
            </span>
          </button>
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
    equipmentData: {!! json_encode($equipment->map->only(['id','name','image','category','available_quantity','description'])->all()) !!},
    categories: {!! json_encode(array_merge(['All'], $equipment->pluck('category')->unique()->sort()->values()->all())) !!},
    selectedId: null,
    selectedName: '',
    selectedImage: '',
    selectedCategory: '',
    selectedQuantity: 0,
    borrowDate: '',
    returnDate: '',
    purpose: '',
    notes: '',
    searchQuery: '',
    selectedCategoryFilter: 'All',
    sortOrder: 'latest',
    isSubmitting: false,
    today: new Date().toISOString().split('T')[0],
    defaultImage: 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=400&h=300&fit=crop',
    defaultDescription: 'High-quality equipment for labs, classrooms, and learning.',

    initializeSelection() {
      const firstAvailable = this.equipmentData.find(item => item.available_quantity > 0);
      if (firstAvailable) {
        this.selectEquipment(firstAvailable);
      }
    },

    selectEquipment(item) {
      if (item.available_quantity <= 0) {
        return;
      }

      this.selectedId = item.id;
      this.selectedName = item.name;
      this.selectedImage = item.image || this.defaultImage;
      this.selectedCategory = item.category;
      this.selectedQuantity = item.available_quantity;

      if (!this.borrowDate) {
        this.borrowDate = this.today;
        this.updateReturnDate();
      }
    },

    updateReturnDate() {
      if (!this.borrowDate) return;
      const borrowDate = new Date(this.borrowDate);
      const defaultReturn = new Date(borrowDate);
      defaultReturn.setDate(defaultReturn.getDate() + 7);
      this.returnDate = defaultReturn.toISOString().split('T')[0];
    },

    get filteredEquipment() {
      let results = this.equipmentData.filter(item => {
        const query = this.searchQuery.toLowerCase();
        const matchesQuery = !query || item.name.toLowerCase().includes(query) || item.category.toLowerCase().includes(query) || item.description.toLowerCase().includes(query);
        const matchesCategory = this.selectedCategoryFilter === 'All' || item.category === this.selectedCategoryFilter;
        return matchesQuery && matchesCategory;
      });

      if (this.sortOrder === 'available') {
        results.sort((a, b) => b.available_quantity - a.available_quantity);
      } else if (this.sortOrder === 'name') {
        results.sort((a, b) => a.name.localeCompare(b.name));
      } else if (this.sortOrder === 'category') {
        results.sort((a, b) => a.category.localeCompare(b.category));
      }

      return results;
    },

    get availableCount() {
      return this.equipmentData.filter(item => item.available_quantity > 0).length;
    },

    get outOfStockCount() {
      return this.equipmentData.filter(item => item.available_quantity === 0).length;
    }
  }
}
</script>
@endsection

