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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => ['web']], function ()
{
	Route::get('/', function () 
	{
		return view('welcome');
	});

	//Ruta para obtener el lenguaje seleccionado por el usuario
	//El método where() nos permite limitar el valor del parámetro {lang} 
	//solo a “en” o “es” para evitar que se asigne a la variable de sesión un idioma que no exista.
	Route::get('lang/{lang}', function ($lang)
	{
		session(['lang' => $lang]);
		return \Redirect::back();
	})->where([
		'lang' => 'en|es'
	]);
	
	Route::resource('cashiers', 'CajeraController');
	Route::resource('reportCashier', 'ReporteCajeraController');
	Route::post('deleteCashier/{id}', 'CajeraController@delete') -> name('deleteCashier');
	Route::post('captureReport', 'ReporteCajeraController@capturaReporte') -> name('captureReport');
	
});