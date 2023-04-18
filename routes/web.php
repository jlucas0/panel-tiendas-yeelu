<?php

use Illuminate\Support\Facades\Route;

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


Route::view('/acceso','tienda.acceso')->name("login");
Route::post('/acceder',[\App\Http\Controllers\TiendaController::class,'acceder'])->name("acceder");
Route::post('/recuperar-clave',[\App\Http\Controllers\TiendaController::class,'recuperarClave'])->name("recuperar-clave");
Route::middleware('auth')->group(function(){
	Route::any('/logout',[\App\Http\Controllers\TiendaController::class,'salir'])->name("logout");
	Route::view('/datos','tienda.datos',['provincias'=>App\Models\Provincia::all()])->name("datos");
	Route::view('/productos','productos.lista')->name("productos");
	Route::view('/producto','productos.editar')->name("producto");
	Route::view('/marcas','marcas.lista')->name("marcas");
	Route::view('/marca','marcas.editar')->name("marca");
	Route::view('/','pedidos.lista')->name("pedidos");
});