<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Yajra\DataTables\DataTables;

use App\NucleoPrograma;
use App\Nucleo;
use App\Grado;
use App\EstudiantePrograma;

class AspiranteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->nombremodelo='EstudiantePrograma';
    }

    protected function inicializaPlucks()
    {
        
        //ARMA EL ARREGLO DE ESTADOS QUE SE CARGARAN EN EL SELECT
        $Nucleos = Nucleo::select('nombre','nombre')->groupBy("nombre","nombre")->pluck('nombre','nombre')->prepend('Todos', '');
        parent::addPluck('Nucleos',$Nucleos); 

        //OPCION SELECCIONADA EN EL MENU LATERAL IZQUIERDO
        parent::addPluck('NavItemActive','aspirantes');   
        
    }

    protected function inicializaColeccion($modelo)
    {

        $AspirantesProgramas = EstudiantePrograma::select('*')->where("condicion", "=", 'P')->where("activo", "=", true);
        
        return $AspirantesProgramas;

    }

}