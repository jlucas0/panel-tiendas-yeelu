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

Route::view('/acceso','acceso')->name("login");
Route::view('/datos','datos',['provincias'=>App\Models\Provincia::all()])->name("datos");
Route::view('/productos','productos')->name("productos");
Route::view('/marcas','marcas')->name("marcas");
