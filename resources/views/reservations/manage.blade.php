@extends('layouts.dashboard')

@section('title', 'Manage Reservations - CLFMS')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Manage Reservations</h2>

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
                            <th>User</th>
                            <th>Laboratory</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->id }}</td>
                            <td>{{ $reservation->user->name ?? 'N/A' }}</td>
                            <td>{{ $reservation->laboratory->name ?? 'N/A' }}</td>
                            <td>{{ $reservation->date }}</td>
                            <td>{{ $reservation->start_time }} - {{ $reservation->end_time }}</td>
                            <td>
                                <span class="badge bg-{{ $reservation->status == 'approved' ? 'success' : ($reservation->status == 'rejected' ? 'danger' : ($reservation->status == 'completed' ? 'secondary' : 'warning')) }}">
                                    {{ ucfirst($reservation->status) }}
                                </span>
                            </td>
                            <td>
                                @if($reservation->status == 'pending')
                                <form method="POST" action="{{ route('reservations.approve', $reservation->id) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                </form>
                                <form method="POST" action="{{ route('reservations.reject', $reservation->id) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                </form>
                                @elseif($reservation->status == 'approved')
                                <form method="POST" action="{{ route('reservations.complete', $reservation->id) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary">Complete</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No reservations found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

