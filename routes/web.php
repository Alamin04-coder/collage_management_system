<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\teacherController;
use App\Http\Middleware\userRole;


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes for authenticated users with any role
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//  only student and admin can access this route 
Route::middleware(['auth', 'role:student,admin'])->group(function () {
    Route::controller(StudentController::class)->group(function () {
        Route::get('/student/info', 'create')->name('student.info');
        Route::post('/student/store', 'store')->name('student.store');
        Route::get('/student/profile', 'update_p')->name('update.profile');
        Route::get('/student/edit/{id}', 'edit')->name('admin.student.edit');
        Route::put('/student/update/{id}', 'update')->name('admin.student.update');
        Route::delete('/student/delete/{id}', 'destroy')->name('admin.student.delete');
    });
});

// teacher and admin can access this route 

Route::middleware(['auth', 'role:admin,teacher'])->group(function () {
    Route::controller(TeacherController::class)->group(function () {

        Route::get('/teacher/info', 'create')->name('teacher.info');
        Route::get('/teacher/profile', 'update_p')->name('teacher.update.profile');
        Route::post('/teacher/store', 'store')->name('store.teacher');
        Route::get('/teacher/edit/{id}', 'edit')->name('teacher.edit');
        Route::put('/teacher/update/{id}', 'update')->name('teacher.update');
        Route::delete('/teacher/delete/{id}', 'destroy')->name('destroy.teacher');
    });

    Route::controller(CourseController::class)->group(function () {
        Route::get('/create/course', 'create')->name('create.course.page');
        Route::post('/course/store', 'store')->name('course.store');
        Route::get('/course/edit/{id}', 'edit')->name('course.edit');
        Route::put('/course/update/{id}', 'update')->name('course.update');
        Route::get('/course/list', 'show_course')->name('course.list');
        Route::get('/course/show/{id}', 'show')->name('single.course');
        Route::delete('/course/destroy/{id}', 'destroy')->name('course.destroy');
    });
});

// only admin can access this route 

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/dashboard', 'index')->name('admin.dashboard');
        Route::get('/admin/students', 'show_student')->name('admin.student.list');
        Route::get('/admin/teachers', 'show_teacher')->name('teacher.list');
        Route::get('/admin/users', 'show_user')->name('users.list');
    });

    Route::get('/createUser', [RegisteredUserController::class, 'createUserByAdmin'])->name('user.create');
    Route::post('/admin/user', [RegisteredUserController::class, 'store'])->name('admin.register');
});


Route::middleware(['auth', 'role:admin,student,teacher'])->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/user/edit{id}', 'edit_user')->name('admin.user.edit');
        Route::put('/admin/user/update{id}', 'update_user')->name('admin.user.update');
        Route::delete('/admin/user/delete{id}', 'destroy')->name('destroy.user');
        Route::get('/complete/profile', 'role')->name('user.role');
    });
});



//  every authenticated user can access this route 

Route::middleware('auth')->group(function () {
    Route::get('/teacher/view/{id}', [TeacherController::class, 'show'])->name('teacher.viewSingleTeacher');
    Route::get('/student/view/{id}', [StudentController::class, 'viewSingleStudent'])->name('student.viewSingleStudent');
});

// only student can Access this routes
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::controller(StudentController::class)->group(function () {
        Route::get('/student/dashboard', 'index')->name('student.dashboard');
    });
});

Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::controller(teacherController::class)->group(function () {
        Route::get('/teacher/dashboard', 'index')->name('teacher.dashboard');
    });
});








require __DIR__ . '/auth.php';
