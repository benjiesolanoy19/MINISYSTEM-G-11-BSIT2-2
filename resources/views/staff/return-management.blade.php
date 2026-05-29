@extends('layouts.dashboard')

@section('title', 'Return Management - Staff')

@section('content')
<style>
    .management-page { min-height: calc(100vh - 4.5rem); padding: 2rem 0; }
    .management-panel {
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
    
    .condition-badge {
        padding: 0.35rem 0.75rem;
        border-radius: 999px;
        font-size: 0.72rem;
        font-weight: 800;
        text-transform: uppercase;
    }
    .condition-good { background: #dcfce7; color: #166534; }
    .condition-minor { background: #fef3c7; color: #92400e; }
    .condition-major { background: #fee2e2; color: #991b1b; }

    .stat-card {
        border-radius: 18px;
        background: #ffffff;
        padding: 1rem;
        border: 1px solid rgba(226, 232, 240, 0.9);
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.04);
    }
    .stat-card .stat-label { font-size: 0.75rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 0.5rem; }
    .stat-card .stat-value { font-size: 1.8rem; font-weight: 700; color: #0f172a; }
</style>

<div class="container-fluid management-page">
    <div class="row gy-4">
        <div class="col-12">
            <div class="management-panel p-4">
                <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
                    <div>
                        <h1 class="fw-bold mb-1" style="letter-spacing:-0.03em; font-size:2rem;">Return Management</h1>
                        <p class="text-muted mb-0">Review and verify returned equipment, approve returns, and update inventory.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="management-panel p-4">
                <div class="row g-3 mb-4">
                    <div class="col-sm-6 col-lg-3">
                        <div class="stat-card">
                            <div class="stat-label">Pending Returns</div>
                            <div class="stat-value">{{ $pendingReturns }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="stat-card">
                            <div class="stat-label">Completed Today</div>
                            <div class="stat-value">{{ $completedToday }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="stat-card">
                            <div class="stat-label">Damaged Items</div>
                            <div class="stat-value text-warning">{{ $damagedItems }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="stat-card">
                            <div class="stat-label">Overdue Borrowings</div>
                            <div class="stat-value text-danger">{{ $overdueItems }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="management-panel p-4">
                <div>
                    <h4 class="fw-semibold mb-1">Pending Return Requests</h4>
                    <p class="text-muted mb-0">Items awaiting staff verification.</p>
                </div>

                <div class="mt-4">
                    <form method="GET" class="row g-3 align-items-end mb-4">
                        <div class="col-sm-6">
                            <label class="form-label small text-muted">Search</label>
                            <input type="search" name="q" class="form-control" placeholder="Search by student or equipment..." value="{{ request('q') }}">
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label small text-muted">Condition</label>
                            <select name="condition" class="form-select">
                                <option value="">All conditions</option>
                                <option value="good" {{ request('condition') === 'good' ? 'selected' : '' }}>Good</option>
                                <option value="minor_damage" {{ request('condition') === 'minor_damage' ? 'selected' : '' }}>Minor Damage</option>
                                <option value="major_damage" {{ request('condition') === 'major_damage' ? 'selected' : '' }}>Major Damage</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-primary rounded-pill w-100">Filter</button>
                        </div>
                    </form>

                    @if (session('success'))
                        <div class="alert alert-success rounded-4 mb-3">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger rounded-4 mb-3">{{ session('error') }}</div>
                    @endif

                    @if($returnRequests->count() === 0)
                        <div class="alert alert-info rounded-4 mb-0">No pending returns.</div>
                    @endif

                    <div class="row g-3">
                        @foreach($returnRequests as $return)
                            <div class="col-12">
                                <div class="req-row d-flex flex-column flex-lg-row align-items-start align-items-lg-center gap-3">
                                    <div class="d-flex align-items-center gap-3" style="min-width: 280px;">
                                        <img class="img-eq" src="{{ $return->equipment->image_url ?? 'https://via.placeholder.com/128?text=EQ' }}" alt="Equipment">
                                        <div>
                                            <div class="fw-bold">{{ $return->student->name }}</div>
                                            <div class="text-muted small">Equipment: <strong class="text-dark">{{ $return->equipment->name }}</strong></div>
                                            <div class="text-muted small">Qty: <strong class="text-dark">{{ $return->quantity }}</strong></div>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center gap-2 ms-lg-auto">
                                        <x-borrow-status-badge :status="$return->status" />
                                        <div class="text-muted small">
                                            Claimed: {{ optional($return->claimed_at)->format('M d, Y') }}<br>
                                            Return Requested: {{ optional($return->return_requested_at)->format('M d, Y H:i') }}
                                        </div>
                                    </div>

                                    <div class="d-flex flex-wrap gap-2">
                                        <button type="button" class="btn btn-info action-btn" data-bs-toggle="modal" data-bs-target="#reviewModal" @click="selectReturn({{ json_encode($return) }})">
                                            <i class="fas fa-eye me-1"></i>Review
                                        </button>
                                        <form method="POST" action="{{ route('staff.approve-return', ['request_id' => $return->id]) }}" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success action-btn">Approve</button>
                                        </form>
                                        <button type="button" class="btn btn-danger action-btn" data-bs-toggle="modal" data-bs-target="#rejectModal" @click="selectReturn({{ json_encode($return) }})">
                                            Reject
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="management-panel p-4">
                <div>
                    <h4 class="fw-semibold mb-1">Recent Returns</h4>
                    <p class="text-muted mb-0">Recently completed equipment returns.</p>
                </div>

                <div class="mt-4">
                    <div class="table-responsive">
                        <table class="table table-hover table-borderless">
                            <thead>
                                <tr>
                                    <th class="text-muted small">Student</th>
                                    <th class="text-muted small">Equipment</th>
                                    <th class="text-muted small">Condition</th>
                                    <th class="text-muted small">Returned Date</th>
                                    <th class="text-muted small">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentReturns as $return)
                                    <tr>
                                        <td><small class="fw-600">{{ $return->student->name }}</small></td>
                                        <td><small>{{ $return->equipment->name }}</small></td>
                                        <td>
                                            @if($return->return_condition)
                                                <span class="condition-badge condition-{{ str_replace('_', '-', $return->return_condition) }}">
                                                    {{ str_replace('_', ' ', $return->return_condition) }}
                                                </span>
                                            @else
                                                <small class="text-muted">-</small>
                                            @endif
                                        </td>
                                        <td><small class="text-muted">{{ optional($return->returned_at)->format('M d, Y H:i') }}</small></td>
                                        <td>
                                            <x-borrow-status-badge :status="$return->status" />
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">No recent returns</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Review Return Modal -->
    <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 28px;">
                <div class="modal-header border-0 pb-0">
                    <div>
                        <h5 class="modal-title fw-bold" id="reviewModalLabel">Review Return</h5>
                        <p class="text-muted mb-0">Verify equipment condition and return details.</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <div class="p-4 rounded-4 border border-1 border-info border-opacity-15 bg-info bg-opacity-5 mb-4">
                        <h6 class="fw-bold mb-3">Return Information</h6>
                        <div class="row g-2">
                            <div class="col-sm-6">
                                <small class="text-muted">Student</small>
                                <div class="fw-bold" id="reviewStudent">-</div>
                            </div>
                            <div class="col-sm-6">
                                <small class="text-muted">Equipment</small>
                                <div class="fw-bold" id="reviewEquipment">-</div>
                            </div>
                            <div class="col-sm-6">
                                <small class="text-muted">Quantity</small>
                                <div class="fw-bold" id="reviewQuantity">-</div>
                            </div>
                            <div class="col-sm-6">
                                <small class="text-muted">Return Requested</small>
                                <div class="fw-bold" id="reviewDate">-</div>
                            </div>
                        </div>
                    </div>

                    @if($return->remarks ?? false)
                        <div class="p-4 rounded-4 border border-1 border-warning border-opacity-15 bg-warning bg-opacity-5 mb-4">
                            <h6 class="fw-bold mb-2">Student Notes</h6>
                            <p class="mb-0" id="reviewNotes">-</p>
                        </div>
                    @endif

                    <div class="p-4 rounded-4 border border-1 border-secondary border-opacity-15 bg-secondary bg-opacity-5">
                        <h6 class="fw-bold mb-3">Staff Verification</h6>
                        <div class="mb-3">
                            <label class="form-label">Equipment Condition</label>
                            <div id="reviewCondition" class="fw-semibold"></div>
                        </div>
                        <div>
                            <label class="form-label">Add Remarks</label>
                            <textarea class="form-control" rows="3" placeholder="Add any inspection notes or remarks..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Return Modal -->
    <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 28px;">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="rejectModalLabel">Reject Return</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <form method="POST" action="" id="rejectForm">
                        @csrf
                        <input type="hidden" name="request_id" id="rejectRequestId">

                        <div class="alert alert-warning rounded-3 mb-4">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            The student will be notified and the equipment will remain borrowed.
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Reason for Rejection</label>
                            <textarea class="form-control" name="remarks" rows="4" placeholder="Explain why this return is being rejected..." required></textarea>
                        </div>

                        <div class="d-flex gap-2 justify-content-end">
                            <button type="button" class="btn btn-outline-secondary btn-lg rounded-pill" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger btn-lg rounded-pill">Reject Return</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function selectReturn(returnData) {
        document.getElementById('reviewStudent').textContent = returnData.student.name;
        document.getElementById('reviewEquipment').textContent = returnData.equipment.name;
        document.getElementById('reviewQuantity').textContent = returnData.quantity;
        document.getElementById('reviewDate').textContent = new Date(returnData.return_requested_at).toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'short',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
        
        const conditionText = (returnData.return_condition || 'Not specified').replace(/_/g, ' ');
        document.getElementById('reviewCondition').textContent = conditionText.charAt(0).toUpperCase() + conditionText.slice(1);
        
        document.getElementById('rejectRequestId').value = returnData.id;
        document.getElementById('rejectForm').action = '{{ url("/borrowings/staff/reject-return") }}/' + returnData.id;
    }
</script>
@endsection
