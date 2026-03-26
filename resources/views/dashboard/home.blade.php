@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4"><i class="fas fa-home me-2"></i>Dashboard Overview</h2>
        </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 p-3 rounded">
                                <i class="fas fa-calendar-check text-primary fs-4"></i>
                            </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-0">{{ $reservations->count() }}</h5>
                            <small class="text-muted">Reservations</small>
                        </div>
                </div>
        </div>
        
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-success bg-opacity-10 p-3 rounded">
                                <i class="fas fa-laptop text-success fs-4"></i>
                            </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-0">{{ $borrowings->count() }}</h5>
                            <small class="text-muted">Borrowings</small>
                        </div>
                </div>
        </div>
        
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-warning bg-opacity-10 p-3 rounded">
                                <i class="fas fa-exclamation-triangle text-warning fs-4"></i>
                            </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-0">{{ $incidents->count() }}</h5>
                            <small class="text-muted">Incidents</small>
                        </div>
                </div>
        </div>
        
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-info bg-opacity-10 p-3 rounded">
                                <i class="fas fa-bell text-info fs-4"></i>
                            </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-0">{{ $unreadCount }}</h5>
                            <small class="text-muted">Notifications</small>
                        </div>
                </div>
        </div>

    <!-- Recent Activity -->
    <div class="row g-4">
        <!-- Recent Reservations -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Recent Reservations</h5>
                </div>
                <div class="card-body">
                    @if($reservations->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time In</th>
                                        <th>Time Out</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reservations->take(5) as $reservation)
                                    <tr>
                                        <td>{{ $reservation->date }}</td>
                                        <td>{{ $reservation->time_in }}</td>
                                        <td>{{ $reservation->time_out }}</td>
                                        <td>
                                            <span class="badge bg-success">Completed</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted text-center mb-0">No reservations yet.</p>
                    @endif
                </div>
        </div>

        <!-- Recent Borrowings -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0"><i class="fas fa-laptop me-2"></i>Recent Borrowings</h5>
                </div>
                <div class="card-body">
                    @if($borrowings->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Equipment</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($borrowings->take(5) as $borrowing)
                                    <tr>
                                        <td>Equipment #{{ $borrowing->equipment_id }}</td>
                                        <td>{{ $borrowing->borrow_date }}</td>
                                        <td>
                                            <span class="badge bg-{{ $borrowing->status == 'returned' ? 'success' : 'warning' }}">
                                                {{ ucfirst($borrowing->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted text-center mb-0">No borrowings yet.</p>
                    @endif
                </div>
        </div>
</div>
@endsection
