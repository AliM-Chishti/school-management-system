

<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('page-title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-4">
    <div class="col-md-3">
        <div class="stat-card students">
            <div class="stat-label">
                <i class="bi bi-people-fill"></i> Total Students
            </div>
            <div class="stat-value"><?php echo e($totalStudents); ?></div>
            <small class="text-muted"><?php echo e($activeStudents); ?> Active</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card teachers">
            <div class="stat-label">
                <i class="bi bi-person-workspace"></i> Total Teachers
            </div>
            <div class="stat-value"><?php echo e($totalTeachers); ?></div>
            <small class="text-muted"><?php echo e($activeTeachers); ?> Active</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card courses">
            <div class="stat-label">
                <i class="bi bi-book-fill"></i> Total Courses
            </div>
            <div class="stat-value"><?php echo e($totalCourses); ?></div>
            <small class="text-muted"><?php echo e($activeCourses); ?> Active</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card fees">
            <div class="stat-label">
                <i class="bi bi-credit-card-fill"></i> Total Fees
            </div>
            <div class="stat-value">Rs. <?php echo e(number_format($totalFees, 0)); ?></div>
            <small class="text-muted">Pending: Rs. <?php echo e(number_format($totalPending, 0)); ?></small>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-bar-chart-fill"></i> Payment Status
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Count</th>
                            <th>Amount</th>
                            <th>Percentage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $feeStats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <?php if($stat->payment_status === 'Paid'): ?>
                                    <span class="badge badge-success"><?php echo e($stat->payment_status); ?></span>
                                <?php elseif($stat->payment_status === 'Partial'): ?>
                                    <span class="badge badge-warning"><?php echo e($stat->payment_status); ?></span>
                                <?php else: ?>
                                    <span class="badge badge-danger"><?php echo e($stat->payment_status); ?></span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($stat->total); ?></td>
                            <td>Rs. <?php echo e(number_format($stat->total_amount, 0)); ?></td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" 
                                        style="width: <?php echo e(($stat->total_amount / $totalFees) * 100); ?>%">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-graph-up-arrow"></i> Financial Summary
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-4">
                        <h5>Total Fees</h5>
                        <h3 class="text-primary">Rs. <?php echo e(number_format($totalFees, 0)); ?></h3>
                    </div>
                    <div class="col-md-4">
                        <h5>Paid Amount</h5>
                        <h3 class="text-success">Rs. <?php echo e(number_format($totalPaid, 0)); ?></h3>
                    </div>
                    <div class="col-md-4">
                        <h5>Pending</h5>
                        <h3 class="text-danger">Rs. <?php echo e(number_format($totalPending, 0)); ?></h3>
                    </div>
                </div>
                <div class="mt-3">
                    <h6>Collection Rate</h6>
                    <div class="progress" style="height: 25px;">
                        <div class="progress-bar bg-success" role="progressbar" 
                            style="width: <?php echo e($totalFees > 0 ? ($totalPaid / $totalFees) * 100 : 0); ?>%">
                            <?php echo e($totalFees > 0 ? round(($totalPaid / $totalFees) * 100, 1) : 0); ?>%
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-person-plus-fill"></i> Recent Students
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $recentStudents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($student->full_name); ?></td>
                            <td><?php echo e($student->email); ?></td>
                            <td>
                                <?php if($student->admission_status === 'Active'): ?>
                                    <span class="badge badge-success"><?php echo e($student->admission_status); ?></span>
                                <?php else: ?>
                                    <span class="badge badge-danger"><?php echo e($student->admission_status); ?></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo e(route('students.show', $student)); ?>" class="btn btn-sm btn-primary">View</a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted">No students yet</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-cash-coin"></i> Recent Fee Transactions
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $recentFees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($fee->student->full_name); ?></td>
                            <td>Rs. <?php echo e(number_format($fee->fee_amount, 0)); ?></td>
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
                                <a href="<?php echo e(route('fees.show', $fee)); ?>" class="btn btn-sm btn-primary">View</a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted">No fee records yet</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\school_management_system\resources\views/dashboard.blade.php ENDPATH**/ ?>