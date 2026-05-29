

<?php $__env->startSection('title', 'Return Equipment'); ?>

<?php $__env->startSection('content'); ?>
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

    .action-btn {
        border-radius: 16px;
        font-weight: 800;
        padding: .65rem 1rem;
        transition: transform .16s ease, box-shadow .16s ease, filter .16s ease;
    }
    .action-btn:hover { 
        transform: translateY(-1px); 
        filter: brightness(1.05); 
        box-shadow: 0 18px 35px rgba(0,0,0,.10); 
    }

    .condition-badge {
        display: inline-block;
        padding: 0.4rem 0.85rem;
        border-radius: 999px;
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    .condition-good { background: #dcfce7; color: #166534; }
    .condition-damaged { background: #fee2e2; color: #991b1b; }
</style>

<div class="container-fluid borrow-page">
    <div class="row gy-4">
        <div class="col-12">
            <div class="borrow-panel p-4">
                <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
                    <div>
                        <h1 class="fw-bold mb-1" style="letter-spacing:-0.03em; font-size:2rem;">Return Equipment</h1>
                        <p class="text-muted mb-0">Manage your borrowed equipment and submit returns for staff verification.</p>
                    </div>
                </div>

                <div class="mt-4">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success rounded-4 mb-3"><?php echo e(session('success')); ?></div>
                    <?php endif; ?>
                    <?php if(session('error')): ?>
                        <div class="alert alert-danger rounded-4 mb-3"><?php echo e(session('error')); ?></div>
                    <?php endif; ?>
                </div>

                <div class="row mt-4 g-4">
                    <div class="col-lg-8">
                        <div class="card-soft p-4">
                            <h5 class="fw-bold mb-4">Currently Borrowed Equipment</h5>
                            <div class="row g-3">
                                <?php $__empty_1 = true; $__currentLoopData = $borrowedItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $borrowing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="col-12">
                                        <div class="req-row d-flex flex-column flex-lg-row align-items-start align-items-lg-center gap-3">
                                            <div class="d-flex align-items-center gap-3" style="min-width: 260px;">
                                                <img class="img-eq" src="<?php echo e($borrowing->equipment->image_url ?? 'https://via.placeholder.com/128?text=EQ'); ?>" alt="Equipment">
                                                <div>
                                                    <div class="fw-bold"><?php echo e($borrowing->equipment->name); ?></div>
                                                    <div class="text-muted small">Qty: <strong><?php echo e($borrowing->quantity); ?></strong></div>
                                                    <div class="text-muted small">Claimed: <?php echo e(optional($borrowing->claimed_at)->format('M d, Y')); ?></div>
                                                    <div class="text-muted small">Due: <?php echo e(optional($borrowing->return_date)->format('M d, Y')); ?></div>
                                                </div>
                                            </div>

                                            <div class="ms-lg-auto d-flex flex-column align-items-start align-items-sm-center gap-2">
                                                <?php if (isset($component)) { $__componentOriginal93987516feedb77453e70083c50dc8df = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal93987516feedb77453e70083c50dc8df = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.borrow-status-badge','data' => ['status' => $borrowing->status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('borrow-status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($borrowing->status)]); ?>
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
                                                <?php if(now()->toDateString() > $borrowing->return_date->toDateString()): ?>
                                                    <div class="text-danger small fw-semibold">
                                                        <i class="fas fa-exclamation-circle me-1"></i>Overdue
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="d-flex gap-2">
                                                <button type="button" class="btn btn-primary action-btn" data-bs-toggle="modal" data-bs-target="#returnModal" @click="selectBorrowing(<?php echo e(json_encode($borrowing)); ?>)">
                                                    Request Return
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="col-12">
                                        <div class="card-soft p-4">
                                            <div class="d-flex gap-3 align-items-start">
                                                <div class="fs-3 text-success"><i class="bi bi-check-circle"></i></div>
                                                <div>
                                                    <h5 class="mb-1">No active borrowings</h5>
                                                    <p class="text-muted mb-0">All your equipment has been returned or you have no active borrowings.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card-soft p-4">
                            <h5 class="fw-bold mb-3">Return Status Overview</h5>
                            <div class="list-unstyled">
                                <div class="mb-3 pb-3 border-bottom">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="small text-muted">Borrowed</span>
                                        <span class="badge bg-primary"><?php echo e($activeBorrowings); ?></span>
                                    </div>
                                    <small class="text-muted">Currently in your possession</small>
                                </div>
                                <div class="mb-3 pb-3 border-bottom">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="small text-muted">Pending Return</span>
                                        <span class="badge bg-warning"><?php echo e($pendingReturns); ?></span>
                                    </div>
                                    <small class="text-muted">Awaiting staff verification</small>
                                </div>
                                <div class="mb-3 pb-3 border-bottom">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="small text-muted">Returned</span>
                                        <span class="badge bg-success"><?php echo e($completedReturns); ?></span>
                                    </div>
                                    <small class="text-muted">Successfully completed</small>
                                </div>
                                <div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="small text-muted">Overdue</span>
                                        <span class="badge bg-danger"><?php echo e($overdueItems); ?></span>
                                    </div>
                                    <small class="text-muted">Past the return date</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4 g-4">
                    <div class="col-12">
                        <div class="card-soft p-4">
                            <h5 class="fw-bold mb-4">Return History</h5>
                            <div class="table-responsive">
                                <table class="table table-hover table-borderless">
                                    <thead>
                                        <tr>
                                            <th class="text-muted small">Equipment</th>
                                            <th class="text-muted small">Borrowed</th>
                                            <th class="text-muted small">Returned</th>
                                            <th class="text-muted small">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $returnHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><small class="fw-600"><?php echo e($history->equipment->name); ?></small></td>
                                                <td><small class="text-muted"><?php echo e(optional($history->claimed_at)->format('M d, Y')); ?></small></td>
                                                <td><small class="text-muted"><?php echo e(optional($history->returned_at)->format('M d, Y')); ?></small></td>
                                                <td>
                                                    <?php if (isset($component)) { $__componentOriginal93987516feedb77453e70083c50dc8df = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal93987516feedb77453e70083c50dc8df = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.borrow-status-badge','data' => ['status' => $history->status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('borrow-status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($history->status)]); ?>
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
                                                <td colspan="4" class="text-center text-muted py-4">No return history yet</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Return Confirmation Modal -->
    <div class="modal fade" id="returnModal" tabindex="-1" aria-labelledby="returnModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 28px;">
                <div class="modal-header border-0 pb-0">
                    <div>
                        <h5 class="modal-title fw-bold" id="returnModalLabel">Return Equipment</h5>
                        <p class="text-muted mb-0">Confirm the return details for staff verification.</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <form method="POST" action="<?php echo e(route('borrowings.submit-return')); ?>" id="returnForm">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="request_id" id="modalRequestId">

                        <div class="p-4 rounded-4 border border-1 border-success border-opacity-15 bg-success bg-opacity-5 mb-4">
                            <h6 class="fw-bold mb-2">Equipment Details</h6>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Item:</span>
                                <strong id="modalEquipmentName">-</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Quantity:</span>
                                <strong id="modalQuantity">-</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-0">
                                <span class="text-muted">Claimed Date:</span>
                                <strong id="modalClaimedDate">-</strong>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Equipment Condition</label>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="condition" id="conditionGood" value="good" checked required>
                                <label class="form-check-label" for="conditionGood">
                                    Good - No damage or issues
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="condition" id="conditionMinor" value="minor_damage" required>
                                <label class="form-check-label" for="conditionMinor">
                                    Minor Damage - Small scratches or wear
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="condition" id="conditionMajor" value="major_damage" required>
                                <label class="form-check-label" for="conditionMajor">
                                    Major Damage - Significant damage or malfunction
                                </label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Return Notes (Optional)</label>
                            <textarea class="form-control" name="return_notes" rows="3" placeholder="Add any notes about the equipment condition or return..."></textarea>
                        </div>

                        <div class="d-flex gap-2 justify-content-end">
                            <button type="button" class="btn btn-outline-secondary btn-lg rounded-pill" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success btn-lg rounded-pill">
                                <i class="fas fa-check me-2"></i>Confirm Return
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function selectBorrowing(borrowing) {
        document.getElementById('modalRequestId').value = borrowing.id;
        document.getElementById('modalEquipmentName').textContent = borrowing.equipment.name;
        document.getElementById('modalQuantity').textContent = borrowing.quantity;
        document.getElementById('modalClaimedDate').textContent = new Date(borrowing.claimed_at).toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        });
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\CLMFS_GROUP11 - Copy (2)\resources\views/borrowings/return-equipment.blade.php ENDPATH**/ ?>