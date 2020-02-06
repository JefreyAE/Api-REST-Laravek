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
//******Rutas de pruebas*****//
Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/pruebas','PruebasController@index');
Route::get('/test','PruebasController@testOrm');
//****** Fin Rutas de pruebas*****//

//RUTAS DEL API

//Rutas para Posts
Route::get('/entradas/pruebas','PostController@pruebas');

//Rutas para Category
Route::get('/categorias/pruebas','CategoryController@pruebas');

//Rutas para User
Route::get('/api/pruebas','UserController@pruebas');
Route::post('/api/registro','UserController@register');
Route::post('/api/loguear','UserController@login');