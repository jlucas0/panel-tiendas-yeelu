<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pedido;

class PedidoController extends Controller
{
    //
    public function listar(){
        $pedidosPendientes = Pedido::select(["pedidos.id","pedidos.estado","pedidos.created_at"])->selectRaw("(SELECT SUM(cantidad*precio_ud-descuento) FROM linea_pedidos WHERE pedido_id = pedidos.id) as precio")->selectRaw("(SELECT COUNT(id) FROM incidencias WHERE pedido_id = pedidos.id AND estado='pendiente') as incidencias")->where('tienda_id',Auth::id())->whereIn('estado',['pendiente','aceptado','preparado','enviado'])->orderBy('id','desc')->get();
        $pedidosTerminados = Pedido::where('tienda_id',Auth::id())->whereIn('estado',['completado','cancelado'])->take(20)->orderBy('id','desc')->get();
        return view('pedidos.lista',["pendientes"=>$pedidosPendientes,"terminados"=>$pedidosTerminados]);
    }

    public function ver($id){
        return view('pedidos.ver');
    }

    //Función AJAX
    public function cargar(Request $request){
        $pedidosTerminados = Pedido::where('tienda_id',Auth::id())->whereIn('estado',['completado','cancelado'])->take(20)->skip($request->inicio)->orderBy('id','desc')->get();
        return response()->json($pedidosTerminados);
    }
}
