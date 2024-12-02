<?php

use App\Http\Controllers\CourseCategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\SettingController;
use App\Models\User;
use Faker\Guesser\Name;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;

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


Route::middleware('guest')->group(function(){
    Route::redirect('/', 'login');
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('requestLogin');
});

Route::middleware('auth')->group(function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [RedirectController::class, 'Dashboard'])->name('dashboard');

    Route::prefix('user')->group(function(){
        Route::get('', [User::class, 'index'])->name('users');
    });

    Route::prefix('setigs')->group(function(){
        Route::get('profile', [SettingController::class, 'profile'])->name('setings.profile');
    });

    Route::prefix('category-course')->group(function(){
        Route::get('', [CourseCategoryController::class, 'index'])->name('categoryCourse');
    });
});
