<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PedidoController extends Controller
{
    //
    public function listar(){
        return view('pedidos.lista');
    }

    public function ver($id){
        return view('pedidos.ver');
    }
}
