<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    UserController,
    ProfileController,
    RoleAndPermissionController
};

Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', ProfileController::class)->name('profile');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleAndPermissionController::class);
});
Route::get('/dashboard', function () {
    return redirect()->route('dashboard');
});
Route::resource('departments', App\Http\Controllers\DepartmentController::class)->middleware('auth');
Route::resource('positions', App\Http\Controllers\PositionController::class)->middleware('auth');
Route::resource('employees', App\Http\Controllers\EmployeeController::class)->middleware('auth');
Route::resource('pengajuans', App\Http\Controllers\PengajuanController::class)->middleware('auth');
Route::resource('contacts', App\Http\Controllers\ContactController::class)->middleware('auth');
Route::post('updateStatus', [App\Http\Controllers\LaporanController::class, 'updateStatus'])->name('updateStatus')->middleware('auth');
