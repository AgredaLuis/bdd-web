<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Yajra\DataTables\DataTables;

use App\Area;
use App\Grado;
use App\Modalidad;

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

        //ARMA EL ARREGLO DE AREAS QUE SE CARGARAN EN EL SELECT
        $Areas = Area::select('nombre','id')->groupBy("nombre","id")->pluck('nombre','id')->prepend('Seleccione...', 'default');
        parent::addPluck('Areas',$Areas);

        //ARMA EL ARREGLO DE GRADOS QUE SE CARGARAN EN EL SELECT
        $Grados = Grado::select('nombre','id')->groupBy("nombre","id")->pluck('nombre','id')->prepend('Seleccione...', 'default');
        parent::addPluck('Grados',$Grados);

        //ARMA EL ARREGLO DE MODALIDADES QUE SE CARGARAN EN EL SELECT
        $Modalidades = Modalidad::select('nombre','id')->groupBy("nombre","id")->pluck('nombre','id')->prepend('Seleccione...', 'default');
        parent::addPluck('Modalidades',$Modalidades);

        //OPCION SELECCIONADA EN EL MENU LATERAL IZQUIERDO
        parent::addPluck('NavItemActive','programas');      
        
    }    

}