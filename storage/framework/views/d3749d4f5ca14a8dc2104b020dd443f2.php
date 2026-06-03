<?php $__env->startSection('title', 'My Borrow Requests'); ?>

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
                    <?php if(session('success')): ?>
                        <div class="alert alert-success rounded-4"><?php echo e(session('success')); ?></div>
                    <?php endif; ?>
                    <?php if(session('error')): ?>
                        <div class="alert alert-danger rounded-4"><?php echo e(session('error')); ?></div>
                    <?php endif; ?>
                </div>

                <div class="row mt-3 g-3">
                    <?php $__empty_1 = true; $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-12">
                            <div class="req-row d-flex flex-column flex-lg-row align-items-start align-items-lg-center gap-3">
                                <div class="d-flex align-items-center gap-3" style="min-width: 260px;">
<img class="img-eq" src="<?php echo e(optional($r->equipment)->getImageUrl() ?? asset('images/equipment/placeholder.svg')); ?>" alt="Equipment" onerror="this.onerror=null;this.src='<?php echo e(asset('images/equipment/placeholder.svg')); ?>';">
                                    <div>
                                        <div class="fw-bold"><?php echo e($r->equipment->name); ?></div>
                                        <div class="text-muted small">Qty: <strong><?php echo e($r->quantity); ?></strong></div>
                                        <div class="text-muted small">Requested: <?php echo e(optional($r->request_date)->format('M d, Y')); ?></div>
                                    </div>
                                </div>

                                <div class="ms-lg-auto d-flex flex-column flex-sm-row align-items-start align-items-sm-center gap-2">
                                    <?php if (isset($component)) { $__componentOriginal93987516feedb77453e70083c50dc8df = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal93987516feedb77453e70083c50dc8df = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.borrow-status-badge','data' => ['status' => $r->status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('borrow-status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($r->status)]); ?>
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
                                        <?php if($r->status === 'ready_to_claim'): ?>
                                            Claim in lab when instructed by staff.
                                        <?php elseif($r->status === 'claimed'): ?>
                                            Claimed at: <?php echo e(optional($r->claimed_at)->format('M d, Y H:i')); ?>

                                        <?php elseif($r->status === 'returned'): ?>
                                            Returned at: <?php echo e(optional($r->returned_at)->format('M d, Y H:i')); ?>

                                        <?php elseif($r->status === 'rejected'): ?>
                                            Your request was rejected.
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <?php if(!empty($r->remarks)): ?>
                                    <div class="w-100">
                                        <div class="text-muted small mb-0">Staff remarks: <span class="fw-semibold text-dark"><?php echo e($r->remarks); ?></span></div>
                                    </div>
                                <?php endif; ?>

                                <?php if($r->status === 'claimed'): ?>
                                    <div class="w-100">
                                        <form method="POST" action="<?php echo e(route('borrowings.request-return', ['request_id' => $r->id])); ?>">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-outline-primary btn-sm rounded-pill mt-3">Request Return</button>
                                        </form>
                                    </div>
                                <?php elseif($r->status === 'return_requested'): ?>
                                    <div class="w-100">
                                        <span class="badge bg-info text-white">Return requested</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
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
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\MINISYSTEM-G-11-BSIT2-2\resources\views/borrowings/my-borrow-requests.blade.php ENDPATH**/ ?>