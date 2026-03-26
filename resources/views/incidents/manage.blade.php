@extends('layouts.dashboard')

@section('title', 'Manage Incidents - CLFMS')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Manage Incidents</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Reporter</th>
                            <th>Equipment</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($incidents as $incident)
                        <tr>
                            <td>{{ $incident->id }}</td>
                            <td>{{ $incident->user->name ?? 'N/A' }}</td>
                            <td>{{ $incident->equipment->name ?? 'N/A' }}</td>
                            <td>{{ Str::limit($incident->description, 50) }}</td>
                            <td>
                                <span class="badge bg-{{ $incident->status == 'closed' ? 'secondary' : ($incident->status == 'resolved' ? 'success' : ($incident->status == 'investigating' ? 'warning' : 'danger')) }}">
                                    {{ ucfirst($incident->status) }}
                                </span>
                            </td>
                            <td>{{ $incident->created_at->format('M d, Y') }}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal{{ $incident->id }}">
                                    Update
                                </button>
                                
                                <!-- Update Modal -->
                                <div class="modal fade" id="updateModal{{ $incident->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Update Incident #{{ $incident->id }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form method="POST" action="{{ route('incidents.update', $incident->id) }}">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Status</label>
                                                        <select name="status" class="form-select" required>
                                                            <option value="pending" {{ $incident->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="investigating" {{ $incident->status == 'investigating' ? 'selected' : '' }}>Investigating</option>
                                                            <option value="resolved" {{ $incident->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                                            <option value="closed" {{ $incident->status == 'closed' ? 'selected' : '' }}>Closed</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Resolution Notes</label>
                                                        <textarea name="resolution" class="form-control" rows="3">{{ $incident->resolution }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No incidents found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

