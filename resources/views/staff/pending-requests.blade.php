@extends('layouts.dashboard')

@section('title', 'Pending Borrow Requests')

@section('content')

<div class="d-none">
    <!-- Status UI uses resources/views/components/borrow-status-badge.blade.php -->
</div>

<style>
    .borrow-page { min-height: calc(100vh - 4.5rem); padding: 2rem 0; }
    .borrow-panel {
        border-radius: 28px;
        background: rgba(255, 255, 255, 0.92);
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 28px 75px rgba(15, 23, 42, 0.08);
        backdrop-filter: blur(18px);
    }
    .req-row {
        padding: 1.2rem;
        border-radius: 20px;
        border: 1px solid rgba(226, 232, 240, 0.9);
        background: rgba(255,255,255,0.85);
        transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
    }
    .req-row:hover {
        transform: translateY(-2px);
        border-color: rgba(14, 165, 233, 0.30);
        box-shadow: 0 24px 60px rgba(14, 165, 233, 0.10);
    }
    .img-eq { width: 56px; height: 56px; object-fit: cover; border-radius: 16px; border: 1px solid rgba(226,232,240,0.9); background:#f8fafc; }
    .action-btn {
        border-radius: 16px;
        font-weight: 800;
        padding: .65rem 1rem;
        transition: transform .16s ease, box-shadow .16s ease, filter .16s ease;
    }
    .action-btn:hover { transform: translateY(-1px); filter: brightness(1.05); box-shadow: 0 18px 35px rgba(0,0,0,.10); }
</style>

<div class="container-fluid borrow-page">
    <div class="row gy-4">
        <div class="col-12">
            <div class="borrow-panel p-4">
                <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
                    <div>
                        <h1 class="fw-bold mb-1" style="letter-spacing:-0.03em; font-size:2rem;">Pending Borrow Requests</h1>
                        <p class="text-muted mb-0">Review and approve or reject.</p>
                    </div>
                    <div class="d-flex gap-2">
                        @if (session('success'))
                            <div class="alert alert-success mb-0 rounded-4">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger mb-0 rounded-4">{{ session('error') }}</div>
                        @endif
                    </div>
                </div>

                <div class="mt-4">
                    @if($requests->count() === 0)
                        <div class="alert alert-info rounded-4 mb-0">No pending requests.</div>
                    @endif

                    <div class="row g-3">
                        @foreach($requests as $r)
                            <div class="col-12">
                                <div class="req-row d-flex flex-column flex-lg-row align-items-start align-items-lg-center gap-3">
                                    <div class="d-flex align-items-center gap-3" style="min-width: 280px;">
                                        <img class="img-eq" src="{{ optional($r->equipment)->image_url ?? ($r->equipment ? $r->equipment->getImageUrl() : 'https://via.placeholder.com/128?text=EQ') }}" alt="Equipment">
                                        <div>
                                            <div class="fw-bold">{{ optional($r->student)->name ?? 'Unknown student' }}</div>
                                            <div class="text-muted small">Equipment: <strong class="text-dark">{{ optional($r->equipment)->name ?? 'Unknown equipment' }}</strong></div>

                                            <div class="text-muted small">Qty: <strong class="text-dark">{{ $r->quantity }}</strong></div>
                                            <div class="text-muted small">Borrow: <strong class="text-dark">{{ optional($r->borrow_date)->format('M d, Y') }}</strong></div>
                                            <div class="text-muted small">Return: <strong class="text-dark">{{ optional($r->return_date)->format('M d, Y') }}</strong></div>
                                            <div class="text-muted small">Purpose: <strong class="text-dark">{{ Str::limit($r->purpose, 45) }}</strong></div>

                                            <div class="text-muted small">Requested: {{ optional($r->request_date)->format('M d, Y H:i') }}</div>
                                        </div>
                                    </div>

                                    <div class="ms-lg-auto d-flex flex-column flex-sm-row align-items-start align-items-sm-center gap-2">
<x-borrow-status-badge status="pending" />
                                        <div class="text-muted small">Available: <strong class="text-dark">{{ $r->equipment->available_quantity }}</strong></div>
                                    </div>

                                    <div class="d-flex gap-2 ms-lg-auto">
                                        <form method="POST" action="{{ route('staff.approve', ['request_id' => $r->id]) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-primary action-btn">Approve</button>
                                        </form>
                                        <form method="POST" action="{{ route('staff.reject', ['request_id' => $r->id]) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-danger action-btn">Reject</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection


