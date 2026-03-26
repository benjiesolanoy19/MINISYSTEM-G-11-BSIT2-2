@extends('layouts.dashboard')

@section('title', 'User Management')

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

.form-select-sm {
  padding: 6px 12px;
  border-radius: 8px;
  border: 2px solid #e5e7eb;
  font-weight: 500;
}

.form-select-sm:focus {
  border-color: #0ea5e9;
  box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
}

.btn-danger {
  background: #ef4444;
  border: none;
  padding: 6px 12px;
  border-radius: 8px;
}

.btn-danger:hover {
  background: #dc2626;
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
    <h1 class="page-title">User Management</h1>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="card">
    <div class="card-body">
      @if($users->count() > 0)
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created At</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
              <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                  <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : ($user->role === 'staff' ? 'warning' : 'info') }}">
                    {{ ucfirst($user->role) }}
                  </span>
                </td>
                <td>{{ \Carbon\Carbon::parse($user->created_at)->format('M d, Y') }}</td>
                <td>
                  <form method="POST" action="{{ route('admin.users.role', $user->id) }}" class="d-inline">
                    @csrf
                    <select name="role" class="form-select form-select-sm" onchange="this.form.submit()">
                      <option value="student" {{ $user->role === 'student' ? 'selected' : '' }}>Student</option>
                      <option value="staff" {{ $user->role === 'staff' ? 'selected' : '' }}>Staff</option>
                      <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                  </form>
                  @if($user->id !== auth()->id())
                  <form method="POST" action="{{ route('admin.users.delete', $user->id) }}" class="d-inline ms-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">
                      <i class="fas fa-trash"></i>
                    </button>
                  </form>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <div class="empty-state">
          <p>No users found.</p>
        </div>
      @endif
    </div>
</div>
@endsection
</parameter>
</create_file>
