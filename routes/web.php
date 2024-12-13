<?php

use App\Models\User;
use Faker\Guesser\Name;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\CourseCategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\EnrolmentController;
use App\Http\Controllers\SubmitedTaskController;
use App\Http\Controllers\TaskController;
use App\Models\Submited;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware('guest')->group(function () {
    Route::redirect('/', 'login');
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('requestLogin');
});

Route::middleware('auth')->group(function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [RedirectController::class, 'Dashboard'])->name('dashboard');

    Route::prefix('task')->group(function () {
        Route::get('', [TaskController::class, 'index'])->name('tasks');
        Route::post('/store', [TaskController::class, 'store'])->name('task.store');
        Route::get('{task}/edit', [TaskController::class, 'edit'])->name('task.edit');
        Route::put('{task}/update', [TaskController::class, 'update'])->name('task.update');
        Route::get('{task}/destroy', [TaskController::class, 'destroy'])->name('task.destroy');
        Route::get('{task}/lihat-pengumpulan-tugas', [SubmitedTaskController::class, 'index'])->name('task.lihat-tugas');
    });

    Route::middleware('isAdmin')->prefix('user')->group(function () {
        Route::get('', [UserController::class, 'index'])->name('users');
        Route::get('/{user}/delete', [UserController::class, 'destroy'])->name('user.destroy');
    });


<<<<<<< HEAD
    Route::prefix('category-course')->group(function(){
=======
    Route::prefix('category-course')->group(function () {
>>>>>>> 83733bde31b9889f741b6d0331dd7788586e0937
        Route::get('', [CourseCategoryController::class, 'index'])->name('categoryCourse');
        Route::post('/create', [CourseCategoryController::class, 'create'])->name('categoryCourse.create');
        Route::get('{categoryCourse}/edit', [CourseCategoryController::class, 'edit'])->name('categoryCourse.edit');
        Route::put('{categoryCourse}/update', [CourseCategoryController::class, 'update'])->name('categoryCourse.update');
        Route::get('{categoryCourse}/delete', [CourseCategoryController::class, 'destroy'])->name('categoryCourse.destroy');
        Route::get('{categoryCourse}/lihat-siswa', [EnrolmentController::class, 'index'])->name('categoryCourse.lihat-siswa');
    });

    Route::prefix('course')->group(function () {
        Route::get('', [CourseController::class, 'index'])->name('course');
        Route::post('/create', [CourseController::class, 'create'])->name('course.create');
        Route::get('{course}/edit', [CourseController::class, 'edit'])->name('course.edit');
        Route::put('{course}/update', [CourseController::class, 'update'])->name('course.update');
        Route::get('{course}/delete', [CourseController::class, 'destroy'])->name('course.destroy');
        Route::get('{course}/discussion', [DiscussionController::class, 'index'])->name('discussion');
    });

    Route::prefix('setigs')->group(function () {
        Route::get('profile', [SettingController::class, 'profile'])->name('setings.profile');
        Route::post('profile', [SettingController::class, 'updateProfile'])->name('setings.update');
        Route::get('change-password', [SettingController::class, 'setPassword'])->name('setings.changePassword');
        Route::post('change-password', [SettingController::class, 'updatePassword'])->name('setings.changePassword');
    });

    Route::post('submited/{submited}/grade', [SubmitedTaskController::class, 'createGrade'])->name('submited.grade');
});
