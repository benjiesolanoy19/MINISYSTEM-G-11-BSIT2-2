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

.stat-card {
  border: none;
  border-radius: 16px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  overflow: hidden;
  transition: all 0.3s ease;
}

.stat-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
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
  position: relative;
}

.stat-card .stat-icon {
  width: 70px;
  height: 70px;
  border-radius: 16px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 15px;
  font-size: 28px;
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
  font-weight: 600;
  border-radius: 0;
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

.badge-users { background: linear-gradient(135deg, #0ea5e9, #0284c7); color: white; }
.badge-equipment { background: linear-gradient(135deg, #10b981, #059669); color: white; }
.badge-reservations { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; }
.badge-incidents { background: linear-gradient(135deg, #ef4444, #dc2626); color: white; }

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

.empty-state {
  text-align: center;
  padding: 40px 20px;
  color: #64748b;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
  <div class="page-header" data-aos="fade-down" data-aos-duration="600">
    <h1 class="page-title" data-aos="fade-right" data-aos-delay="100">
      <i class="fas fa-chart-line"></i>Admin Dashboard
    </h1>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" data-aos="slide-in-right" role="alert">
      <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <!-- Stats Cards -->
  <div class="row mb-4">
    <div class="col-md-3 mb-3" data-aos="fade-up" data-aos-delay="100">
      <div class="card stat-card text-center">
        <div class="card-body">
          <div class="stat-icon badge-users" style="background: rgba(14, 165, 233, 0.1) !important; color: #0ea5e9;">
            <i class="fas fa-users"></i>
          </div>
          <div class="stat-value">{{ $stats['total_users'] ?? 0 }}</div>
          <div class="stat-label">Total Users</div>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3" data-aos="fade-up" data-aos-delay="150">
      <div class="card stat-card text-center">
        <div class="card-body">
          <div class="stat-icon badge-equipment" style="background: rgba(16, 185, 129, 0.1) !important; color: #10b981;">
            <i class="fas fa-boxes-stacked"></i>
          </div>
          <div class="stat-value">{{ $stats['total_equipment'] ?? 0 }}</div>
          <div class="stat-label">Equipment</div>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3" data-aos="fade-up" data-aos-delay="200">
      <div class="card stat-card text-center">
        <div class="card-body">
          <div class="stat-icon badge-reservations" style="background: rgba(245, 158, 11, 0.1) !important; color: #f59e0b;">
            <i class="fas fa-calendar-check"></i>
          </div>
          <div class="stat-value">{{ $stats['total_reservations'] ?? 0 }}</div>
          <div class="stat-label">Reservations</div>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3" data-aos="fade-up" data-aos-delay="250">
      <div class="card stat-card text-center">
        <div class="card-body">
          <div class="stat-icon badge-incidents" style="background: rgba(239, 68, 68, 0.1) !important; color: #ef4444;">
            <i class="fas fa-exclamation-triangle"></i>
          </div>
          <div class="stat-value">{{ $stats['active_incidents'] ?? 0 }}</div>
          <div class="stat-label">Active Incidents</div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <!-- Recent Reservations -->
    <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
      <div class="card">
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
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($reservations as $reservation)
                  <tr data-aos="fade-in" data-aos-delay="{{ $loop->index * 50 }}">
                    <td>{{ $reservation->user->name ?? 'N/A' }}</td>
                    <td>{{ $reservation->laboratory->name ?? 'N/A' }}</td>
                    <td>
                      @if($reservation->status === 'approved')
                        <span class="badge" style="background: #10b981; color: white;"><i class="fas fa-check"></i> Approved</span>
                      @elseif($reservation->status === 'pending')
                        <span class="badge" style="background: #f59e0b; color: white;"><i class="fas fa-hourglass"></i> Pending</span>
                      @else
                        <span class="badge" style="background: #94a3b8; color: white;"><i class="fas fa-info-circle"></i> {{ ucfirst($reservation->status) }}</span>
                      @endif
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <div class="empty-state">
              <p><i class="fas fa-inbox"></i> No recent reservations</p>
            </div>
          @endif
        </div>
      </div>
    </div>

    <!-- Recent Incidents -->
    <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="350">
      <div class="card">
        <div class="card-header">
          <i class="fas fa-exclamation-circle me-2"></i> Active Incidents
        </div>
        <div class="card-body">
          @if($incidents->count() > 0)
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($incidents as $incident)
                  <tr data-aos="fade-in" data-aos-delay="{{ $loop->index * 50 }}">
                    <td>{{ ucfirst($incident->type ?? 'Unknown') }}</td>
                    <td>
                      @if($incident->status === 'open')
                        <span class="badge" style="background: #ef4444; color: white;"><i class="fas fa-circle-exclamation"></i> Open</span>
                      @else
                        <span class="badge" style="background: #10b981; color: white;"><i class="fas fa-check"></i> Resolved</span>
                      @endif
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <div class="empty-state">
              <p><i class="fas fa-inbox"></i> No active incidents</p>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

