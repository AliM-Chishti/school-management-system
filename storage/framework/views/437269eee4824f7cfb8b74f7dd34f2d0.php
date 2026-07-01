

<?php $__env->startSection('title', 'Fee Report'); ?>
<?php $__env->startSection('page-title', 'Financial Report'); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-4">
    <div class="col-md-3">
        <div class="stat-card fees">
            <div class="stat-label">Total Fees</div>
            <div class="stat-value">Rs. <?php echo e(number_format($totalFees, 0)); ?></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="border-left-color: #10b981;">
            <div class="stat-label">Total Paid</div>
            <div class="stat-value text-success">Rs. <?php echo e(number_format($totalPaid, 0)); ?></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="border-left-color: #f59e0b;">
            <div class="stat-label">Pending Amount</div>
            <div class="stat-value text-warning">Rs. <?php echo e(number_format($totalPending, 0)); ?></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="border-left-color: #3b82f6;">
            <div class="stat-label">Collection Rate</div>
            <div class="stat-value"><?php echo e($totalFees > 0 ? round(($totalPaid / $totalFees) * 100, 1) : 0); ?>%</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <i class="bi bi-bar-chart-fill"></i> Payment Status Summary
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Count</th>
                    <th>Total Amount</th>
                    <th>Percentage</th>
                    <th>Bar</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $paymentStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                        <?php if($status->payment_status === 'Paid'): ?>
                            <span class="badge badge-success"><?php echo e($status->payment_status); ?></span>
                        <?php elseif($status->payment_status === 'Partial'): ?>
                            <span class="badge badge-warning"><?php echo e($status->payment_status); ?></span>
                        <?php else: ?>
                            <span class="badge badge-danger"><?php echo e($status->payment_status); ?></span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($status->total); ?></td>
                    <td><strong>Rs. <?php echo e(number_format($status->total_amount, 0)); ?></strong></td>
                    <td><?php echo e($totalFees > 0 ? round(($status->total_amount / $totalFees) * 100, 1) : 0); ?>%</td>
                    <td>
                        <div class="progress" style="height: 25px;">
                            <div class="progress-bar" role="progressbar" 
                                style="width: <?php echo e($totalFees > 0 ? ($status->total_amount / $totalFees) * 100 : 0); ?>%; 
                                <?php if($status->payment_status === 'Paid'): ?> background-color: #10b981; 
                                <?php elseif($status->payment_status === 'Partial'): ?> background-color: #f59e0b; 
                                <?php else: ?> background-color: #ef4444; <?php endif; ?>">
                            </div>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    <a href="<?php echo e(route('fees.index')); ?>" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\SMS\resources\views/fees/report.blade.php ENDPATH**/ ?>