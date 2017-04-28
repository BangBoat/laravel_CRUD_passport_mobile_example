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

/*
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api'); 
*/

Route::middleware('auth:api')->group(function (){
    Route::resource('test', 'TestController');
    Route::get('user/logout', 'LoginController@logout');
    //for controller with tokens 
    Route::get('scan/{id}', 'ScanController@show');
    Route::post('search', 'SearchController@search');
    Route::get('search', 'SearchController@index');
    Route::get('economic', 'EconomicViewController@index');
});

Route::prefix('user')->group(function (){
    Route::resource('registration', 'RegisterController', ['only' => ['store']]);

    Route::post('login', 'LoginController@create');    
});




