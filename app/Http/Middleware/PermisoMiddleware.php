<?php

namespace App\Http\Middleware;

use Closure;
use App\Permiso;
use App\Modulo;

use Illuminate\Support\Facades\Route;

class PermisoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //ARMANDO EL MENU DEL USUARIO
        $ruta= Route::getCurrentRoute()->getActionName();
        $accion=explode('@', Route::getCurrentRoute()->getActionName())[1];
        $objpermiso = new Permiso;

        if(auth()->user()->tipousuario["nombre"] == 'Administrador LGC'){

            $menu = $objpermiso->menu(0,/*auth()->user()->id*/1,$ruta,$accion);

        }

        if(auth()->user()->tipousuario["nombre"] == 'Administrador SAT'){

            $menu = $objpermiso->menu(0,/*auth()->user()->id*/5000,$ruta,$accion);

        }


        if(auth()->user()->tipousuario["nombre"] == 'Usuario SAT' || auth()->user()->tipousuario["nombre"] == 'Revisor' || auth()->user()->tipousuario["nombre"] == 'Valuador'){

            $menu = $objpermiso->menu(0,/*auth()->user()->id*/10000,$ruta,$accion);
        }
        
        session()->put('Menu',$menu);

        //VERIFICANDO LA PERMISOLOGIA DEL USUARIO
        $nombreruta= Route::currentRouteName(); // Nombre de la ruta;
        if($nombreruta=='home' || $nombreruta=='logout'){
            return $next($request);
        }else{
            $iduser=auth()->user()->id;
            // $validez=true; //SOLO PROGRAMACION

            //VERIFICAMOS SI MODULO ES UNA FUNCION AJAX SI ES AJAX SIEMPRE ACTIVO
            $canti = Modulo::where("nombreruta", "=", $nombreruta)->where("ajax", "=", "1")->count();
            if($canti>0){
                $validez=true;
            }else{
                //BUSCAR SI EL USUARIO TIENE PERMISO PARA ESE NOMBRE RUTA
                $objPermiso = new Permiso;
                $validez=$objPermiso->VerificarPermiso($iduser,$nombreruta);
            }
             $validez=true;
            if($validez==true){
                return $next($request);
            }else{
                return redirect('/home');
            }
        }
    }
}
