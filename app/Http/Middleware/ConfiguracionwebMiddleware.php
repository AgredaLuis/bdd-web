<?php

namespace App\Http\Middleware;

use Closure;
use App\Configuracionweb;

/**
 * FILTRO QUE SE ENCARGARA DE BUSCAR TODAS LAS VARIABLES NECESARIAS DEL SISTEMA Y LO GUARDA EN LA SESION
 */
class ConfiguracionwebMiddleware
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
        //BUSCANDO LAS CONFIGURACIONES DEL SITIO WEB
            $ConfiguracionWebs = Configuracionweb::all();
            foreach ($ConfiguracionWebs as $ConfiguracionWeb) {
                $nombre = $ConfiguracionWeb->nombre;
                $parametros = $ConfiguracionWeb->parametros;

                if(!session()->has('Configuracion.Web.'.$nombre)) {
                    session()->put('Configuracion.Web.'.$nombre, $parametros);
                }
            }
        return $next($request);
    }
}
