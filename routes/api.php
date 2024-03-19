<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\UserOpinionController;
use Modules\Admin\Http\Controllers\SiteInfoController;
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
Route::middleware(['setLocal'])->group(function () {
    //reviewed 
    Route::post('login', [AuthController::class, 'login']);
    Route::get('/get_terms_and_laws', [SiteInfoController::class, 'get_terms_and_laws']);
    Route::get('/get_last_offers', [SiteInfoController::class, 'get_last_offers']);
    Route::get('/get_about_us_site_info', [SiteInfoController::class, 'get_about_us_site_info']);
    Route::get('/get_home_site_info', [SiteInfoController::class, 'get_home_site_info']);
    Route::post('/add_conact_us_information', [ContactUsController::class, 'add_conact_us_information']);
    Route::get('/get_social_info', [SiteInfoController::class, 'get_social_info']);
    Route::post('/post_user_opinion', [UserOpinionController::class, 'post_user_opinions']);
    Route::get('/get_users_opinions', [UserOpinionController::class, 'get_users_opinions']);
    //reviewed
    // don't put any new route in reviewed section
    // you can put it here  
    //Route::get('/new_route ', [new_route::class, 'new_route']);
});


