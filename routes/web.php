<?php

use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Enrollment;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Models\Notice;
use Illuminate\Support\Facades\Route;

// Homepage / Dashboard
Route::get('/', function () {
    $notices = Notice::latest()->get();
    return view('dashboard', compact('notices'));
})->middleware('redirect.role');

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminLoginController::class, 'login_form'])->name('admin.login.form');
    Route::post('/admin/login/dashboard', [AdminLoginController::class, 'adminLogin'])->name('admin.login');
});

// Authenticated Routes
Route::middleware(['auth'])->group(function () {


    Route::get('/teacher/view/{id}', [TeacherController::class, 'show'])->name('teacher.viewSingleTeacher');
    Route::get('/student/view/{id}', [StudentController::class, 'viewSingleStudent'])->name('student.viewSingleStudent');
    Route::put('/user/update/{id}', [PasswordController::class, 'update'])->name('update.user.password');
    Route::get('/complete/profile', [AdminController::class, 'role'])->name('user.role');
    // Student admin  Routes
    Route::middleware('role:student,admin')->group(function () {
        Route::controller(StudentController::class)->group(function () {
            Route::get('/student/info', 'create')->name('student.info');
            Route::post('/student/store', 'store')->name('student.store');
            Route::get('/student/profile', 'update_p')->name('update.profile');
            Route::get('/student/edit/{id}', 'edit')->name('admin.student.edit');
            Route::put('/student/update/{id}', 'update')->name('admin.student.update');
            Route::delete('/student/delete/{id}', 'destroy')->name('admin.student.delete');
        });
    });
    // Student Routes
    Route::middleware('role:student')->group(function () {
        Route::get('/student/dashboard', [StudentController::class, 'index'])->name('student.dashboard');
    });
    // Teacher admin Routes
    Route::middleware('role:teacher,admin')->group(function () {
        Route::controller(TeacherController::class)->group(function () {
            Route::get('/teacher/profile', 'update_p')->name('teacher.update.profile');
            Route::get('/teacher/info', 'create')->name('teacher.info');
            Route::post('/teacher/store', 'store')->name('store.teacher');
            Route::get('/teacher/edit/{id}', 'edit')->name('teacher.edit');
            Route::put('/teacher/update/{id}', 'update')->name('teacher.update');
            Route::delete('/teacher/delete/{id}', 'destroy')->name('destroy.teacher');
        });

        //notice routes group
        Route::controller(NoticeController::class)->group(function () {
            Route::get('/notice/home', 'index')->name('notice.index');
            Route::get('/notice/create', 'create')->name('notice.create');
            Route::post('/notice/store', 'store')->name('notice.store');
            Route::get('/notice/edit/{id}', 'edit')->name('notice.edit');
            Route::put('/notice/update/{id}', 'update')->name('notice.update');
            Route::delete('/notice/destroy/{id}', 'destroy')->name('notice.destroy');
            Route::get('/notice', 'index')->name('notice.list');
        });
    });


    Route::middleware('role:teacher')->group(function () {
        Route::get('/teacher/dashboard', [TeacherController::class, 'index'])->name('teacher.dashboard');
    });

    // Admin Routes
    Route::middleware('role:admin')->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('/admin/dashboard', 'index')->name('admin.dashboard');
            Route::get('/admin/students', 'show_student')->name('admin.student.list');
            Route::get('/admin/teachers', 'show_teacher')->name('teacher.list');
            Route::get('/admin/users', 'show_user')->name('users.list');
            Route::get('/admin/user/edit{id}', 'edit_user')->name('admin.user.edit');
            Route::put('/admin/user/update{id}', 'update_user')->name('admin.user.update');
            Route::delete('/admin/user/delete{id}', 'destroy')->name('destroy.user');
            Route::get('/createUser', [RegisteredUserController::class, 'createUserByAdmin'])->name('user.create');
            Route::post('/admin/user', [RegisteredUserController::class, 'store'])->name('admin.register');
            Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
            Route::get('/enroll', 'enrollStudent')->name('enrolled');
        });
    });



    // Mixed Role Routes
    Route::middleware('role:admin,teacher,student')->group(function () {
        //course routes
        Route::controller(CourseController::class)->group(function () {
            Route::get('/create/course', 'create')->name('create.course.page');
            Route::post('/course/store', 'store')->name('course.store');
            Route::get('/course/edit/{id}', 'edit')->name('course.edit');
            Route::put('/course/update/{id}', 'update')->name('course.update');
            Route::get('/course/list', 'index')->name('course.list');
            Route::get('/course/show/{id}', 'show')->name('single.course');
            Route::delete('/course/destroy/{id}', 'destroy')->name('course.destroy');
        });

        // user routes
        Route::controller(AdminController::class)->group(function () {
            Route::get('/admin/user/edit{id}', 'edit_user')->name('admin.user.edit');
            Route::put('/admin/user/update{id}', 'update_user')->name('admin.user.update');
            Route::delete('/admin/user/delete{id}', 'destroy')->name('destroy.user');
        });

        // enroll route 
        Route::controller(Enrollment::class)->group(function () {
            Route::get('/course{id}', 'show')->name('course');
            Route::post('/course/post', 'store')->name('enroll.course');
            Route::get('/myCourse', 'index')->name('myCourse');
            Route::get('/cou', 'studentEnroll_course')->name('coc');
            Route::get('/enrolled', 'enrolledCourse')->name('enrolled.user');
        });
    });

    
});

require __DIR__ . '/auth.php';
