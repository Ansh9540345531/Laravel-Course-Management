<?php

use Illuminate\Support\Facades\Route;


// Student Routes
Route::prefix('student')->group(function () {
    // Authentication
    Route::get('/register', [App\Http\Controllers\Student\AuthController::class, 'showRegistrationForm'])->name('student.register');
    Route::post('/register', [App\Http\Controllers\Student\AuthController::class, 'register']);
    Route::get('/login', [App\Http\Controllers\Student\AuthController::class, 'showLoginForm'])->name('student.login');
    Route::post('/login', [App\Http\Controllers\Student\AuthController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\Student\AuthController::class, 'logout'])->name('student.logout');

    // Enrollment Process 
    Route::middleware('auth:student')->group(function () {
        Route::get('/enroll', [App\Http\Controllers\Student\EnrollmentController::class, 'showStep1'])->name('enroll.step1');
        Route::post('/enroll/step1', [App\Http\Controllers\Student\EnrollmentController::class, 'processStep1'])->name('enroll.process.step1');
        Route::get('/enroll/step2', [App\Http\Controllers\Student\EnrollmentController::class, 'showStep2'])->name('enroll.step2');
        Route::post('/enroll/step2', [App\Http\Controllers\Student\EnrollmentController::class, 'processStep2'])->name('enroll.process.step2');
        Route::get('/enroll/step3', [App\Http\Controllers\Student\EnrollmentController::class, 'showStep3'])->name('enroll.step3');
        Route::post('/enroll/complete', [App\Http\Controllers\Student\EnrollmentController::class, 'complete'])->name('enroll.complete');
        Route::get('/enroll/success/{id}', [App\Http\Controllers\Student\EnrollmentController::class, 'success'])->name('enroll.success');
    });
});

// Admin Routes
Route::prefix('admin')->group(function () {
    // Authentication
    Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('admin.logout');

    // Protected Routes
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
        
        // Courses Resource Routes
        Route::resource('courses', App\Http\Controllers\Admin\CourseController::class)->names([
            'index' => 'admin.courses.index',
            'create' => 'admin.courses.create',
            'store' => 'admin.courses.store',
            'show' => 'admin.courses.show',
            'edit' => 'admin.courses.edit',
            'update' => 'admin.courses.update',
            'destroy' => 'admin.courses.destroy'
        ]);
        
        // Students Routes
        Route::get('/students', [App\Http\Controllers\Admin\StudentController::class, 'index'])->name('admin.students.index');
        Route::get('/students/export', [App\Http\Controllers\Admin\StudentController::class, 'export'])->name('admin.students.export');
    });
});

// Home Route
Route::get('/', function () {
    return view('welcome');
});
