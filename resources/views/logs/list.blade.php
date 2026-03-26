@extends('layouts.dashboard')

@section('title', 'Time In/Out Logs')

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
}

.btn-timein {
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  color: white;
  border: none;
  border-radius: 50px;
  padding: 25px 50px;
  font-weight: 600;
  transition: all 0.3s ease;
  box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
}

.btn-timein:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
  color: white;
}

.btn-timeout {
  background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
  color: white;
  border: none;
  border-radius: 50px;
  padding: 25px 50px;
  font-weight: 600;
  transition: all 0.3s ease;
  box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
}

.btn-timeout:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
  color: white;
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

.empty-state {
  text-align: center;
  padding: 60px 20px;
  color: #64748b;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
  <div class="page-header">
    <h1 class="page-title">Time In / Time Out Logs</h1>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="row mb-4">
    <div class="col-md-6">
      <div class="card stat-card text-center">
        <div class="card-body" style="padding: 30px;">
          <form method="POST" action="{{ route('logs.timein') }}">
            @csrf
            <button type="submit" class="btn btn-timein">
              <i class="fas fa-sign-in-alt fa-2x d-block mb-2"></i>
              Time In
            </button>
          </form>
        </div>
    </div>
    <div class="col-md-6">
      <div class="card stat-card text-center">
        <div class="card-body" style="padding: 30px;">
          <form method="POST" action="{{ route('logs.timeout') }}">
            @csrf
            <button type="submit" class="btn btn-timeout">
              <i class="fas fa-sign-out-alt fa-2x d-block mb-2"></i>
              Time Out
            </button>
          </form>
        </div>
    </div>

  <div class="card">
    <div class="card-body">
      @if($logs->count() > 0)
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Type</th>
                <th>Time</th>
                <th>User</th>
              </tr>
            </thead>
            <tbody>
              @foreach($logs as $log)
              <tr>
                <td>
                  @if($log->type === 'time_in')
                    <span class="badge bg-success"><i class="fas fa-sign-in-alt me-1"></i> Time In</span>
                  @else
                    <span class="badge bg-danger"><i class="fas fa-sign-out-alt me-1"></i> Time Out</span>
                  @endif
                </td>
                <td>{{ \Carbon\Carbon::parse($log->timestamp)->format('M d, Y - h:i A') }}</td>
                <td>{{ $log->user->name ?? 'N/A' }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <div class="empty-state">
          <p>No logs recorded yet.</p>
        </div>
      @endif
    </div>
</div>
@endsection
</parameter>
</create_file>
