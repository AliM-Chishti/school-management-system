

<?php $__env->startSection('title', 'Teachers'); ?>
<?php $__env->startSection('page-title', 'Teacher Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-4">
            <div>
                <h2 class="h5 mb-1">Teacher management</h2>
                <p class="text-muted mb-0">Manage your instructor roster with quick search, filters, and modern action controls.</p>
            </div>
            <a href="<?php echo e(route('teachers.create')); ?>" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle me-1"></i> Register teacher
            </a>
        </div>

        <form class="row g-3 align-items-end mb-4" method="GET" action="<?php echo e(route('teachers.index')); ?>">
            <div class="col-md-5">
                <label class="form-label visually-hidden" for="teacherSearch">Search</label>
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                    <input id="teacherSearch" name="search" type="search" value="<?php echo e(request('search')); ?>" class="form-control border-start-0" placeholder="Search by name, email, employee ID" />
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label visually-hidden" for="statusFilter">Status</label>
                <select id="statusFilter" name="status" class="form-select shadow-sm">
                    <option value="">All statuses</option>
                    <option value="Active" <?php if(request('status') === 'Active'): echo 'selected'; endif; ?>>Active</option>
                    <option value="Inactive" <?php if(request('status') === 'Inactive'): echo 'selected'; endif; ?>>Inactive</option>
                    <option value="On Leave" <?php if(request('status') === 'On Leave'): echo 'selected'; endif; ?>>On Leave</option>
                </select>
            </div>
            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-outline-primary btn-sm">Apply filter</button>
                <a href="<?php echo e(route('teachers.index')); ?>" class="btn btn-outline-secondary btn-sm">Reset</a>
            </div>
        </form>

        <div class="row g-3 mb-3">
            <div class="col-sm-4">
                <div class="p-3 rounded-4 border bg-white shadow-sm">
                    <div class="text-muted text-uppercase fw-semibold small mb-2">Total teachers</div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="fs-3 fw-bold"><?php echo e($teachers->total()); ?></div>
                        <div class="badge bg-primary-subtle text-primary">Page <?php echo e($teachers->currentPage()); ?></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="p-3 rounded-4 border bg-white shadow-sm">
                    <div class="text-muted text-uppercase fw-semibold small mb-2">Showing</div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div><?php echo e($teachers->count()); ?> records</div>
                        <div class="text-muted small"><?php echo e($teachers->firstItem() ?? 0); ?> - <?php echo e($teachers->lastItem() ?? 0); ?></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="p-3 rounded-4 border bg-white shadow-sm">
                    <div class="text-muted text-uppercase fw-semibold small mb-2">Current filter</div>
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <span class="badge bg-info-subtle text-info"><?php echo e(request('status') ?: 'All teachers'); ?></span>
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
                    <th>Employee</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Qualification</th>
                    <th>Status</th>
                    <th>Courses</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><strong><?php echo e($teacher->employee_id); ?></strong></td>
                        <td>
                            <div class="fw-semibold"><?php echo e($teacher->full_name); ?></div>
                            <div class="text-muted small"><?php echo e($teacher->gender); ?> · <?php echo e($teacher->date_of_birth->format('d M Y')); ?></div>
                        </td>
                        <td><?php echo e($teacher->email); ?></td>
                        <td><?php echo e($teacher->qualification); ?></td>
                        <td>
                            <?php
                                $status = $teacher->status;
                                $statusClasses = [
                                    'Active' => 'bg-success-subtle text-success',
                                    'Inactive' => 'bg-secondary-subtle text-secondary',
                                    'On Leave' => 'bg-warning-subtle text-warning',
                                ];
                            ?>
                            <span class="badge <?php echo e($statusClasses[$status] ?? 'bg-danger-subtle text-danger'); ?>"><?php echo e($status); ?></span>
                        </td>
                        <td><span class="badge bg-info-subtle text-info"><?php echo e($teacher->courses_count); ?></span></td>
                        <td class="text-end">
                            <a href="<?php echo e(route('teachers.show', $teacher)); ?>" class="btn btn-sm btn-outline-info" title="View">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="<?php echo e(route('teachers.edit', $teacher)); ?>" class="btn btn-sm btn-outline-warning" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form method="POST" action="<?php echo e(route('teachers.destroy', $teacher)); ?>" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this teacher?')" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">No teachers found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mt-3">
    <p class="text-muted mb-0">Showing <?php echo e($teachers->count()); ?> of <?php echo e($teachers->total()); ?> teachers</p>
    <?php echo e($teachers->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\SMS\resources\views/teachers/index.blade.php ENDPATH**/ ?>