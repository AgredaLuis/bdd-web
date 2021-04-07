<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Yajra\DataTables\DataTables;

use App\Municipio;

class MunicipioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->nombremodelo='Municipio';
    }

    public function getMunicipiosEstado(Request $request)
    {

        $Municipios=Municipio::where('id_estado',$request['id_estado'])->get();
        return Response()->json($Municipios); 

    }

}