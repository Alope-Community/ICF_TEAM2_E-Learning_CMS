<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RedirectController;
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

Route::get('/', function () {
    return view('login');
})->name('formLogin');

Route::get('/welkom', function () {
    return view('welcome');
})->name('welcome');

Route::post('/login', [LoginController::class, 'login'])->name('requestLogin');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [RedirectController::class, 'Dashboard'])->name('dashboard');
});
