<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title'); ?> - School Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #1e40af;
            --secondary-color: #0f172a;
            --accent-color: #3b82f6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
        }

        /* Sidebar */
        .sidebar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            min-height: 100vh;
            padding: 2rem 0;
            position: fixed;
            width: 260px;
            left: 0;
            top: 0;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .sidebar .logo {
            text-align: center;
            margin-bottom: 2rem;
            color: white;
        }

        .sidebar .logo h3 {
            font-weight: 700;
            font-size: 1.5rem;
        }

        .sidebar .logo small {
            display: block;
            color: rgba(255, 255, 255, 0.7);
            margin-top: 0.5rem;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0 1rem;
        }

        .sidebar-menu li {
            margin-bottom: 0.5rem;
        }

        .sidebar-menu a {
            display: block;
            padding: 0.75rem 1rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            border-radius: 0.375rem;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background-color: var(--accent-color);
            color: white;
            padding-left: 1.5rem;
        }

        /* Main Content */
        .main-wrapper {
            margin-left: 260px;
        }

        .topbar {
            background: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .topbar h2 {
            margin: 0;
            color: var(--secondary-color);
            font-weight: 600;
        }

        .content-area {
            padding: 2rem;
        }

        .card {
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .card-header {
            background-color: var(--primary-color);
            color: white;
            border: none;
            font-weight: 600;
            padding: 1.25rem;
        }

        /* Buttons */
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: var(--accent-color);
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
        }

        .btn-sm {
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
        }

        /* Tables */
        .table {
            background-color: white;
        }

        .table thead th {
            background-color: #f1f5f9;
            color: var(--secondary-color);
            font-weight: 600;
            border-bottom: 2px solid #e2e8f0;
            padding: 1rem;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            color: #475569;
        }

        .table tbody tr:hover {
            background-color: #f8fafc;
        }

        /* Forms */
        .form-label {
            font-weight: 500;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }

        .form-control,
        .form-select {
            border: 1px solid #e2e8f0;
            border-radius: 0.375rem;
            padding: 0.625rem 0.875rem;
            font-size: 0.95rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
        }

        /* Badges */
        .badge {
            padding: 0.5rem 0.875rem;
            font-size: 0.8rem;
            font-weight: 500;
            border-radius: 0.375rem;
        }

        .badge-success {
            background-color: #10b981;
        }

        .badge-warning {
            background-color: #f59e0b;
            color: white;
        }

        .badge-danger {
            background-color: #ef4444;
        }

        .badge-info {
            background-color: #0891b2;
        }

        /* Alerts */
        .alert {
            border: none;
            border-radius: 0.5rem;
        }

        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
        }

        .alert-danger {
            background-color: #fee2e2;
            color: #7f1d1d;
        }

        .alert-warning {
            background-color: #fef3c7;
            color: #78350f;
        }

        /* Dashboard Stats */
        .stat-card {
            background: white;
            border-radius: 0.5rem;
            padding: 1.5rem;
            border-left: 4px solid var(--primary-color);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .stat-card .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0.5rem 0;
        }

        .stat-card .stat-label {
            font-size: 0.95rem;
            color: #6b7280;
        }

        .stat-card.students { border-left-color: #3b82f6; }
        .stat-card.teachers { border-left-color: #10b981; }
        .stat-card.courses { border-left-color: #f59e0b; }
        .stat-card.fees { border-left-color: #ef4444; }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                min-height: auto;
                padding: 1rem;
            }

            .main-wrapper {
                margin-left: 0;
            }

            .content-area {
                padding: 1rem;
            }
        }
    </style>
    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <h3><i class="bi bi-mortarboard-fill"></i></h3>
            <h5>SMS</h5>
            <small>School Management</small>
        </div>

        <ul class="sidebar-menu">
            <li><a href="<?php echo e(route('dashboard')); ?>" class="<?php if(request()->route()->getName() === 'dashboard'): ?> active <?php endif; ?>"><i class="bi bi-house-fill"></i> Dashboard</a></li>
            <li><a href="<?php echo e(route('students.index')); ?>" class="<?php if(str_contains(request()->route()->getName(), 'students')): ?> active <?php endif; ?>"><i class="bi bi-people-fill"></i> Students</a></li>
            <li><a href="<?php echo e(route('teachers.index')); ?>" class="<?php if(str_contains(request()->route()->getName(), 'teachers')): ?> active <?php endif; ?>"><i class="bi bi-person-workspace"></i> Teachers</a></li>
            <li><a href="<?php echo e(route('courses.index')); ?>" class="<?php if(str_contains(request()->route()->getName(), 'courses')): ?> active <?php endif; ?>"><i class="bi bi-book-fill"></i> Courses</a></li>
            <li><a href="<?php echo e(route('fees.index')); ?>" class="<?php if(str_contains(request()->route()->getName(), 'fees')): ?> active <?php endif; ?>"><i class="bi bi-credit-card-fill"></i> Fees</a></li>
            <li><a href="<?php echo e(route('timetable.index')); ?>" class="<?php if(str_contains(request()->route()->getName(), 'timetable')): ?> active <?php endif; ?>"><i class="bi bi-calendar-event-fill"></i> Timetable</a></li>
        </ul>
    </div>

    <div class="main-wrapper">
        <div class="topbar">
            <h2><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></h2>
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle"></i> <?php echo e(Auth::user()->name ?? 'Admin'); ?>

                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="<?php echo e(route('profile.show')); ?>"><i class="bi bi-person"></i> My Profile</a></li>
                    <li><a class="dropdown-item" href="<?php echo e(route('profile.edit')); ?>"><i class="bi bi-pencil"></i> Edit Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="<?php echo e(route('logout')); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <div class="content-area">
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <h5>Please check the errors:</h5>
                    <ul class="mb-0">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="bi bi-check-circle-fill"></i> <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="bi bi-exclamation-triangle-fill"></i> <?php echo e(session('error')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html><?php /**PATH D:\xampp\htdocs\school_management_system\resources\views/layout/app.blade.php ENDPATH**/ ?>