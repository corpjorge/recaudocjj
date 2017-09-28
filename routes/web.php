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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::group(['middleware' => 'auth'], function () {

  Route::resource('presupuestos', 'PresupuestoController');
  Route::get('presupuesto/{id}/edit', 'PresupuestoController@editar');
  Route::post('presupuesto/{id}', 'PresupuestoController@actualizar');
  Route::resource('prestamos', 'PrestamoController');
  Route::resource('clientes', 'ClienteController');
  Route::resource('cuotas', 'CuotaController');
  Route::post('prestamos/{id}', 'PrestamoController@store');
  Route::get('prestamos/create/{id}', 'PrestamoController@create');
  Route::get('prestamo/consulta', 'PrestamoController@consultaMesindex');
  Route::post('prestamo/consulta', 'PrestamoController@consultaMes');
  Route::post('clientes/buscar', 'ClienteController@buscar');
  Route::get('rol/{id}', 'HomeController@rol');


});
