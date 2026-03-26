@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid p-4">
    <div class="mb-4">
        <h1 class="h3 fw-bold mb-2">Welcome, {{ $user->name }}!</h1>
        <p class="text-muted">Dashboard Overview</p>
    </div>
    
    <!-- Quick Stats -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-body">
                    <p class="card-text text-muted small text-uppercase fw-600 mb-2">Reservations</p>
                    <h3 class="card-title fw-bold text-primary">{{ $reservations->count() }}</h3>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-body">
                    <p class="card-text text-muted small text-uppercase fw-600 mb-2">Borrowings</p>
                    <h3 class="card-title fw-bold text-success">{{ $borrowings->count() }}</h3>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-body">
                    <p class="card-text text-muted small text-uppercase fw-600 mb-2">Incidents</p>
                    <h3 class="card-title fw-bold text-warning">{{ $incidents->count() }}</h3>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-body">
                    <p class="card-text text-muted small text-uppercase fw-600 mb-2">Notifications</p>
                    <h3 class="card-title fw-bold text-info">{{ $unreadCount }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="mb-4">
        <a href="{{ route('reservations.index') }}" class="btn btn-primary me-2">View Reservations</a>
        <a href="{{ route('borrowings.index') }}" class="btn btn-success me-2">View Borrowings</a>
        <a href="{{ route('notifications.index') }}" class="btn btn-info me-2">View Notifications</a>
        <a href="{{ route('profile.index') }}" class="btn btn-secondary">Profile</a>
    </div>
</div>
@endsection
