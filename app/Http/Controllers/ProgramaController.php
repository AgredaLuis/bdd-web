<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Yajra\DataTables\DataTables;

use App\Nucleo;
use App\Programa;

class ProgramaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->nombremodelo='Programa';
    }

    protected function inicializaPlucks()
    {
        
        //ARMA EL ARREGLO DE NUCLEOS QUE SE CARGARAN EN EL SELECT
        $Nucleos = Nucleo::select('nombre','id')->groupBy("nombre","id")->pluck('nombre','id')->prepend('Seleccione...', 'default');
        parent::addPluck('Nucleos',$Nucleos);      
        
    }    

}