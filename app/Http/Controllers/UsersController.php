<?php

namespace App\Http\Controllers;

//ANEXANDO REQUEST PARA VALIDACIONES
use Illuminate\Http\Request;

//ANEXANDO SEGURIDAD
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


//ANEXANDO STORAGE
use Illuminate\Support\Facades\Storage;

//CORREOS
use App\Mail\UsuarioRegistrado;

use App\User;
use App\Modulo;
use App\Permiso;
use App\Tipousuario;
use App\Oficinasat;
use App\Tipodocumento;
use App\Nivelestudio;
use App\Tituloprofesional;
use App\Estado;
use App\Estudio;
use App\Cobertura;
use App\Documento;
use App\DatosLGC;
use App\DatosSAT;
use App\Notificacion;

use Mail;


//MANEJO DE TRANSACCIONES
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->nombremodelo='User';
    }

    protected function inicializaColeccion($modelo)
    {
        if( Auth::user()->tipousuario['nombre'] == 'Administrador SAT' ){

            $users = DB::table('users')
            ->select('users.email as correo','tipousuarios.nombre as tipousuario','datoslgc.nombre as nombrelgc','datoslgc.apellidopat as apellidopat','datossat.nombre as nombresat','users.id as idusuario','oficinassat.nombre as oficina'/*,'nivelestudios.nombre as nivelestudio'*/)     
            ->leftJoin('datoslgc', 'datoslgc.iduser', '=', 'users.id')
            ->leftJoin('datossat', 'datossat.iduser', '=', 'users.id')
            ->leftJoin('tipousuarios', 'tipousuarios.id', '=', 'users.idtipousuario')
            ->leftJoin('oficinassat', 'oficinassat.id', '=', 'datossat.idoficinasat')
            //->leftJoin('estudios', 'estudios.iduser', '=', 'users.id')
            //->leftJoin('nivelestudios', 'nivelestudios.id', '=', 'estudios.idnivelestudio')
            ->where("users.estatus", "=", 'A') 
            ->whereIn("users.idtipousuario", [2,3]); 

        }
        else
        {
            $users = DB::table('users')
            ->select('users.email as correo','tipousuarios.nombre as tipousuario','datoslgc.nombre as nombrelgc','datoslgc.apellidopat as apellidopat','datossat.nombre as nombresat','users.id as idusuario','oficinassat.nombre as oficina'/*,'nivelestudios.nombre as nivelestudio'*/)     
            ->leftJoin('datoslgc', 'datoslgc.iduser', '=', 'users.id')
            ->leftJoin('datossat', 'datossat.iduser', '=', 'users.id')
            ->leftJoin('tipousuarios', 'tipousuarios.id', '=', 'users.idtipousuario')
            ->leftJoin('oficinassat', 'oficinassat.id', '=', 'datossat.idoficinasat')
            //->leftJoin('estudios', 'estudios.iduser', '=', 'users.id')
            //->leftJoin('nivelestudios', 'nivelestudios.id', '=', 'estudios.idnivelestudio')
            ->where("users.estatus", "=", 'A'); 
        }
        

        return $users;
          
    }

    protected function inicializaPlucks()
    {

        if( Auth::user()->tipousuario['nombre'] == 'Administrador SAT' ){

            $Tipousuario = Tipousuario::select('nombre','id')->where("estatus", "=", 'A')->where("nombre", "=", 'Usuario SAT')->groupBy("nombre","id")->pluck('nombre','id');

        }
        else
        {
            $Tipousuario = Tipousuario::select('nombre','id')->where("estatus", "=", 'A')->groupBy("nombre","id")->pluck('nombre','id');            
        }

        parent::addPluck('Tipousuario',$Tipousuario); 

        $Oficinasat = Oficinasat::select('nombre','id')->where("estatus", "=", 'A')->groupBy("nombre","id")->pluck('nombre','id');
        parent::addPluck('Oficinasat',$Oficinasat); 

        $Tipodocumento = Tipodocumento::select('nombre','id')->where("estatus", "=", 'A')->groupBy("nombre","id")->pluck('nombre','id');
        parent::addPluck('Tipodocumento',$Tipodocumento); 

        $Nivelestudio = Nivelestudio::select('nombre','id')->where("estatus", "=", 'A')->groupBy("nombre","id")->orderBy("id","ASC")->pluck('nombre','id');
        parent::addPluck('Nivelestudio',$Nivelestudio); 

        $Estado = Estado::select('nombre','id')->where("estatus", "=", 'A')->groupBy("nombre","id")->pluck('nombre','id');
        parent::addPluck('Estado',$Estado);  

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

    protected function complementoColeccion($id)
    {

        $User = User::find($id);

        if($User->tipousuario['nombre'] == 'Administrador SAT' || $User->tipousuario['nombre'] == 'Usuario SAT'){

            $Datosusuario = DatosSAT::where("iduser", "=",$id)->first();
            parent::addPluck('DatosusuarioSAT',$Datosusuario);
         
        }
        else
        {

            
            $Datosusuario = DatosLGC::where("iduser", "=",$id)->first();
            $Documentos=Documento::select('*')->where("iduser", "=", $id)->get();
            $Estudios=Estudio::select('*')->where("iduser", "=",$id)->get();

            $Coberturas=Cobertura::select('idestado')->where("iduser", "=",$id)->get();

            $Estadoscoberturas=Estado::select('nombre','id')
                ->whereIn("id",$Coberturas)
                ->groupBy("nombre","id")
                ->pluck('nombre','id');

            $Estadosnocoberturas=Estado::select('nombre','id')
                ->whereNotIn("id",$Coberturas)
                ->groupBy("nombre","id")
                ->pluck('nombre','id');

            if($Estudios->isEmpty()){

                $Estudios=null;

            }

            if($Documentos->isEmpty()){

                $Documentos=null;

            }

            parent::addPluck('Documentos',$Documentos);
            parent::addPluck('Estudios',$Estudios);
            parent::addPluck('Coberturas',$Estadoscoberturas);
            parent::addPluck('Nocoberturas',$Estadosnocoberturas);
            parent::addPluck('DatosusuarioLGC',$Datosusuario);

        }   

    }

    public function buscartituloprofesionales(Request $request)
    {
        $Titulosprofesional = Tituloprofesional::select('*')
            ->where('idnivelestudio', '=', $request->id)
            ->get();

        echo json_encode($Titulosprofesional); 
    }

    public function visualizarestudios($archivo){

        return Storage::disk('public')->response("estudiosusers/$archivo");

    }

    public function visualizardocumentos($archivo){

        return Storage::disk('public')->response("documentosusers/$archivo");

    }

    public function descargarestudios($archivo){

        return Storage::disk('public')->download("estudiosusers/$archivo");

    }

    public function descargardocumentos($archivo){

        return Storage::disk('public')->download("documentosusers/$archivo");

    }

    public function afterUpdate($user, $lrequest, Request $request, $idalterno=0){

        $deletecoberturas=Cobertura::where("iduser", "=", $user->id)->delete();

        $DocumentosUsuario = Documento::where("iduser", "=", $user->id )
        ->update(['estatus' => 'D']);

        $EstudiosUsuario = Estudio::where("iduser", "=", $user->id )
        ->update(['estatus' => 'D']);

        $detallesmodel=json_decode($lrequest['_estudios_documentos_cobertura_datos'], true);
        
        $continuar=true;

        $ModeloActual;
        $Encontro=false;

        $ContadorEstudios=0;
        $ContadorDocumentos=0;

        foreach ($detallesmodel as $key => $value) {
            $Encontro=false;
            foreach ($value as $key_model => $value_model) {
                if($key_model=='Model'){
                    $objmodelo_detalles=$this->getModelo('App\\'.$value_model);
                    $objdetalle=$objmodelo_detalles;
                    $ModeloActual=$value_model;
                }else{

                    if(isset($value['id']) && !$Encontro){
                        $objdetalle=$objmodelo_detalles::findOrFail($value['id']);
                        $Encontro=true;
                                                    
                    }
                    else
                    {
                        if($key_model!='id'){
                            $objdetalle->$key_model=$value_model;
                        }
                        
                    }                   
                }
            }

            $objdetalle->iduser=$user->id;

            if($ModeloActual == 'Estudio'){

                $objdetalle->estatus='A';

                if(!$Encontro){

                    //VERIFICAMOS SI TRAJO ARCHIVO
                    if($request->hasFile('estudios')){
                        $sitioguardar='public/estudiosusers';
                        $estudiouser = $request->file('estudios');
                        $nombreoriginal=$estudiouser[$ContadorEstudios]->getClientOriginalName();
                        $tipo=$this->typeFile($nombreoriginal);

                        $nombre_archivo = $estudiouser[$ContadorEstudios]->storeAs($sitioguardar,$objdetalle->id.'-'.uniqid().'.'.$tipo);
                        $nombre_archivo = str_replace("public/estudiosusers/", "", $nombre_archivo);

                        $objdetalle->nombreruta = $nombre_archivo;

                        $ContadorEstudios++;
      
                    }

                }

            }

            if($ModeloActual == 'Documento'){

                $objdetalle->estatus='A';

                if(!$Encontro){

                    //VERIFICAMOS SI TRAJO ARCHIVO
                    if($request->hasFile('documentos')){
                        $sitioguardar='public/documentosusers';
                        $documentouser = $request->file('documentos');
                        $nombreoriginal=$documentouser[$ContadorDocumentos]->getClientOriginalName();
                        $tipo=$this->typeFile($nombreoriginal);

                        $nombre_archivo = $documentouser[$ContadorDocumentos]->storeAs($sitioguardar,$objdetalle->id.'-'.uniqid().'.'.$tipo);
                        $nombre_archivo = str_replace("public/documentosusers/", "", $nombre_archivo);

                        $objdetalle->nombreruta = $nombre_archivo;

                        $ContadorDocumentos++;
      
                    }

                }

            }

            if(!$objdetalle->save()){
                $continuar=false;
                $mensaje='No se pudo guardar detalles';
                break;
            }
            
        }

        $BorrarDocumentos=Documento::where("iduser", "=", $user->id)
        ->where("estatus", "=", 'D')
        ->delete();

        $BorrarEstudios=Estudio::where("iduser", "=", $user->id)
        ->where("estatus", "=", 'D')
        ->delete();

        //VERIFICAMOS SI TRAJO ARCHIVO
        if($request->hasFile('foto_perfil')){
            $sitioguardar='public/img';
            $foto_perfil = $request->file('foto_perfil');
            $nombreoriginal=$foto_perfil->getClientOriginalName();
            $tipo=$this->typeFile($nombreoriginal);

            $nombre_archivo = $foto_perfil->storeAs($sitioguardar,$user->id.'-'.uniqid().'.'.$tipo);
            $nombre_archivo = str_replace("public/img/", "", $nombre_archivo);

            $user->nombreruta = $nombre_archivo;
            if(!$user->save()){
                $type='warning';
                $msj='Se ha creado el usuario, pero no se pudo cargar la imagen.';
            }
        }
        
        return $continuar;

    }

    public function notificacion($lrequest, $nuevoRegistro, $obj, $idalterno){

        if($nuevoRegistro){

            $data = array('subject'=>'Usuario registrado en APP LGC Avalúos','usuario'=>$obj->email, 'contrasena'=>$lrequest['password']);
             
            Mail::to($obj->email)->send(new UsuarioRegistrado($data));

        }

    }

    public function buscarusuario(Request $request)
    {
        $Usuario=User::where("email", "=", $request->email)->first();

        $Encontro=true;

        if(empty($Usuario)){

            $Encontro=false;

        }

        echo json_encode($Encontro);
    }

    /**
     * Permite mostrar la vista para actualizar la permisologia de las opciones para ese usuario
     * @param type $iduser
     * @return type
     */
    public function permisos($iduser){
        $User = User::findOrFail($iduser);

        $modulos = Modulo::where("dependede", "<>", null)->where("estatus", "=", "A")->orderBy('modulo_permiso')->get();

        $j=0;
        foreach ($modulos AS $modulo) {
            $estatususer='D';
            $objpermiso = Permiso::where("idmodulo","=",$modulo->id)->where("iduser", "=", $iduser)->first();
            if(!empty($objpermiso)){
                $estatususer=$objpermiso->estatus;
            }
            $modulo->estatususer=$estatususer;
            unset($objpermiso);
            $j++;
        }
        return view('users.permisos', ['User' => $User, 'modulos' => $modulos, 'user' => $User->user]);
    }

    /**
     * Permite mostrar la vista para actualizar la permisologia de las opciones para ese usuario
     * @param type $iduser
     * @return type
     */
    public function spermisos(Request $request){
        $datas=json_decode($request->ar,true);
        $idmodulos=json_decode($request->ids,true);
        $iduser=$request->iduser;

        DB::beginTransaction();
        $idpadres=array();
        $objpermisoLote = new Permiso;
        $objpermisoLote->DeletePermisosPorLoteDeUsuario($iduser);
        foreach ($idmodulos AS $idmodulo) {
            $estatus=$datas[$idmodulo.'__estatus'];
            if($estatus=='A'){
                $objmodulo = Modulo::where("id","=",$idmodulo)->first();

                //BUSCAR DEPENDENCIA Y CREAR EL REGISTO
                if(!empty($objmodulo)){
                    //PERMISO DE MODULO DEPENDIENTE
                    if($objmodulo->dependede!=null && $objmodulo->dependede>0){
                        $objpermiso = Permiso::where("idmodulo","=",$objmodulo->dependede)->where("iduser","=",$iduser)->first();
                        if(empty($objpermiso)){
                            $objpermiso = new Permiso;
                            $objpermiso->iduser=$iduser;
                            $objpermiso->idmodulo=$objmodulo->dependede;
                        }
                        $objpermiso->estatus=$estatus;
                        if(!$objpermiso->save()){
                            $dataenvio['type']='danger';
                            $dataenvio['title']='Ocurrio un error, por favor intente más tarde';
                            $dataenvio['accion']='1';//RECARGA
                            $dataenvio['error']='No se pudo guardar los permisos.';
                            $error='No se pudo guardar los permisos.';
                            break;
                        }
                        unset($objpermiso);
                    }

                    //CREAR PADRE DEL MODULO
                        $idpadre=$objmodulo->idpadre;
                        while($idpadre!=null || $idpadre!=0){
                            $objpermiso = Permiso::where("idmodulo","=",$idpadre)->where("iduser","=",$iduser)->first();
                            if(empty($objpermiso)){
                                $objpermiso = new Permiso;
                                $objpermiso->iduser=$iduser;
                                $objpermiso->idmodulo=$idpadre;
                            }
                            $objpermiso->estatus=$estatus;
                            if(!$objpermiso->save()){
                                $dataenvio['type']='danger';
                                $dataenvio['title']='Ocurrio un error, por favor intente más tarde';
                                $dataenvio['accion']='1';//RECARGA
                                $dataenvio['error']='No se pudo guardar los permisos.';
                                $error='No se pudo guardar los permisos.';
                                break;
                            }
                            //BUSCAMOS SI TIENE PADRE EL ID PADRE
                            $objmodulopadre = Modulo::where("id","=",$idpadre)->where("dependede","<>",null)->first();
                            if(!empty($objmodulopadre)){
                                $idpadre=$objmodulopadre->idpadre;
                            }else{
                                $idpadre=null;
                            }
                        }
                        unset($objpermiso);

                    //CREAR MODULO ACTUAL
                    $objpermiso = Permiso::where("idmodulo","=",$objmodulo->id)->where("iduser","=",$iduser)->first();
                    if(empty($objpermiso)){
                        $objpermiso = new Permiso;
                        $objpermiso->iduser=$iduser;
                        $objpermiso->idmodulo=$objmodulo->id;
                    }
                    $objpermiso->estatus=$estatus;
                    if(!$objpermiso->save()){
                        $dataenvio['type']='danger';
                        $dataenvio['title']='Ocurrio un error, por favor intente más tarde';
                        $dataenvio['accion']='1';//RECARGA
                        $dataenvio['error']='No se pudo guardar los permisos.';
                        $error='No se pudo guardar los permisos.';
                        break;
                    }
                    unset($objpermiso);
                }else{
                    //MODULO NO ENCONTRADO
                    $dataenvio['type']='danger';
                    $dataenvio['title']='Ocurrio un error, por favor intente más tarde';
                    $dataenvio['accion']='1';//RECARGA
                    $dataenvio['error']='No se pudo guardar el permisos ';
                    $error='No se pudo guardar, modulo no encontrado.';
                    break;
                }
            }
        }

        if(!isset($error)){
            $objpermisos = Permiso::where("iduser","=",$iduser)->orderBy('idmodulo', 'ASC')->get();
            DB::commit();
            $dataenvio['type']='success';
            $dataenvio['title']='Se ha realizado los permisos correctamente';
            $dataenvio['accion']='1';
            $dataenvio['error']=0;
        }else{
            DB::rollBack();
            $dataenvio['type']='danger';
            $dataenvio['title']='Ocurrio un error, por favor intente más tarde';
            $dataenvio['accion']='1';//RECARGA
            $dataenvio['error']=$error;
        }
        echo json_encode($dataenvio);
    }

    /**
     * Permite mostrar la vista para actualizar los datos de configuración del usuario
     * @param type $id
     * @return type
     */
    public function privacidad($id){
        $User = User::findOrFail($id);

        return view('users.privacidad', ['User' => $User,'username' => $User->user]);

    }
    /**
     * Permite actualizar los datos de configuración del usuario
     * @param Request $request
     * @return type
     */
    public function sprivacidad(Request $request){
        $id = $request->id;

        if($User=User::findOrFail($id)){
            $this->validate($request, [
                'user' => 'required',
                'nombre' => 'required',
                'email' => 'required',
                //'rfc' => 'required',
            ]);
            $canti = User::where("id","<>",$id)->where("user","=",$request->user)->where("estatus","=","A")->count();
            if($canti==0){
                $canti = User::where("id","<>",$id)->where("nombre","=",$request->nombre)->where("estatus","=","A")->count();
                if($canti==0){
                    $canti=User::where("id","<>",$id)->where("email","=",$request->email)->where("estatus","=","A")->count();
                    if($canti==0){
                        $User->user = $request->user;
                        $User->nombre = $request->nombre;
                        $User->email = $request->email;

                        if(!empty($request->password)){
                            $User->password =  Hash::make($request->password);
                        }else{
                            $User->password=$User->password;
                        }

                        //VERIFICAMOS SI TRAJO ARCHIVO
                        if($request->hasFile('foto_perfil')){
                            if($User->foto_perfil!='img/avatar10.jpg'){
                                //ELIMINAR FISICAMENTE LA FOTO
                                Storage::delete('public/'.$User->foto_perfil);
                            }
                            $sitioguardar='public/users';
                            $foto_perfil = $request->file('foto_perfil');
                            $nombreoriginal=$foto_perfil->getClientOriginalName();
                            $tipo=$this->typeFile($nombreoriginal);

                            $nombre_archivo = $foto_perfil->storeAs($sitioguardar,$id.'-'.uniqid().'.'.$tipo);
                            $nombre_archivo = str_replace("public/", "", $nombre_archivo);

                            $User->foto_perfil = $nombre_archivo;
                        }
                        $User->save();
                        return redirect('users/privacidad/'.$request->id)->with('success','Se ha actualizado los datos de perfil correctamente');
                    }
                    else{
                    return redirect('users/privacidad/'.$request->id)->with('danger','Correo existente.');
                    }
                }else{
                    return redirect('users/privacidad/'.$request->id)->with('danger','Nombre existente.');
                }
            }else{
                return redirect('users/privacidad/'.$request->id)->with('danger','Usuario existente.');
            }
        }else{
            return redirect('home')->with('danger','Acción invalida.');
        }
    }
}
