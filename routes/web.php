<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UserController,
    ProfileController,
    RoleAndPermissionController
};

Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/', fn () => view('dashboard'));
    Route::get('/dashboard', fn () => view('dashboard'));

    Route::get('/profile', ProfileController::class)->name('profile');

    Route::resource('users', UserController::class);
    Route::resource('roles', RoleAndPermissionController::class);
});

Route::resource('departments', App\Http\Controllers\DepartmentController::class)->middleware('auth');
Route::resource('positions', App\Http\Controllers\PositionController::class)->middleware('auth');

Route::resource('employees', App\Http\Controllers\EmployeeController::class)->middleware('auth');
Route::resource('pengajuans', App\Http\Controllers\PengajuanController::class)->middleware('auth');