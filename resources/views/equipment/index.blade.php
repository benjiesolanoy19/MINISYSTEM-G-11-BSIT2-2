@extends('layouts.dashboard')

@section('title', 'Equipment Inventory')

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
}

.card {
  border: none;
  border-radius: 20px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  overflow: hidden;
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
  border-bottom: 1px solid #e2e8f0;
}

.table tbody td {
  padding: 15px;
  border: none;
  border-bottom: 1px solid #f1f5f9;
  vertical-align: middle;
}

.table tbody tr:hover {
  background: #f8fafc;
}

.table tbody tr:last-child td {
  border-bottom: none;
}

.badge {
  padding: 6px 12px;
  border-radius: 20px;
  font-weight: 600;
  font-size: 12px;
}

.btn-primary {
  background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%);
  border: none;
  padding: 12px 24px;
  border-radius: 10px;
  font-weight: 600;
  box-shadow: 0 4px 15px rgba(14, 165, 233, 0.3);
  text-decoration: none;
}

.btn-primary:hover {
  background: linear-gradient(135deg, #0284c7 0%, #059669 100%);
  transform: translateY(-2px);
  color: white;
}

.btn-sm {
  padding: 6px 12px;
  border-radius: 8px;
  font-weight: 600;
}

.btn-danger {
  background: #ef4444;
  border: none;
}

.btn-danger:hover {
  background: #dc2626;
}

.btn-edit {
  background: #0ea5e9;
  color: white;
}

.btn-edit:hover {
  background: #0284c7;
}

.empty-state {
  text-align: center;
  padding: 60px 20px;
  color: #64748b;
}

.empty-state p {
  margin-bottom: 20px;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
  <div class="page-header">
    <h1 class="page-title">Equipment Inventory</h1>
    <a href="{{ route('equipment.create') }}" class="btn btn-primary">
      <i class="fas fa-plus me-2"></i> Add Equipment
    </a>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="card">
    <div class="card-body">
      @if($equipment->count() > 0)
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Available</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($equipment as $item)
              <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->category }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->available }}</td>
                <td>
                  @if($item->status === 'available')
                    <span class="badge bg-success">Available</span>
                  @elseif($item->status === 'borrowed')
                    <span class="badge bg-warning">Borrowed</span>
                  @elseif($item->status === 'maintenance')
                    <span class="badge bg-danger">Maintenance</span>
                  @endif
                </td>
                <td>
                  <a href="{{ route('equipment.edit', $item->id) }}" class="btn btn-sm btn-edit me-1">
                    <i class="fas fa-edit"></i>
                  </a>
                  <form method="POST" action="{{ route('equipment.destroy', $item->id) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                      <i class="fas fa-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <div class="empty-state">
          <p>No equipment found.</p>
          <a href="{{ route('equipment.create') }}" class="btn btn-primary">Add Equipment</a>
        </div>
      @endif
    </div>
</div>
@endsection
</parameter>
</create_file>
