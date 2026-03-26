@extends('layouts.dashboard')

@section('title', 'Manage Reservations - CLFMS')

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

.badge-approved { background: linear-gradient(135deg, #10b981, #059669); color: white; }
.badge-pending { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; }
.badge-completed { background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; }
.badge-rejected { background: linear-gradient(135deg, #ef4444, #dc2626); color: white; }

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
  cursor: pointer;
}

.btn-approve {
  background: linear-gradient(135deg, #10b981, #059669);
  color: white;
}

.btn-reject {
  background: linear-gradient(135deg, #ef4444, #dc2626);
  color: white;
}

.btn-complete {
  background: linear-gradient(135deg, #3b82f6, #1d4ed8);
  color: white;
}

.btn-sm:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
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
        <i class="fas fa-calendar-alt"></i>Manage Reservations
      </h1>
      <p class="page-subtitle" data-aos="fade-right" data-aos-delay="150">
        Review and manage all laboratory reservations
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
      <h5><i class="fas fa-list me-2"></i>Reservations List</h5>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th><i class="fas fa-hashtag me-1"></i>ID</th>
              <th><i class="fas fa-user me-1"></i>User</th>
              <th><i class="fas fa-door-open me-1"></i>Laboratory</th>
              <th><i class="fas fa-calendar me-1"></i>Date</th>
              <th><i class="fas fa-clock me-1"></i>Time</th>
              <th><i class="fas fa-circle me-1"></i>Status</th>
              <th><i class="fas fa-tasks me-1"></i>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($reservations as $reservation)
            <tr data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
              <td><strong>#{{ $reservation->id }}</strong></td>
              <td>{{ $reservation->user->name ?? 'N/A' }}</td>
              <td>{{ $reservation->laboratory->name ?? 'N/A' }}</td>
              <td>{{ \Carbon\Carbon::parse($reservation->date)->format('M d, Y') }}</td>
              <td>
                <span class="badge" style="background: #f0f4ff; color: #4f46e5;">
                  {{ $reservation->start_time ?? $reservation->time_in ?? 'N/A' }} - {{ $reservation->end_time ?? $reservation->time_out ?? 'N/A' }}
                </span>
              </td>
              <td>
                @if($reservation->status == 'approved')
                  <span class="badge badge-approved"><i class="fas fa-check-circle"></i> Approved</span>
                @elseif($reservation->status == 'rejected')
                  <span class="badge badge-rejected"><i class="fas fa-times-circle"></i> Rejected</span>
                @elseif($reservation->status == 'completed')
                  <span class="badge badge-completed"><i class="fas fa-check"></i> Completed</span>
                @else
                  <span class="badge badge-pending"><i class="fas fa-hourglass"></i> Pending</span>
                @endif
              </td>
              <td>
                <div class="btn-group-sm">
                  @if($reservation->status == 'pending')
                    <form method="POST" action="{{ route('reservations.approve', $reservation->id) }}" style="display: inline;">
                      @csrf
                      <button type="submit" class="btn btn-sm btn-approve" title="Approve">
                        <i class="fas fa-check"></i> Approve
                      </button>
                    </form>
                    <form method="POST" action="{{ route('reservations.reject', $reservation->id) }}" style="display: inline;">
                      @csrf
                      <button type="submit" class="btn btn-sm btn-reject" title="Reject" onclick="return confirm('Reject this reservation?')">
                        <i class="fas fa-times"></i> Reject
                      </button>
                    </form>
                  @elseif($reservation->status == 'approved')
                    <form method="POST" action="{{ route('reservations.complete', $reservation->id) }}" style="display: inline;">
                      @csrf
                      <button type="submit" class="btn btn-sm btn-complete" title="Mark as completed">
                        <i class="fas fa-flag-checkered"></i> Complete
                      </button>
                    </form>
                  @else
                    <span class="badge badge-secondary"><i class="fas fa-lock"></i> No actions</span>
                  @endif
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="7">
                <div class="empty-state py-4">
                  <i class="fas fa-inbox mb-3"></i>
                  <h4>No Reservations Found</h4>
                  <p>There are currently no reservations to manage.</p>
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