

<?php $__env->startSection('title', $equipment->name); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="row g-4">
        <div class="col-12 col-lg-5">
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                <img src="<?php echo e($equipment->getImageUrl()); ?>" class="card-img-top" alt="<?php echo e($equipment->name); ?>" style="object-fit: cover; height: 420px;" onerror="this.onerror=null;this.src='<?php echo e(asset('images/equipment/placeholder.svg')); ?>';" />
                <div class="card-body">
                    <h1 class="h4 mb-3"><?php echo e($equipment->name); ?></h1>
                    <p class="text-muted mb-0"><?php echo e($equipment->category); ?></p>
                    <div class="mt-4">
                        <span class="badge bg-info text-dark me-2"><?php echo e($equipment->status_label); ?></span>
                        <span class="badge bg-secondary"><?php echo e($equipment->condition); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-7">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h2 class="h5 mb-3">Equipment Details</h2>
                <dl class="row">
                    <dt class="col-sm-4 text-muted">Asset Tag</dt>
                    <dd class="col-sm-8"><?php echo e($equipment->asset_tag); ?></dd>

                    <dt class="col-sm-4 text-muted">Brand / Model</dt>
                    <dd class="col-sm-8"><?php echo e($equipment->brand); ?> &mdash; <?php echo e($equipment->model); ?></dd>

                    <dt class="col-sm-4 text-muted">Serial Number</dt>
                    <dd class="col-sm-8"><?php echo e($equipment->serial_number ?? 'N/A'); ?></dd>

                    <dt class="col-sm-4 text-muted">Location</dt>
                    <dd class="col-sm-8"><?php echo e($equipment->location ?? 'Unassigned'); ?></dd>

                    <dt class="col-sm-4 text-muted">Available Quantity</dt>
                    <dd class="col-sm-8"><?php echo e($equipment->available_quantity); ?></dd>

                    <dt class="col-sm-4 text-muted">Total Quantity</dt>
                    <dd class="col-sm-8"><?php echo e($equipment->quantity); ?></dd>

                    <dt class="col-sm-4 text-muted">Purchased</dt>
                    <dd class="col-sm-8"><?php echo e(optional($equipment->purchase_date)->format('M d, Y') ?? 'N/A'); ?></dd>

                    <dt class="col-sm-4 text-muted">Warranty Expiration</dt>
                    <dd class="col-sm-8"><?php echo e(optional($equipment->warranty_expiration)->format('M d, Y') ?? 'N/A'); ?></dd>

                    <dt class="col-sm-4 text-muted">Description</dt>
                    <dd class="col-sm-8"><?php echo e($equipment->description ?? 'No additional description provided.'); ?></dd>
                </dl>

                <div class="mt-4 d-flex flex-column flex-sm-row gap-2">
                    <a href="<?php echo e(route('equipment.index')); ?>" class="btn btn-outline-secondary btn-lg">
                        <i class="fas fa-chevron-left me-2"></i>Back to Inventory
                    </a>
                    <?php if(auth()->check() && auth()->user()->role === 'student' && $equipment->status === 'available'): ?>
                        <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#borrowModal">
                            <i class="fas fa-hand-holding me-2"></i>Borrow Item
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modals'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('modals'); ?>
    <div class="modal fade" id="borrowModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4">
                <div class="modal-header">
                    <h5 class="modal-title">Request to Borrow</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
<form method="POST" action="<?php echo e(route('equipment.borrow', request()->route('id'))); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <p>You're requesting to borrow <strong><?php echo e($equipment->name); ?></strong>.</p>
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
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\MINISYSTEM-G-11-BSIT2-2\resources\views/equipment/show.blade.php ENDPATH**/ ?>