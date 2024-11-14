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

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/validate-token', [AuthController::class, 'validate_token']);

Route::middleware('auth:sanctum')->controller(UserController::class)->group(function (){
  Route::get('/users', 'all_user');
  Route::get('/user-online', 'user_online');
  Route::post('/add-user', 'add_user');
  Route::get('/remove-user/{id}', 'remove_user');
  Route::get('/get-user-pk/{id}', 'get_user_pk');
  Route::post('/update-user', 'update_user');
});

Route::get('/list-menu', [SettingController::class, 'list_menu']);
Route::post('/update-setting', [SettingController::class, 'update_setting']);
Route::get('/data-image', [SettingController::class, 'data_image']);