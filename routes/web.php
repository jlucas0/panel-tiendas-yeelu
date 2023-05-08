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
		Route::get('/',[\App\Http\Controllers\ProductoController::class,'listar'])->name("productos");
		Route::get('/crear',[\App\Http\Controllers\ProductoController::class,'crear'])->name("crear-producto");
		Route::post('/guardar',[\App\Http\Controllers\ProductoController::class,'guardar'])->name("guardar-producto");
		Route::post('/aplicar-descuento',[\App\Http\Controllers\ProductoController::class,'aplicarDescuento'])->name("aplicar-descuento");
		Route::post('/aplicar-descuento-masivo',[\App\Http\Controllers\ProductoController::class,'aplicarDescuentoMasivo'])->name("aplicar-descuento-masivo");
		Route::post('/quitar-descuento',[\App\Http\Controllers\ProductoController::class,'quitarDescuento'])->name("quitar-descuento");
		Route::post('/cambiar-estado',[\App\Http\Controllers\ProductoController::class,'cambiarEstado'])->name("cambiar-estado");
		Route::get('/editar/{id}',[\App\Http\Controllers\ProductoController::class,'editar'])->name("editar-producto");
		Route::post('/modificar',[\App\Http\Controllers\ProductoController::class,'modificar'])->name("modificar-producto");
		Route::get('/borrar/{id}',[\App\Http\Controllers\ProductoController::class,'borrar'])->name("borrar-producto");

	});
	
	Route::prefix('/marcas')->group(function(){
		/*Route::get('/',[\App\Http\Controllers\MarcaController::class,'listar'])->name("marcas");
		Route::get('/modificar/{id?}',[\App\Http\Controllers\MarcaController::class,'editar'])->name("marca");
		Route::get('/borrar/{id}',[\App\Http\Controllers\MarcaController::class,'borrar'])->name("borrar-marca");
		Route::post('/guardar',[\App\Http\Controllers\MarcaController::class,'guardar'])->name('guardar-marca');*/
		Route::post('/registrar',[\App\Http\Controllers\MarcaController::class,'crear'])->name('crear-marca');
	});
	
	Route::prefix('/pedidos')->group(function(){
		Route::get('/',[\App\Http\Controllers\PedidoController::class,'listar'])->name("pedidos");
		Route::get('/cargar',[\App\Http\Controllers\PedidoController::class,'cargar'])->name("cargar-pedidos");
		Route::get('/{id}',[\App\Http\Controllers\PedidoController::class,'ver'])->name("pedido");
	});
	Route::redirect('/', '/pedidos');

	Route::prefix('/incidencias')->group(function(){
		Route::post('/registrar',[\App\Http\Controllers\IncidenciaController::class,'registrar'])->name("registrar-incidencia");
	});


});