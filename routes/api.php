<?php

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

Route::group([
    'namespace' => 'App\Http\Controllers',
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('login', 'AuthController@login');
});


Route::group([
    'namespace' => 'App\Http\Controllers',
    'middleware' => 'api',
    'prefix' => 'boleto'

], function ($router) {
   Route::post('create', 'BoletoController@create');
   Route::put('create/{boleto_id}', 'BoletoController@update');
   Route::delete('create/{boleto_id}', 'BoletoController@destroy');
   Route::get('me', 'BoletoController@show');
   Route::get('pagador/{pagador_id}', 'BoletoController@show');
});


Route::post('register', 'App\Http\Controllers\RegisterController@register');
