<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/test', [AuthController::class, 'test']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/validate-token', [AuthController::class, 'validate_token']);
Route::middleware('auth:sanctum')->get('/users', [UserController::class, 'all_user']);
Route::middleware('auth:sanctum')->post('/add-user', [UserController::class, 'add_user']);
Route::middleware('auth:sanctum')->get('/remove-user/{id}', [UserController::class, 'remove_user']);
Route::middleware('auth:sanctum')->get('/get-user-pk/{id}', [UserController::class, 'get_user_pk']);
Route::middleware('auth:sanctum')->post('/update-user', [UserController::class, 'update_user']);
Route::post('/status', [AuthController::class, 'set_status']);

Route::get('/list-menu', [SettingController::class, 'list_menu']);
Route::post('/update-setting', [SettingController::class, 'update_setting']);
Route::get('/data-image', [SettingController::class, 'data_image']);