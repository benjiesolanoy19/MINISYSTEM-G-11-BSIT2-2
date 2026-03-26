@extends('layouts.dashboard')

@section('title', 'Usage Report')

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

.stat-badge {
  background: linear-gradient(135deg, #06b6d4, #0891b2);
  color: white;
  padding: 4px 8px;
  border-radius: 6px;
  font-weight: 600;
  font-size: 13px;
}

.empty-state {
  text-align: center;
  padding: 40px 20px;
  color: #64748b;
}

.empty-state i {
  font-size: 36px;
  margin-bottom: 10px;
  color: #cbd5e1;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
  <div class="page-header" data-aos="fade-down" data-aos-duration="600">
    <div>
      <h1 class="page-title" data-aos="fade-right" data-aos-delay="100">
        <i class="fas fa-chart-line"></i>Usage Report
      </h1>
      <p class="page-subtitle" data-aos="fade-right" data-aos-delay="150">
        System usage statistics and activity summary
      </p>
    </div>
  </div>

  <div class="row">
    <!-- Reservations by Lab -->
    <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
      <div class="card">
        <div class="card-header">
          <h5><i class="fas fa-calendar-check me-2"></i>Reservations by Lab</h5>
        </div>
        <div class="card-body">
          @if(!empty($reservations_by_lab) && $reservations_by_lab->count() > 0)
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th><i class="fas fa-door-open me-1"></i>Laboratory</th>
                    <th><i class="fas fa-chart-bar me-1"></i>Reservations</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($reservations_by_lab as $labId => $count)
                  <tr data-aos="fade-in" data-aos-delay="{{ $loop->index * 40 }}">
                    <td>Lab {{ $labId }}</td>
                    <td><span class="stat-badge">{{ $count }}</span></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <div class="empty-state py-3">
              <i class="fas fa-inbox"></i>
              <p>No reservation data available</p>
            </div>
          @endif
        </div>
      </div>
    </div>

    <!-- Borrowings by Equipment -->
    <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="150">
      <div class="card">
        <div class="card-header">
          <h5><i class="fas fa-laptop me-2"></i>Borrowings by Equipment</h5>
        </div>
        <div class="card-body">
          @if(!empty($borrowings_by_equipment) && $borrowings_by_equipment->count() > 0)
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th><i class="fas fa-box me-1"></i>Equipment</th>
                    <th><i class="fas fa-chart-bar me-1"></i>Borrowings</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($borrowings_by_equipment as $equipId => $count)
                  <tr data-aos="fade-in" data-aos-delay="{{ $loop->index * 40 }}">
                    <td>Equipment {{ $equipId }}</td>
                    <td><span class="stat-badge">{{ $count }}</span></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <div class="empty-state py-3">
              <i class="fas fa-inbox"></i>
              <p>No borrowing data available</p>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>

  <!-- User Activity -->
  <div class="row mt-4">
    <div class="col-md-12" data-aos="fade-up" data-aos-delay="200">
      <div class="card">
        <div class="card-header">
          <h5><i class="fas fa-users me-2"></i>User Activity Summary</h5>
        </div>
        <div class="card-body">
          @if(!empty($user_activity) && $user_activity->count() > 0)
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th><i class="fas fa-user me-1"></i>User</th>
                    <th><i class="fas fa-history me-1"></i>Log Entries</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($user_activity as $activity)
                  <tr data-aos="fade-in" data-aos-delay="{{ $loop->index * 40 }}">
                    <td><strong>{{ $activity->user->name ?? 'User ' . $activity->user_id }}</strong></td>
                    <td><span class="stat-badge">{{ $activity->logs_count ?? 0 }}</span></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <div class="empty-state py-4">
              <i class="fas fa-inbox"></i>
              <p>No user activity data available</p>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
