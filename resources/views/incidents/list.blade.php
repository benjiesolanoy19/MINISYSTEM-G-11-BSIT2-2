@extends('layouts.dashboard')

@section('title', 'My Incidents')

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
  text-decoration: none;
}

.btn-primary:hover {
  background: linear-gradient(135deg, #0284c7 0%, #059669 100%);
  transform: translateY(-2px);
  color: white;
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
    <h1 class="page-title">My Incidents</h1>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="card">
    <div class="card-body">
      @if($incidents->count() > 0)
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Equipment</th>
                <th>Description</th>
                <th>Severity</th>
                <th>Status</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
              @foreach($incidents as $incident)
              <tr>
                <td>{{ $incident->equipment->name ?? 'N/A' }}</td>
                <td>{{ Str::limit($incident->description, 50) }}</td>
                <td>
                  @if($incident->severity === 'low')
                    <span class="badge bg-info">Low</span>
                  @elseif($incident->severity === 'medium')
                    <span class="badge bg-warning">Medium</span>
                  @elseif($incident->severity === 'high')
                    <span class="badge bg-danger">High</span>
                  @else
                    <span class="badge bg-dark">Critical</span>
                  @endif
                </td>
                <td>
                  @if($incident->status === 'open')
                    <span class="badge bg-primary">Open</span>
                  @elseif($incident->status === 'investigating')
                    <span class="badge bg-warning">Investigating</span>
                  @else
                    <span class="badge bg-success">Closed</span>
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
          <p>No incidents reported.</p>
          <a href="{{ route('incidents.report') }}" class="btn btn-primary">Report an Incident</a>
        </div>
      @endif
    </div>
</div>
@endsection
</parameter>
</create_file>
