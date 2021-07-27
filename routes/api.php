<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
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

// Route::post('signup','AuthController@signUp');

// namespace is custom folder name where we create controller,as here 'Api' folder
Route::namespace('Api')->group(function(){
    Route::prefix('auth')->group(function(){
        Route::post('login',[AuthController::class, 'login']);
        Route::post('signup',[AuthController::class, 'signUp']);

    });

    // To add authentication,we will use middleware
    Route::group([
        'middleware'=>'auth:api'
    ],function(){
        Route::get('getdata',[AuthController::class, 'getdata']);
        Route::get('logout',[AuthController::class, 'logOut']);
    });

});
