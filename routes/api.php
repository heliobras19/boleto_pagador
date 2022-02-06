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


Route::get('nao_logado', function (){
   return response()->json([
        "msg" => "token inválido, faça autenticação por favor"
    ]);
})->name('login');

Route::group([
    'namespace' => 'App\Http\Controllers',
    'middleware' => 'api',

], function ($router) {
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
});


Route::group([
    'namespace' => 'App\Http\Controllers',
    'middleware' => 'api',
    'prefix' => 'boleto'

], function ($router) {
   Route::post('/', 'BoletoController@create');
   Route::put('/{boleto_id}', 'BoletoController@update');
   Route::delete('/{boleto_id}', 'BoletoController@destroy');
   Route::get('me', 'BoletoController@show');
   Route::get('pagador/{pagador_id}', 'BoletoController@pagador_boleto');
});

Route::group([
    'namespace' => 'App\Http\Controllers',
    'middleware' => 'api',
    'prefix' => 'pagador'

], function ($router) {
    Route::post('/', 'PagadorController@create');
    Route::put('/{pagador_id}', 'PagadorController@update');
    Route::delete('/{pagador_id}', 'PagadorController@destroy');
    Route::get('me', 'PagadorController@show');
});


