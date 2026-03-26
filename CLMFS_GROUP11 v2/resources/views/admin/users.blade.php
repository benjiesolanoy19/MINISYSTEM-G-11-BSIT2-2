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
  display: flex;
  align-items: center;
  gap: 12px;
}

.page-title i {
  background: linear-gradient(135deg, #3b82f6, #1d4ed8);
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
  background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
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

.badge-admin { background: linear-gradient(135deg, #ef4444, #dc2626); color: white; }
.badge-staff { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; }
.badge-student { background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; }

.form-select-sm {
  padding: 8px 12px;
  border-radius: 8px;
  border: 2px solid #e2e8f0;
  font-weight: 500;
  transition: all 0.3s ease;
  cursor: pointer;
}

.form-select-sm:focus {
  border-color: #3b82f6;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
  outline: none;
}

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

.btn-danger-sm {
  background: linear-gradient(135deg, #ef4444, #dc2626);
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

.alert-danger {
  border-left-color: #ef4444;
  background: rgba(239, 68, 68, 0.1);
  color: #991b1b;
}

.user-avatar {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background: linear-gradient(135deg, #3b82f6, #1d4ed8);
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
  margin-right: 8px;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
  <div class="page-header" data-aos="fade-down" data-aos-duration="600">
    <div>
      <h1 class="page-title" data-aos="fade-right" data-aos-delay="100">
        <i class="fas fa-users"></i>User Management
      </h1>
      <p class="page-subtitle" data-aos="fade-right" data-aos-delay="150">
        Manage system users and assign roles
      </p>
    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" data-aos="slide-in-right" role="alert">
      <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" data-aos="slide-in-right" role="alert">
      <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="card" data-aos="fade-up" data-aos-duration="700">
    <div class="card-header">
      <h5><i class="fas fa-list me-2"></i>Users List</h5>
    </div>
    <div class="card-body">
      @if($users->count() > 0)
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th><i class="fas fa-user me-1"></i>Name</th>
                <th><i class="fas fa-envelope me-1"></i>Email</th>
                <th><i class="fas fa-badge me-1"></i>Role</th>
                <th><i class="fas fa-calendar me-1"></i>Joined</th>
                <th><i class="fas fa-tasks me-1"></i>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
              <tr data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <td>
                  <div style="display: flex; align-items: center;">
                    <div class="user-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                    <strong>{{ $user->name }}</strong>
                  </div>
                </td>
                <td>{{ $user->email }}</td>
                <td>
                  @if($user->role === 'admin')
                    <span class="badge badge-admin"><i class="fas fa-crown"></i> Admin</span>
                  @elseif($user->role === 'staff')
                    <span class="badge badge-staff"><i class="fas fa-briefcase"></i> Staff</span>
                  @else
                    <span class="badge badge-student"><i class="fas fa-graduation-cap"></i> Student</span>
                  @endif
                </td>
                <td>{{ \Carbon\Carbon::parse($user->created_at)->format('M d, Y') }}</td>
                <td>
                  <div class="btn-group-sm">
                    <form method="POST" action="{{ route('admin.users.role', $user->id) }}" class="d-inline">
                      @csrf
                      <select name="role" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="student" {{ $user->role === 'student' ? 'selected' : '' }}>Student</option>
                        <option value="staff" {{ $user->role === 'staff' ? 'selected' : '' }}>Staff</option>
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                      </select>
                    </form>
                    @if($user->id !== auth()->id())
                      <form method="POST" action="{{ route('admin.users.delete', $user->id) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger-sm" onclick="return confirm('Delete this user permanently?')" title="Delete">
                          <i class="fas fa-trash"></i> Delete
                        </button>
                      </form>
                    @else
                      <button class="btn btn-sm" style="background: #e2e8f0; color: #64748b;" disabled title="Cannot delete yourself">
                        <i class="fas fa-lock"></i> Current
                      </button>
                    @endif
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <div class="empty-state py-4">
          <i class="fas fa-inbox mb-3"></i>
          <h4>No Users Found</h4>
          <p>No users have been registered in the system yet.</p>
        </div>
      @endif
    </div>
  </div>
</div>
@endsection
</parameter>
</create_file>
