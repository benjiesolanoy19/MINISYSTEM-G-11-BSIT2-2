@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')

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

.stat-card {
  border-radius: 20px;
  border: none;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  overflow: hidden;
  position: relative;
}

.stat-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%);
}

.stat-card .card-body {
  padding: 25px;
}

.stat-card .stat-icon {
  width: 60px;
  height: 60px;
  border-radius: 16px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 15px;
  font-size: 24px;
}

.stat-card .stat-value {
  font-size: 36px;
  font-weight: 700;
  color: #1e293b;
  line-height: 1;
}

.stat-card .stat-label {
  font-size: 14px;
  color: #64748b;
  font-weight: 500;
  margin-top: 5px;
}

.card {
  border: none;
  border-radius: 20px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  overflow: hidden;
}

.card-header {
  background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%);
  color: #fff;
  font-weight: 600;
  border-radius: 20px 20px 0 0 !important;
  padding: 18px 20px;
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

.text-center {
  padding: 40px 20px;
  color: #64748b;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
  <div class="page-header">
    <h1 class="page-title">Admin Dashboard</h1>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <!-- Stats Cards -->
  <div class="row mb-4">
    <div class="col-md-3">
      <div class="card stat-card text-center">
        <div class="card-body">
          <div class="stat-icon" style="background: rgba(14, 165, 233, 0.1); color: #0ea5e9;">
            <i class="fas fa-users"></i>
          </div>
          <div class="stat-value">{{ $stats['total_users'] }}</div>
          <div class="stat-label">Total Users</div>
      </div>
    <div class="col-md-3">
      <div class="card stat-card text-center">
        <div class="card-body">
          <div class="stat-icon" style="background: rgba(16, 185, 129, 0.1); color: #10b981;">
            <i class="fas fa-boxes-stacked"></i>
          </div>
          <div class="stat-value">{{ $stats['total_equipment'] }}</div>
          <div class="stat-label">Equipment</div>
      </div>
    <div class="col-md-3">
      <div class="card stat-card text-center">
        <div class="card-body">
          <div class="stat-icon" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b;">
            <i class="fas fa-calendar-check"></i>
          </div>
          <div class="stat-value">{{ $stats['total_reservations'] }}</div>
          <div class="stat-label">Reservations</div>
      </div>
    <div class="col-md-3">
      <div class="card stat-card text-center">
        <div class="card-body">
          <div class="stat-icon" style="background: rgba(239, 68, 68, 0.1); color: #ef4444;">
            <i class="fas fa-exclamation-triangle"></i>
          </div>
          <div class="stat-value">{{ $stats['active_incidents'] }}</div>
          <div class="stat-label">Active Incidents</div>
      </div>
  </div>

  <div class="row">
    <!-- Recent Reservations -->
    <div class="col-md-6">
      <div class="card mb-4">
        <div class="card-header">
          <i class="fas fa-calendar-check me-2"></i> Recent Reservations
        </div>
        <div class="card-body">
          @if($reservations->count() > 0)
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>User</th>
                    <th>Lab</th>
                    <th>Date</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($reservations->take(5) as $res)
                  <tr>
                    <td>{{ $res->user->name ?? 'N/A' }}</td>
                    <td>{{ $res->laboratory->name ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($res->date)->format('M d') }}</td>
                    <td>
                      @if($res->status === 'approved')
                        <span class="badge bg-success">Approved</span>
                      @elseif($res->status === 'pending')
                        <span class="badge bg-warning">Pending</span>
                      @else
                        <span class="badge bg-danger">Rejected</span>
                      @endif
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <p class="text-center">No reservations</p>
          @endif
        </div>
    </div>

    <!-- Recent Borrowings -->
    <div class="col-md-6">
      <div class="card mb-4">
        <div class="card-header">
          <i class="fas fa-laptop me-2"></i> Recent Borrowings
        </div>
        <div class="card-body">
          @if($borrowings->count() > 0)
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>User</th>
                    <th>Equipment</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($borrowings->take(5) as $bor)
                  <tr>
                    <td>{{ $bor->user->name ?? 'N/A' }}</td>
                    <td>{{ $bor->equipment->name ?? 'N/A' }}</td>
                    <td>
                      @if($bor->status === 'returned')
                        <span class="badge bg-success">Returned</span>
                      @elseif($bor->status === 'pending')
                        <span class="badge bg-warning">Pending</span>
                      @else
                        <span class="badge bg-primary">Active</span>
                      @endif
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <p class="text-center">No borrowings</p>
          @endif
        </div>
    </div>
</div>
@endsection
</parameter>
</create_file>
