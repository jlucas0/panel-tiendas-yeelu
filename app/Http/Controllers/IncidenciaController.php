<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incidencia;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class IncidenciaController extends Controller
{
    //

    public function registrar(Request $request){
        $validator = Validator::make($request->all(), [
            "pedido" => ["required","exists:pedidos,id"],
            "motivo" => ["required",Rule::in(["stock","otro"])],
            "informacion" => ["required"],
        ],[
            'pedido.required' => 'No se ha especificado el pedido',
            'pedido.exists' => 'El pedido no es válido',
            'motivo.required' => 'No se ha especificado el motivo',
            'motivo.in' => 'Motivo no válido',
            'informacion.required' => 'No se ha proporcionado información para la incidencia'
        ]);
 
        if ($validator->fails()) {
            $mensaje = "";
            foreach($validator->errors()->all() as $error){
                $mensaje .= "$error";
            }
            return back()->withErrors(["warning"=>$error]);
        }
        try{
            $valido = $validator->validated();
            //Verificar que el pedido es de la tienda
            if(Pedido::find($valido['pedido'])->tienda_id!=Auth::id()){
                return back()->withErrors(["warning"=>"Pedido no válido"]);
            }
            $incidencia = new Incidencia();
            $incidencia->motivo = $valido["motivo"];
            $incidencia->observaciones = $valido["informacion"];
            $incidencia->pedido_id = $valido["pedido"];
            $incidencia->save();
            //TODO: Avisar por email
            
            return back()->withErrors(['success' => "Incidencia registrada. Recibirás respuesta lo antes posible."]);
        }catch(\Exception $e){
            return back()->withErrors([
                'danger' => 'Se ha producido un error en el sistema.'.(config('app.env')!="production" ? " ".$e->getMessage():"")
            ]);
        }
    }

}
