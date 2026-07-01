

<?php $__env->startSection('title', 'Timetable'); ?>
<?php $__env->startSection('page-title', 'Class Schedule Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-calendar-event-fill"></i> Timetable Schedule</span>
        <div>
            <a href="<?php echo e(route('timetable.create')); ?>" class="btn btn-primary btn-sm me-2">
                <i class="bi bi-plus-circle"></i> Add Schedule
            </a>
            <a href="<?php echo e(route('timetable.by-day')); ?>" class="btn btn-info btn-sm me-2">
                <i class="bi bi-calendar-week"></i> View by Day
            </a>
            <a href="<?php echo e(route('timetable.by-teacher')); ?>" class="btn btn-info btn-sm">
                <i class="bi bi-person-workspace"></i> View by Teacher
            </a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Course</th>
                    <th>Teacher</th>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Room</th>
                    <th>Duration</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $timetables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $timetable): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($timetable->course->course_code); ?></td>
                    <td><?php echo e($timetable->teacher->full_name); ?></td>
                    <td><span class="badge badge-info"><?php echo e($timetable->day); ?></span></td>
                    <td><?php echo e($timetable->start_time); ?> - <?php echo e($timetable->end_time); ?></td>
                    <td><?php echo e($timetable->room_no); ?></td>
                    <td><?php echo e($timetable->duration); ?> mins</td>
                    <td>
                        <a href="<?php echo e(route('timetable.show', $timetable)); ?>" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                        <a href="<?php echo e(route('timetable.edit', $timetable)); ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="<?php echo e(route('timetable.destroy', $timetable)); ?>" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">No schedule created yet</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    <?php echo e($timetables->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\SMS\resources\views/timetable/index.blade.php ENDPATH**/ ?>