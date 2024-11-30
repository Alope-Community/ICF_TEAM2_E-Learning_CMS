<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseCategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/auth/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
    
    Route::prefix('settings')->group(function(){
        Route::get('/profile', [SettingController::class, 'getProfileAuth'])->name('setting.profile');
        Route::post('/change-password', [SettingController::class, 'updatePassword'])->name('setting.change-password');
    });

    Route::middleware(['auth:sanctum', 'isUser'])->group(function(){

    });

    Route::middleware(['auth:sanctum', 'isTeacher'])->group(function(){
        Route::prefix('/course-category')->group(function(){
            Route::get('', [CourseCategoryController::class, 'get'])->name('category-course');
        });
    });
});
