@extends('layouts.dashboard')

@section('title', 'Time In/Out Logs')

@section('styles')
<style>
.page-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 30px;
  padding: 30px;
  background: linear-gradient(135deg, #64748b 0%, #475569 100%);
  border-radius: 15px;
  box-shadow: 0 8px 25px rgba(100, 116, 139, 0.2);
}

.page-title {
  font-size: 32px;
  font-weight: 700;
  color: white;
  margin: 0;
  display: flex;
  align-items: center;
  gap: 15px;
}

.page-title i {
  font-size: 36px;
  opacity: 0.95;
}

.stat-card {
  border-radius: 20px;
  border: none;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  overflow: hidden;
  transition: all 0.3s ease;
  border-top: 4px solid #64748b;
}

.stat-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 30px rgba(100, 116, 139, 0.15);
}

.btn-timein {
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  color: white;
  border: none;
  border-radius: 12px;
  padding: 20px 40px;
  font-weight: 700;
  font-size: 16px;
  transition: all 0.3s ease;
  box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
  display: inline-flex;
  align-items: center;
  gap: 12px;
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
  border-radius: 12px;
  padding: 20px 40px;
  font-weight: 700;
  font-size: 16px;
  transition: all 0.3s ease;
  box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
  display: inline-flex;
  align-items: center;
  gap: 12px;
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
  border-top: 4px solid #64748b;
}

.card-body {
  padding: 0;
}

.table {
  margin-bottom: 0;
}

.table thead th {
  background: linear-gradient(135deg, #f1f5f9 0%, #f1f5f9 100%);
  padding: 15px;
  font-weight: 700;
  font-size: 13px;
  text-transform: uppercase;
  letter-spacing: 0.6px;
  color: #475569;
  border: none;
  border-bottom: 2px solid #64748b;
}

.table thead th i {
  margin-right: 8px;
  opacity: 0.8;
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
  box-shadow: inset 0 0 10px rgba(100, 116, 139, 0.05);
}

.table tbody tr:last-child td {
  border-bottom: none;
}

.badge {
  padding: 8px 14px;
  border-radius: 20px;
  font-weight: 700;
  font-size: 12px;
  display: inline-flex;
  align-items: center;
  gap: 6px;
}

.badge-type-in {
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  color: white;
}

.badge-type-out {
  background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
  color: white;
}

.empty-state {
  text-align: center;
  padding: 80px 20px;
  color: #64748b;
}

.empty-state i {
  font-size: 64px;
  color: #cbd5e1;
  margin-bottom: 20px;
  opacity: 0.6;
}

.empty-state h4 {
  font-size: 24px;
  font-weight: 700;
  color: #1e293b;
  margin: 20px 0 10px 0;
}

.empty-state p {
  margin-bottom: 10px;
  font-size: 15px;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
  <div class="page-header" data-aos="fade-down" data-aos-duration="600">
    <h1 class="page-title"><i class="fas fa-history"></i>Time In/Out Logs</h1>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" data-aos="fade-down">
      <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="row mb-4" data-aos="fade-up" data-aos-delay="100">
    <div class="col-md-6">
      <div class="card stat-card text-center">
        <div class="card-body" style="padding: 40px;">
          <form method="POST" action="{{ route('logs.timein') }}">
            @csrf
            <button type="submit" class="btn btn-timein">
              <i class="fas fa-sign-in-alt fa-lg"></i>
              Record Time In
            </button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card stat-card text-center">
        <div class="card-body" style="padding: 40px;">
          <form method="POST" action="{{ route('logs.timeout') }}">
            @csrf
            <button type="submit" class="btn btn-timeout">
              <i class="fas fa-sign-out-alt fa-lg"></i>
              Record Time Out
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="card" data-aos="fade-up" data-aos-duration="700">
    <div class="card-body">
      @if($logs->count() > 0)
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th><i class="fas fa-clock"></i>Type</th>
                <th><i class="fas fa-calendar"></i>Time</th>
                <th><i class="fas fa-user"></i>User</th>
              </tr>
            </thead>
            <tbody>
              @foreach($logs as $log)
              <tr data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <td>
                  @if($log->type === 'time_in')
                    <span class="badge badge-type-in"><i class="fas fa-sign-in-alt"></i>Time In</span>
                  @else
                    <span class="badge badge-type-out"><i class="fas fa-sign-out-alt"></i>Time Out</span>
                  @endif
                </td>
                <td><strong>{{ \Carbon\Carbon::parse($log->timestamp)->format('M d, Y') }}</strong><br><small class="text-muted">{{ \Carbon\Carbon::parse($log->timestamp)->format('h:i A') }}</small></td>
                <td>{{ $log->user->name ?? 'N/A' }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <div class="empty-state">
          <i class="fas fa-inbox"></i>
          <h4>No Logs Recorded</h4>
          <p>Start recording by clicking the buttons above.</p>
        </div>
      @endif
    </div>
  </div>
</div>
@endsection
</parameter>
</create_file>
