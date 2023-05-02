<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Referencia;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\Foto;
use App\Models\GrupoEtiqueta;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    //
    public function crear(){

        $marcas = Marca::where('tienda_id',null)->orWhere('tienda_id',Auth::id())->orderBy('nombre','asc')->get();
        $categorias = DB::table('subsubcategorias')->select('subsubcategorias.id','subsubcategorias.nombre','subcategorias.nombre as subcategoria')->join('subcategorias','subcategoria_id','=','subcategorias.id')->orderBy('subcategorias.nombre','asc')->orderBy('subsubcategorias.nombre','asc')->get();
        $productos = Producto::with('marca')->where('confirmado',1)->get();
        $etiquetas = GrupoEtiqueta::with('etiquetas')->get();
        return view('productos.crear',["marcas" => $marcas,"categorias" => $categorias,"productos"=>$productos,"etiquetas"=>$etiquetas]);
    }

    public function guardar(Request $request){
        
        $validaciones = [
            "codigo" => ['required','max:150',Rule::unique('referencias')->where(fn ($query) => $query->where('tienda_id', Auth::id()))],
            "precio" => ['required','min:0','numeric'],
            "maximo" => ['nullable','min:1','numeric'],
        ];
        $textos = [
            "codigo.required" => "Campo obligatorio",
            "codigo.max" => "Máximo 150 caracteres",
            "codigo.unique" => "Ya existe el código",
            "precio.min" => "El valor mínimo es 0",
            "precio.required" => "Campo obligatorio",
            "precio.numeric" => "Debe ser un número válido",
            "maximo.min" => "El valor mínimo es 1",
            "maximo.numeric" => "Debe ser un número válido" 
        ];

        //Si está creando solamente una referencia
        if($request->accion == 'buscar'){
            $validaciones["seleccionado"] = ['required','exists:productos,id'];
            $textos['seleccionado.required'] = "Debes elegir un producto existente";
            $textos['seleccionado.exists'] = "El producto seleccionado no está en la lista";
        }

        //Si es un producto nuevo
        else{
            $validaciones["nombre"] = ['required','max:200'];
            $textos["nombre.required"] = "Campo obligatorio";
            $textos["nombre.max"] = "Texto demasiado largo";
            $validaciones["categoria"] = ['required','exists:subsubcategorias,id'];
            $textos["categoria.required"] = "Campo obligatorio";
            $textos["categoria.exists"] = "Elige una categoría válida";
            $validaciones["marca"] = ['required','exists:marcas,id'];
            $textos["marca.required"] = "Campo obligatorio";
            $textos["marca.exists"] = "Elige una categoría válida";
            $validaciones["fotos.*"] = ['nullable','image','max:4096'];
            $textos["fotos.*.image"] = "Alguna foto no tenía un formato válido";
            $textos["fotos.*.max"] = "Las fotos no pueden superar los 4MB cada una";
            $validaciones["peso"] = ['nullable','numeric','min:1'];
            $textos["peso.numeric"] = "No es un número válido";
            $textos["peso.min"] = "El mínimo es 1";
            $validaciones["kcal"] = ['nullable','numeric'];
            $textos["kcal.numeric"] = "No es un número válido";
            $validaciones["grasas"] = ['nullable','numeric'];
            $textos["grasas.numeric"] = "No es un número válido";
            $validaciones["saturadas"] = ['nullable','numeric'];
            $textos["saturadas.numeric"] = "No es un número válido";
            $validaciones["hidratos"] = ['nullable','numeric'];
            $textos["hidratos.numeric"] = "No es un número válido";
            $validaciones["azucar"] = ['nullable','numeric'];
            $textos["azucar.numeric"] = "No es un número válido";
            $validaciones["proteinas"] = ['nullable','numeric'];
            $textos["proteinas.numeric"] = "No es un número válido";
            $validaciones["sal"] = ['nullable','numeric'];
            $textos["sal.numeric"] = "No es un número válido";
            $validaciones["etiquetas.*"] = ['nullable','exists:etiquetas,id'];
            $textos["etiquetas.*.exists"] = "Alguna etiqueta no es válida";
        }

        $valido = $request->validate($validaciones,$textos);

        try{

            $productoId = null;

            if($request->accion == 'crear'){
                //Datos del producto
                $producto = new Producto();
                $producto->nombre = $valido["nombre"];
                if(isset($valido["peso"])){
                    $producto->peso = $valido["peso"];
                    $producto->unidad = $request->unidad;
                }
                $producto->descripcion = $request->descripcion;
                $producto->ingredientes = $request->ingredientes;
                if(isset($valido["kcal"])){
                    $producto->kcal = $valido["kcal"];
                }
                if(isset($valido["grasas"])){
                    $producto->grasas = $valido["grasas"];
                }
                if(isset($valido["saturadas"])){
                    $producto->saturadas = $valido["saturadas"];
                }
                if(isset($valido["hidratos"])){
                    $producto->hidratos = $valido["hidratos"];
                }
                if(isset($valido["azucar"])){
                    $producto->azucar = $valido["azucar"];
                }
                if(isset($valido["proteinas"])){
                    $producto->proteinas = $valido["proteinas"];
                }
                if(isset($valido["sal"])){
                    $producto->sal = $valido["sal"];
                }
                $producto->confirmado = false;
                $producto->marca_id = $valido["marca"];
                $producto->subsubcategoria_id = $valido["categoria"];
                $producto->save();
                $productoId = $producto->id;
                //Sus fotos
                if(isset($request->fotos)){
                    foreach($request->fotos as $i=>$foto){
                        $path = $foto->store('productos','public');
                        $fotoBd = new Foto();
                        if($i==$request->fotoPrincipal){
                            $fotoBd->principal = true;
                        }
                        $fotoBd->direccion = $path;
                        $fotoBd->producto_id = $productoId;
                        $fotoBd->save();
                    }
                }
                //Referencia a las etiquetas
                if(isset($request->etiquetas)){
                    foreach($request->etiquetas as $etiqueta){
                        $producto->etiquetas()->attach($etiqueta);
                    }
                }
            }
            else{
                $productoId = $valido['seleccionado'];
            }

            $referencia = new Referencia();
            $referencia->codigo = $valido['codigo'];
            $referencia->precio = $valido['precio'];
            if(isset($valido['maximo'])){
                $referencia->maximo = $valido['maximo'];
            }
            $referencia->disponible = true;
            $referencia->producto_id = $productoId;
            $referencia->tienda_id = Auth::id();
            $referencia->save();
            return redirect('productos')->withErrors(['success' => "Producto registrado"]);
        }catch(\Exception $e){
            return back()->withErrors([
                'danger' => 'Se ha producido un error en el sistema.'.(config('app.env')!="production" ? " ".$e->getMessage():"")
            ]);
        }
    
    }

    //EDITAR con descuento

    public function listar(){

        $referencias = Referencia::with(['producto','producto.fotos'=>function ($query) {
            $query->where('principal', 1);
        },'producto.subsubcategoria.subcategoria','producto.marca'])->where('tienda_id',Auth::id())->get();
        $marcas = DB::table('marcas')->join('productos','marcas.id','=','productos.marca_id')->join('referencias','productos.id','=','referencias.producto_id')->where('referencias.tienda_id',Auth::id())->select('marcas.nombre')->orderBy('marcas.nombre','asc')->groupBy('marcas.nombre')->get();
        $categorias = DB::table('subsubcategorias')->join('subcategorias','subcategorias.id','=','subsubcategorias.subcategoria_id')->join('productos','subsubcategorias.id','=','productos.subsubcategoria_id')->join('referencias','productos.id','=','referencias.producto_id')->where('referencias.tienda_id',Auth::id())->select('subsubcategorias.nombre as subsubcategoria','subcategorias.nombre as subcategoria')->orderBy('subcategorias.nombre','asc')->groupBy('subsubcategorias.nombre')->get();
        return view('productos.lista',["referencias"=>$referencias,"marcas" => $marcas,"categorias" => $categorias]);
    }

    //Funciones AJAX
    public function aplicarDescuento(Request $request){
        $respuesta = ["resultado"=>1,"mensaje"=>"ok"];
        

        $validator = Validator::make($request->all(), [
            "id" => ["required","exists:referencias,id"],
            "descuento" => ["required","numeric","min:0.01"],
            "fecha" => ["nullable","date"],
        ],[
            'id.required' => 'No se ha especificado el producto',
            'id.exists' => 'No se ha encontrado el producto',
            'descuento.required' => 'No se ha indicado el descuento',
            'descuento.numeric' => 'El importe no es un número válido',
            'descuento.min' => 'El descuento es demasiado bajo',
            'fecha.date' => 'La fecha no tiene un formato válido',
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
                $referencia = Referencia::find($valido['id']);
                //Validar además que fecha sea mayor a hoy y descuento menor a precio base del producto
                if(isset($valido["fecha"])){
                    $hoy = new \DateTime();
                    $fechaFin = new \DateTime($valido["fecha"]);
                    if($fechaFin<$hoy){
                        $respuesta["mensaje"] = "La fecha tiene que ser posterior a la del día de hoy";
                    }
                    $referencia->fin_descuento = $valido["fecha"];
                }
                
                if($valido["descuento"] >= $referencia->precio){
                    $respuesta["mensaje"] = "El descuento supera al precio del producto";
                }
                
                $referencia->descuento = $valido["descuento"];
                
                if($respuesta["mensaje"] == "ok"){
                    $referencia->save();
                }else{
                    $respuesta["resultado"] = 0;
                }
            }catch(\Exception $e){
                $respuesta["mensaje"] = 'Se ha producido un error en el sistema.'.(config('app.env')!="production" ? " ".$e->getMessage():"");
                $respuesta["resultado"] = 0;
            }

        }



        return response()->json($respuesta);
    }
}
