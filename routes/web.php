<?php

use App\Http\Controllers\AuthManager;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NonVegController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VegController;
use App\Http\Controllers\DessertController;

Route::get('/', [AuthManager::class, 'login'])->name('login');
Route::post('/', [AuthManager::class, 'loginPost'])->name('login.post');
Route::get('/register', [AuthManager::class, 'registration'])->name('registration');
Route::post('/register', [AuthManager::class, 'registrationPost'])->name('registration.post');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/nonveg', [NonVegController::class, 'index'])->name('nonveg.index');
    Route::get('/nonveg/create', [NonVegController::class, 'create'])->name('nonveg.create');
    Route::post('/nonveg', [NonVegController::class, 'store'])->name('nonveg.store');
    Route::get('/nonveg/details/{id}', [NonVegController::class, 'show'])->name('nonveg.details');
    Route::get('/nonveg/search', [NonVegController::class, 'search'])->name('nonveg.search');
    Route::get('/veg', [VegController::class, 'index'])->name('veg.index');
    Route::get('/veg/create', [VegController::class, 'create'])->name('veg.create');
    Route::post('/veg', [VegController::class, 'store'])->name('veg.store');
    Route::get('/veg/details/{id}', [VegController::class, 'show'])->name('veg.details');
    Route::get('/veg/search', [VegController::class, 'search'])->name('veg.search');
    Route::get('/dessert', [DessertController::class, 'index'])->name('dessert.index');
    Route::get('/dessert/create', [DessertController::class, 'create'])->name('dessert.create');
    Route::post('/dessert', [DessertController::class, 'store'])->name('dessert.store');
    Route::get('/dessert/details/{id}', [DessertController::class, 'show'])->name('dessert.details');
    Route::get('/dessert/search', [DessertController::class, 'search'])->name('dessert.search');
});
Route::post('/logout', [AuthManager::class, 'logout'])->name('logout');