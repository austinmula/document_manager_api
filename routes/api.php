<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\PassportController;
use App\Http\Controllers\PermissionController;
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

Route::resource('files', FilesController::class)->middleware('auth:api');
Route::resource('departments', DepartmentController::class);
Route::resource('permissions', PermissionController::class);

Route::group(['middleware' => 'role:admin'], function() {
    Route::get('/user', function() {
        return 'Welcome...!!';
    });
});
