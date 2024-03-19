<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Parents\Http\Controllers\API\GuardianController;
use Modules\Students\Http\Controllers\API\StudentController;

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

Route::middleware('auth:api')->get('/parents', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum', 'setLocal'])->group(function () {
    //Routes that needs Authentication to access
    Route::get('/get_student_by_guardian/{guardian_id}', [StudentController::class, 'get_student_by_guardian']);

    Route::get('/get_guardian_profile', [GuardianController::class, 'get_guardian_profile']);

    Route::post('update_guardian_password ', [GuardianController::class, 'update_guardian_password']);
});
