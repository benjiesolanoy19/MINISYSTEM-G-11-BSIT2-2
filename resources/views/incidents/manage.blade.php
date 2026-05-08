@extends('layouts.dashboard')

@section('title', 'Manage Incidents - ICTFE')

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

.card {
  border: none;
  border-radius: 20px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  overflow: hidden;
  border-top: 4px solid #ef4444;
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

.badge {
  padding: 8px 14px;
  border-radius: 20px;
  font-weight: 700;
  font-size: 12px;
  display: inline-flex;
  align-items: center;
  gap: 6px;
}

.badge-status-pending {
  background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
  color: white;
}

.badge-status-investigating {
  background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
  color: white;
}

.badge-status-resolved {
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  color: white;
}

.badge-status-closed {
  background: linear-gradient(135deg, #64748b 0%, #475569 100%);
  color: white;
}

.btn-update {
  background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
  border: none;
  color: white;
  padding: 8px 16px;
  border-radius: 8px;
  font-weight: 700;
  font-size: 12px;
  cursor: pointer;
  transition: all 0.3s ease;
}

.btn-update:hover {
  background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
  color: white;
}

.modal-header {
  background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
  color: white;
  border: none;
}

.modal-header .btn-close {
  filter: brightness(0) invert(1);
}

.btn-modal-submit {
  background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
  border: none;
  color: white;
  font-weight: 700;
}

.btn-modal-submit:hover {
  background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
  color: white;
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
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="page-header" data-aos="fade-down" data-aos-duration="600">
        <h1 class="page-title"><i class="fas fa-wrench"></i>Manage Incidents</h1>
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
                            <th><i class="fas fa-hashtag"></i>ID</th>
                            <th><i class="fas fa-user"></i>Reporter</th>
                            <th><i class="fas fa-microchip"></i>Equipment</th>
                            <th><i class="fas fa-align-left"></i>Description</th>
                            <th><i class="fas fa-circle-info"></i>Status</th>
                            <th><i class="fas fa-calendar"></i>Date</th>
                            <th><i class="fas fa-sliders"></i>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($incidents as $incident)
                        <tr data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                            <td><strong>#{{ $incident->id }}</strong></td>
                            <td>{{ $incident->user->name ?? 'N/A' }}</td>
                            <td>{{ $incident->equipment->name ?? 'N/A' }}</td>
                            <td>{{ Str::limit($incident->description, 50) }}</td>
                            <td>
                                @if($incident->status == 'closed')
                                    <span class="badge badge-status-closed"><i class="fas fa-lock"></i>Closed</span>
                                @elseif($incident->status == 'resolved')
                                    <span class="badge badge-status-resolved"><i class="fas fa-check"></i>Resolved</span>
                                @elseif($incident->status == 'investigating')
                                    <span class="badge badge-status-investigating"><i class="fas fa-magnifying-glass"></i>Investigating</span>
                                @else
                                    <span class="badge badge-status-pending"><i class="fas fa-clock"></i>Pending</span>
                                @endif
                            </td>
                            <td>{{ $incident->created_at->format('M d, Y') }}</td>
                            <td>
                                <button class="btn btn-update" data-bs-toggle="modal" data-bs-target="#updateModal{{ $incident->id }}">
                                    <i class="fas fa-edit me-1"></i>Update
                                </button>
                                
                                <!-- Update Modal -->
                                <div class="modal fade" id="updateModal{{ $incident->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Update Incident #{{ $incident->id }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form method="POST" action="{{ route('incidents.update', $incident->id) }}">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3" data-aos="fade-up" data-aos-delay="100">
                                                        <label class="form-label"><i class="fas fa-circle-info me-2"></i>Status</label>
                                                        <select name="status" class="form-select" required>
                                                            <option value="pending" {{ $incident->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="investigating" {{ $incident->status == 'investigating' ? 'selected' : '' }}>Investigating</option>
                                                            <option value="resolved" {{ $incident->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                                            <option value="closed" {{ $incident->status == 'closed' ? 'selected' : '' }}>Closed</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3" data-aos="fade-up" data-aos-delay="150">
                                                        <label class="form-label"><i class="fas fa-file-text me-2"></i>Resolution Notes</label>
                                                        <textarea name="resolution" class="form-control" rows="3" placeholder="Enter resolution notes...">{{ $incident->resolution }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i>Close</button>
                                                    <button type="submit" class="btn btn-modal-submit"><i class="fas fa-check me-1"></i>Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <i class="fas fa-inbox"></i>
                                    <h4>No Incidents Found</h4>
                                    <p>All systems are operating normally.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h4>No Incidents to Manage</h4>
                <p>There are currently no incidents in the system.</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

