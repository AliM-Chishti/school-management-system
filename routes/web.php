<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Authentication Routes (Guest Only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
});

// Logout Route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Protected Routes (Auth Required)
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/profile/update-avatar', [ProfileController::class, 'updateAvatar'])->name('profile.update-avatar');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');

    Route::resource('students', StudentController::class);
    Route::post('students/{student}/enroll', [StudentController::class, 'enrollCourse'])->name('students.enroll');
    Route::delete('students/{student}/courses/{course}', [StudentController::class, 'dropCourse'])->name('students.drop-course');

    Route::resource('teachers', TeacherController::class);
    Route::post('teachers/{teacher}/assign-courses', [TeacherController::class, 'assignCourses'])->name('teachers.assign-courses');
    Route::delete('teachers/{teacher}/courses/{course}', [TeacherController::class, 'removeCourse'])->name('teachers.remove-course');

    Route::resource('courses', CourseController::class);
    Route::post('courses/{course}/allocate-students', [CourseController::class, 'allocateToStudents'])->name('courses.allocate-students');
    Route::post('courses/{course}/allocate-teachers', [CourseController::class, 'allocateToTeachers'])->name('courses.allocate-teachers');

    Route::resource('fees', FeeController::class);
    Route::post('fees/{fee}/record-payment', [FeeController::class, 'recordPayment'])->name('fees.record-payment');
    Route::get('fees/{fee}/generate-receipt', [FeeController::class, 'generateReceipt'])->name('fees.generate-receipt');
    Route::get('fees/report/view', [FeeController::class, 'feeReport'])->name('fees.report');

    // Timetable custom routes MUST come before resource route
    Route::get('timetable/by-day', [TimetableController::class, 'viewByDay'])->name('timetable.by-day');
    Route::get('timetable/by-teacher', [TimetableController::class, 'viewByTeacher'])->name('timetable.by-teacher');
    Route::resource('timetable', TimetableController::class);
});
