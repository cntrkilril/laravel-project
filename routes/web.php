<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {return view("about.about");})->name('about');
Route::get('/things', [\App\Http\Controllers\ThingsController::class, 'index'])->name('home');

Route::middleware("auth")-> group(function (){
    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    Route::get('/things/create', [\App\Http\Controllers\ThingsController::class, 'create'])->name('things_create');
    Route::post('/things/store', [\App\Http\Controllers\ThingsController::class, 'store'])->name('things_store');
    Route::get('/things/{id}', [\App\Http\Controllers\ThingsController::class, 'show'])->name('things_show');
    Route::post('/things/{id}/delete', [\App\Http\Controllers\ThingsController::class, 'destroy'])->name('things_delete');
    Route::get('/things/{id}/edit', [\App\Http\Controllers\ThingsController::class, 'edit'])->name('things_edit');
    Route::post('/things/{id}/edit', [\App\Http\Controllers\ThingsController::class, 'store'])->name('things_edit');
});

Route::middleware("guest")-> group(function (){
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login_process', [\App\Http\Controllers\AuthController::class, 'login'])->name('login_process');
    Route::get('/register', [\App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register_process', [\App\Http\Controllers\AuthController::class, 'register'])->name('register_process');
});

