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
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" data-aos="slide-in-right" role="alert">
      <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="card" data-aos="fade-up" data-aos-duration="700">
    <div class="card-header">
      <h5><i class="fas fa-list me-2"></i>Borrowing History</h5>
    </div>
    <div class="card-body">
      @if($borrowings->count() > 0)
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th><i class="fas fa-tools me-2" style="color: #0ea5e9;"></i>Equipment</th>
                <th><i class="fas fa-cube me-2" style="color: #10b981;"></i>Category</th>
                <th><i class="fas fa-calendar me-2" style="color: #f59e0b;"></i>Borrow Date</th>
                <th><i class="fas fa-hourglass-end me-2" style="color: #ef4444;"></i>Expected Return</th>
                <th><i class="fas fa-check me-2" style="color: #059669;"></i>Return Date</th>
                <th><i class="fas fa-info-circle me-2" style="color: #3b82f6;"></i>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($borrowings as $borrowing)
              <tr data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <td>
                  <strong>{{ $borrowing->equipment->name ?? 'N/A' }}</strong>
                </td>
                <td>
                  <span class="badge" style="background: #e0f2fe; color: #0284c7;">
                    {{ $borrowing->equipment->category ?? 'N/A' }}
                  </span>
                </td>
                <td>{{ \Carbon\Carbon::parse($borrowing->borrow_date)->format('M d, Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($borrowing->expected_return)->format('M d, Y') }}</td>
                <td>
                  @if($borrowing->return_date)
                    <span style="color: #059669;"><i class="fas fa-check-circle me-1"></i>{{ \Carbon\Carbon::parse($borrowing->return_date)->format('M d, Y') }}</span>
                  @else
                    <span style="color: #64748b;">—</span>
                  @endif
                </td>
                <td>
                  @if($borrowing->status === 'returned')
                    <span class="badge badge-success"><i class="fas fa-check"></i> Returned</span>
                  @elseif($borrowing->status === 'pending')
                    <span class="badge badge-warning"><i class="fas fa-clock"></i> Pending</span>
                  @elseif($borrowing->status === 'approved')
                    <span class="badge badge-primary"><i class="fas fa-thumbs-up"></i> Approved</span>
                  @elseif($borrowing->status === 'damaged')
                    <span class="badge badge-danger"><i class="fas fa-exclamation"></i> Damaged</span>
                  @elseif($borrowing->status === 'lost')
                    <span class="badge badge-danger"><i class="fas fa-times"></i> Lost</span>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <div class="empty-state" data-aos="fade-in">
          <i class="fas fa-inbox"></i>
          <h3>No Borrowings Yet</h3>
          <p>You haven't borrowed any equipment. Start by browsing available items!</p>
          <a href="{{ route('borrowings.create') }}" class="btn btn-primary mt-3">
            <i class="fas fa-plus me-2"></i>Borrow Equipment
          </a>
        </div>
      @endif
    </div>
  </div>
</div>
@endsection
</parameter>
</create_file>
