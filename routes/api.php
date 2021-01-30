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

//Para todos (no logeados y logeados)
Route::group(['middleware' => ['cors']], function () {
    Route::post('/login', 'Auth\ApiAuthController@login')->name('login.api');
});

//Para usuarios general (padres,profesores,administradores) 'json.response'
Route::group(['middleware' => ['cors','auth:api']], function () {
    Route::get('/logout', 'Auth\ApiAuthController@logout')->name('logout.api');
    Route::get('/usuarioLogeado', 'UserController@show');
    Route::get('/cambiarDatos', 'UserController@edit');
    Route::post('/registerUser','Auth\ApiAuthController@register')->name('register.api');
    Route::post('/getClase', 'ClaseController@show');
});

//Para usuarios Profesores
Route::group(['middleware' => ['cors','auth:api','api.profesor']], function () {
    Route::get('/getAllAlumnos', 'AlumnoController@index');
    Route::get('/addComentario', 'AlumnoController@createComentario');
  
});
//Para usuarios Administradores
Route::group(['middleware' => ['cors','auth:api','api.administrador']], function () {
    Route::get('/getAllUsuarios', 'UserController@index');
    Route::get('/getAllClases', 'ClaseController@index');
    Route::get('/createUser', 'UserController@create');
    Route::get('/createAlumno', 'AlumnoController@create');
    Route::post('/registerAlumno','Auth\ApiAuthController@registerAlumno');
});
