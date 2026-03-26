@extends('layouts.dashboard')

@section('title', 'Inventory Report')

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
  background: linear-gradient(135deg, #06b6d4, #0891b2);
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

.card:hover {
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
}

.card-header {
  background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
  color: white;
  padding: 20px;
  border: none;
}

.card-body {
  padding: 0;
}

.table {
  margin-bottom: 0;
}

.table thead th {
  background: #f8fafc;
  padding: 15px;
  font-weight: 600;
  font-size: 12px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  color: #64748b;
  border: none;
  border-bottom: 2px solid #e2e8f0;
}

.table tbody td {
  padding: 15px;
  border: none;
  border-bottom: 1px solid #f1f5f9;
  vertical-align: middle;
}

.table tbody tr {
  transition: all 0.3s ease;
}

.table tbody tr:hover {
  background: #f8fafc;
  transform: scale(0.99);
}

.table tbody tr:last-child td {
  border-bottom: none;
}

.badge {
  padding: 6px 12px;
  border-radius: 20px;
  font-weight: 600;
  font-size: 12px;
  display: inline-flex;
  align-items: center;
  gap: 4px;
}

.badge-available { background: linear-gradient(135deg, #10b981, #059669); color: white; }
.badge-out-of-stock { background: linear-gradient(135deg, #ef4444, #dc2626); color: white; }

.empty-state {
  text-align: center;
  padding: 60px 20px;
  color: #64748b;
}

.empty-state i {
  font-size: 48px;
  margin-bottom: 15px;
  color: #cbd5e1;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
  <div class="page-header" data-aos="fade-down" data-aos-duration="600">
    <div>
      <h1 class="page-title" data-aos="fade-right" data-aos-delay="100">
        <i class="fas fa-boxes"></i>Inventory Report
      </h1>
      <p class="page-subtitle" data-aos="fade-right" data-aos-delay="150">
        Complete equipment inventory and availability status
      </p>
    </div>
  </div>

  <div class="card" data-aos="fade-up" data-aos-duration="700">
    <div class="card-header">
      <h5><i class="fas fa-list me-2"></i>Equipment Inventory</h5>
    </div>
    <div class="card-body">
      @if($equipment->count() > 0)
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th><i class="fas fa-box me-1"></i>Name</th>
                <th><i class="fas fa-tag me-1"></i>Category</th>
                <th><i class="fas fa-cubes me-1"></i>Total</th>
                <th><i class="fas fa-check-square me-1"></i>Available</th>
                <th><i class="fas fa-circle me-1"></i>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($equipment as $item)
              <tr data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <td><strong>{{ $item->name }}</strong></td>
                <td>
                  <span class="badge" style="background: #e0f2fe; color: #0284c7;">
                    {{ $item->category }}
                  </span>
                </td>
                <td>{{ $item->quantity ?? 0 }}</td>
                <td>{{ $item->available_quantity ?? 0 }}</td>
                <td>
                  @if(($item->available_quantity ?? 0) > 0)
                    <span class="badge badge-available">
                      <i class="fas fa-check-circle"></i> Available
                    </span>
                  @else
                    <span class="badge badge-out-of-stock">
                      <i class="fas fa-times-circle"></i> Out of Stock
                    </span>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <div class="empty-state py-4">
          <i class="fas fa-inbox mb-3"></i>
          <h4>No Equipment Found</h4>
          <p>The inventory is currently empty.</p>
        </div>
      @endif
    </div>
  </div>
</div>
@endsection