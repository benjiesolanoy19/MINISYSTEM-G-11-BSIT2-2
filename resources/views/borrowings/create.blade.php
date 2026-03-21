@extends('layouts.dashboard')

@section('title', 'Borrow Equipment')

@push('styles')
<style>
.page-title { font-size: 28px; font-weight: 700; color: #1e293b; }
.equipment-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 25px; }
.equipment-card { background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08); transition: all 0.3s ease; cursor: pointer; border: 3px solid transparent; }
.equipment-card:hover { transform: translateY(-5px); box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12); }
.equipment-card.selected { border-color: #0ea5e9; background: #f0f9ff; }
.equipment-img { width: 100%; height: 160px; object-fit: cover; background: #e2e8f0; }
.equipment-body { padding: 18px; }
.equipment-name { font-size: 16px; font-weight: 600; color: #1e293b; margin-bottom: 8px; }
.equipment-category { display: inline-block; padding: 4px 10px; background: #e0f2fe; color: #0284c7; border-radius: 20px; font-size: 12px; font-weight: 600; margin-bottom: 10px; }
.equipment-details { display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; }
.equipment-quantity { font-size: 14px; color: #64748b; }
.quantity-badge { padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; }
.quantity-available { background: #d1fae5; color: #059669; }
.quantity-limited { background: #fef3c7; color: #d97706; }
.quantity-empty { background: #fee2e2; color: #dc2626; }
.equipment-desc { font-size: 13px; color: #64748b; line-height: 1.5; }
.selected-equipment { background: white; border-radius: 16px; padding: 25px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08); }
.selected-title { font-size: 18px; font-weight: 600; color: #1e293b; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
.selected-img { width: 80px; height: 80px; border-radius: 12px; object-fit: cover; }
.form-label { font-weight: 600; color: #374151; margin-bottom: 8px; }
.form-control { border: 2px solid #e5e7eb; border-radius: 10px; padding: 12px 16px; }
.form-control:focus { border-color: #0ea5e9; box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.1); }
.btn-submit { background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%); border: none; padding: 14px 32px; border-radius: 12px; font-weight: 600; color: white; transition: all 0.3s ease; }
.btn-submit:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(14, 165, 233, 0.3); }
.no-equipment { text-align: center; padding: 60px 20px; color: #64748b; }
.no-equipment i { font-size: 48px; margin-bottom: 15px; color: #cbd5e1; }
</style>
@endpush

@section('content')
<div class="container-fluid">
  <h1 class="page-title mb-4">Borrow Equipment</h1>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      @foreach($errors->all() as $error){{ $error }}@endforeach
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @if($equipment->isEmpty())
    <div class="no-equipment">
      <i class="fas fa-laptop"></i>
      <h3>No Equipment Available</h3>
      <p>There are no equipment items available for borrowing at the moment.</p>
    </div>
  @else
    <form method="POST" action="{{ route('borrowings.store') }}" id="borrowingForm">
      @csrf
      <input type="hidden" name="equipment_id" id="selectedEquipmentId" required>
      
      <h4 class="mb-3">Select Equipment</h4>
      <div class="equipment-grid mb-4">
        @foreach($equipment as $item)
        <div class="equipment-card" data-id="{{ $item->id }}" data-name="{{ $item->name }}" data-image="{{ $item->image ?? 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=400&h=300&fit=crop' }}" onclick="selectEquipment(this)">
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
        @endforeach
      </div>

      <div class="row">
        <div class="col-lg-8">
          <div class="selected-equipment" id="selectedInfo" style="display: none;">
            <h5 class="selected-title"><i class="fas fa-check-circle text-success"></i> Selected Equipment</h5>
            <div class="row align-items-center">
              <div class="col-md-3">
                <img src="" alt="" id="selectedImage" class="selected-img">
              </div>
              <div class="col-md-9">
                <h4 id="selectedName" class="mb-1"></h4>
                <div class="mb-3">
                  <label class="form-label">Borrow Date</label>
                  <input type="date" name="borrow_date" id="borrow_date" class="form-control" required min="{{ date('Y-m-d') }}">
                </div>
                <div class="mb-3">
                  <label class="form-label">Expected Return Date</label>
                  <input type="date" name="expected_return" id="expected_return" class="form-control" required min="{{ date('Y-m-d') }}">
                </div>
                <div class="mb-3">
                  <label class="form-label">Notes (Optional)</label>
                  <textarea name="notes" id="notes" class="form-control" rows="2" placeholder="Any special requirements..."></textarea>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
          <div class="selected-equipment" id="submitSection" style="display: none;">
            <h5 class="selected-title"><i class="fas fa-paper-plane"></i> Submit Request</h5>
            <button type="submit" class="btn btn-submit w-100 mb-2"><i class="fas fa-check me-2"></i>Submit Request</button>
<a href="{{ route('dashboard') }}" class="btn btn-outline-secondary w-100">Cancel</a>
          </div>
      </div>
    </form>
  @endif
</div>

<script>
function selectEquipment(element) {
  document.querySelectorAll('.equipment-card').forEach(card => card.classList.remove('selected'));
  element.classList.add('selected');
  const id = element.dataset.id;
  const name = element.dataset.name;
  const image = element.dataset.image;
  document.getElementById('selectedEquipmentId').value = id;
  document.getElementById('selectedInfo').style.display = 'block';
  document.getElementById('submitSection').style.display = 'block';
  document.getElementById('selectedImage').src = image;
  document.getElementById('selectedName').textContent = name;
  document.getElementById('selectedInfo').scrollIntoView({ behavior: 'smooth', block: 'center' });
}
document.getElementById('borrow_date').addEventListener('change', function() {
  const borrowDate = new Date(this.value);
  borrowDate.setDate(borrowDate.getDate() + 1);
  document.getElementById('expected_return').min = borrowDate.toISOString().split('T')[0];
});
</script>
@endsection
</parameter>
</create_file>
