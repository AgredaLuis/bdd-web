<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Yajra\DataTables\DataTables;

use App\Estado;
use App\Titulo;
use App\Universidad;
use App\TipoTitulo;
use App\Persona;

class PersonaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->nombremodelo='Persona';
    }

    protected function inicializaPlucks()
    {
        
        //ARMA EL ARREGLO DE ESTADOS QUE SE CARGARAN EN EL SELECT
        $Estados = Estado::select('nombre','id')->groupBy("nombre","id")->pluck('nombre','id')->prepend('Seleccione...', 'default');
        parent::addPluck('Estados',$Estados);

        //ARMA EL ARREGLO DE UNIVERSIDADES QUE SE CARGARAN EN EL SELECT
        $Universidades = Universidad::select('nombre','id')->groupBy("nombre","id")->pluck('nombre','id')->prepend('Seleccione...', 'default');
        parent::addPluck('Universidades',$Universidades);

        //ARMA EL ARREGLO DE TIPO DE TITULO QUE SE CARGARAN EN EL SELECT
        $TiposTitulos = TipoTitulo::select('nombre','id')->groupBy("nombre","id")->pluck('nombre','id')->prepend('Seleccione...', 'default');
        parent::addPluck('TiposTitulos',$TiposTitulos); 

        //OPCION SELECCIONADA EN EL MENU LATERAL IZQUIERDO
        parent::addPluck('NavItemActive','datospersonales');        
        
    }

    public function beforeUpdate($lrequest, $id, $persona){

        $continuar = true;
        //VERIFICAR SI HAY TITULOS REGISTRADOS POR LA PERSONA
        if (Titulo::where("id_persona", "=", $id)->count() != 0) {
            //SE BORRAN LOS TITULOS REGISTRADOS DE LA PERSONA, PARA PROCEDER A GUARDAR LOS NUEVOS DATOS
            if(!Titulo::where("id_persona", "=", $id)->delete()){

                $continuar = false;

            }
        }
          
        return $continuar;
    }

    public function getPersona(Request $request)
    {

        $Persona=Persona::where('ci',$request['ci'])->first();      
        return Response()->json($Persona); 
       
    }

}
