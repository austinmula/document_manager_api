<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FileCategoryController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\PassportController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TemporaryFilesController;
use App\Http\Controllers\UserController;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::post('register', [PassportController::class, 'register']);
Route::post('login', [PassportController::class, 'login']);
Route::post('logout', [PassportController::class, 'logout']);

Route::resource('files', FilesController::class)->middleware('auth:api');
Route::resource('requests', RequestController::class)->middleware('auth:api');
Route::resource('temp-requests-files', TemporaryFilesController::class)->middleware('auth:api');


Route::group(['middleware' => 'role:admin'], function() {
    Route::resource('departments', DepartmentController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('file-categories', FileCategoryController::class);
});
