<?php

use App\Http\Controllers\API\DaftarCutiController;
use App\Http\Controllers\API\FormPengajuanController;
use App\Http\Controllers\API\KontakController;
use App\Http\Controllers\API\SisaCutiController;
use App\Http\Controllers\API\StatusPengajuanController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [UserController::class, 'login']);
Route::get('getListPengajuan', [StatusPengajuanController::class, 'getListPengajuan']);
Route::post('store', [KontakController::class, 'store']);
Route::post('formPengajuan', [FormPengajuanController::class, 'store']);
Route::post('updateProfile', [UserController::class, 'updateProfile']);
Route::post('changePassword', [UserController::class, 'changePassword']);
Route::get('sisaCuti', [SisaCutiController::class, 'sisaCuti']);
Route::get('daftarCutiToday', [DaftarCutiController::class, 'daftarCutiToday']);
