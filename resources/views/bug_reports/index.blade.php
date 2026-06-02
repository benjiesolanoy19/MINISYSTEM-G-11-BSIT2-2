@extends('layouts.dashboard')

@section('title', 'Bug Reports')

@section('styles')
<style>
.page-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 30px;
  padding: 30px;
  background: linear-gradient(135deg, #0f766e 0%, #0ea5e9 100%);
  border-radius: 15px;
  box-shadow: 0 8px 25px rgba(14, 165, 233, 0.16);
}

.page-title {
  font-size: 32px;
  font-weight: 700;
  color: white;
  margin: 0;
  display: flex;
  align-items: center;
  gap: 14px;
}

.card-modern {
  border-radius: 24px;
  border: 1px solid rgba(226,232,240,0.95);
  background: white;
  box-shadow: 0 20px 45px rgba(15, 23, 42, 0.04);
}

.table thead th {
  border-bottom: 2px solid rgba(226,232,240,0.95);
}

.badge-status {
  text-transform: capitalize;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
  <div class="page-header" data-aos="fade-down" data-aos-duration="600">
    <h1 class="page-title"><i class="fas fa-bug"></i>Bug Reports</h1>
    @if(! Auth::user()->isAdmin())
      <a href="{{ route('bug-reports.create') }}" class="btn btn-light btn-lg border rounded-pill"><i class="fas fa-plus-circle me-2"></i>Submit New Bug</a>
    @else
      <span class="badge bg-primary text-white rounded-pill py-2 px-3">Admin Dashboard</span>
    @endif
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" data-aos="fade-down">
      <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="card-modern p-4" data-aos="fade-up" data-aos-duration="700">
    <div class="table-responsive">
      <table class="table align-middle mb-0">
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Reporter</th>
            <th>Priority</th>
            <th>Status</th>
            <th>Submitted</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @forelse($bugReports as $bug)
            <tr>
              <td>{{ $bug->id }}</td>
              <td>{{ Str::limit($bug->title, 45) }}</td>
              <td>{{ optional($bug->reporter)->name }}</td>
              <td><span class="badge bg-{{ $bug->priority === 'critical' ? 'danger' : ($bug->priority === 'high' ? 'warning' : ($bug->priority === 'medium' ? 'info' : 'secondary')) }} bg-opacity-15 text-{{ $bug->priority === 'critical' ? 'danger' : ($bug->priority === 'high' ? 'warning' : ($bug->priority === 'medium' ? 'info' : 'secondary')) }} rounded-pill">{{ ucfirst($bug->priority) }}</span></td>
              <td><span class="badge badge-status bg-{{ $bug->status === 'resolved' ? 'success' : ($bug->status === 'in_progress' ? 'primary' : ($bug->status === 'under_review' ? 'warning' : ($bug->status === 'closed' ? 'dark' : 'secondary'))) }} bg-opacity-15 text-{{ $bug->status === 'resolved' ? 'success' : ($bug->status === 'in_progress' ? 'primary' : ($bug->status === 'under_review' ? 'warning' : ($bug->status === 'closed' ? 'dark' : 'secondary'))) }} rounded-pill">{{ str_replace('_', ' ', ucfirst($bug->status)) }}</span></td>
              <td>{{ $bug->created_at->diffForHumans() }}</td>
              <td class="text-end">
                <a href="{{ route('bug-reports.show', $bug) }}" class="btn btn-sm btn-outline-primary">View</a>
                @if(Auth::user()->isAdmin())
                  <form action="{{ route('bug-reports.update', $bug) }}" method="POST" class="d-inline ms-2">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="approved">
                    <button type="submit" class="btn btn-sm btn-success" title="Approve">✔</button>
                  </form>

                  <a href="{{ route('bug-reports.show', $bug) }}" class="btn btn-sm btn-warning ms-2" title="Assign">🔄</a>

                  <form action="{{ route('bug-reports.update', $bug) }}" method="POST" class="d-inline ms-2">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="resolved">
                    <button type="submit" class="btn btn-sm btn-primary" title="Mark Resolved">✅</button>
                  </form>
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-center text-muted py-5">No bug reports have been submitted yet.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
