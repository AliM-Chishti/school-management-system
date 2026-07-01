

<?php $__env->startSection('title', 'Fee Details'); ?>
<?php $__env->startSection('page-title', 'Fee Record - ' . $fee->student->full_name); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-file-text"></i> Fee Details
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <td><strong>Student Name:</strong></td>
                        <td><?php echo e($fee->student->full_name); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Enrollment No:</strong></td>
                        <td><?php echo e($fee->student->enrollment_no); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td><?php echo e($fee->student->email); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Fee Amount:</strong></td>
                        <td><span class="h5">Rs. <?php echo e(number_format($fee->fee_amount, 2)); ?></span></td>
                    </tr>
                    <tr>
                        <td><strong>Due Date:</strong></td>
                        <td><?php echo e($fee->due_date->format('d M Y')); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Payment Status:</strong></td>
                        <td>
                            <?php if($fee->payment_status === 'Paid'): ?>
                                <span class="badge badge-success"><?php echo e($fee->payment_status); ?></span>
                            <?php elseif($fee->payment_status === 'Partial'): ?>
                                <span class="badge badge-warning"><?php echo e($fee->payment_status); ?></span>
                            <?php else: ?>
                                <span class="badge badge-danger"><?php echo e($fee->payment_status); ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-cash-coin"></i> Payment Information
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <td><strong>Paid Amount:</strong></td>
                        <td><span class="h5 text-success">Rs. <?php echo e(number_format($fee->paid_amount, 2)); ?></span></td>
                    </tr>
                    <tr>
                        <td><strong>Remaining:</strong></td>
                        <td><span class="h5 text-danger">Rs. <?php echo e(number_format($fee->remaining_amount, 2)); ?></span></td>
                    </tr>
                    <tr>
                        <td><strong>Collection %:</strong></td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" 
                                    style="width: <?php echo e($fee->payment_percentage); ?>%">
                                    <?php echo e(round($fee->payment_percentage, 1)); ?>%
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Payment Date:</strong></td>
                        <td><?php echo e($fee->payment_date ? $fee->payment_date->format('d M Y') : 'Not Paid'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Payment Method:</strong></td>
                        <td><?php echo e($fee->payment_method ?? 'N/A'); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<?php if($fee->remaining_amount > 0): ?>
<div class="row mt-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-plus-circle"></i> Record Payment
            </div>
            <div class="card-body">
                <form method="POST" action="<?php echo e(route('fees.record-payment', $fee)); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label class="form-label">Amount to Pay</label>
                        <input type="number" name="paid_amount" step="0.01" class="form-control <?php $__errorArgs = ['paid_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" max="<?php echo e($fee->remaining_amount); ?>" required>
                        <?php $__errorArgs = ['paid_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <small class="text-muted">Maximum: Rs. <?php echo e(number_format($fee->remaining_amount, 2)); ?></small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Payment Date</label>
                        <input type="date" name="payment_date" class="form-control <?php $__errorArgs = ['payment_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        <?php $__errorArgs = ['payment_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Payment Method</label>
                        <select name="payment_method" class="form-select <?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="">Select Method</option>
                            <option value="Cash">Cash</option>
                            <option value="Check">Check</option>
                            <option value="Online">Online Transfer</option>
                            <option value="Card">Credit/Debit Card</option>
                        </select>
                        <?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Remarks</label>
                        <textarea name="remarks" class="form-control" rows="2"></textarea>
                    </div>

                    <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Record Payment</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="mt-3">
    <a href="<?php echo e(route('fees.generate-receipt', $fee)); ?>" class="btn btn-info"><i class="bi bi-file-pdf"></i> Download Receipt</a>
    <a href="<?php echo e(route('fees.edit', $fee)); ?>" class="btn btn-warning"><i class="bi bi-pencil"></i> Edit</a>
    <a href="<?php echo e(route('fees.index')); ?>" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\SMS\resources\views/fees/show.blade.php ENDPATH**/ ?>