<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Tienda;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\Aviso;

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
    public function salir(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('login'));
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
