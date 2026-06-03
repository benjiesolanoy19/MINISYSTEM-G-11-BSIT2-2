<?php $__env->startSection('title', 'Admin - Equipment'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Admin - Equipment</h1>
            <div class="text-muted">Edit or delete equipment. Borrowing is handled in the Borrow Equipment page only.</div>
        </div>

        <div>
            <a href="<?php echo e(route('equipment.create')); ?>" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add Equipment
            </a>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

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
                <?php $__empty_1 = true; $__currentLoopData = $equipment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($e->id); ?></td>
                        <td><?php echo e($e->name); ?></td>
                        <td><?php echo e($e->description); ?></td>
                        <td><?php echo e($e->total_quantity ?? $e->quantity ?? '-'); ?></td>
                        <td><?php echo e($e->available_quantity); ?></td>
                        <td class="text-end">
                            <a href="<?php echo e(route('equipment.edit', $e->id)); ?>" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-edit me-1"></i>Edit
                            </a>

                            <form action="<?php echo e(route('equipment.destroy', $e->id)); ?>" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this equipment?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-outline-danger btn-sm ms-2">
                                    <i class="fas fa-trash me-1"></i>Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">No equipment found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\MINISYSTEM-G-11-BSIT2-2\resources\views/admin/equipment/index.blade.php ENDPATH**/ ?>