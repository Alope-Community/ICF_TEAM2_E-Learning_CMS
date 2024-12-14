<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\CourseCategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\EnrolmentController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SocialAccountController;
use App\Http\Controllers\SubmitedTaskController;
use App\Models\CategoryCourse;
use App\Models\Discussion;
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

Route::prefix('course-category')->group(function () {
    Route::get('', [CourseCategoryController::class, 'get']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth/logout', [AuthController::class, 'logout']);

    Route::prefix('course-category')->group(function () {
        Route::post('/{categoryCourse}/enrolment', [EnrolmentController::class, 'create']);
    });

    Route::prefix('settings')->group(function () {
        Route::get('/profile', [SettingController::class, 'getProfileAuth']);
        Route::post('/change-password', [SettingController::class, 'updatePassword']);
        Route::post('/update-profil', [SettingController::class, 'updateProfile']);
    });




    Route::post('course/{course}/discussion', [DiscussionController::class, 'create']);
    Route::get('category/{course}/course-detail', [CourseController::class, 'show']);
    Route::get('category/{categoryCourse}/course', [CourseController::class, 'get'])->name('category.api');

    Route::post('task/{task}/submited', [SubmitedTaskController::class, 'create']);

    // Route::get('discussion/{course}/read');
});
