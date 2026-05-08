@extends('layouts.dashboard')

@section('title', 'Manage Borrowings - ICTFE')

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

.badge-success { background: linear-gradient(135deg, #10b981, #059669); color: white; }
.badge-warning { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; }
.badge-primary { background: linear-gradient(135deg, #0ea5e9, #0284c7); color: white; }
.badge-info { background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; }
.badge-danger { background: linear-gradient(135deg, #ef4444, #dc2626); color: white; }

.btn-group-sm {
  display: flex;
  gap: 6px;
  flex-wrap: wrap;
}

.btn-sm {
  padding: 6px 12px;
  font-size: 12px;
  border-radius: 8px;
  border: none;
  font-weight: 600;
  transition: all 0.3s ease;
  display: inline-flex;
  align-items: center;
  gap: 4px;
  cursor: pointer;
}

.btn-success {
  background: linear-gradient(135deg, #10b981, #059669);
  color: white;
}

.btn-primary {
  background: linear-gradient(135deg, #0ea5e9, #0284c7);
  color: white;
}

.btn-warning {
  background: linear-gradient(135deg, #f59e0b, #d97706);
  color: white;
}

.btn-danger {
  background: linear-gradient(135deg, #ef4444, #dc2626);
  color: white;
}

.btn-sm:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.btn-sm:disabled {
  opacity: 0.5;
  cursor: not-allowed;
  transform: none;
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

.status-badge-pending { color: #f59e0b; }
.status-badge-approved { color: #0ea5e9; }
.status-badge-returned { color: #10b981; }
.status-badge-damaged { color: #ef4444; }
.status-badge-lost { color: #dc2626; }
</style>
@endsection

@section('content')
<div class="container-fluid" x-data="borrowingsManagement()">
    <div class="page-header" data-aos="fade-down" data-aos-duration="600">
      <div>
        <h2 class="page-title" data-aos="fade-right" data-aos-delay="100">
          <i class="fas fa-cogs"></i>Manage Borrowings
        </h2>
        <p class="page-subtitle" data-aos="fade-right" data-aos-delay="150">
          Review and manage equipment borrowing requests
        </p>
      </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" data-aos="slide-in-right" role="alert">
          <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card" data-aos="fade-up" data-aos-duration="700">
        <div class="card-header">
          <h5><i class="fas fa-list me-2"></i>All Borrowing Requests</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><i class="fas fa-hashtag me-1"></i>ID</th>
                            <th><i class="fas fa-user me-1"></i>User</th>
                            <th><i class="fas fa-tools me-1"></i>Equipment</th>
                            <th><i class="fas fa-cube me-1"></i>Qty</th>
                            <th><i class="fas fa-calendar-check me-1"></i>Borrow</th>
                            <th><i class="fas fa-hourglass-end me-1"></i>Due</th>
                            <th><i class="fas fa-info-circle me-1"></i>Status</th>
                            <th><i class="fas fa-tasks me-1"></i>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($borrowings as $borrowing)
                        <tr data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                            <td>
                              <strong>#{{ $borrowing->id }}</strong>
                            </td>
                            <td>
                              <strong>{{ $borrowing->user->name ?? 'N/A' }}</strong>
                              <br>
                              <small class="text-muted">{{ $borrowing->user->email ?? 'N/A' }}</small>
                            </td>
                            <td>{{ $borrowing->equipment->name ?? 'N/A' }}</td>
                            <td>
                              <span class="badge badge-info">{{ $borrowing->quantity }}</span>
                            </td>
                            <td>
                              <i class="fas fa-calendar-alt me-1" style="color: #0ea5e9;"></i>
                              {{ $borrowing->borrow_date }}
                            </td>
                            <td>
                              <i class="fas fa-calendar-times me-1" style="color: #ef4444;"></i>
                              {{ $borrowing->due_date }}
                            </td>
                            <td>
                                <span class="badge {{ 
                                  $borrowing->status == 'returned' ? 'badge-success' : 
                                  ($borrowing->status == 'damaged' ? 'badge-warning' : 
                                  ($borrowing->status == 'lost' ? 'badge-danger' : 
                                  ($borrowing->status == 'pending' ? 'badge-warning' : 'badge-primary'))) 
                                }}">
                                    @if($borrowing->status === 'returned')
                                        <i class="fas fa-check-circle"></i> Returned
                                    @elseif($borrowing->status === 'damaged')
                                        <i class="fas fa-exclamation-triangle"></i> Damaged
                                    @elseif($borrowing->status === 'lost')
                                        <i class="fas fa-times-circle"></i> Lost
                                    @elseif($borrowing->status === 'pending')
                                        <i class="fas fa-clock"></i> Pending
                                    @else
                                        <i class="fas fa-thumbs-up"></i> Approved
                                    @endif
                                </span>
                            </td>
                            <td>
                                <div class="btn-group-sm">
                                    @if($borrowing->status == 'pending')
                                    <form method="POST" action="{{ route('borrowings.approve', $borrowing->id) }}" style="display: inline;">
                                        @csrf
                                        <button 
                                          type="submit" 
                                          class="btn-sm btn-success"
                                          @click="isSubmitting = true"
                                          x-bind:disabled="isSubmitting"
                                        >
                                            <i class="fas fa-check"></i> Approve
                                        </button>
                                    </form>
                                    @elseif($borrowing->status == 'approved')
                                    <form method="POST" action="{{ route('borrowings.return', $borrowing->id) }}" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn-sm btn-primary">
                                            <i class="fas fa-undo"></i> Mark Returned
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('borrowings.damaged', $borrowing->id) }}" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn-sm btn-warning">
                                            <i class="fas fa-wrench"></i> Damaged
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('borrowings.lost', $borrowing->id) }}" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Lost
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">
                              <div class="empty-state py-4">
                                <i class="fas fa-inbox mb-3"></i>
                                <h4>No borrowings found</h4>
                                <p>There are no equipment borrowing requests to manage.</p>
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

@section('scripts')
<script>
function borrowingsManagement() {
  return {
    isSubmitting: false
  }
}
</script>
@endsection

