<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Configuracion;
use App\DatosLGC;
use App\DatosSAT;
use App\Notificacion;

//MANEJO DE TRANSACCIONES
use Illuminate\Support\Facades\DB;

//ANEXANDO SEGURIDAD
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ConfiguracionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->nombremodelo='Configuracion';
    }

    protected function inicializaColeccion($modelo)
    {
    	$configuraciones=Configuracion::where('estatus','<>','D');

    	return $configuraciones;
    }

    protected function inicializaPlucks()
    {

        $CantidadNotificacion=Notificacion::where("idusuario", "=", Auth::user()->id) 
            ->where("estatus", "=", 'A') 
            ->count();
        parent::addPluck('CantidadNotificacion',$CantidadNotificacion); 

        $Notificaciones = DB::table('notificaciones')
            ->select('notificaciones.*','solicitudes.folioexterior as folioexterior','bienesevaluar.foliointerno as foliointerno')     
            ->leftJoin('solicitudes', 'solicitudes.id', '=', 'notificaciones.idsolicitud')
            ->leftJoin('bienesevaluar', 'bienesevaluar.id', '=', 'notificaciones.idtipobien')
            ->where("idusuario", "=", Auth::user()->id) 
            ->where("notificaciones.estatus", "=", 'A')
            ->orderBy('notificaciones.id', 'desc')
            ->get();
        parent::addPluck('Notificaciones',$Notificaciones);

        $Usuario = DB::table('users')
            ->select('datossat.nombre as nombresat','datoslgc.nombre as nombrelgc','datoslgc.apellidopat as apellidopat','datoslgc.apellidomat as apellidomat')     
            ->leftJoin('datoslgc', 'datoslgc.iduser', '=', 'users.id')
            ->leftJoin('datossat', 'datossat.iduser', '=', 'users.id')
            ->where("users.id", "=", Auth::user()->id)
            ->first();

        parent::addPluck('Usuario',$Usuario);

    }
    public function afterUpdate($certificado, $lrequest, Request $request, $idalterno=0){

        $Configuracion=Configuracion::findOrFail($certificado->id);

        $continuar=true;

        //VERIFICAMOS SI TRAJO ARCHIVO
        if($request->hasFile('cer')){
            $sitioguardar='public/certificados';
            $cer = $request->file('cer');
            $nombreoriginal=$cer->getClientOriginalName();
            $tipo=$this->typeFile($nombreoriginal);

            $nombre_archivo = $cer->storeAs($sitioguardar,$Configuracion->id.'-'.uniqid().'.'.$tipo);
            $nombre_archivo = str_replace("public/certificados/", "", $nombre_archivo);

            $Configuracion->cer = $nombre_archivo;
            
        }

        //VERIFICAMOS SI TRAJO ARCHIVO
        if($request->hasFile('key')){
            $sitioguardar='public/certificados';
            $key = $request->file('key');
            $nombreoriginal=$cer->getClientOriginalName();
            $tipo=$this->typeFile($nombreoriginal);

            $nombre_archivo = $key->storeAs($sitioguardar,$Configuracion->id.'-'.uniqid().'.'.$tipo);
            $nombre_archivo = str_replace("public/certificados/", "", $nombre_archivo);
            
            $Configuracion->key = $nombre_archivo;
            
        }

        if(!$Configuracion->save()){
            $type='warning';
            $msj='Se ha creado la configuracion, pero no se pudo cargar los archivos.';
        }
        
        return $continuar;

    }
}