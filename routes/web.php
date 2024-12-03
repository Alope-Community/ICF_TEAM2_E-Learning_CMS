<?php

use App\Http\Controllers\CourseCategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RedirectController;
<<<<<<< HEAD
use App\Http\Controllers\UserController;
=======
use App\Http\Controllers\SettingController;
use App\Models\User;
use Faker\Guesser\Name;
>>>>>>> 260bb7c3cf85f6fb6608494e1b93865c5a356e38
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

<<<<<<< HEAD
Route::get('/', function () {
    return view('login');
})->name('login');
=======
>>>>>>> 260bb7c3cf85f6fb6608494e1b93865c5a356e38

Route::middleware('guest')->group(function(){
    Route::redirect('/', 'login');
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('requestLogin');
});

Route::middleware('auth')->group(function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [RedirectController::class, 'Dashboard'])->name('dashboard');
<<<<<<< HEAD
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
=======

    Route::prefix('user')->group(function(){
        Route::get('', [User::class, 'index'])->name('users');
    });

    Route::prefix('setigs')->group(function(){
        Route::get('profile', [SettingController::class, 'profile'])->name('setings.profile');
    });

    Route::prefix('category-course')->group(function(){
        Route::get('', [CourseCategoryController::class, 'index'])->name('categoryCourse');
    });
>>>>>>> 260bb7c3cf85f6fb6608494e1b93865c5a356e38
});
