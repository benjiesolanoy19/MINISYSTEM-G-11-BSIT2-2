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
}

.btn-primary:hover {
  background: linear-gradient(135deg, #0284c7 0%, #059669 100%);
  transform: translateY(-2px);
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
    <h1 class="page-title">My Reservations</h1>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="card">
    <div class="card-body">
      @if($reservations->count() > 0)
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Date</th>
                <th>Time In</th>
                <th>Time Out</th>
                <th>Laboratory</th>
                <th>Purpose</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($reservations as $reservation)
              <tr>
                <td>{{ \Carbon\Carbon::parse($reservation->date)->format('M d, Y') }}</td>
                <td>{{ $reservation->time_in }}</td>
                <td>{{ $reservation->time_out }}</td>
                <td>{{ $reservation->laboratory->name ?? 'N/A' }}</td>
                <td>{{ $reservation->purpose ?? 'N/A' }}</td>
                <td>
                  @if($reservation->status === 'approved')
                    <span class="badge bg-success">Approved</span>
                  @elseif($reservation->status === 'pending')
                    <span class="badge bg-warning">Pending</span>
                  @elseif($reservation->status === 'completed')
                    <span class="badge bg-info">Completed</span>
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
        <div class="empty-state">
          <p>No reservations yet.</p>
          <a href="{{ route('reservations.create') }}" class="btn btn-primary">Make a Reservation</a>
        </div>
      @endif
    </div>
</div>
@endsection
</parameter>
</create_file>
