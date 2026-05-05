@extends('layouts.dashboard')

@section('title', 'My Borrowings')

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
  margin-top: 5px;
}

.borrowing-cards-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
  gap: 20px;
  margin-bottom: 30px;
}

.borrowing-card {
  background: white;
  border-radius: 16px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  overflow: hidden;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  border: 1px solid #e2e8f0;
  position: relative;
}

.borrowing-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
}

.borrowing-card-header {
  padding: 20px 20px 0 20px;
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
}

.borrowing-card-body {
  padding: 15px 20px 20px 20px;
}

.equipment-icon {
  width: 50px;
  height: 50px;
  border-radius: 12px;
  background: linear-gradient(135deg, #0ea5e9, #10b981);
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 1.2rem;
  margin-bottom: 12px;
}

.equipment-name {
  font-size: 1.1rem;
  font-weight: 700;
  color: #1e293b;
  margin-bottom: 8px;
}

.equipment-category {
  display: inline-flex;
  align-items: center;
  padding: 4px 8px;
  border-radius: 6px;
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  margin-bottom: 12px;
}

.category-laptop { background: rgba(14, 165, 233, 0.1); color: #0369a1; }
.category-projector { background: rgba(16, 185, 129, 0.1); color: #047857; }
.category-other { background: rgba(249, 115, 22, 0.1); color: #c2410c; }

.borrowing-details {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px;
  margin-bottom: 15px;
}

.detail-item {
  display: flex;
  flex-direction: column;
}

.detail-label {
  font-size: 0.75rem;
  color: #64748b;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  font-weight: 600;
  margin-bottom: 4px;
}

.detail-value {
  font-size: 0.9rem;
  color: #1e293b;
  font-weight: 500;
}

.status-badge {
  padding: 6px 12px;
  border-radius: 20px;
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  display: inline-flex;
  align-items: center;
  gap: 6px;
}

.status-pending { background: rgba(251, 191, 36, 0.1); color: #d97706; }
.status-approved { background: rgba(34, 197, 94, 0.1); color: #16a34a; }
.status-returned { background: rgba(99, 102, 241, 0.1); color: #4338ca; }
.status-damaged { background: rgba(239, 68, 68, 0.1); color: #dc2626; }
.status-lost { background: rgba(107, 114, 128, 0.1); color: #6b7280; }

.card-actions {
  display: flex;
  gap: 8px;
  margin-top: 15px;
}

.btn-card {
  padding: 8px 16px;
  border-radius: 8px;
  font-size: 0.85rem;
  font-weight: 600;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  transition: all 0.2s ease;
  border: none;
  cursor: pointer;
}

.btn-primary { background: #0ea5e9; color: white; }
.btn-primary:hover { background: #0284c7; transform: translateY(-1px); }

.btn-success { background: #10b981; color: white; }
.btn-success:hover { background: #059669; transform: translateY(-1px); }

.btn-outline-secondary {
  background: transparent;
  color: #64748b;
  border: 1px solid #d1d5db;
}
.btn-outline-secondary:hover {
  background: #f9fafb;
  color: #374151;
  transform: translateY(-1px);
}

.empty-state {
  text-align: center;
  padding: 60px 20px;
  color: #64748b;
}

.empty-state i {
  font-size: 4rem;
  margin-bottom: 20px;
  opacity: 0.5;
}

.empty-state h4 {
  font-size: 1.25rem;
  font-weight: 600;
  color: #1e293b;
  margin-bottom: 8px;
}

.empty-state p {
  font-size: 0.95rem;
  margin-bottom: 30px;
}

.filter-tabs {
  display: flex;
  gap: 8px;
  margin-bottom: 30px;
  flex-wrap: wrap;
}

.filter-tab {
  padding: 8px 16px;
  border-radius: 8px;
  font-size: 0.85rem;
  font-weight: 600;
  text-decoration: none;
  color: #64748b;
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  transition: all 0.2s ease;
}

.filter-tab:hover,
.filter-tab.active {
  background: #0ea5e9;
  color: white;
  border-color: #0ea5e9;
}

@media (max-width: 768px) {
  .borrowing-cards-grid {
    grid-template-columns: 1fr;
  }

  .borrowing-details {
    grid-template-columns: 1fr;
  }

  .card-actions {
    flex-direction: column;
  }

  .btn-card {
    justify-content: center;
  }
}
</style>
@endsection
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

.badge-success { background: linear-gradient(135deg, #10b981, #059669); color: white; }
.badge-warning { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; }
.badge-primary { background: linear-gradient(135deg, #0ea5e9, #0284c7); color: white; }
.badge-danger { background: linear-gradient(135deg, #ef4444, #dc2626); color: white; }

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

.empty-state p {
  margin-bottom: 20px;
}

.status-icon {
  font-size: 14px;
  margin-right: 4px;
}
</style>
@endsection

@section('content')
<div class="container-fluid" x-data="borrowingsList()">
  <div class="page-header" data-aos="fade-down" data-aos-duration="600">
    <div>
      <h1 class="page-title" data-aos="fade-right" data-aos-delay="100">
        <i class="fas fa-exchange-alt"></i>My Borrowings
      </h1>
      <p class="page-subtitle" data-aos="fade-right" data-aos-delay="150">
        Track your equipment borrowing history
      </p>
    </div>
    <div data-aos="fade-left" data-aos-delay="200">
      <a href="{{ route('borrowings.create') }}" class="btn btn-primary btn-lg rounded-pill px-4">
        <i class="fas fa-plus me-2"></i>New Borrowing
      </a>
    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" data-aos="slide-in-right" role="alert">
      <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <!-- Filter Tabs -->
  <div class="filter-tabs" data-aos="fade-up" data-aos-delay="300">
    <a href="#" class="filter-tab active" onclick="filterBorrowings('all')">
      <i class="fas fa-list me-1"></i>All ({{ $borrowings->count() }})
    </a>
    <a href="#" class="filter-tab" onclick="filterBorrowings('pending')">
      <i class="fas fa-clock me-1"></i>Pending ({{ $borrowings->where('status', 'pending')->count() }})
    </a>
    <a href="#" class="filter-tab" onclick="filterBorrowings('approved')">
      <i class="fas fa-check me-1"></i>Approved ({{ $borrowings->where('status', 'approved')->count() }})
    </a>
    <a href="#" class="filter-tab" onclick="filterBorrowings('returned')">
      <i class="fas fa-undo me-1"></i>Returned ({{ $borrowings->where('status', 'returned')->count() }})
    </a>
  </div>

  @if($borrowings->count() > 0)
    <div class="borrowing-cards-grid" data-aos="fade-up" data-aos-delay="400">
      @foreach($borrowings as $borrowing)
      <div class="borrowing-card" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 50 }}">
        <div class="borrowing-card-header">
          <div class="equipment-icon">
            <i class="fas fa-laptop"></i>
          </div>
          <span class="status-badge status-{{ $borrowing->status }}">
            <i class="fas fa-{{ $borrowing->status === 'pending' ? 'clock' : ($borrowing->status === 'approved' ? 'check' : ($borrowing->status === 'returned' ? 'undo' : 'exclamation')) }}"></i>
            {{ ucfirst($borrowing->status) }}
          </span>
        </div>

        <div class="borrowing-card-body">
          <h3 class="equipment-name">{{ $borrowing->equipment->name ?? 'N/A' }}</h3>

          @if($borrowing->equipment->category)
          <span class="equipment-category category-{{ strtolower($borrowing->equipment->category) }}">
            {{ $borrowing->equipment->category }}
          </span>
          @endif

          <div class="borrowing-details">
            <div class="detail-item">
              <span class="detail-label">Borrow Date</span>
              <span class="detail-value">{{ \Carbon\Carbon::parse($borrowing->borrow_date)->format('M d, Y') }}</span>
            </div>
            <div class="detail-item">
              <span class="detail-label">Return Date</span>
              <span class="detail-value">
                @if($borrowing->return_date)
                  {{ \Carbon\Carbon::parse($borrowing->return_date)->format('M d, Y') }}
                @else
                  {{ \Carbon\Carbon::parse($borrowing->return_date)->format('M d, Y') }}
                @endif
              </span>
            </div>
            @if($borrowing->purpose)
            <div class="detail-item" style="grid-column: span 2;">
              <span class="detail-label">Purpose</span>
              <span class="detail-value">{{ Str::limit($borrowing->purpose, 60) }}</span>
            </div>
            @endif
          </div>

          <div class="card-actions">
            @if($borrowing->status === 'approved' && !$borrowing->return_date)
            <form method="POST" action="{{ route('borrowings.return', $borrowing) }}" style="display: inline;">
              @csrf
              <button type="submit" class="btn-card btn-success" onclick="return confirm('Mark this equipment as returned?')">
                <i class="fas fa-undo"></i>Return Equipment
              </button>
            </form>
            @endif

            <a href="{{ route('equipment.index') }}" class="btn-card btn-outline-secondary">
              <i class="fas fa-eye"></i>View Equipment
            </a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  @else
    <div class="empty-state" data-aos="fade-in" data-aos-delay="400">
      <i class="fas fa-inbox"></i>
      <h4>No Borrowings Yet</h4>
      <p>You haven't borrowed any equipment. Start by browsing available items!</p>
      <a href="{{ route('borrowings.create') }}" class="btn btn-primary rounded-pill px-4 py-2">
        <i class="fas fa-plus me-2"></i>Borrow Equipment
      </a>
    </div>
  @endif
</div>

<script>
function borrowingsList() {
  return {
    filterBorrowings(status) {
      // Add filtering logic here if needed
      console.log('Filtering by:', status);
    }
  }
}
</script>
@endsection
</parameter>
</create_file>
