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
	Route::match(['get','post'],'/datos',[\App\Http\Controllers\TiendaController::class,'modificar'])->name("datos");
	
	Route::prefix('/productos')->group(function(){
		Route::view('/','productos.lista')->name("productos");
		Route::get('/crear',[\App\Http\Controllers\ProductoController::class,'crear'])->name("crear-producto");
		Route::post('/guardar',[\App\Http\Controllers\ProductoController::class,'guardar'])->name("guardar-producto");

	});
	
	Route::prefix('/marcas')->group(function(){
		Route::get('/',[\App\Http\Controllers\MarcaController::class,'listar'])->name("marcas");
		Route::get('/modificar/{id?}',[\App\Http\Controllers\MarcaController::class,'editar'])->name("marca");
		Route::get('/borrar/{id}',[\App\Http\Controllers\MarcaController::class,'borrar'])->name("borrar-marca");
		Route::post('/guardar',[\App\Http\Controllers\MarcaController::class,'guardar'])->name('guardar-marca');
	});
	
	Route::prefix('/pedidos')->group(function(){
		Route::get('/',[\App\Http\Controllers\PedidoController::class,'listar'])->name("pedidos");
		Route::get('/{id}',[\App\Http\Controllers\PedidoController::class,'ver'])->name("pedido");
	});
	Route::redirect('/', '/pedidos');


});