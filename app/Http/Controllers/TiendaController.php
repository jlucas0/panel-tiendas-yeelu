<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Tienda;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\Aviso;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class TiendaController extends Controller
{
    public function acceder(Request $request){
        $credenciales = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $credenciales['activa'] = 1;
        try{
            $tienda = Tienda::where("email",$request->email)->first();
            $error = 'Las credenciales introducidas no son correctas.';
            if($tienda){
                //Verificar que no está bloqueado
                $bloqueada = false;
                if($tienda->bloqueo_acceso){
                    $ahora = now();
                    $diferencia = $ahora->timestamp - $tienda->bloqueo_acceso->timestamp;
                    //Si la diferencia es menor a 30 minutos, no pasa
                    if($diferencia<(30*60)){
                        $bloqueada = true;
                        $error = "Acceso bloqueado debido a demasiados intentos fallidos de acceso. Vuelva a intentarlo más tarde o contacte con el equipo de soporte.";
                    }else{
                        $tienda->bloqueo_acceso = null;
                        $tienda->save();
                    }
                }
                if(!$bloqueada){
                    $recordar = ($request->has('recordar') ? true : false);
                    if (Auth::attempt($credenciales, $recordar)) {
                        $request->session()->regenerate();
                        return redirect()->intended(route('pedidos'));
                    }else{
                        $tienda->accesos_mal++;
                        if($tienda->accesos_mal>3){
                            $tienda->accesos_mal = 0;
                            $tienda->bloqueo_acceso = new \DateTime();
                        }
                        $tienda->save();
                    }
                }
            }
            return back()->withErrors([
                'warning' => $error,
            ]);
        }catch(\Exception $e){
            return back()->withErrors([
                'danger' => 'Se ha producido un error en el sistema.'.(config('app.env')!="production" ? " ".$e->getMessage():"")
            ]);
        }

    }
    public function salir(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('login'));
    }

    public function modificar(Request $request){
        if($request->isMethod('post')){
            $valido = $request->validate([
                "foto" => ["image","nullable","max:8192"],
                "logo" => ["image","nullable","max:4096"],
                "envio" => ["nullable","numeric","min:0"],
                "gratis" => ["nullable","numeric","min:0"],
                "tiempo" => ["nullable","max:30"],
                "video" => ["nullable","max:51200","mimetypes:video/avi,video/mpeg,video/mp4"],
                "clave" => ["nullable","confirmed",Password::min(8)->letters()->numbers()->symbols()],
            ],[
                'foto.image' => 'Debe ser de un formato de imagen válido',
                'logo.image' => 'Debe ser de un formato de imagen válido',
                'foto.max' => 'El tamaño máximo es de 8MB',
                'logo.max' => 'El tamaño máximo es de 4MB',
                'envio.numeric' => 'Debe ser un número válido',
                'envio.min' => 'Debe ser positivo',
                'gratis.numeric' => 'Debe ser un número válido',
                'gratis.min' => 'Debe ser positivo',
                'tiempo.max' => 'Máximo 30 caracteres',
                'video.max' => 'Máximo 50MB',
                'video.mimetypes' => 'Debe ser formato AVI, MPEG o MP4'

            ]);
            try{
                $tienda = Tienda::find(Auth::id());

                if(isset($valido['foto']) && $tienda->foto && Storage::disk('public')->exists($tienda->foto)){
                    Storage::disk('public')->delete($tienda->foto);
                }
                if(isset($valido['foto'])){
                    $tienda->foto = $request->file('foto')->store('tiendas','public');
                }
                if(isset($valido['logo']) && $tienda->logo && Storage::disk('public')->exists($tienda->logo)){
                    Storage::disk('public')->delete($tienda->logo);
                }
                if(isset($valido['logo'])){
                    $tienda->logo = $request->file('logo')->store('tiendas','public');
                }
                $tienda->descripcion = $request->descripcion;
                $tienda->coste_envio = $request->envio;
                $tienda->envio_gratis = $request->gratis;
                $tienda->tiempo_envio = $request->tiempo;
                if((isset($valido['video']) && $tienda->video && Storage::disk('public')->exists($tienda->video))||(!isset($valido['video']) && $request->borravideo=="si")){
                    Storage::disk('public')->delete($tienda->video);
                    $tienda->video = null;
                }
                if(isset($valido['video'])){
                    $tienda->video = $request->file('video')->store('tiendas','public');
                }
                if(isset($valido['clave'])){
                    $tienda->password = Hash::make($valido['clave']);
                }
                $tienda->save();
                return redirect('datos')->withErrors(['success' => "Datos actualizados"]);
            }catch(\Exception $e){
                return back()->withErrors([
                    'danger' => 'Se ha producido un error en el sistema.'.(config('app.env')!="production" ? " ".$e->getMessage():"")
                ]);
            }
        }
        return view('tienda.datos',["tienda"=>Tienda::find(Auth::id())]);
    }

    //Funciones Ajax
    public function recuperarClave(Request $request){
        $email = $request->email;
        $respuesta = ["resultado"=>1,"mensaje"=>"ok"];
        try{
            $tienda = Tienda::where("email",$request->email)->first();

            if($tienda && $tienda->activa){

                $nuevaClave = Str::random(10);

                Mail::to($email)->send(new Aviso("Recuperación de contraseña","La nueva clave para acceder es: $nuevaClave<br>Podrás cambiar la clave en la sección Datos dentro del panel."));
                $tienda->password = Hash::make($nuevaClave);
                $respuesta["mensaje"] = "Se han enviado las nuevas credenciales al correo indicado.";
            }else{
                $respuesta["resultado"] = 2;
                $respuesta["mensaje"] = "No se ha encontrado la cuenta.";
            }
        }catch(\Exception $e){
            $respuesta["resultado"] = 3;
            $respuesta["mensaje"] = "Se ha producido un error".(config('app.env')!="production" ? " ".$e->getMessage():"");
        }

        return response()->json($respuesta);
    }
}
