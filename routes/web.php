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

use App\User;
use App\RoleUser;

/*
//PRUEBAS 
use App\User;
use App\RoleUser;

Route::get('/estudiante', function(){

	$user = User::where("id", "=", 1)->first();
	return $user->user;

});
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
		Route::get('/ConsultarPersona','PersonaController@getPersona')->name('ConsultarPersona');

		//PROGRAMA
		Route::get('/programas/index', 'ProgramaController@index')->name('programas.index');
		Route::get('/programas/edit/{id}', 'ProgramaController@edit')->name('programas.edit');
		Route::put('/programas/{id}/{retorno?}/{idalterno?}', 'ProgramaController@update')->name('programas.update');

		//NUCLEO PROGRAMA
		Route::get('/nucleoprogramas/index', 'NucleoProgramaController@index')->name('nucleoprogramas.index');
		Route::get('/nucleoprogramas/edit/{id}', 'NucleoProgramaController@edit')->name('nucleoprogramas.edit');

		//ESTUDIANTES PROGRAMA
		Route::get('/aspirantes/index', 'AspiranteController@index')->name('aspirantes.index');
		Route::get('/postulacion','NucleoProgramaController@onPostulacion')->name('postulacion');

		//MUNICIPIO
		Route::get('/MunicipioEstado','MunicipioController@getMunicipiosEstado')->name('MunicipioEstado');

		//PARROQUIA
		Route::get('/ParroquiaMunicipio','ParroquiaController@getParroquiasMunicipio')->name('ParroquiaMunicipio');	

		//RETORNA EL ROL DEL USUARIO
		Route::get('/estudiante', function(){

			$usuario = User::where("id", "=", Auth::user()->id)->first();

			#El tipo de usuario
			if($usuario->user == 'Estudiante'){
				return "Es estudiante";
			}
			else return "No es estudiante";
			#Retorna el tipo de usuario
			#return $usuario->user;

		});

		//**********************************************************************//
		//Ruta que dirige a la seccion de Pagos
	Route::get('/pago/index', 'PagoController@index')->name('pago.index');
	Route::get('/pago/new', 'PagoController@new')->name('pago.new'); //aqui llama a la interfaz para nuevo pago
	Route::get('/pago/{id?}', 'PagoController@show')->name('pago.show');
	Route::post('/pago', 'PagoController@store')->name('pago.store');

	Route::get('/pagos/adminpago', 'PagoController@adminpago')->name('pago.adminpago');
	});