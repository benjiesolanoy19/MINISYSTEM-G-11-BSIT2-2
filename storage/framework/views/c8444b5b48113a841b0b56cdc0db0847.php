<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Available Equipment</title>
</head>
<body>
<h1>Available Equipment</h1>

<?php if(session('success')): ?>
    <p style="color: green;"><?php echo e(session('success')); ?></p>
<?php endif; ?>
<?php if(session('error')): ?>
    <p style="color: red;"><?php echo e(session('error')); ?></p>
<?php endif; ?>

<table border="1" cellpadding="6" cellspacing="0">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Available</th>
            <th>Request</th>
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $equipment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($item->name); ?></td>
            <td><?php echo e($item->description); ?></td>
            <td><?php echo e($item->available_quantity); ?></td>
            <td>
                <form method="POST" action="<?php echo e(route('borrow.create')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="equipment_id" value="<?php echo e($item->id); ?>">
                    <label>Qty</label>
                    <input type="number" name="quantity" min="1" max="<?php echo e($item->available_quantity); ?>" value="1" required>
                    <button type="submit">Borrow</button>
                </form>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
</body>
</html>

<?php /**PATH C:\xampp\htdocs\CLMFS_GROUP11 - Copy (2)\resources\views/equipment/index.blade.php ENDPATH**/ ?>