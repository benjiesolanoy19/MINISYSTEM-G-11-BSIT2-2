@extends('layouts.dashboard')

@section('title', 'Transactions Report')

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

.badge-pending { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; }
.badge-approved { background: linear-gradient(135deg, #10b981, #059669); color: white; }
.badge-returned { background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; }

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
        <i class="fas fa-exchange-alt"></i>Transactions Report
      </h1>
      <p class="page-subtitle" data-aos="fade-right" data-aos-delay="150">
        Track all equipment borrowing and transaction history
      </p>
    </div>
  </div>

  <div class="card" data-aos="fade-up" data-aos-duration="700">
    <div class="card-header">
      <h5><i class="fas fa-list me-2"></i>Borrowing Transactions</h5>
    </div>
    <div class="card-body">
      @if($transactions->count() > 0)
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th><i class="fas fa-user me-1"></i>User</th>
                <th><i class="fas fa-box me-1"></i>Equipment</th>
                <th><i class="fas fa-sign-out-alt me-1"></i>Borrow Date</th>
                <th><i class="fas fa-sign-in-alt me-1"></i>Return Date</th>
                <th><i class="fas fa-circle me-1"></i>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($transactions as $transaction)
              <tr data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <td><strong>{{ $transaction->user->name ?? 'N/A' }}</strong></td>
                <td>{{ $transaction->equipment->name ?? 'N/A' }}</td>
                <td>{{ $transaction->borrow_date ? \Carbon\Carbon::parse($transaction->borrow_date)->format('M d, Y') : 'N/A' }}</td>
                <td>{{ $transaction->return_date ? \Carbon\Carbon::parse($transaction->return_date)->format('M d, Y') : 'N/A' }}</td>
                <td>
                  @switch($transaction->status)
                    @case('pending')
                      <span class="badge badge-pending"><i class="fas fa-hourglass"></i> Pending</span>
                      @break
                    @case('approved')
                      <span class="badge badge-approved"><i class="fas fa-check-circle"></i> Approved</span>
                      @break
                    @case('returned')
                      <span class="badge badge-returned"><i class="fas fa-check"></i> Returned</span>
                      @break
                    @default
                      <span class="badge" style="background: #94a3b8; color: white;">
                        <i class="fas fa-info-circle"></i> {{ ucfirst($transaction->status) }}
                      </span>
                  @endswitch
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <div class="empty-state py-4">
          <i class="fas fa-inbox mb-3"></i>
          <h4>No Transactions Found</h4>
          <p>No borrowing transactions have been recorded yet.</p>
        </div>
      @endif
    </div>
  </div>
</div>
@endsection