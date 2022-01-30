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
Route::get('/things/my', [\App\Http\Controllers\ThingsController::class, 'indexMy'])->name('things_my')->middleware('auth');
Route::get('/things/taken', [\App\Http\Controllers\ThingsController::class, 'indexTaken'])->name('things_taken')->middleware('auth');
Route::get('/things/repair', [\App\Http\Controllers\ThingsController::class, 'indexRepair'])->name('things_repair');
Route::get('/things/work', [\App\Http\Controllers\ThingsController::class, 'indexWork'])->name('things_work');
Route::get('/things/used', [\App\Http\Controllers\ThingsController::class, 'indexUsed'])->name('things_used');
Route::get('/places', [\App\Http\Controllers\PlaceController::class, 'index'])->name('places');
Route::get("/users", [\App\Http\Controllers\UserController::class, 'index'])->name('profiles');

Route::middleware("auth")-> group(function (){
    Route::group(["prefix"=>'/things'], function () {
        Route::get('/create', [\App\Http\Controllers\ThingsController::class, 'create'])->name('things_create');
        Route::post('/store', [\App\Http\Controllers\ThingsController::class, 'store'])->name('things_store');
        Route::get('/{id}', [\App\Http\Controllers\ThingsController::class, 'show'])->name('things_show');
        Route::post('/{id}/delete', [\App\Http\Controllers\ThingsController::class, 'destroy'])->name('things_delete');
        Route::get('/{id}/edit', [\App\Http\Controllers\ThingsController::class, 'edit'])->name('things_edit');
        Route::post('/{id}/edit', [\App\Http\Controllers\ThingsController::class, 'store'])->name('things_edit');
        Route::get('/{id}/edit', [\App\Http\Controllers\ThingsController::class, 'edit'])->name('things_edit');
    });
    Route::group(["prefix"=>'/users'], function () {
        Route::get("/{id}", [\App\Http\Controllers\UserController::class, 'show'])->name('profile');
    });
    Route::group(["prefix"=>'/places'], function () {
        Route::get('/create', [\App\Http\Controllers\PlaceController::class, 'create'])->name('places_create');
        Route::post('/store', [\App\Http\Controllers\PlaceController::class, 'store'])->name('places_store');
        Route::get('/{id}', [\App\Http\Controllers\PlaceController::class, 'show'])->name('places_show');
        Route::post('/{id}/delete', [\App\Http\Controllers\PlaceController::class, 'destroy'])->name('places_delete');
        Route::get('/{id}/edit', [\App\Http\Controllers\PlaceController::class, 'edit'])->name('places_edit');
        Route::post('/{id}/edit', [\App\Http\Controllers\PlaceController::class, 'store'])->name('places_edit');
    });
    Route::group(["prefix"=>'/uses'], function () {
        Route::get('{id}/create/', [\App\Http\Controllers\UseController::class, 'create'])->name('uses_create');
        Route::post('/store', [\App\Http\Controllers\UseController::class, 'store'])->name('uses_store');
        Route::post('/{thing_id}/{place_id}/{user_id}/delete', [\App\Http\Controllers\UseController::class, 'destroy'])->name('uses_delete');
    });
    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
});

Route::middleware("guest")-> group(function (){
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login_process', [\App\Http\Controllers\AuthController::class, 'login'])->name('login_process');
    Route::get('/register', [\App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register_process', [\App\Http\Controllers\AuthController::class, 'register'])->name('register_process');
});

