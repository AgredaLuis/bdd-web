<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Notificacion;

//MANEJO DE TRANSACCIONES
use Illuminate\Support\Facades\DB;

//ANEXANDO SEGURIDAD
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Persona;

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

        $Persona = Persona::where("email", "=", Auth::user()->email)->first();
        
        return view('home',
            [
                'pluck' => ['NavItemActive' => 'inicio' , 'Persona' => $Persona],
            ]
        );

    }
}
