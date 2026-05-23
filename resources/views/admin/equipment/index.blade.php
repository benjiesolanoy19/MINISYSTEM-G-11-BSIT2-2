@extends('layouts.dashboard')

@section('title', 'Admin - Equipment')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Admin - Equipment</h1>
            <div class="text-muted">Edit or delete equipment. Borrowing is handled in the Borrow Equipment page only.</div>
        </div>

        <div>
            <a href="{{ route('equipment.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add Equipment
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="table-responsive bg-white rounded-3 border">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Total</th>
                    <th>Available</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($equipment as $e)
                    <tr>
                        <td>{{ $e->id }}</td>
                        <td>{{ $e->name }}</td>
                        <td>{{ $e->description }}</td>
                        <td>{{ $e->total_quantity ?? $e->quantity ?? '-' }}</td>
                        <td>{{ $e->available_quantity }}</td>
                        <td class="text-end">
                            <a href="{{ route('equipment.edit', $e->id) }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-edit me-1"></i>Edit
                            </a>

                            <form action="{{ route('equipment.destroy', $e->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this equipment?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm ms-2">
                                    <i class="fas fa-trash me-1"></i>Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">No equipment found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection


