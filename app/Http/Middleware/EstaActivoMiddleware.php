<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class EstaActivoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check() && auth()->user()->estatus == 'D') {
            // usuario con sesión iniciada pero inactivo

            // cerramos su sesión
            Auth::guard()->logout();

            // invalidamos su sesión
            $request->session()->invalidate();

            // redireccionamos a donde queremos
            return redirect('/usuariobloqueado');
        }else{
            return $next($request);
        }
    }
}
