

<?php $__env->startSection('title', 'Students'); ?>
<?php $__env->startSection('page-title', 'Student Admission Module'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-people-fill"></i> Students List</span>
        <a href="<?php echo e(route('students.create')); ?>" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Add New Student
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Enrollment No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Admission Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><strong><?php echo e($student->enrollment_no); ?></strong></td>
                    <td><?php echo e($student->full_name); ?></td>
                    <td><?php echo e($student->email); ?></td>
                    <td><?php echo e($student->phone); ?></td>
                    <td>
                        <?php if($student->admission_status === 'Active'): ?>
                            <span class="badge badge-success"><?php echo e($student->admission_status); ?></span>
                        <?php elseif($student->admission_status === 'Inactive'): ?>
                            <span class="badge badge-info"><?php echo e($student->admission_status); ?></span>
                        <?php else: ?>
                            <span class="badge badge-danger"><?php echo e($student->admission_status); ?></span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($student->admission_date->format('d M Y')); ?></td>
                    <td>
                        <a href="<?php echo e(route('students.show', $student)); ?>" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                        <a href="<?php echo e(route('students.edit', $student)); ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="<?php echo e(route('students.destroy', $student)); ?>" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">No students found</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    <?php echo e($students->links()); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\school_management_system\resources\views/students/index.blade.php ENDPATH**/ ?>