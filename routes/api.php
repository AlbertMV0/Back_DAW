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
    Route::get('/usuarioLogeado', 'UserController@userLogeado');
    Route::post('/getUser', 'UserController@show');
    Route::post('/editAlumno', 'AlumnoController@edit');
    Route::post('/editUser', 'UserController@edit');
    Route::post('/registerUser','Auth\ApiAuthController@register')->name('register.api');
    Route::post('/getClase', 'ClaseController@show');
    Route::post('/getAlumno', 'AlumnoController@show');
    Route::post('/verComentarios', 'AlumnoController@verComentarios');

});

//Para usuarios Profesores
Route::group(['middleware' => ['cors','auth:api','api.profesor']], function () {
    Route::get('/getAllAlumnos', 'AlumnoController@index');
    Route::get('/addComentario', 'AlumnoController@createComentario');
    Route::post('/addComentario', 'AlumnoController@crearComentario');
  
});
//Para usuarios Administradores
Route::group(['middleware' => ['cors','auth:api','api.administrador']], function () {
    Route::get('/getAllClases', 'ClaseController@index');
    Route::post('/editClase', 'ClaseController@edit');
    Route::get('/createUser', 'UserController@create');
    Route::get('/getAllUsuarios', 'UserController@index');
    Route::post('/createAlumno', 'AlumnoController@create');
    Route::post('/registerAlumno','Auth\ApiAuthController@registerAlumno');
    Route::post('/createAlumno', 'AlumnoController@create');
    Route::post('/deleteUser', 'UserController@destroy');
    Route::post('/deleteAlumno', 'AlumnoController@destroy');
});
