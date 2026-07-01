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
            color-scheme: light;
            --bg: #F8FAFC;
            --surface: #ffffff;
            --surface-soft: #f1f5f9;
            --surface-strong: #e2e8f0;
            --text: #0f172a;
            --text-muted: #475569;
            --primary: #2563EB;
            --secondary: #4F46E5;
            --accent: #0EA5E9;
            --success: #10B981;
            --warning: #F59E0B;
            --danger: #EF4444;
            --shadow: 0 24px 80px rgba(15, 23, 42, 0.08);
            --radius: 1.5rem;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: 'Inter', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--bg);
            color: var(--text);
            transition: background 0.3s ease, color 0.3s ease;
        }

        .app-shell,
        .main-panel,
        .app-header,
        .sidebar,
        .topbar,
        .notification-dropdown,
        .profile-dropdown-menu,
        .app-footer {
            transition: background 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }

        body.dark-mode {
            color-scheme: dark;
            --bg: #070b16;
            --surface: #0f172a;
            --surface-soft: #111827;
            --surface-strong: #1f2937;
            --text: #e2e8f0;
            --text-muted: #94a3b8;
            --primary: #60a5fa;
            --secondary: #a78bfa;
            --accent: #38bdf8;
            --success: #34d399;
            --warning: #f59e0b;
            --danger: #f87171;
            --shadow: 0 24px 80px rgba(0, 0, 0, 0.25);
        }

        body.dark-mode .sidebar {
            background: linear-gradient(180deg, rgba(30,58,138,1) 0%, rgba(15,23,42,1) 100%);
        }

        body.dark-mode .app-footer {
            background: #0f172a;
            color: #cbd5e1;
        }

        body.dark-mode .topbar {
            background: rgba(15,23,42,0.95);
            border-color: rgba(148,163,184,0.12);
        }

        body.dark-mode .notification-dropdown,
        body.dark-mode .profile-dropdown-menu {
            background: #111827;
            color: #e2e8f0;
            border-color: rgba(148,163,184,0.14);
        }

        body.dark-mode .notification-item {
            background: #111827;
            color: #e2e8f0;
        }

        body.dark-mode .notification-item:hover {
            background: #1f2937;
        }

        body.dark-mode .notification-item-icon {
            background: rgba(96,165,250,0.12);
        }

        body.dark-mode .profile-dropdown-toggle {
            background: #0f172a;
            border-color: rgba(148,163,184,0.15);
            color: #e2e8f0;
        }

        body.dark-mode .profile-dropdown-menu a:hover,
        body.dark-mode .profile-dropdown-menu button:hover {
            background: rgba(255,255,255,0.08);
            color: #e2e8f0;
        }

        body.dark-mode .topbar-action {
            background: #111827;
            border-color: rgba(148,163,184,0.1);
            color: #e2e8f0;
        }

        body.dark-mode .topbar-action:hover {
            background: rgba(255,255,255,0.08);
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .app-shell {
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: 280px;
            padding: 2rem 1.25rem;
            background: linear-gradient(180deg, rgba(37,99,235,1) 0%, rgba(79,70,229,1) 100%);
            color: #f8fafc;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: width 0.3s ease;
            z-index: 20;
        }

        .sidebar-collapsed .sidebar {
            width: 88px;
        }

        .sidebar .brand {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 2.5rem;
        }

        .sidebar .brand-logo {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            display: grid;
            place-items: center;
            background: rgba(255,255,255,0.16);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.08);
        }

        .sidebar .brand-logo i {
            font-size: 1.25rem;
        }

        .sidebar .brand-copy {
            display: flex;
            flex-direction: column;
            gap: 0.15rem;
            opacity: 1;
            transition: opacity 0.3s ease;
        }

        .sidebar-collapsed .brand-copy {
            opacity: 0;
            pointer-events: none;
        }

        .sidebar .brand-copy .brand-name {
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        .sidebar .brand-copy .brand-text {
            font-size: 0.82rem;
            color: rgba(248,250,252,0.8);
        }

        .sidebar-toggle {
            border: none;
            background: rgba(255,255,255,0.12);
            color: #fff;
            width: 36px;
            height: 36px;
            border-radius: 12px;
            cursor: pointer;
            display: grid;
            place-items: center;
            transition: transform 0.3s ease, background 0.3s ease;
        }

        .sidebar-toggle:hover {
            background: rgba(255,255,255,0.18);
            transform: translateX(2px);
        }

        .sidebar nav {
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
            flex: 1;
            overflow-y: auto;
            padding-right: 0.15rem;
        }

        .sidebar .menu-group,
        .sidebar .menu-item {
            list-style: none;
        }

        .sidebar .menu-link,
        .sidebar .submenu-link,
        .sidebar .submenu-toggle {
            width: 100%;
            display: inline-flex;
            align-items: center;
            gap: 0.95rem;
            padding: 0.95rem 1rem;
            border-radius: 1rem;
            color: rgba(248,250,252,0.9);
            font-size: 0.95rem;
            transition: background 0.25s ease, color 0.25s ease, padding-left 0.25s ease;
            border: none;
            background: transparent;
            cursor: pointer;
            text-align: left;
        }

        .sidebar .menu-link:hover,
        .sidebar .submenu-link:hover,
        .sidebar .submenu-toggle:hover {
            background: rgba(255,255,255,0.12);
            color: #fff;
        }

        .sidebar .menu-link.active,
        .sidebar .submenu-link.active,
        .sidebar .submenu-toggle.active {
            background: rgba(255,255,255,0.18);
            color: #fff;
            box-shadow: inset 3px 0 0 rgba(255,255,255,0.85);
        }

        .sidebar .menu-icon,
        .sidebar .submenu-icon {
            display: grid;
            place-items: center;
            width: 2rem;
            height: 2rem;
            border-radius: 0.75rem;
            background: rgba(255,255,255,0.12);
            color: #fff;
            font-size: 1rem;
        }

        .sidebar .menu-label {
            flex: 1;
            transition: opacity 0.3s ease;
        }

        .sidebar-collapsed .menu-label,
        .sidebar-collapsed .submenu-list,
        .sidebar-collapsed .menu-separator-label {
            opacity: 0;
        }

        .sidebar-collapsed .submenu-list {
            max-height: 0;
            overflow: hidden;
        }

        .sidebar .menu-separator-label {
            margin: 1.5rem 1rem 0.8rem;
            text-transform: uppercase;
            font-size: 0.73rem;
            letter-spacing: 0.14em;
            color: rgba(248,250,252,0.6);
        }

        .submenu-list {
            margin: 0.1rem 0 0 3rem;
            padding: 0;
            list-style: none;
            display: none;
        }

        .menu-group.open .submenu-list {
            display: block;
        }

        .submenu-link {
            font-size: 0.86rem;
            padding: 0.75rem 1rem;
            gap: 0.7rem;
            color: rgba(248,250,252,0.8);
            background: transparent;
        }

        .submenu-link.active {
            background: rgba(255,255,255,0.14);
            color: #fff;
        }

        .profile-info {
            display: flex;
            align-items: center;
            gap: 0.85rem;
        }

        .profile-avatar {
            width: 46px;
            height: 46px;
            border-radius: 16px;
            display: grid;
            place-items: center;
            background: rgba(255,255,255,0.18);
            font-size: 1.1rem;
        }

        .profile-meta {
            display: flex;
            flex-direction: column;
            gap: 0.15rem;
        }

        .profile-name {
            font-weight: 700;
        }

        .profile-role {
            color: rgba(248,250,252,0.75);
            font-size: 0.82rem;
        }

        .main-panel {
            margin-left: 280px;
            flex: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s ease;
        }

        .sidebar-collapsed .main-panel {
            margin-left: 88px;
        }

        .topbar {
            position: sticky;
            top: 0;
            z-index: 10;
            background: rgba(255,255,255,0.94);
            backdrop-filter: blur(18px);
            box-shadow: 0 9px 40px rgba(15, 23, 42, 0.06);
            border-bottom: 1px solid rgba(148,163,184,0.12);
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 1rem;
            min-width: 0;
        }

        .topbar .breadcrumbs {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: var(--text-muted);
            font-size: 0.92rem;
        }

        .topbar .breadcrumbs span {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .topbar .breadcrumbs svg {
            width: 14px;
            height: 14px;
            color: rgba(71,85,105,0.7);
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            flex-wrap: wrap;
        }

        .topbar-action {
            position: relative;
            border: 1px solid rgba(148,163,184,0.18);
            background: #fff;
            color: var(--text);
            border-radius: 16px;
            padding: 0.85rem 0.95rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            cursor: pointer;
            transition: background 0.25s ease, transform 0.25s ease;
        }

        .topbar-action:hover {
            background: rgba(37,99,235,0.08);
            transform: translateY(-1px);
        }

        body.dark-mode .topbar-action {
            background: #111827;
            border-color: rgba(148,163,184,0.1);
            color: #e2e8f0;
        }

        body.dark-mode .topbar-action:hover {
            background: rgba(255,255,255,0.08);
        }

        .topbar-action .badge {
            position: absolute;
            top: 8px;
            right: 8px;
            min-width: 18px;
            height: 18px;
            border-radius: 999px;
            padding: 0 6px;
            font-size: 0.65rem;
            line-height: 18px;
        }

        .notification-dropdown {
            position: absolute;
            right: 0;
            top: calc(100% + 0.75rem);
            width: 320px;
            border-radius: 1.25rem;
            background: #fff;
            border: 1px solid rgba(148,163,184,0.16);
            box-shadow: 0 24px 60px rgba(15, 23, 42, 0.12);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: opacity 0.2s ease, transform 0.2s ease, visibility 0.2s ease;
            z-index: 50;
        }

        .notification-dropdown.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .notification-dropdown-header,
        .notification-footer {
            padding: 0.95rem 1rem;
            border-bottom: 1px solid rgba(148,163,184,0.12);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
        }

        .notification-dropdown-header {
            font-weight: 700;
            color: var(--text);
        }

        .notification-list {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
            max-height: 260px;
            overflow-y: auto;
            padding: 0.75rem 0.75rem 0.5rem;
        }

        .notification-item {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            padding: 0.85rem;
            border-radius: 1rem;
            background: #f8fafc;
            transition: background 0.2s ease;
            color: var(--text);
        }

        .notification-item:hover {
            background: #eef2ff;
        }

        .notification-item-icon {
            width: 38px;
            min-width: 38px;
            height: 38px;
            border-radius: 12px;
            background: rgba(37,99,235,0.1);
            display: grid;
            place-items: center;
            color: var(--primary);
        }

        .notification-item-content {
            display: flex;
            flex-direction: column;
            gap: 0.2rem;
        }

        .notification-item-title {
            font-size: 0.92rem;
            font-weight: 600;
        }

        .notification-item-time {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .notification-footer {
            border-top: 1px solid rgba(148,163,184,0.12);
            border-bottom: none;
            font-size: 0.9rem;
            color: var(--primary);
        }

        .profile-dropdown {
            position: relative;
        }

        .profile-dropdown-toggle {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            border-radius: 999px;
            padding: 0.65rem 0.85rem;
            background: #fff;
            border: 1px solid rgba(148,163,184,0.18);
            cursor: pointer;
            min-width: 180px;
        }

        .profile-dropdown-toggle img,
        .profile-dropdown-toggle .profile-avatar-small {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            background: #eff6ff;
        }

        .profile-dropdown-menu {
            position: absolute;
            right: 0;
            top: calc(100% + 12px);
            width: 240px;
            border-radius: 1.25rem;
            border: 1px solid rgba(148,163,184,0.18);
            background: #fff;
            box-shadow: 0 28px 60px rgba(15, 23, 42, 0.12);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-6px);
            transition: opacity 0.2s ease, transform 0.2s ease, visibility 0.2s ease;
            z-index: 50;
        }

        .profile-dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .profile-dropdown-menu a,
        .profile-dropdown-menu button {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.95rem 1.1rem;
            color: var(--text);
            background: transparent;
            border: none;
            text-align: left;
            font-size: 0.95rem;
            cursor: pointer;
        }

        .profile-dropdown-menu a:hover,
        .profile-dropdown-menu button:hover {
            background: rgba(37,99,235,0.06);
            color: var(--text);
        }

        .content-area {
            padding: 2rem 2rem 1.5rem;
            flex: 1;
        }

        .page-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .page-title h1 {
            margin: 0;
            font-size: clamp(1.65rem, 1.8vw, 2.25rem);
            font-weight: 700;
            letter-spacing: -0.03em;
        }

        .page-subtitle {
            color: var(--text-muted);
            font-size: 0.96rem;
        }

        .app-footer {
            padding: 1rem 2rem;
            background: #ffffff;
            border-top: 1px solid rgba(148,163,184,0.16);
            color: #64748b;
            font-size: 0.92rem;
        }

        .alert {
            border-radius: 1rem;
        }

        .btn-close {
            border: none;
        }

        @media (max-width: 1200px) {
            .sidebar {
                position: sticky;
                height: auto;
                width: 100%;
                border-radius: 0 0 2rem 2rem;
            }

            .sidebar-collapsed .sidebar {
                width: 100%;
            }

            .main-panel {
                margin-left: 0;
            }

            .topbar {
                padding: 1rem;
                flex-wrap: wrap;
            }

            .content-area {
                padding: 1.25rem;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }

            .main-panel {
                margin-left: 0;
            }

            .topbar {
                gap: 0.75rem;
            }

            .topbar .breadcrumbs {
                display: none;
            }

            .sidebar-toggle {
                display: inline-flex;
            }
        }
    </style>
    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>
    <div class="app-shell">
        <aside class="sidebar">
            <div>
                <div class="brand">
                    <div class="brand-logo">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>
                    <div class="brand-copy">
                        <span class="brand-name">SMS Studio</span>
                        <span class="brand-text">School ERP</span>
                    </div>
                    <button id="sidebarToggle" class="sidebar-toggle" type="button" aria-label="Toggle sidebar">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                </div>

                <nav>
                    <div class="menu-item">
                        <a href="<?php echo e(route('dashboard')); ?>" class="menu-link <?php if(request()->route()->getName() === 'dashboard'): ?> active <?php endif; ?>">
                            <span class="menu-icon"><i class="bi bi-speedometer2"></i></span>
                            <span class="menu-label">Dashboard</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a href="<?php echo e(route('students.index')); ?>" class="menu-link <?php if(str_contains(request()->route()->getName(), 'students')): ?> active <?php endif; ?>">
                            <span class="menu-icon"><i class="bi bi-people-fill"></i></span>
                            <span class="menu-label">Students</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a href="<?php echo e(route('teachers.index')); ?>" class="menu-link <?php if(str_contains(request()->route()->getName(), 'teachers')): ?> active <?php endif; ?>">
                            <span class="menu-icon"><i class="bi bi-person-badge-fill"></i></span>
                            <span class="menu-label">Teachers</span>
                        </a>
                    </div>

                    <div class="menu-group <?php if(str_contains(request()->route()->getName(), 'courses') || str_contains(request()->route()->getName(), 'timetable')): ?> open <?php endif; ?>">
                        <button type="button" class="submenu-toggle <?php if(str_contains(request()->route()->getName(), 'courses') || str_contains(request()->route()->getName(), 'timetable')): ?> active <?php endif; ?>">
                            <span class="menu-icon"><i class="bi bi-journal-bookmark-fill"></i></span>
                            <span class="menu-label">Academics</span>
                            <span class="submenu-icon ms-auto"><i class="bi bi-chevron-down"></i></span>
                        </button>
                        <ul class="submenu-list">
                            <li><a href="<?php echo e(route('courses.index')); ?>" class="submenu-link <?php if(str_contains(request()->route()->getName(), 'courses')): ?> active <?php endif; ?>">Courses</a></li>
                            <li><a href="<?php echo e(route('timetable.index')); ?>" class="submenu-link <?php if(str_contains(request()->route()->getName(), 'timetable')): ?> active <?php endif; ?>">Timetable</a></li>
                        </ul>
                    </div>

                    <div class="menu-item">
                        <a href="<?php echo e(route('fees.index')); ?>" class="menu-link <?php if(str_contains(request()->route()->getName(), 'fees')): ?> active <?php endif; ?>">
                            <span class="menu-icon"><i class="bi bi-currency-dollar"></i></span>
                            <span class="menu-label">Fees</span>
                        </a>
                    </div>
                </nav>
            </div>
        </aside>

        <div class="main-panel">
            <header class="topbar">
                <div class="topbar-left">
                    <button id="mobileSidebarToggle" class="topbar-action d-lg-none" type="button" aria-label="Open sidebar">
                        <i class="bi bi-list"></i>
                    </button>
                    <div class="breadcrumbs">
                        <span><i class="bi bi-house-door-fill"></i> Home</span>
                        <svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 4.5L10 8L6 11.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <span><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></span>
                    </div>
                </div>

                <div class="topbar-actions">
                    <div class="topbar-action notification-toggle" id="notificationToggle" type="button" aria-label="Notifications">
                        <i class="bi bi-bell-fill"></i>
                        <span class="badge bg-danger">3</span>
                    </div>
                    <div class="notification-dropdown" id="notificationDropdown">
                        <div class="notification-dropdown-header">
                            <span>Notifications</span>
                            <span class="text-muted">3 new</span>
                        </div>
                        <div class="notification-list">
                            <a href="#" class="notification-item">
                                <span class="notification-item-icon"><i class="bi bi-person-plus"></i></span>
                                <span class="notification-item-content">
                                    <span class="notification-item-title">New student admission</span>
                                    <span class="notification-item-time">2 minutes ago</span>
                                </span>
                            </a>
                            <a href="#" class="notification-item">
                                <span class="notification-item-icon"><i class="bi bi-cash-stack"></i></span>
                                <span class="notification-item-content">
                                    <span class="notification-item-title">Fee payment received</span>
                                    <span class="notification-item-time">1 hour ago</span>
                                </span>
                            </a>
                            <a href="#" class="notification-item">
                                <span class="notification-item-icon"><i class="bi bi-calendar-event"></i></span>
                                <span class="notification-item-content">
                                    <span class="notification-item-title">Timetable updated</span>
                                    <span class="notification-item-time">3 hours ago</span>
                                </span>
                            </a>
                        </div>
                        <a href="#" class="notification-footer">View all notifications</a>
                    </div>
                    <button id="themeToggle" class="topbar-action" type="button" aria-label="Theme toggle">
                        <i class="bi bi-sun-fill"></i>
                    </button>

                    <div class="profile-dropdown">
                        <button class="profile-dropdown-toggle" type="button" aria-label="Open profile menu">
                            <div class="profile-avatar-small bg-sky-100 text-sky-700"><i class="bi bi-person-fill"></i></div>
                            <div>
                                <div class="fw-semibold"><?php echo e(Auth::user()->name ?? 'Admin User'); ?></div>
                                <div class="text-muted" style="font-size: 0.85rem;"><?php echo e(Auth::user()->email ?? 'admin@example.com'); ?></div>
                            </div>
                            <i class="bi bi-chevron-down ms-auto"></i>
                        </button>
                        <div class="profile-dropdown-menu">
                            <a href="<?php echo e(route('profile.show')); ?>"><i class="bi bi-person"></i> My profile</a>
                            <a href="<?php echo e(route('profile.edit')); ?>"><i class="bi bi-pencil"></i> Settings</a>
                            <div class="dropdown-divider"></div>
                            <form action="<?php echo e(route('logout')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="w-100 text-start bg-transparent"><i class="bi bi-box-arrow-right"></i> Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <main class="content-area">
                <div class="page-title">
                    <div>
                        <h1><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></h1>
                        <p class="page-subtitle">Professional school management in a modern dashboard.</p>
                    </div>
                </div>

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
                    <div class="alert alert-success alert-dismissible fade show rounded-4" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i> <?php echo e(session('success')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show rounded-4" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> <?php echo e(session('error')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php echo $__env->yieldContent('content'); ?>
            </main>

            <footer class="app-footer">
                © <?php echo e(date('Y')); ?> School Management System. Built for modern campuses and efficient teams.
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const body = document.body;
            const sidebarToggle = document.getElementById('sidebarToggle');
            const mobileSidebarToggle = document.getElementById('mobileSidebarToggle');
            const themeToggle = document.getElementById('themeToggle');
            const submenuToggles = document.querySelectorAll('.submenu-toggle');
            const profileToggle = document.querySelector('.profile-dropdown-toggle');
            const profileMenu = document.querySelector('.profile-dropdown-menu');
            const notificationToggle = document.getElementById('notificationToggle');
            const notificationDropdown = document.getElementById('notificationDropdown');

            function updateThemeIcon() {
                const icon = themeToggle?.querySelector('i');
                if (!icon) return;

                if (body.classList.contains('dark-mode')) {
                    icon.classList.remove('bi-sun-fill');
                    icon.classList.add('bi-moon-fill');
                    themeToggle.setAttribute('aria-label', 'Switch to light mode');
                } else {
                    icon.classList.remove('bi-moon-fill');
                    icon.classList.add('bi-sun-fill');
                    themeToggle.setAttribute('aria-label', 'Switch to dark mode');
                }
            }

            function applySavedTheme() {
                const savedTheme = localStorage.getItem('theme');
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
                    body.classList.add('dark-mode');
                } else {
                    body.classList.remove('dark-mode');
                }
                updateThemeIcon();
            }

            sidebarToggle?.addEventListener('click', function () {
                body.classList.toggle('sidebar-collapsed');
                const icon = sidebarToggle.querySelector('i');
                if (body.classList.contains('sidebar-collapsed')) {
                    icon.classList.remove('bi-chevron-right');
                    icon.classList.add('bi-chevron-left');
                } else {
                    icon.classList.remove('bi-chevron-left');
                    icon.classList.add('bi-chevron-right');
                }
            });

            mobileSidebarToggle?.addEventListener('click', function () {
                const sidebar = document.querySelector('.sidebar');
                if (!sidebar) return;
                sidebar.classList.toggle('d-none');
            });

            submenuToggles.forEach(function (button) {
                button.addEventListener('click', function () {
                    const group = button.closest('.menu-group');
                    if (!group) return;
                    group.classList.toggle('open');
                });
            });

            themeToggle?.addEventListener('click', function () {
                body.classList.toggle('dark-mode');
                localStorage.setItem('theme', body.classList.contains('dark-mode') ? 'dark' : 'light');
                updateThemeIcon();
            });

            profileToggle?.addEventListener('click', function () {
                profileMenu?.classList.toggle('show');
                notificationDropdown?.classList.remove('show');
            });

            notificationToggle?.addEventListener('click', function (event) {
                event.stopPropagation();
                notificationDropdown?.classList.toggle('show');
                profileMenu?.classList.remove('show');
            });

            document.addEventListener('click', function (event) {
                if (!event.target.closest('.profile-dropdown')) {
                    profileMenu?.classList.remove('show');
                }
                if (!event.target.closest('.notification-dropdown') && !event.target.closest('.notification-toggle')) {
                    notificationDropdown?.classList.remove('show');
                }
            });

            applySavedTheme();
        });
    </script>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html><?php /**PATH D:\xampp\htdocs\SMS\resources\views/layout/app.blade.php ENDPATH**/ ?>