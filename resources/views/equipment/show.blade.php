@extends('layouts.dashboard')

@section('title', $equipment->name)

@section('content')
<div class="container py-4">
    <div class="row g-4">
        <div class="col-12 col-lg-5">
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                <img src="{{ $equipment->getImageUrl() }}" class="card-img-top" alt="{{ $equipment->name }}" style="object-fit: cover; height: 420px;" onerror="this.onerror=null;this.src='{{ asset('images/equipment/placeholder.svg') }}';" />
                <div class="card-body">
                    <h1 class="h4 mb-3">{{ $equipment->name }}</h1>
                    <p class="text-muted mb-0">{{ $equipment->category }}</p>
                    <div class="mt-4">
                        <span class="badge bg-info text-dark me-2">{{ $equipment->status_label }}</span>
                        <span class="badge bg-secondary">{{ $equipment->condition }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-7">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h2 class="h5 mb-3">Equipment Details</h2>
                <dl class="row">
                    <dt class="col-sm-4 text-muted">Asset Tag</dt>
                    <dd class="col-sm-8">{{ $equipment->asset_tag }}</dd>

                    <dt class="col-sm-4 text-muted">Brand / Model</dt>
                    <dd class="col-sm-8">{{ $equipment->brand }} &mdash; {{ $equipment->model }}</dd>

                    <dt class="col-sm-4 text-muted">Serial Number</dt>
                    <dd class="col-sm-8">{{ $equipment->serial_number ?? 'N/A' }}</dd>

                    <dt class="col-sm-4 text-muted">Location</dt>
                    <dd class="col-sm-8">{{ $equipment->location ?? 'Unassigned' }}</dd>

                    <dt class="col-sm-4 text-muted">Available Quantity</dt>
                    <dd class="col-sm-8">{{ $equipment->available_quantity }}</dd>

                    <dt class="col-sm-4 text-muted">Total Quantity</dt>
                    <dd class="col-sm-8">{{ $equipment->quantity }}</dd>

                    <dt class="col-sm-4 text-muted">Purchased</dt>
                    <dd class="col-sm-8">{{ optional($equipment->purchase_date)->format('M d, Y') ?? 'N/A' }}</dd>

                    <dt class="col-sm-4 text-muted">Warranty Expiration</dt>
                    <dd class="col-sm-8">{{ optional($equipment->warranty_expiration)->format('M d, Y') ?? 'N/A' }}</dd>

                    <dt class="col-sm-4 text-muted">Description</dt>
                    <dd class="col-sm-8">{{ $equipment->description ?? 'No additional description provided.' }}</dd>
                </dl>

                <div class="mt-4 d-flex flex-column flex-sm-row gap-2">
                    <a href="{{ route('equipment.index') }}" class="btn btn-outline-secondary btn-lg">
                        <i class="fas fa-chevron-left me-2"></i>Back to Inventory
                    </a>
                    @if(auth()->check() && auth()->user()->role === 'student' && $equipment->status === 'available')
                        <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#borrowModal">
                            <i class="fas fa-hand-holding me-2"></i>Borrow Item
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
    @parent
    <div class="modal fade" id="borrowModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4">
                <div class="modal-header">
                    <h5 class="modal-title">Request to Borrow</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
<form method="POST" action="{{ route('equipment.borrow', request()->route('id')) }}">
                    @csrf
                    <div class="modal-body">
                        <p>You're requesting to borrow <strong>{{ $equipment->name }}</strong>.</p>
                        <div class="mb-3">
                            <label class="form-label">Purpose</label>
                            <input type="text" name="purpose" class="form-control" placeholder="e.g., Project work, exam" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Return Date</label>
                            <input type="date" name="return_date" class="form-control" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

