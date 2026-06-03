<?php $__env->startSection('title', 'Return Management - Staff'); ?>

<?php $__env->startSection('content'); ?>
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
                            <div class="stat-value"><?php echo e($pendingReturns); ?></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="stat-card">
                            <div class="stat-label">Completed Today</div>
                            <div class="stat-value"><?php echo e($completedToday); ?></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="stat-card">
                            <div class="stat-label">Damaged Items</div>
                            <div class="stat-value text-warning"><?php echo e($damagedItems); ?></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="stat-card">
                            <div class="stat-label">Overdue Borrowings</div>
                            <div class="stat-value text-danger"><?php echo e($overdueItems); ?></div>
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
                            <input type="search" name="q" class="form-control" placeholder="Search by student or equipment..." value="<?php echo e(request('q')); ?>">
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label small text-muted">Condition</label>
                            <select name="condition" class="form-select">
                                <option value="">All conditions</option>
                                <option value="good" <?php echo e(request('condition') === 'good' ? 'selected' : ''); ?>>Good</option>
                                <option value="minor_damage" <?php echo e(request('condition') === 'minor_damage' ? 'selected' : ''); ?>>Minor Damage</option>
                                <option value="major_damage" <?php echo e(request('condition') === 'major_damage' ? 'selected' : ''); ?>>Major Damage</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-primary rounded-pill w-100">Filter</button>
                        </div>
                    </form>

                    <?php if(session('success')): ?>
                        <div class="alert alert-success rounded-4 mb-3"><?php echo e(session('success')); ?></div>
                    <?php endif; ?>
                    <?php if(session('error')): ?>
                        <div class="alert alert-danger rounded-4 mb-3"><?php echo e(session('error')); ?></div>
                    <?php endif; ?>

                    <?php if($returnRequests->count() === 0): ?>
                        <div class="alert alert-info rounded-4 mb-0">No pending returns.</div>
                    <?php endif; ?>

                    <div class="row g-3">
                        <?php $__currentLoopData = $returnRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $return): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-12">
                                <div class="req-row d-flex flex-column flex-lg-row align-items-start align-items-lg-center gap-3">
                                    <div class="d-flex align-items-center gap-3" style="min-width: 280px;">
                                        <img class="img-eq" src="<?php echo e($return->equipment->image_url ?? 'https://via.placeholder.com/128?text=EQ'); ?>" alt="Equipment">
                                        <div>
                                            <div class="fw-bold"><?php echo e($return->student->name); ?></div>
                                            <div class="text-muted small">Equipment: <strong class="text-dark"><?php echo e($return->equipment->name); ?></strong></div>
                                            <div class="text-muted small">Qty: <strong class="text-dark"><?php echo e($return->quantity); ?></strong></div>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center gap-2 ms-lg-auto">
                                        <?php if (isset($component)) { $__componentOriginal93987516feedb77453e70083c50dc8df = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal93987516feedb77453e70083c50dc8df = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.borrow-status-badge','data' => ['status' => $return->status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('borrow-status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($return->status)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal93987516feedb77453e70083c50dc8df)): ?>
<?php $attributes = $__attributesOriginal93987516feedb77453e70083c50dc8df; ?>
<?php unset($__attributesOriginal93987516feedb77453e70083c50dc8df); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal93987516feedb77453e70083c50dc8df)): ?>
<?php $component = $__componentOriginal93987516feedb77453e70083c50dc8df; ?>
<?php unset($__componentOriginal93987516feedb77453e70083c50dc8df); ?>
<?php endif; ?>
                                        <div class="text-muted small">
                                            Claimed: <?php echo e(optional($return->claimed_at)->format('M d, Y')); ?><br>
                                            Return Requested: <?php echo e(optional($return->return_requested_at)->format('M d, Y H:i')); ?>

                                        </div>
                                    </div>

                                    <div class="d-flex flex-wrap gap-2">
                                        <button type="button" class="btn btn-info action-btn" data-bs-toggle="modal" data-bs-target="#reviewModal" @click="selectReturn(<?php echo e(json_encode($return)); ?>)">
                                            <i class="fas fa-eye me-1"></i>Review
                                        </button>
                                        <form method="POST" action="<?php echo e(route('staff.approve-return', ['request_id' => $return->id])); ?>" style="display: inline;">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-success action-btn">Approve</button>
                                        </form>
                                        <button type="button" class="btn btn-danger action-btn" data-bs-toggle="modal" data-bs-target="#rejectModal" @click="selectReturn(<?php echo e(json_encode($return)); ?>)">
                                            Reject
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                <?php $__empty_1 = true; $__currentLoopData = $recentReturns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $return): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><small class="fw-600"><?php echo e($return->student->name); ?></small></td>
                                        <td><small><?php echo e($return->equipment->name); ?></small></td>
                                        <td>
                                            <?php if($return->return_condition): ?>
                                                <span class="condition-badge condition-<?php echo e(str_replace('_', '-', $return->return_condition)); ?>">
                                                    <?php echo e(str_replace('_', ' ', $return->return_condition)); ?>

                                                </span>
                                            <?php else: ?>
                                                <small class="text-muted">-</small>
                                            <?php endif; ?>
                                        </td>
                                        <td><small class="text-muted"><?php echo e(optional($return->returned_at)->format('M d, Y H:i')); ?></small></td>
                                        <td>
                                            <?php if (isset($component)) { $__componentOriginal93987516feedb77453e70083c50dc8df = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal93987516feedb77453e70083c50dc8df = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.borrow-status-badge','data' => ['status' => $return->status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('borrow-status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($return->status)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal93987516feedb77453e70083c50dc8df)): ?>
<?php $attributes = $__attributesOriginal93987516feedb77453e70083c50dc8df; ?>
<?php unset($__attributesOriginal93987516feedb77453e70083c50dc8df); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal93987516feedb77453e70083c50dc8df)): ?>
<?php $component = $__componentOriginal93987516feedb77453e70083c50dc8df; ?>
<?php unset($__componentOriginal93987516feedb77453e70083c50dc8df); ?>
<?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">No recent returns</td>
                                    </tr>
                                <?php endif; ?>
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

                    <?php if($return->remarks ?? false): ?>
                        <div class="p-4 rounded-4 border border-1 border-warning border-opacity-15 bg-warning bg-opacity-5 mb-4">
                            <h6 class="fw-bold mb-2">Student Notes</h6>
                            <p class="mb-0" id="reviewNotes">-</p>
                        </div>
                    <?php endif; ?>

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
                        <?php echo csrf_field(); ?>
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
        document.getElementById('rejectForm').action = '<?php echo e(url("/borrowings/staff/reject-return")); ?>/' + returnData.id;
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\MINISYSTEM-G-11-BSIT2-2\resources\views/staff/return-management.blade.php ENDPATH**/ ?>