

<?php $__env->startSection('title', 'Fees'); ?>
<?php $__env->startSection('page-title', 'Fee Management Module'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-credit-card-fill"></i> Fee Records</span>
        <div>
            <a href="<?php echo e(route('fees.create')); ?>" class="btn btn-primary btn-sm me-2">
                <i class="bi bi-plus-circle"></i> Add Fee
            </a>
            <a href="<?php echo e(route('fees.report')); ?>" class="btn btn-info btn-sm">
                <i class="bi bi-bar-chart"></i> View Report
            </a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Fee Amount</th>
                    <th>Paid Amount</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Collection %</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $fees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($fee->student->full_name); ?></td>
                    <td>Rs. <?php echo e(number_format($fee->fee_amount, 0)); ?></td>
                    <td>Rs. <?php echo e(number_format($fee->paid_amount, 0)); ?></td>
                    <td><?php echo e($fee->due_date->format('d M Y')); ?></td>
                    <td>
                        <?php if($fee->payment_status === 'Paid'): ?>
                            <span class="badge badge-success"><?php echo e($fee->payment_status); ?></span>
                        <?php elseif($fee->payment_status === 'Partial'): ?>
                            <span class="badge badge-warning"><?php echo e($fee->payment_status); ?></span>
                        <?php else: ?>
                            <span class="badge badge-danger"><?php echo e($fee->payment_status); ?></span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar" role="progressbar" 
                                style="width: <?php echo e($fee->payment_percentage); ?>%">
                                <?php echo e(round($fee->payment_percentage, 1)); ?>%
                            </div>
                        </div>
                    </td>
                    <td>
                        <a href="<?php echo e(route('fees.show', $fee)); ?>" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                        <a href="<?php echo e(route('fees.edit', $fee)); ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="<?php echo e(route('fees.destroy', $fee)); ?>" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">No fee records found</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    <?php echo e($fees->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\SMS\resources\views/fees/index.blade.php ENDPATH**/ ?>