<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//**********************************************************************//
// Ruta que dirige a la seccion de INICIAR SESION, esta es la ruta raiz //
Route::get('/', 'Auth\LoginController@showLoginForm');

//**********************************************************************//
// Ruta que dirige a la seccion de INICIAR SESION //
Route::get('/signin', 'Auth\LoginController@showLoginForm')->name('signin');
Route::post('/signin', 'Auth\LoginController@login');

//**********************************************************************//
// Ruta que dirige a la seccion de RECUPERAR CONTRASEÑA //
Route::get('forgotpassword', function () {
    return view('auth.forgotpassword');
})->name('forgotpassword');

//**********************************************************************//
// Ruta que dirige a la seccion de CREAR CUENTA DE USUARIO //
Route::get('newaccount', function () {
    return view('auth.newaccount');
})->name('newaccount');

//**********************************************************************//
// Ruta que dirige a la seccion de RESTABLECER CONTRASEÑA //
Route::get('resetpassword', function () {
    return view('auth.resetpassword');
})->name('resetpassword');

//**********************************************************************//
// Rutas de autenticación generadas //
/*
	Las rutas de autenticación se generan mediante un archivo instalado durante la generación del sistema de autenticación. se habilita mediante el comando "php artisan make:auth".
*/
Auth::routes();

//**********************************************************************//
// Ruta que dirige a la seccion para activar la CUENTA DE USUARIO //
Route::get('/user/activation/{token}','Auth\RegisterController@userActivation')->name('userActivation');


//PAGINA DE AVISO DE USUARIO BLOQUEADO
	//Route::get('/usuariobloqueado', 'UsuariobloqueadoController@index')->name('usuariobloqueado');

//SOLO USUARIO LOGUIADOS
	Route::middleware(['auth'])->group(function () {
		Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
		Route::get('/home', 'HomeController@index')->name('home');

		//PERSONAS
		Route::get('/personas/edit/{id}', 'PersonaController@edit')->name('personas.edit');
		Route::put('/personas/{id}/{retorno?}/{idalterno?}', 'PersonaController@update')->name('personas.update');

		//PROGRAMA
		Route::get('/programas/index', 'ProgramaController@index')->name('programas.index');

		//MUNICIPIO
		Route::get('/MunicipioEstado','MunicipioController@getMunicipiosEstado')->name('MunicipioEstado');

		//PARROQUIA
		Route::get('/ParroquiaMunicipio','ParroquiaController@getParroquiasMunicipio')->name('ParroquiaMunicipio');	

	});
