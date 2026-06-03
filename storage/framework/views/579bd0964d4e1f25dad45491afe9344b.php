<?php
    $status = $status ?? '';
    $statusLower = strtolower($status);

    $class = 'bg-secondary text-white';
    $label = $status;

    switch ($statusLower) {
        case 'pending':
            $class = 'bg-warning text-dark';
            $label = 'Pending';
            break;
        case 'approved':
            $class = 'bg-primary text-white';
            $label = 'Approved';
            break;
        case 'ready_to_claim':
            $class = 'bg-purple text-white';
            $label = 'Ready to Claim';
            break;
        case 'claimed':
            $class = 'bg-success text-white';
            $label = 'Claimed';
            break;
        case 'return_requested':
            $class = 'bg-info text-white';
            $label = 'Return Requested';
            break;
        case 'rejected':
            $class = 'bg-danger text-white';
            $label = 'Rejected';
            break;
        case 'returned':
            $class = 'bg-secondary text-white';
            $label = 'Returned';
            break;
        case 'overdue':
            $class = 'bg-danger text-white';
            $label = 'Overdue';
            break;
    }
?>

<style>
    /* Local helper (won't break existing theme) */
    .bg-purple { background: #7c3aed !important; }

    .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.35rem 0.75rem;
        border-radius: 999px;
        font-weight: 800;
        text-transform: uppercase;
        font-size: 0.72rem;
        letter-spacing: 0.02em;
        transform: translateZ(0);
        transition: transform .18s ease, filter .18s ease, box-shadow .18s ease;
        box-shadow: 0 10px 25px rgba(0,0,0,0.06);
    }
    .status-pill:hover {
        transform: translateY(-1px);
        filter: brightness(1.05);
        box-shadow: 0 16px 35px rgba(0,0,0,0.10);
    }
</style>

<span class="status-pill <?php echo e($class); ?>" title="<?php echo e($label); ?>">
    <?php echo e($label); ?>

</span>

<?php /**PATH C:\xampp\htdocs\MINISYSTEM-G-11-BSIT2-2\resources\views/components/borrow-status-badge.blade.php ENDPATH**/ ?>