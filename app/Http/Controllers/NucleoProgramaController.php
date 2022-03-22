<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Yajra\DataTables\DataTables;

use App\NucleoPrograma;
use App\Nucleo;
use App\Grado;

class NucleoProgramaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->nombremodelo='NucleoPrograma';
    }

    protected function inicializaPlucks()
    {
        
        //ARMA EL ARREGLO DE ESTADOS QUE SE CARGARAN EN EL SELECT
        $Nucleos = Nucleo::select('nombre','nombre')->groupBy("nombre","nombre")->pluck('nombre','nombre')->prepend('Todos', '');
        parent::addPluck('Nucleos',$Nucleos);

        //ARMA EL ARREGLO DE UNIVERSIDADES QUE SE CARGARAN EN EL SELECT
        $Tipos = Grado::select('titulo','titulo')->groupBy("titulo","titulo")->pluck('titulo','titulo')->prepend('Todos', '');
        parent::addPluck('Tipos',$Tipos);   

        //OPCION SELECCIONADA EN EL MENU LATERAL IZQUIERDO
        parent::addPluck('NavItemActive','ofertaacademica');   
        
    }

    protected function inicializaColeccion($modelo)
    {

	    $NucleoProgramas = DB::table('nucleosprogramas')
	    ->select('nucleosprogramas.id as id','programas.nombre as programa','nucleos.nombre as nucleo','menciones.nombre as mencion','grados.titulo as tipo','programaciones.id as programacion')     
	    ->leftJoin('programas', 'programas.id', '=', 'nucleosprogramas.id_programa')
	    ->leftJoin('nucleos', 'nucleos.id', '=', 'nucleosprogramas.id_nucleo')
	    ->leftJoin('menciones', 'menciones.id_programa', '=', 'programas.id')
	    ->leftJoin('grados', 'grados.id', '=', 'programas.id_grado')
        ->leftJoin('programaciones', 'programaciones.id_nucleoprograma', '=', 'nucleosprogramas.id')
        ->leftJoin('tiposprogramaciones', 'tiposprogramaciones.id', '=', 'programaciones.id_tipoprogramacion')
	    ->where("nucleosprogramas.activo", "=", true)
	    ->orderBy('nucleos.id', 'ASC')
	    ->orderBy('grados.id', 'ASC')
	    ->orderBy('programas.id', 'ASC')
	    ->orderBy('menciones.id', 'ASC');      

        return $NucleoProgramas;
          
    }

}