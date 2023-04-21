<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class MarcaController extends Controller
{
    //
    public function guardar(Request $request){
        $valido = $request->validate([
            "nombre" => ["required","string","max:150"],
            "foto" => ["image","nullable","max:8192"]
        ],[
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.string' => 'El nombre debe ser un texto válido',
            'nombre.max' => 'El nombre es demasiado largo',
            'foto.image' => 'La foto debe ser de un formato de imagen válido',
            'foto.max' => 'El tamaño máximo de la foto es de 8MB'
        ]);
        try{
            $marca = new Marca();
            $marca->nombre = $request->nombre;
            if(isset($valido['foto'])){
                $marca->foto = $request->file('foto')->store('marcas','public');
            }
            $marca->descripcion = $request->descripcion;
            $marca->tienda_id = Auth::id();
            $marca->save();
            return redirect('marcas')->withErrors(['success' => "Marca guardada"]);
        }catch(\Exception $e){
            if (Storage::disk('public')->exists($marca->foto)) {
                Storage::disk('public')->delete($marca->foto);
            }
            return back()->withErrors([
                'danger' => 'Se ha producido un error en el sistema.'.(config('app.env')!="production" ? " ".$e->getMessage():"")
            ]);
        }
    }
}
