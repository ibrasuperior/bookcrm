<?php

use Illuminate\Http\Request;

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
Route::post('login', 'AuthController@authenticate');


//PROTECTED ROUTES
Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('user', 'UserController@getAuthenticatedUser');

    /*
    /----------------------------------------------------------------
    / LEADS
    /----------------------------------------------------------------
    /
    /
    */
    Route::get('leads', 'MobileLeadController@index');
});