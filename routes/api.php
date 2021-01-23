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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['cors', 'json.response']], function () {
    // public routes
    Route::post('/login', 'Auth\ApiAuthController@login')->name('login.api');
    Route::post('/register','Auth\ApiAuthController@register')->name('register.api');
});

//Para usuarios general (padres,profesores,administradores)
Route::group(['middleware' => ['cors', 'json.response','auth:api']], function () {
    Route::post('/logout', 'Auth\ApiAuthController@logout')->name('logout.api');
});
//Para usuarios Profesores
Route::group(['middleware' => ['cors', 'json.response','auth:api','api.profesor']], function () {
   Route::get('/getAllAlumnos', 'AlumnoController@index')->name('index.api');
});
//Para usuarios Administradores
Route::group(['middleware' => ['cors', 'json.response','auth:api','api.administrador']], function () {
});
