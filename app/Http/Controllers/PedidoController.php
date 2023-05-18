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
        $pedido = Pedido::with(['incidencias','lineaPedido','lineaPedido.referencia','lineaPedido.referencia.producto','lineaPedido.referencia.producto.marca'])->find($id);
        if(!$pedido || $pedido->tienda_id!=Auth::id()){
            return back()->withErrors(["warning"=>"Pedido no encontrado"]);
        }
        return view('pedidos.ver',["pedido"=>$pedido,"incidenciasPendientes"=>$pedido->incidencias()->where('estado','pendiente')->get()]);
    }

    public function actualizar($id){
        try{
            $pedido = Pedido::find($id);
            if(!$pedido || $pedido->tienda_id!=Auth::id() || count($pedido->incidencias()->where('estado','pendiente')->get())>0){
                return back()->withErrors(["warning"=>"Pedido no encontrado"]);
            }
            $mensaje = "";
            //Actuar según estado actual
            if($pedido->estado == 'pendiente'){
                $pedido->estado = "aceptado";
                $mensaje = "Pedido aceptado correctamente. Puedes preparar los productos.";
                //TODO: Notificar cliente
            }
            else if($pedido->estado == 'aceptado'){
                $pedido->estado = "preparado";
                //TODO: Solicitar transporte
                //TODO: Notificar cliente
                $mensaje = "Solicitud de recogida transmitida a transportista. Imprime la etiqueta a continuación.";
            }

            $pedido->save();

            return back()->withErrors(["success"=>$mensaje]);

        }catch(\Exception $e){
            return back()->withErrors([
                'danger' => 'Se ha producido un error en el sistema.'.(config('app.env')!="production" ? " ".$e->getMessage():"")
            ]);
        }
    }

    //Función AJAX
    public function cargar(Request $request){
        $pedidosTerminados = Pedido::where('tienda_id',Auth::id())->whereIn('estado',['completado','cancelado'])->take(20)->skip($request->inicio)->orderBy('id','desc')->get();
        return response()->json($pedidosTerminados);
    }
}
