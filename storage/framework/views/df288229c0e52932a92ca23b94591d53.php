

<?php $__env->startSection('title', 'Courses'); ?>
<?php $__env->startSection('page-title', 'Course Allocation Module'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-book-fill"></i> Courses List</span>
        <a href="<?php echo e(route('courses.create')); ?>" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Add Course
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Department</th>
                    <th>Credit Hours</th>
                    <th>Students</th>
                    <th>Teachers</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><strong><?php echo e($course->course_code); ?></strong></td>
                    <td><?php echo e($course->course_name); ?></td>
                    <td><?php echo e($course->department); ?></td>
                    <td><?php echo e($course->credit_hours); ?></td>
                    <td><span class="badge badge-info"><?php echo e($course->students_count); ?></span></td>
                    <td><span class="badge badge-success"><?php echo e($course->teachers_count); ?></span></td>
                    <td>
                        <?php if($course->status === 'Active'): ?>
                            <span class="badge badge-success"><?php echo e($course->status); ?></span>
                        <?php else: ?>
                            <span class="badge badge-danger"><?php echo e($course->status); ?></span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo e(route('courses.show', $course)); ?>" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                        <a href="<?php echo e(route('courses.edit', $course)); ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="<?php echo e(route('courses.destroy', $course)); ?>" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">No courses found</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    <?php echo e($courses->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\SMS\resources\views/courses/index.blade.php ENDPATH**/ ?>