@extends('layouts.dashboard')

@section('title', 'My Reservations')

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
  background: linear-gradient(135deg, #8b5cf6, #7c3aed);
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
  background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
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

.badge-approved { background: linear-gradient(135deg, #10b981, #059669); color: white; }
.badge-pending { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; }
.badge-completed { background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; }
.badge-rejected { background: linear-gradient(135deg, #ef4444, #dc2626); color: white; }

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

.btn-view {
  background: linear-gradient(135deg, #8b5cf6, #7c3aed);
  color: white;
}

.btn-view:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
}

.btn-primary {
  background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
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
  box-shadow: 0 8px 20px rgba(139, 92, 246, 0.3);
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
        <i class="fas fa-calendar-check"></i>My Reservations
      </h1>
      <p class="page-subtitle" data-aos="fade-right" data-aos-delay="150">
        Track and manage your laboratory reservations
      </p>
    </div>
    <a href="{{ route('reservations.create') }}" class="btn btn-primary" data-aos="fade-up" data-aos-delay="100">
      <i class="fas fa-plus"></i>New Reservation
    </a>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" data-aos="slide-in-right" role="alert">
      <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="card" data-aos="fade-up" data-aos-duration="700">
    <div class="card-header">
      <h5><i class="fas fa-list me-2"></i>Reservations List</h5>
    </div>
    <div class="card-body">
      @if($reservations->count() > 0)
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th><i class="fas fa-calendar me-1"></i>Date</th>
                <th><i class="fas fa-clock me-1"></i>Time In</th>
                <th><i class="fas fa-clock me-1"></i>Time Out</th>
                <th><i class="fas fa-door-open me-1"></i>Laboratory</th>
                <th><i class="fas fa-note-sticky me-1"></i>Purpose</th>
                <th><i class="fas fa-circle me-1"></i>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($reservations as $reservation)
              <tr data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <td><strong>{{ \Carbon\Carbon::parse($reservation->date)->format('M d, Y') }}</strong></td>
                <td>{{ $reservation->time_in }}</td>
                <td>{{ $reservation->time_out }}</td>
                <td>{{ $reservation->laboratory->name ?? 'N/A' }}</td>
                <td>
                  <span class="badge" style="background: #f0f4ff; color: #4f46e5;">
                    {{ Str::limit($reservation->purpose ?? 'No purpose stated', 30) }}
                  </span>
                </td>
                <td>
                  @if($reservation->status === 'approved')
                    <span class="badge badge-approved"><i class="fas fa-check-circle"></i> Approved</span>
                  @elseif($reservation->status === 'pending')
                    <span class="badge badge-pending"><i class="fas fa-hourglass"></i> Pending</span>
                  @elseif($reservation->status === 'completed')
                    <span class="badge badge-completed"><i class="fas fa-check"></i> Completed</span>
                  @else
                    <span class="badge badge-rejected"><i class="fas fa-times-circle"></i> Rejected</span>
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
          <h4>No Reservations Yet</h4>
          <p>You haven't made any laboratory reservations yet.</p>
          <a href="{{ route('reservations.create') }}" class="btn btn-primary mt-3">
            <i class="fas fa-plus"></i> Create Your First Reservation
          </a>
        </div>
      @endif
    </div>
  </div>
</div>
@endsection

</parameter>
</create_file>
