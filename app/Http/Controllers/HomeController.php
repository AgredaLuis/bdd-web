<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Notificacion;

//MANEJO DE TRANSACCIONES
use Illuminate\Support\Facades\DB;

//ANEXANDO SEGURIDAD
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        /*$CantidadNotificacion=Notificacion::where("idusuario", "=", Auth::user()->id)
            ->where("estatus", "=", 'A')  
            ->count();

        $Notificaciones = DB::table('notificaciones')
            ->select('notificaciones.*','solicitudes.folioexterior as folioexterior','bienesevaluar.foliointerno as foliointerno')     
            ->leftJoin('solicitudes', 'solicitudes.id', '=', 'notificaciones.idsolicitud')
            ->leftJoin('bienesevaluar', 'bienesevaluar.id', '=', 'notificaciones.idtipobien')
            ->where("idusuario", "=", Auth::user()->id) 
            ->where("notificaciones.estatus", "=", 'A')
            ->orderBy('notificaciones.id', 'desc')
            ->get();*/

        /*$Usuario = DB::table('users')
            ->select('datossat.nombre as nombresat','datoslgc.nombre as nombrelgc','datoslgc.apellidopat as apellidopat','datoslgc.apellidomat as apellidomat')     
            ->leftJoin('datoslgc', 'datoslgc.iduser', '=', 'users.id')
            ->leftJoin('datossat', 'datossat.iduser', '=', 'users.id')
            ->where("users.id", "=", Auth::user()->id)
            ->first();*/

        //Mostrar la vista de index
        /*return view('home',
            [
                //'Notificaciones' => $Notificaciones,
                'Usuario' => $Usuario
                //'CantidadNotificacion' => $CantidadNotificacion
            ]
        );*/

        return view('home');
    }
}
