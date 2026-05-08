@extends('layouts.dashboard')

@section('title', 'Equipment Inventory - ICTFE')

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

.card {
  border: none;
  border-radius: 16px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  overflow: hidden;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.card:hover {
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
}

.card-header {
  background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%);
  color: white;
  padding: 20px;
  border: none;
}

.card-header h5 {
  margin: 0;
  display: flex;
  align-items: center;
  gap: 10px;
  font-weight: 600;
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
.badge-borrowed { background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; }
.badge-maintenance { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; }

.btn-group-sm {
  display: flex;
  gap: 6px;
  flex-wrap: wrap;
}

.btn-sm {
  padding: 6px 12px;
  border-radius: 8px;
  font-weight: 600;
  border: none;
  transition: all 0.3s ease;
  display: inline-flex;
  align-items: center;
  gap: 4px;
}

.btn-primary-sm {
  background: linear-gradient(135deg, #0ea5e9, #0284c7);
  color: white;
}

.btn-danger-sm {
  background: linear-gradient(135deg, #ef4444, #dc2626);
  color: white;
}

.btn-sm:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.btn-primary {
  background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%);
  border: none;
  padding: 12px 24px;
  border-radius: 10px;
  font-weight: 600;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  transition: all 0.3s ease;
  color: white;
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(14, 165, 233, 0.3);
  color: white;
}

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
</style>
@endsection

@section('content')
<div class="container-fluid">
  <div class="page-header" data-aos="fade-down" data-aos-duration="600">
    <div>
      <h1 class="page-title" data-aos="fade-right" data-aos-delay="100">
        <i class="fas fa-tools"></i>Equipment Inventory - ICTFE
      </h1>
      <p class="page-subtitle" data-aos="fade-right" data-aos-delay="150">
        Manage all facility equipment and resources
      </p>
    </div>
    <a href="{{ route('equipment.create') }}" class="btn btn-primary" data-aos="fade-up" data-aos-delay="100">
      <i class="fas fa-plus"></i>Add Equipment
    </a>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" data-aos="slide-in-right" role="alert">
      <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <!-- Equipment Statistics -->
  <div class="row mb-4" data-aos="fade-up" data-aos-delay="100">
    <div class="col-lg-3 col-md-6 mb-3">
      <div class="card">
        <div class="card-body p-4">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <div class="h4 mb-1">{{ $equipment->count() }}</div>
              <small class="text-muted">Total Equipment</small>
            </div>
            <div style="font-size: 2rem; color: #0ea5e9; opacity: 0.2;">
              <i class="fas fa-cube"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-3">
      <div class="card">
        <div class="card-body p-4">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <div class="h4 mb-1" style="color: #10b981;">{{ $equipment->where('status', 'available')->count() }}</div>
              <small class="text-muted">Available</small>
            </div>
            <div style="font-size: 2rem; color: #10b981; opacity: 0.2;">
              <i class="fas fa-check-circle"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-3">
      <div class="card">
        <div class="card-body p-4">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <div class="h4 mb-1" style="color: #3b82f6;">{{ $equipment->where('status', 'borrowed')->count() }}</div>
              <small class="text-muted">In Borrowing</small>
            </div>
            <div style="font-size: 2rem; color: #3b82f6; opacity: 0.2;">
              <i class="fas fa-exchange-alt"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-3">
      <div class="card">
        <div class="card-body p-4">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <div class="h4 mb-1" style="color: #f59e0b;">{{ $equipment->where('status', 'maintenance')->count() }}</div>
              <small class="text-muted">In Maintenance</small>
            </div>
            <div style="font-size: 2rem; color: #f59e0b; opacity: 0.2;">
              <i class="fas fa-wrench"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card" data-aos="fade-up" data-aos-duration="700">
    <div class="card-header">
      <h5><i class="fas fa-list me-2"></i>Equipment List</h5>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th><i class="fas fa-box me-1"></i>Equipment</th>
              <th><i class="fas fa-tag me-1"></i>Category</th>
              <th><i class="fas fa-cubes me-1"></i>Quantity</th>
              <th><i class="fas fa-circle me-1"></i>Status</th>
              <th><i class="fas fa-tasks me-1"></i>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($equipment as $item)
            <tr data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
              <td><strong>{{ $item->name }}</strong></td>
              <td>
                <span class="badge" style="background: #e0f2fe; color: #0284c7;">
                  {{ $item->category }}
                </span>
              </td>
              <td>
                <span class="badge badge-{{ $item->quantity > 0 ? 'available' : 'maintenance' }}">
                  {{ $item->quantity }} units
                </span>
              </td>
              <td>
                @if($item->status === 'available')
                  <span class="badge badge-available"><i class="fas fa-check-circle"></i> Available</span>
                @elseif($item->status === 'borrowed')
                  <span class="badge badge-borrowed"><i class="fas fa-exchange-alt"></i> Borrowed</span>
                @else
                  <span class="badge badge-maintenance"><i class="fas fa-wrench"></i> Maintenance</span>
                @endif
              </td>
              <td>
                <div class="btn-group-sm">
                  <a href="{{ route('equipment.edit', $item) }}" class="btn btn-sm btn-primary-sm">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <form action="{{ route('equipment.destroy', $item) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger-sm" onclick="return confirm('Delete this equipment?')">
                      <i class="fas fa-trash"></i> Delete
                    </button>
                  </form>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="5">
                <div class="empty-state py-4">
                  <i class="fas fa-inbox mb-3"></i>
                  <h4>No Equipment Found</h4>
                  <p>Start by adding your first equipment item.</p>
                  <a href="{{ route('equipment.create') }}" class="btn btn-primary mt-3">
                    <i class="fas fa-plus"></i> Add Equipment
                  </a>
                </div>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

