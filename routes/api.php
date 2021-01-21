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
//Aqui irán las rutas protegidas, solo para usuarios autentificados
Route::middleware('auth:api')->get('/user', function (Request $request) {
    Route::post('/logout', 'Auth\ApiAuthController@logout')->name('logout.api');

});
<<<<<<< Updated upstream
=======
Route::get('usuarios','UsuarioController@getAllUsuarios');

//rousources para generar 
Route::resource('usuarioss','UsuarioController@getAllUsuarios');

//Nuestras rutas públicas irán aqui:
Route::group(['middleware' => ['cors', 'json.response']], function () {
     // public routes
     Route::post('/login', 'Auth\ApiAuthController@login')->name('login.api');
     Route::post('/register','Auth\ApiAuthController@register')->name('register.api');
 
     // ...
});
>>>>>>> Stashed changes
