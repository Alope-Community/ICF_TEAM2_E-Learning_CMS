<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\CourseCategoryController;
// use App\Http\Controllers\CourseController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SocialAccountController;
use App\Models\CategoryCourse;
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

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::prefix('/course-category')->group(function(){
    Route::get('', [CourseCategoryController::class, 'get']);
});

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/auth/logout', [AuthController::class, 'logout']);

    Route::prefix('settings')->group(function(){
        Route::get('/profile', [SettingController::class, 'getProfileAuth']);
        Route::post('/change-password', [SettingController::class, 'updatePassword']);
    });

    Route::middleware(['auth:sanctum', 'isUser'])->group(function(){
        Route::get('category-course/{name}', [CourseCategoryController::class, 'get']);
    });

    Route::middleware(['auth:sanctum', 'isTeacher'])->group(function(){

    });
});
