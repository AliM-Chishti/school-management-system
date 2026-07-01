

<?php $__env->startSection('title', 'Students'); ?>
<?php $__env->startSection('page-title', 'Student Admission Module'); ?>

<?php $__env->startSection('content'); ?>
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-4">
            <div>
                <h2 class="h5 mb-1">Student management</h2>
                <p class="text-muted mb-0">Browse and manage admissions with searchable records, status filters, and quick actions.</p>
            </div>
            <a href="<?php echo e(route('students.create')); ?>" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle me-1"></i> Add new student
            </a>
        </div>

        <form class="row g-3 align-items-end mb-4" method="GET" action="<?php echo e(route('students.index')); ?>">
            <div class="col-md-5">
                <label class="form-label visually-hidden" for="studentSearch">Search</label>
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                    <input id="studentSearch" name="search" type="search" value="<?php echo e(request('search')); ?>" class="form-control border-start-0" placeholder="Search by name, email, enrollment no" />
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label visually-hidden" for="statusFilter">Status</label>
                <select id="statusFilter" name="status" class="form-select shadow-sm">
                    <option value="">All statuses</option>
                    <option value="Active" <?php if(request('status') === 'Active'): echo 'selected'; endif; ?>>Active</option>
                    <option value="Inactive" <?php if(request('status') === 'Inactive'): echo 'selected'; endif; ?>>Inactive</option>
                    <option value="Suspended" <?php if(request('status') === 'Suspended'): echo 'selected'; endif; ?>>Suspended</option>
                </select>
            </div>
            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-outline-primary btn-sm">Apply filter</button>
                <a href="<?php echo e(route('students.index')); ?>" class="btn btn-outline-secondary btn-sm">Reset</a>
            </div>
        </form>

        <div class="row g-3 mb-3">
            <div class="col-sm-4">
                <div class="p-3 rounded-4 border bg-white shadow-sm">
                    <div class="text-muted text-uppercase fw-semibold small mb-2">Total students</div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="fs-3 fw-bold"><?php echo e($students->total()); ?></div>
                        <div class="badge bg-primary-subtle text-primary">Page <?php echo e($students->currentPage()); ?></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="p-3 rounded-4 border bg-white shadow-sm">
                    <div class="text-muted text-uppercase fw-semibold small mb-2">Showing</div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div><?php echo e($students->count()); ?> records</div>
                        <div class="text-muted small"><?php echo e($students->firstItem() ?? 0); ?> - <?php echo e($students->lastItem() ?? 0); ?></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="p-3 rounded-4 border bg-white shadow-sm">
                    <div class="text-muted text-uppercase fw-semibold small mb-2">Current filter</div>
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <span class="badge bg-info-subtle text-info"><?php echo e(request('status') ?: 'All students'); ?></span>
                        <?php if(request('search')): ?>
                            <span class="badge bg-secondary-subtle text-secondary">Search: <?php echo e(request('search')); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Enrollment</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Admission</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><strong><?php echo e($student->enrollment_no); ?></strong></td>
                        <td>
                            <div class="fw-semibold"><?php echo e($student->full_name); ?></div>
                            <div class="text-muted small"><?php echo e($student->gender); ?> · <?php echo e($student->date_of_birth->format('d M Y')); ?></div>
                        </td>
                        <td><?php echo e($student->email); ?></td>
                        <td><?php echo e($student->phone); ?></td>
                        <td>
                            <?php
                                $status = $student->admission_status;
                                $statusClasses = [
                                    'Active' => 'bg-success-subtle text-success',
                                    'Inactive' => 'bg-secondary-subtle text-secondary',
                                    'Suspended' => 'bg-warning-subtle text-warning',
                                ];
                            ?>
                            <span class="badge <?php echo e($statusClasses[$status] ?? 'bg-danger-subtle text-danger'); ?>"><?php echo e($status); ?></span>
                        </td>
                        <td><?php echo e($student->admission_date->format('d M Y')); ?></td>
                        <td class="text-end">
                            <a href="<?php echo e(route('students.show', $student)); ?>" class="btn btn-sm btn-outline-info" title="View">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="<?php echo e(route('students.edit', $student)); ?>" class="btn btn-sm btn-outline-warning" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form method="POST" action="<?php echo e(route('students.destroy', $student)); ?>" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this student?')" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">No student records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mt-3">
    <p class="text-muted mb-0">Showing <?php echo e($students->count()); ?> of <?php echo e($students->total()); ?> students</p>
    <?php echo e($students->links()); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\SMS\resources\views/students/index.blade.php ENDPATH**/ ?>