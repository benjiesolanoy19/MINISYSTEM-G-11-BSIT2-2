@extends('layouts.dashboard')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="container-fluid py-4">
    <div class="row g-4 align-items-center mb-4">
        <div class="col-xl-8">
            <div class="card-modern p-4 hero-banner">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <span class="badge bg-white text-primary mb-3">Welcome back</span>
                        <h1 class="display-6 text-white mb-2">Hello, {{ $user->name }}.</h1>
                        @if($user->role === 'staff')
                            <p class="text-white-75">Quickly oversee lab approvals, track equipment usage, and manage incident response with clarity.</p>
                        @else
                            <p class="text-white-75">Access reservations, borrowings, and lab alerts in one clean, organized student dashboard.</p>
                        @endif
                    </div>
                    <div class="col-md-4 text-md-end mt-4 mt-md-0">
                        <div class="d-grid gap-2">
                            @if($user->role === 'staff')
                                <a href="{{ route('reservations.index') }}" class="btn btn-light btn-lg text-primary">Review Reservations</a>
                                <a href="{{ route('equipment.index') }}" class="btn btn-light btn-lg text-dark">Manage Equipment</a>
                            @else
                                <a href="{{ route('reservations.create') }}" class="btn btn-light btn-lg text-primary">Reserve Lab</a>
                                <a href="{{ route('borrowings.create') }}" class="btn btn-light btn-lg text-dark">Borrow Equipment</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card-modern p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h5 class="mb-1">Today's Snapshot</h5>
                        <p class="mb-0 text-muted">Live summary of your current activity.</p>
                    </div>
                    <span class="badge bg-primary bg-opacity-15 text-primary py-2 px-3">Updated</span>
                </div>

                <div class="row g-3">
                    <div class="col-6">
                        <div class="metric-card p-3 text-center">
                            <div class="metric-label">Reservations</div>
                            <div class="metric-value">{{ $reservations->count() }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="metric-card p-3 text-center">
                            <div class="metric-label">Borrowings</div>
                            <div class="metric-value">{{ $borrowings->count() }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="metric-card p-3 text-center">
                            <div class="metric-label">Incidents</div>
                            <div class="metric-value">{{ $incidents->count() }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="metric-card p-3 text-center">
                            <div class="metric-label">Alerts</div>
                            <div class="metric-value">{{ $unreadCount }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-xl-4">
            <div class="card-modern p-4 h-100">
                <h5 class="mb-3">Quick Actions</h5>
                <div class="list-group list-group-flush">
                    @if($user->role === 'staff')
                        <a href="{{ route('reservations.index') }}" class="list-group-item list-group-item-action rounded-4 py-3">Review Reservations</a>
                        <a href="{{ route('equipment.index') }}" class="list-group-item list-group-item-action rounded-4 py-3">Equipment Inventory</a>
                        <a href="{{ route('notifications.index') }}" class="list-group-item list-group-item-action rounded-4 py-3">View Notifications</a>
                        <a href="{{ route('incidents.index') }}" class="list-group-item list-group-item-action rounded-4 py-3">Incident History</a>
                    @else
                        <a href="{{ route('reservations.index') }}" class="list-group-item list-group-item-action rounded-4 py-3">My Reservations</a>
                        <a href="{{ route('borrowings.index') }}" class="list-group-item list-group-item-action rounded-4 py-3">My Borrowings</a>
                        <a href="{{ route('notifications.index') }}" class="list-group-item list-group-item-action rounded-4 py-3">Notifications</a>
                        <a href="{{ route('profile.index') }}" class="list-group-item list-group-item-action rounded-4 py-3">Profile Settings</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card-modern p-4 h-100">
                <h5 class="mb-3">Activity Highlights</h5>
                <div class="d-flex flex-column gap-3">
                    <div class="bg-light rounded-4 p-3">
                        <h6 class="mb-1">Equipment Status</h6>
                        <p class="text-muted mb-0">Monitor availability and assigned lab equipment at a glance.</p>
                    </div>
                    <div class="bg-light rounded-4 p-3">
                        <h6 class="mb-1">Lab Utilization</h6>
                        <p class="text-muted mb-0">Track how many labs are currently reserved and active.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card-modern p-4 h-100">
                <h5 class="mb-3">Recent Activity</h5>
                <div class="list-group list-group-flush">
                    @forelse($reservations->take(4) as $reservation)
                        <div class="list-group-item rounded-4 mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <strong>{{ $reservation->laboratory->name ?? 'Laboratory' }}</strong>
                                <span class="badge bg-primary bg-opacity-15 text-primary">{{ ucfirst($reservation->status) }}</span>
                            </div>
                            <p class="text-muted mb-1">{{ \Carbon\Carbon::parse($reservation->date)->format('M d, Y') }} · {{ $reservation->time_in }} - {{ $reservation->time_out }}</p>
                        </div>
                    @empty
                        <div class="text-muted">No recent activity available.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-4">
        <div class="col-xl-12">
            <div class="card-modern p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <h5 class="mb-1">Campus Operations</h5>
                        <p class="text-muted mb-0">A clean overview of the most important dashboard sections.</p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-primary btn-sm">Refresh Overview</a>
                </div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="metric-card p-4 h-100">
                            <div class="metric-label">Labs Reserved</div>
                            <div class="metric-value">{{ $reservations->count() }}</div>
                            <p class="text-muted">Active and upcoming bookings for your account.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="metric-card p-4 h-100">
                            <div class="metric-label">Equipment Borrowed</div>
                            <div class="metric-value">{{ $borrowings->count() }}</div>
                            <p class="text-muted">Current equipment loans and scheduled returns.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="metric-card p-4 h-100">
                            <div class="metric-label">Open Alerts</div>
                            <div class="metric-value">{{ $unreadCount }}</div>
                            <p class="text-muted">Unread notifications and incident flags.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

