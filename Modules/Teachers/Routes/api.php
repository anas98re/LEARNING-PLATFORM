<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Teachers\Http\Controllers\TeachersController;

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

Route::middleware('auth:api')->get('/teachers', function (Request $request) {
    return $request->user();
});
Route::middleware(['auth:sanctum', 'setLocal'])->group(function () {
    //Routes that needs Authentication to access
    Route::get('/get_teacher_profile', [TeachersController::class, 'get_teacher_profile']);
    Route::post('update_teacher_password ', [TeachersController::class, 'update_teacher_password']);
});

Route::get('/get_teacher_by_id/{id}', [TeachersController::class, 'get_teacher_by_id']);
