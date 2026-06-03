@extends('layouts.dashboard')

@section('title', 'My Borrow Requests')

@section('content')
<style>
    .borrow-page {
        min-height: calc(100vh - 4.5rem);
        padding: 2rem 0;
    }

    .borrow-panel {
        border-radius: 28px;
        background: rgba(255, 255, 255, 0.92);
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 28px 75px rgba(15, 23, 42, 0.08);
        backdrop-filter: blur(18px);
    }

    .card-soft {
        border-radius: 24px;
        border: 1px solid rgba(226, 232, 240, 0.9);
        background: rgba(255,255,255,0.92);
        box-shadow: 0 20px 45px rgba(15, 23, 42, 0.06);
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

    .img-eq {
        width: 64px;
        height: 64px;
        object-fit: cover;
        border-radius: 16px;
        border: 1px solid rgba(226,232,240,0.9);
        background: #f8fafc;
    }
</style>

<div class="container-fluid borrow-page">
    <div class="row gy-4">
        <div class="col-12">
            <div class="borrow-panel p-4">
                <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
                    <div>
                        <h1 class="fw-bold mb-1" style="letter-spacing:-0.03em; font-size:2rem;">My Borrow Requests</h1>
                        <p class="text-muted mb-0">Track approvals, claim status, and return schedule.</p>
                    </div>
                </div>

                <div class="mt-4">
                    @if (session('success'))
                        <div class="alert alert-success rounded-4">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger rounded-4">{{ session('error') }}</div>
                    @endif
                </div>

                <div class="row mt-3 g-3">
                    @forelse($requests as $r)
                        <div class="col-12">
                            <div class="req-row d-flex flex-column flex-lg-row align-items-start align-items-lg-center gap-3">
                                <div class="d-flex align-items-center gap-3" style="min-width: 260px;">
<img class="img-eq" src="{{ optional($r->equipment)->getImageUrl() ?? asset('images/equipment/placeholder.svg') }}" alt="Equipment" onerror="this.onerror=null;this.src='{{ asset('images/equipment/placeholder.svg') }}';">
                                    <div>
                                        <div class="fw-bold">{{ $r->equipment->name }}</div>
                                        <div class="text-muted small">Qty: <strong>{{ $r->quantity }}</strong></div>
                                        <div class="text-muted small">Requested: {{ optional($r->request_date)->format('M d, Y') }}</div>
                                    </div>
                                </div>

                                <div class="ms-lg-auto d-flex flex-column flex-sm-row align-items-start align-items-sm-center gap-2">
                                    <x-borrow-status-badge :status="$r->status" />
                                    <div class="text-muted small">
                                        @if($r->status === 'ready_to_claim')
                                            Claim in lab when instructed by staff.
                                        @elseif($r->status === 'claimed')
                                            Claimed at: {{ optional($r->claimed_at)->format('M d, Y H:i') }}
                                        @elseif($r->status === 'returned')
                                            Returned at: {{ optional($r->returned_at)->format('M d, Y H:i') }}
                                        @elseif($r->status === 'rejected')
                                            Your request was rejected.
                                        @endif
                                    </div>
                                </div>

                                @if(!empty($r->remarks))
                                    <div class="w-100">
                                        <div class="text-muted small mb-0">Staff remarks: <span class="fw-semibold text-dark">{{ $r->remarks }}</span></div>
                                    </div>
                                @endif

                                @if($r->status === 'claimed')
                                    <div class="w-100">
                                        <form method="POST" action="{{ route('borrowings.request-return', ['request_id' => $r->id]) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary btn-sm rounded-pill mt-3">Request Return</button>
                                        </form>
                                    </div>
                                @elseif($r->status === 'return_requested')
                                    <div class="w-100">
                                        <span class="badge bg-info text-white">Return requested</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="card-soft p-4">
                                <div class="d-flex gap-3 align-items-start">
                                    <div class="fs-3 text-primary"><i class="bi bi-inbox"></i></div>
                                    <div>
                                        <h5 class="mb-1">No borrow requests yet</h5>
                                        <p class="text-muted mb-0">Browse equipment and submit a request to see it here.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

