<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MarcaController extends Controller
{
    //

    public function editar($id=null){
        $marca = null;
        if($id){
            $marca = Marca::find($id);
            if(!$marca || ($marca && $marca->tienda_id != Auth::id())){
                return back()->withErrors(["warning"=>"La marca solicitada no existe"]);
            }
        }

        return view('marcas.editar',["marca"=>$marca]);
    }

    public function listar(){

        //Marcas de la tienda
        $marcasTienda = Marca::with('productos')->where('tienda_id',Auth::id())->get();
        //Marcas generales
        $marcasYeelu = Marca::where('tienda_id',null)->get();

        return view('marcas.lista',['marcasTienda' => $marcasTienda,'marcasYeelu' => $marcasYeelu]);
    }

    public function guardar(Request $request){
        $valido = $request->validate([
            "nombre" => ["required","string","max:150"],
            "foto" => ["image","nullable","max:8192"],
            "id" => ["sometimes","required","exists:marcas,id"]
        ],[
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.string' => 'El nombre debe ser un texto válido',
            'nombre.max' => 'El nombre es demasiado largo',
            'foto.image' => 'La foto debe ser de un formato de imagen válido',
            'foto.max' => 'El tamaño máximo de la foto es de 8MB'
        ]);
        try{
            $marca = null;
            if(isset($valido['id'])){
                $marca = Marca::find($valido['id']);
            }else{
                $marca = new Marca();
            }
            $marca->nombre = $request->nombre;
            if(isset($valido['foto']) && $marca->foto && Storage::disk('public')->exists($marca->foto)){
                Storage::disk('public')->delete($marca->foto);
            }
            if(isset($valido['foto'])){
                $marca->foto = $request->file('foto')->store('marcas','public');
            }
            $marca->descripcion = $request->descripcion;
            $marca->tienda_id = Auth::id();
            $marca->save();
            return redirect('marcas')->withErrors(['success' => "Marca guardada"]);
        }catch(\Exception $e){
            if (!isset($valido['id']) && Storage::disk('public')->exists($marca->foto)) {
                Storage::disk('public')->delete($marca->foto);
            }
            return back()->withErrors([
                'danger' => 'Se ha producido un error en el sistema.'.(config('app.env')!="production" ? " ".$e->getMessage():"")
            ]);
        }
    }

    public function borrar($id){
        $marca = Marca::find($id);
        if(!$marca || ($marca && $marca->tienda_id != Auth::id())){
            return back()->withErrors(["warning"=>"La marca solicitada no existe"]);
        }
        else if(count($marca->productos)){
            return back()->withErrors(["danger"=>"No puedes borrar una marca con productos asociados"]);
        }else{
            if ($marca->foto && Storage::disk('public')->exists($marca->foto)) {
                Storage::disk('public')->delete($marca->foto);
            }
            $marca->delete();
            return redirect('marcas')->withErrors(["success"=>"Marca borrada"]);
        }
    }

    //Fúnción para AJAX
    public function crear(Request $request){
        $respuesta = ["resultado"=>1,"mensaje"=>"ok"];
        

        $validator = Validator::make($request->all(), [
            "nombre" => ["required","string","max:150"],
            "foto" => ["image","nullable","max:8192"],
        ],[
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.string' => 'El nombre debe ser un texto válido',
            'nombre.max' => 'El nombre es demasiado largo',
            'foto.image' => 'La foto debe ser de un formato de imagen válido',
            'foto.max' => 'El tamaño máximo de la foto es de 8MB'
        ]);
 
        if ($validator->fails()) {
            $respuesta["resultado"] = 0;
            $respuesta["mensaje"] = "Debes corregir los siguientes errores:";
            foreach($validator->errors()->all() as $error){
                $respuesta["mensaje"] .= "<br>$error";
            }
        }
        else{
            try{
                $valido = $validator->validated();
                $marca = new Marca();
                $marca->nombre = $request->nombre;
                if(isset($valido['foto'])){
                    $marca->foto = $request->file('foto')->store('marcas','public');
                }
                $marca->descripcion = $request->descripcion;
                $marca->tienda_id = Auth::id();
                $marca->save();
                $respuesta["mensaje"] = $marca->id;
            }catch(\Exception $e){
                if (Storage::disk('public')->exists($marca->foto)) {
                    Storage::disk('public')->delete($marca->foto);
                }
                $respuesta["mensaje"] = 'Se ha producido un error en el sistema.'.(config('app.env')!="production" ? " ".$e->getMessage():"");
                $respuesta["resultado"] = 0;
            }

        }



        return response()->json($respuesta);
    }

    
}
