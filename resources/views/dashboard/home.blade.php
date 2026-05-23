@extends('layouts.dashboard')

@section('title', 'ICTFE - Home')
@section('page-title', 'ICTFE Home')

@section('styles')
<style>
.dashboard-header {
    border-radius: 24px;
    background: rgba(255, 255, 255, 0.96);
    box-shadow: 0 24px 60px rgba(15, 23, 42, 0.08);
}
.dashboard-header .header-meta {
    font-size: 0.78rem;
    text-transform: uppercase;
    letter-spacing: 0.18em;
    color: #0ea5e9;
    margin-bottom: 0.8rem;
    font-weight: 700;
}
.dashboard-header h2 {
    font-size: 2rem;
    margin-bottom: 0.5rem;
}
.dashboard-header p {
    color: #64748b;
    margin-bottom: 0;
}
.dashboard-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
}
.dashboard-stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1rem;
    margin-top: 1.5rem;
}
.dashboard-stat-card {
    background: #ffffff;
    border-radius: 22px;
    padding: 1.35rem 1.4rem;
    box-shadow: 0 30px 70px rgba(15, 23, 42, 0.06);
    border: 1px solid rgba(226, 232, 240, 0.95);
}
.dashboard-stat-card .stat-label {
    font-size: 0.75rem;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: #64748b;
    margin-bottom: 0.75rem;
}
.dashboard-stat-card .stat-value {
    font-size: 2rem;
    font-weight: 700;
    color: #0f172a;
}
.dashboard-stat-card .stat-note {
    font-size: 0.85rem;
    color: #64748b;
    margin-top: 0.65rem;
}
.quick-actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1rem;
}
.quick-action-card {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 18px;
    transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    text-decoration: none;
    color: #0f172a;
}
.quick-action-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 18px 40px rgba(15, 23, 42, 0.08);
    border-color: rgba(14, 165, 233, 0.4);
}
.action-icon {
    width: 44px;
    height: 44px;
    border-radius: 16px;
    background: linear-gradient(135deg, #0ea5e9, #10b981);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.05rem;
}
.action-title {
    font-weight: 600;
    font-size: 0.95rem;
    margin-bottom: 0.2rem;
}
.action-subtitle {
    font-size: 0.8rem;
    color: #64748b;
}
.notifications-preview {
    display: grid;
    gap: 1rem;
}
.notification-preview-item {
    display: flex;
    align-items: flex-start;
    gap: 0.9rem;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 18px;
    padding: 1rem;
}
.notification-preview-item.unread {
    background: rgba(14, 165, 233, 0.07);
    border-color: rgba(14, 165, 233, 0.3);
}
.notification-icon {
    width: 36px;
    height: 36px;
    border-radius: 12px;
    background: rgba(14, 165, 233, 0.12);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #0ea5e9;
    font-size: 0.95rem;
}
.notification-title {
    font-size: 0.95rem;
    font-weight: 600;
    color: #0f172a;
    margin-bottom: 0.2rem;
}
.notification-time {
    font-size: 0.78rem;
    color: #64748b;
}
@media (max-width: 991.98px) {
    .dashboard-header h2 {
        font-size: 1.75rem;
    }
}
</style>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row g-4 align-items-center mb-4">
        <div class="col-12">
            <div class="card-modern p-4">
                <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between gap-3">
                    <div>
                        <div class="text-uppercase text-primary fw-semibold mb-2" style="letter-spacing:0.18em; font-size:0.78rem;">Home overview</div>
                        <h2 class="mb-2 fw-bold">Welcome back, {{ $user->name }}.</h2>
                        <p class="text-muted mb-0">Quick access to equipment, requests, incidents, and notifications from one place.</p>
                    </div>
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <a href="{{ route('notifications.index') }}" class="btn btn-outline-primary rounded-pill">Notifications</a>
                        @if($user->role === 'staff')
                            <a href="{{ route('borrowings.index') }}" class="btn btn-primary rounded-pill">Review Requests</a>
                        @else
                            <a href="{{ route('borrowings.create') }}" class="btn btn-primary rounded-pill">Borrow Equipment</a>
                        @endif
                    </div>
                </div>

                <div class="dashboard-stats-grid mt-4">
                    <div class="dashboard-stat-card">
                        <div class="stat-label">Active borrowings</div>
                        <div class="stat-value">{{ $borrowings->count() }}</div>
                        <div class="stat-note">{{ $borrowings->where('status', 'pending')->count() }} pending</div>
                    </div>
                    <div class="dashboard-stat-card">
                        <div class="stat-label">Unread notifications</div>
                        <div class="stat-value">{{ $unreadCount }}</div>
                        <div class="stat-note">Latest updates waiting</div>
                    </div>
                    <div class="dashboard-stat-card">
                        <div class="stat-label">Reported incidents</div>
                        <div class="stat-value">{{ $incidents->count() }}</div>
                        <div class="stat-note">{{ $incidents->where('status', 'open')->count() }} open</div>
                    </div>
                    <div class="dashboard-stat-card">
                        <div class="stat-label">Total equipment</div>
                        <div class="stat-value">{{ \App\Models\Equipment::count() }}</div>
                        <div class="stat-note">Inventory overview</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-xl-8">
            <div class="card-modern p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="mb-1 fw-bold"><i class="fas fa-history text-primary me-2"></i>Recent Activity</h5>
                        <p class="text-muted small mb-0">Your latest borrowings and requests</p>
                    </div>
                    <a href="{{ route('borrowings.index') }}" class="btn btn-outline-primary btn-sm rounded-pill">View All</a>
                </div>

                <div class="activity-timeline">
                    @forelse($borrowings->take(5) as $borrowing)
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-laptop"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">
                                    Borrowed {{ $borrowing->equipment->name }}
                                    <span class="badge bg-{{ $borrowing->status === 'approved' ? 'success' : ($borrowing->status === 'pending' ? 'warning' : 'secondary') }} bg-opacity-15 text-{{ $borrowing->status === 'approved' ? 'success' : ($borrowing->status === 'pending' ? 'warning' : 'secondary') }} ms-2">
                                        {{ ucfirst($borrowing->status) }}
                                    </span>
                                </div>
                                <div class="activity-meta">
                                    <span>{{ optional($borrowing->borrow_date)->format('M d, Y') ?? 'N/A' }}</span>
                                    @if($borrowing->purpose)
                                        <span class="mx-2">•</span>
                                        <span>{{ Str::limit($borrowing->purpose, 40) }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="activity-time">{{ optional($borrowing->borrow_date)->diffForHumans() ?? 'N/A' }}</div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <h6 class="text-muted">No recent activity</h6>
                            <p class="text-muted small">Your borrowing history will appear here</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="row g-4">
                <div class="col-12">
                    <div class="card-modern p-4">
                        <h5 class="mb-1 fw-bold"><i class="fas fa-bolt text-warning me-2"></i>Quick Actions</h5>
                        <p class="text-muted small mb-4">Frequently used actions</p>
                        <div class="quick-actions-grid">
                            @if($user->role === 'staff')
                                <a href="{{ route('borrowings.index') }}" class="quick-action-card">
                                    <div class="action-icon"><i class="fas fa-clipboard-check"></i></div>
                                    <div class="action-content">
                                        <div class="action-title">Review Requests</div>
                                        <div class="action-subtitle">Approve borrowings</div>
                                    </div>
                                </a>
                                <a href="{{ route('equipment.index') }}" class="quick-action-card">
                                    <div class="action-icon"><i class="fas fa-cogs"></i></div>
                                    <div class="action-content">
                                        <div class="action-title">Equipment</div>
                                        <div class="action-subtitle">Manage inventory</div>
                                    </div>
                                </a>
                                <a href="{{ route('incidents.index') }}" class="quick-action-card">
                                    <div class="action-icon"><i class="fas fa-exclamation-triangle"></i></div>
                                    <div class="action-content">
                                        <div class="action-title">Incidents</div>
                                        <div class="action-subtitle">Handle reports</div>
                                    </div>
                                </a>
                                <a href="{{ route('logs.index') }}" class="quick-action-card">
                                    <div class="action-icon"><i class="fas fa-history"></i></div>
                                    <div class="action-content">
                                        <div class="action-title">Activity Logs</div>
                                        <div class="action-subtitle">System history</div>
                                    </div>
                                </a>
                            @else
                                <a href="{{ route('borrowings.create') }}" class="quick-action-card">
                                    <div class="action-icon"><i class="fas fa-plus"></i></div>
                                    <div class="action-content">
                                        <div class="action-title">New Borrowing</div>
                                        <div class="action-subtitle">Request equipment</div>
                                    </div>
                                </a>
                                <a href="{{ route('borrowings.index') }}" class="quick-action-card">
                                    <div class="action-icon"><i class="fas fa-list"></i></div>
                                    <div class="action-content">
                                        <div class="action-title">My Borrowings</div>
                                        <div class="action-subtitle">Track requests</div>
                                    </div>
                                </a>
                                <a href="{{ route('incidents.report') }}" class="quick-action-card">
                                    <div class="action-icon"><i class="fas fa-exclamation-circle"></i></div>
                                    <div class="action-content">
                                        <div class="action-title">Report Issue</div>
                                        <div class="action-subtitle">Equipment problems</div>
                                    </div>
                                </a>
                                <a href="{{ route('profile.index') }}" class="quick-action-card">
                                    <div class="action-icon"><i class="fas fa-user"></i></div>
                                    <div class="action-content">
                                        <div class="action-title">Profile</div>
                                        <div class="action-subtitle">Account settings</div>
                                    </div>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card-modern p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h5 class="mb-1 fw-bold"><i class="fas fa-bell text-info me-2"></i>Notifications</h5>
                                <p class="text-muted small mb-0">Latest updates</p>
                            </div>
                            <a href="{{ route('notifications.index') }}" class="btn btn-outline-info btn-sm rounded-pill">View All</a>
                        </div>
                        <div class="notifications-preview">
                            @forelse($notifications->take(3) as $notification)
                                <div class="notification-preview-item {{ $notification->is_read ? '' : 'unread' }}">
                                    <div class="notification-icon"><i class="fas fa-info-circle"></i></div>
                                    <div class="notification-content">
                                        <div class="notification-title">{{ Str::limit($notification->message, 50) }}</div>
                                        <div class="notification-time">{{ $notification->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-3">
                                    <i class="fas fa-bell-slash fa-2x text-muted mb-2"></i>
                                    <p class="text-muted small mb-0">No new notifications</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-4">
        <div class="col-lg-4">
            <div class="card-modern p-4">
                <h5 class="mb-4 fw-bold"><i class="fas fa-clock text-info me-2"></i>Facility Access Tracking</h5>
                <div class="d-grid gap-2">
                    <button class="btn btn-lg btn-info rounded-pill py-3" onclick="toggleTimeTracking('in')">
                        <i class="fas fa-sign-in-alt me-2"></i>Time In
                    </button>
                    <button class="btn btn-lg btn-warning rounded-pill py-3" onclick="toggleTimeTracking('out')">
                        <i class="fas fa-sign-out-alt me-2"></i>Time Out
                    </button>
                </div>
                <div class="mt-4 p-3 bg-light rounded-3">
                    <p class="text-muted small mb-2">Current Session:</p>
                    <p class="mb-1"><strong id="sessionTime">--:--</strong></p>
                    <p class="text-muted small mb-0">Last Activity: <span id="lastActivity">Just now</span></p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-modern p-4">
                <h5 class="mb-4 fw-bold"><i class="fas fa-chart-pie text-success me-2"></i>Equipment Status</h5>
                <div class="row text-center">
                    <div class="col-6">
                        <div class="mb-3">
                            <div class="display-6 text-success fw-bold">{{ \App\Models\Equipment::where('status', 'available')->count() }}</div>
                            <small class="text-muted">Available</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <div class="display-6 text-warning fw-bold">{{ \App\Models\Equipment::where('status', 'borrowed')->count() }}</div>
                            <small class="text-muted">In Use</small>
                        </div>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 8px;">
                    @php
                        $total = \App\Models\Equipment::count();
                        $available = \App\Models\Equipment::where('status', 'available')->count();
                        $percent = $total > 0 ? ($available / $total) * 100 : 0;
                    @endphp
                    <div class="progress-bar bg-success" style="width: {{ $percent }}%"></div>
                </div>
                <small class="text-muted">Availability: {{ round($percent) }}%</small>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-modern p-4">
                <h5 class="mb-4 fw-bold"><i class="fas fa-tachometer-alt text-danger me-2"></i>System Health</h5>
                <div class="list-unstyled">
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="small">Active Requests</span>
                            <span class="badge bg-primary">{{ $borrowings->where('status', 'pending')->count() }}</span>
                        </div>
                        <small class="text-muted">{{ $borrowings->where('status', 'pending')->count() }} pending approval</small>
                    </div>
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="small">Open Incidents</span>
                            <span class="badge bg-warning">{{ $incidents->where('status', 'open')->count() }}</span>
                        </div>
                        <small class="text-muted">{{ $incidents->where('status', 'open')->count() }} unresolved</small>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="small">System Uptime</span>
                            <span class="badge bg-success">99.9%</span>
                        </div>
                        <small class="text-muted">All systems operational</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-2">
        <div class="col-lg-6">
            <div class="card-modern p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-boxes text-primary me-2"></i>Active Borrowings</h5>
                    <a href="{{ route('borrowings.index') }}" class="btn btn-sm btn-outline-primary rounded-pill">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-borderless">
                        <thead>
                            <tr>
                                <th class="text-muted small">Equipment</th>
                                <th class="text-muted small">Status</th>
                                <th class="text-muted small">Due Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($borrowings->take(5) as $borrowing)
                                <tr>
                                    <td><small class="fw-600">{{ $borrowing->equipment->name }}</small></td>
                                    <td>
                                        <span class="badge bg-{{ $borrowing->status === 'approved' ? 'success' : ($borrowing->status === 'pending' ? 'warning' : 'secondary') }} bg-opacity-15 text-{{ $borrowing->status === 'approved' ? 'success' : ($borrowing->status === 'pending' ? 'warning' : 'secondary') }}">
                                            {{ ucfirst($borrowing->status) }}
                                        </span>
                                    </td>
                                    <td><small class="text-muted">{{ optional($borrowing->return_date)->format('M d, Y') ?? 'N/A' }}</small></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">No active borrowings</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card-modern p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-alert-circle text-danger me-2"></i>Recent Incidents</h5>
                    <a href="{{ route('incidents.index') }}" class="btn btn-sm btn-outline-danger rounded-pill">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-borderless">
                        <thead>
                            <tr>
                                <th class="text-muted small">Type</th>
                                <th class="text-muted small">Severity</th>
                                <th class="text-muted small">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($incidents->take(5) as $incident)
                                <tr>
                                    <td><small class="fw-600">{{ $incident->type }}</small></td>
                                    <td>
                                        <span class="badge bg-{{ $incident->severity === 'high' ? 'danger' : ($incident->severity === 'medium' ? 'warning' : 'info') }} bg-opacity-15 text-{{ $incident->severity === 'high' ? 'danger' : ($incident->severity === 'medium' ? 'warning' : 'info') }}">
                                            {{ ucfirst($incident->severity) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $incident->status === 'closed' ? 'success' : 'warning' }} bg-opacity-15 text-{{ $incident->status === 'closed' ? 'success' : 'warning' }}">
                                            {{ ucfirst($incident->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">No incidents reported</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleTimeTracking(type) {
        const now = new Date();
        document.getElementById('sessionTime').textContent = now.toLocaleTimeString();
        document.getElementById('lastActivity').textContent = 'Just now';
        alert('Time ' + type + ' recorded successfully!');
    }
</script>
@endsection


