@extends('layouts.dashboard')

@section('title', 'My Incidents')

@section('styles')
<style>
.page-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 30px;
  padding: 30px;
  background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
  border-radius: 15px;
  box-shadow: 0 8px 25px rgba(239, 68, 68, 0.2);
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

.page-subtitle {
  color: rgba(255, 255, 255, 0.85);
  font-size: 14px;
  margin: 5px 0 0 51px;
}

.card {
  border: none;
  border-radius: 20px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  overflow: hidden;
  border-top: 4px solid #ef4444;
}

.card-body {
  padding: 0;
}

.table {
  margin-bottom: 0;
}

.table thead th {
  background: linear-gradient(135deg, #fef2f2 0%, #fef2f2 100%);
  padding: 15px;
  font-weight: 700;
  font-size: 13px;
  text-transform: uppercase;
  letter-spacing: 0.6px;
  color: #dc2626;
  border: none;
  border-bottom: 2px solid #ef4444;
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
  background: #fef2f2;
  box-shadow: inset 0 0 10px rgba(239, 68, 68, 0.05);
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

.badge-severity-low {
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  color: white;
}

.badge-severity-medium {
  background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
  color: white;
}

.badge-severity-high {
  background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
  color: white;
}

.badge-severity-critical {
  background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%);
  color: white;
}

.badge-status-open {
  background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
  color: white;
}

.badge-status-investigating {
  background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
  color: white;
}

.badge-status-closed {
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  color: white;
}

.btn-primary {
  background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
  border: none;
  padding: 12px 24px;
  border-radius: 10px;
  font-weight: 700;
  box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
  text-decoration: none;
  color: white;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}

.btn-primary:hover {
  background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
  transform: translateY(-2px);
  color: white;
  box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
}

.empty-state {
  text-align: center;
  padding: 80px 20px;
  color: #64748b;
}

.empty-state i {
  font-size: 64px;
  color: #fecaca;
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
  margin-bottom: 30px;
  font-size: 15px;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
  <div class="page-header" data-aos="fade-down" data-aos-duration="600">
    <div>
      <h1 class="page-title"><i class="fas fa-exclamation-triangle"></i>My Incidents</h1>
      <p class="page-subtitle">Track and manage reported incidents</p>
    </div>
    <a href="{{ route('incidents.report') }}" class="btn btn-primary"><i class="fas fa-plus"></i>Report Incident</a>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" data-aos="fade-down">
      <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="card" data-aos="fade-up" data-aos-duration="700">
    <div class="card-body">
      @if($incidents->count() > 0)
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th><i class="fas fa-microchip"></i>Equipment</th>
                <th><i class="fas fa-align-left"></i>Description</th>
                <th><i class="fas fa-fire"></i>Severity</th>
                <th><i class="fas fa-circle-info"></i>Status</th>
                <th><i class="fas fa-calendar"></i>Date</th>
              </tr>
            </thead>
            <tbody>
              @foreach($incidents as $incident)
              <tr data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <td><strong>{{ $incident->equipment->name ?? 'N/A' }}</strong></td>
                <td>{{ Str::limit($incident->description, 50) }}</td>
                <td>
                  @if($incident->severity === 'low')
                    <span class="badge badge-severity-low"><i class="fas fa-check"></i>Low</span>
                  @elseif($incident->severity === 'medium')
                    <span class="badge badge-severity-medium"><i class="fas fa-exclamation"></i>Medium</span>
                  @elseif($incident->severity === 'high')
                    <span class="badge badge-severity-high"><i class="fas fa-exclamation-circle"></i>High</span>
                  @else
                    <span class="badge badge-severity-critical"><i class="fas fa-fire"></i>Critical</span>
                  @endif
                </td>
                <td>
                  @if($incident->status === 'open')
                    <span class="badge badge-status-open"><i class="fas fa-lock-open"></i>Open</span>
                  @elseif($incident->status === 'investigating')
                    <span class="badge badge-status-investigating"><i class="fas fa-magnifying-glass"></i>Investigating</span>
                  @else
                    <span class="badge badge-status-closed"><i class="fas fa-lock"></i>Closed</span>
                  @endif
                </td>
                <td>{{ \Carbon\Carbon::parse($incident->created_at)->format('M d, Y') }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <div class="empty-state">
          <i class="fas fa-inbox"></i>
          <h4>No Incidents Reported</h4>
          <p>All systems are running smoothly! Report any issues you encounter.</p>
          <a href="{{ route('incidents.report') }}" class="btn btn-primary"><i class="fas fa-plus"></i>Report an Incident</a>
        </div>
      @endif
    </div>
  </div>
</div>
@endsection
</parameter>
</create_file>
