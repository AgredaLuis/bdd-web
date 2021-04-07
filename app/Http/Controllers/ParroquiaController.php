<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Yajra\DataTables\DataTables;

use App\Parroquia;

class ParroquiaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->nombremodelo='Parroquia';
    }

    public function getParroquiasMunicipio(Request $request)
    {

        $Parroquias=Parroquia::where('id_municipio',$request['id_municipio'])->get();      
        return Response()->json($Parroquias); 
       
    }

}