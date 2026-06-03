@extends('layouts.dashboard')

@section('title', 'All Borrow Requests')

@section('content')
<style>
    .borrow-page { min-height: calc(100vh - 4.5rem); padding: 2rem 0; }
    .borrow-panel {
        border-radius: 28px;
        background: rgba(255, 255, 255, 0.92);
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 28px 75px rgba(15, 23, 42, 0.08);
        backdrop-filter: blur(18px);
    }
    .toolbar {
        border-radius: 22px;
        border: 1px solid rgba(226, 232, 240, 0.85);
        background: rgba(255,255,255,0.9);
    }
    .req-row {
        padding: 1.1rem;
        border-radius: 20px;
        border: 1px solid rgba(226, 232, 240, 0.9);
        background: rgba(255,255,255,0.86);
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
        font-weight: 900;
        padding: .55rem .95rem;
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
                        <h1 class="fw-bold mb-1" style="letter-spacing:-0.03em; font-size:2rem;">Borrow Approval Dashboard</h1>
                        <p class="text-muted mb-0">Approve/reject requests and confirm claim/return in the lab.</p>
                    </div>
                </div>

                <div class="mt-4">
                    <form method="GET" action="{{ route('borrowings.index') }}" class="row g-3 align-items-end mb-4">
                        <div class="col-sm-5">
                            <label class="form-label small text-muted">Search</label>
                            <input type="search" name="q" class="form-control" placeholder="Search by student, equipment, or purpose" value="{{ request('q') }}">
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label small text-muted">Status</label>
                            <select name="status" class="form-select">
                                <option value="">All statuses</option>
                                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="ready_to_claim" {{ request('status') === 'ready_to_claim' ? 'selected' : '' }}>Ready to Claim</option>
                                <option value="claimed" {{ request('status') === 'claimed' ? 'selected' : '' }}>Claimed</option>
                                <option value="return_requested" {{ request('status') === 'return_requested' ? 'selected' : '' }}>Return Requested</option>
                                <option value="returned" {{ request('status') === 'returned' ? 'selected' : '' }}>Returned</option>
                                <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                <option value="overdue" {{ request('status') === 'overdue' ? 'selected' : '' }}>Overdue</option>
                            </select>
                        </div>
                        <div class="col-sm-3 text-sm-end">
                            <button type="submit" class="btn btn-primary rounded-pill px-4">Filter</button>
                            <a href="{{ route('borrowings.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Clear</a>
                        </div>
                    </form>

                    @if (session('success'))
                        <div class="alert alert-success rounded-4 mb-3">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger rounded-4 mb-3">{{ session('error') }}</div>
                    @endif

                    @if($requests->count() === 0)
                        <div class="alert alert-info rounded-4 mb-0">No requests found.</div>
                    @endif

                    <div class="row g-3">
                        @foreach($requests as $r)
                            <div class="col-12">
                                <div class="req-row d-flex flex-column flex-lg-row align-items-start align-items-lg-center gap-3">
                                    <div class="d-flex align-items-center gap-3" style="min-width: 280px;">
<img class="img-eq" src="{{ optional($r->equipment)->getImageUrl() ?? asset('images/equipment/placeholder.svg') }}" alt="Equipment" onerror="this.onerror=null;this.src='{{ asset('images/equipment/placeholder.svg') }}';">
                                        <div>
                                            <div class="fw-bold">{{ $r->student->name }}</div>
                                            <div class="text-muted small">{{ $r->equipment->name }}</div>
                                            <div class="text-muted small">Qty: <strong class="text-dark">{{ $r->quantity }}</strong></div>
                                            <div class="text-muted small">Purpose: <strong>{{ \\Illuminate\\Support\\Str::limit($r->purpose, 40) }}</strong></div>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center gap-2 ms-lg-auto">
                                        <x-borrow-status-badge :status="$r->status" />
                                        <div class="text-muted small">
                                            Requested: {{ optional($r->request_date)->format('M d, Y') }}<br>
                                            Borrow: {{ optional($r->borrow_date)->format('M d, Y') }} • Due: {{ optional($r->return_date)->format('M d, Y') }}
                                            @if($r->approval_date)
                                                <br>Approved: {{ optional($r->approval_date)->format('M d, Y') }}
                                            @endif
                                            @if($r->status === 'claimed' && $r->claimed_at)
                                                <br>Claimed: {{ optional($r->claimed_at)->format('M d, Y H:i') }}
                                            @endif
                                            @if($r->status === 'returned' && $r->returned_at)
                                                <br>Returned: {{ optional($r->returned_at)->format('M d, Y H:i') }}
                                            @endif
                                            @if($r->status === 'return_requested' && $r->return_requested_at)
                                                <br>Return requested: {{ optional($r->return_requested_at)->format('M d, Y H:i') }}
                                            @endif
                                        </div>
                                    </div>

                                    <div class="d-flex flex-wrap gap-2">
                                        @if($r->status === 'pending')
                                            <form method="POST" action="{{ route('staff.approve', ['request_id' => $r->id]) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-primary action-btn">Approve</button>
                                            </form>
                                            <form method="POST" action="{{ route('staff.reject', ['request_id' => $r->id]) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-danger action-btn">Reject</button>
                                            </form>
                                        @endif

                                        @if($r->status === 'approved')
                                            <form method="POST" action="{{ route('staff.ready-to-claim', ['request_id' => $r->id]) }}">
                                                @csrf
                                                <button type="submit" class="btn action-btn" style="background:#7c3aed; color:white;">Ready to Claim</button>
                                            </form>
                                        @endif

                                        @if($r->status === 'ready_to_claim')
                                            <form method="POST" action="{{ route('staff.mark-claimed', ['request_id' => $r->id]) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-success action-btn">Mark as Claimed</button>
                                            </form>
                                        @endif

                                        @if($r->status === 'return_requested')
                                            <form method="POST" action="{{ route('staff.approve-return', ['request_id' => $r->id]) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-success action-btn">Approve Return</button>
                                            </form>
                                            <form method="POST" action="{{ route('staff.reject-return', ['request_id' => $r->id]) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-danger action-btn">Reject Return</button>
                                            </form>
                                        @endif

                                        @if(in_array($r->status, ['claimed', 'overdue']))
                                            <form method="POST" action="{{ route('staff.mark-returned', ['request_id' => $r->id]) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-secondary action-btn">Mark as Returned</button>
                                            </form>
                                        @endif
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


