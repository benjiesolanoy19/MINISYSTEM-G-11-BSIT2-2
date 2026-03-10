@extends('layouts.dashboard')

@section('title', 'Manage Borrowings - CLFMS')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Manage Borrowings</h2>

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
                            <th>Equipment</th>
                            <th>Quantity</th>
                            <th>Borrow Date</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($borrowings as $borrowing)
                        <tr>
                            <td>{{ $borrowing->id }}</td>
                            <td>{{ $borrowing->user->name ?? 'N/A' }}</td>
                            <td>{{ $borrowing->equipment->name ?? 'N/A' }}</td>
                            <td>{{ $borrowing->quantity }}</td>
                            <td>{{ $borrowing->borrow_date }}</td>
                            <td>{{ $borrowing->due_date }}</td>
                            <td>
                                <span class="badge bg-{{ $borrowing->status == 'returned' ? 'success' : ($borrowing->status == 'damaged' ? 'warning' : ($borrowing->status == 'lost' ? 'danger' : 'info')) }}">
                                    {{ ucfirst($borrowing->status) }}
                                </span>
                            </td>
                            <td>
                                @if($borrowing->status == 'pending')
                                <form method="POST" action="{{ route('borrowings.approve', $borrowing->id) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                </form>
                                @elseif($borrowing->status == 'approved')
                                <form method="POST" action="{{ route('borrowings.return', $borrowing->id) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary">Mark Returned</button>
                                </form>
                                <form method="POST" action="{{ route('borrowings.damaged', $borrowing->id) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-warning">Damaged</button>
                                </form>
                                <form method="POST" action="{{ route('borrowings.lost', $borrowing->id) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Lost</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">No borrowings found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

