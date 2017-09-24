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

Route::get('auth/{provider}', 'Auth\loginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\loginController@handleProviderCallback');

Route::group(['middleware' => 'auth'], function () {

  Route::resource('presupuestos', 'PresupuestoController');
  Route::resource('prestamos', 'PrestamoController');
  Route::resource('clientes', 'ClienteController');
  Route::resource('cuotas', 'CuotaController');
  Route::post('prestamos/{id}', 'PrestamoController@store');
  Route::get('prestamos/create/{id}', 'PrestamoController@create');

});
