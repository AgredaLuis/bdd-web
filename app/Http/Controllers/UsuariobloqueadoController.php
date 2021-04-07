<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuariobloqueadoController extends Controller
{

    /**
     * Muestra mensaje de usuario bloqueado
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('usuariobloqueado');
    }
}
