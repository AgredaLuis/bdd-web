<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Permiso;
use App\Notificacion;

use Illuminate\Support\Facades\Route;

//ANEXANDO REQUEST PARA VALIDACIONES
use Illuminate\Http\Request;

//ANEXANDO SEGURIDAD
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

//MANEJO DE TRANSACCIONES
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    var $nombremodelo="";
    private $pluck=[];
    private $coleccion=[];
    var $filtro=[];
    var $filtroconsulta=[];
    var $validaciones=[];
    var $msj="";

    //Metodos publicos

    /**
     * Muestra uan lista de empleados
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return $this->aplicarfiltros();
    }
    public function filtrar(Request $request)
    {
        return $this->aplicarfiltros($request);
    }
    private function aplicarfiltros(Request $request=null)
    {

        //Instanciar el modelo
        $modelo=$this->getModelo('App\\'.$this->nombremodelo);

        //Agregar la colecciones de objetos que van al index
        if(method_exists($this, "inicializaColeccion")){
            $query = $this->inicializaColeccion($modelo);
        }
        else{
            $query = $modelo::select("*")
                        ->where("activo", "=", true);
        }

        //Agregar las filtros que van al index
        if(method_exists($this, "inicializaFiltro")){
            $this->inicializaFiltro($request);
            //Agregar los filtros a la consulta
            foreach ($this->filtroconsulta as $key => $value) {
                $query->where($key,"=",$value);
            }
        }

        $coleccion=$query->get();

        //Agregar los plucks
        if(method_exists($this, "inicializaPlucks")){
            $this->inicializaPlucks();
        }
        //Mostrar la vista de index
        return view(explode("/",Route::getCurrentRoute()->uri)[0].'.index',
            [
                'coleccion' => $coleccion,
                'pluck' => $this->pluck,
                'filtro' => $this->filtro
            ]
        );
    }

    /**
    * Permite mostrar los datos de una entidad
    * @param
    */
    public function view($id,$idalterno=0)
    {
        $this->addPluck('ubicacion',"Mostrar");
        return self::edit($id,$idalterno);
    }

    /**
    * Permite mostrar el ->formulario para crear ana nueva entidad
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {

        return redirect(str_replace("create", "edit/-1", Route::getCurrentRoute()->uri));

    }

    /**
    * Permite mostrar un formulario para modificar los datos de una entidad
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id=0, $idalterno=0)
    {   
        //Desencripta el id de la entidad a editar   
        $id =  Crypt::decrypt($id);
        //Agregar los plucks
        if(method_exists($this, "inicializaPlucks")){
            $this->inicializaPlucks();
        }
        //Agregar el pluck de ubicacion
        if(!array_key_exists("ubicacion", $this->pluck))
        {
            $this->addPluck("ubicacion","Editar");
        }
        //Instanciar el modelo
        $modelo=$this->getModelo('App\\'.$this->nombremodelo);
        //Cargar entidad a editar
        if($id>0){

            $obj = $modelo::findOrFail($id);
            if(method_exists($this, "complementoColeccion")){
                $this->complementoColeccion($id,$idalterno);
            }

            if(method_exists($this, "notificacion")){
                $this->notificacion(null, false, $obj,$idalterno);
            }

        }
        else
        {

            //$obj= new $modelo($arrayName = array('nombre' => 'nombre creado'));
            $obj= new $modelo();
            $this->addPluck("ubicacion","Crear");

        }

        if($idalterno == -10){

            $this->addPluck("ubicacion_alterna","Alterna");  

        }
        //Mostrar la vista de editar
        return view(explode("/",Route::getCurrentRoute()->uri)[0].'.edit',
            [$this->nombremodelo => $obj,
            'pluck' => $this->pluck]
        );

    }


    /**
     * Permite actualizar los datos de una entidad del modelo en la BD
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $retorno='index', $idalterno=0)
    {
        if(!empty($this->validaciones)){
            $this->validate($request,$this->validaciones);
        }
        //Obtenemos el objeto de la clase del modelo
        $modelo=$this->getModelo('App\\'.$this->nombremodelo);
        $modeloMsj='El '.$this->nombremodelo;

        //Pasamos los valores del request a los atributos del objeto
        $lrequest=$request->getAllRequest();

        if($id>0){

            $modeloMsj='Los datos han sido actualizados de forma exitosa'; 

        }
        else
        {
            $modeloMsj='Los datos han sido guardados de forma exitosa';  
        }

        //Iniciamos transaccion
        DB::beginTransaction();
        if($id>0){
            $obj=$modelo::findOrFail($id);  
        }
        else
        {
            $obj = $modelo;
        }
        
        $existemodelosdependientes=0;//VARIABLE UTILIZADA PARA NOTIFICAR QUE ES UN FORMULARIO CON DETALLES
        $nuevoRegistro=true;

        foreach ($lrequest as $key => $value) {
            if($key=="detallesmodel" || $key=='retorno'){
                if($key=='retorno'){
                    $retorno=$value;
                }elseif($key=="detallesmodel"){
                    $existemodelosdependientes=1;
                }
            }else{
                if($id<0){
                    if($value!=""){
                        if(substr($key,0,1)!="_"){
                            $campos = explode(",", $key);
                            if(count($campos)>1){
                                if($campos[0]==$this->nombremodelo){
                                    $obj->$campos[1]=$value;
                                }
                            }else{
                                if($key == 'password'){
                                    $value=Hash::make($value); 
                                }
                                $obj->$key=$value;
                            }
                        }
                    }
                }else{
                    $nuevoRegistro=false;
                    if(substr($key,0,1)!="_"){
                        $campos = explode(",", $key);
                        if(count($campos)>1){
                            if($campos[0]==$this->nombremodelo){
                                $obj->$campos[1]=$value;
                            }
                        }else{
                            if($key == 'password'){
                                $value=Hash::make($value); 
                            }
                            $obj->$key=$value;
                        }
                    }
                }
            }
        }
        $continuar=true;
        //Validaciones y acciones previas al guardado
        if(method_exists($this, "beforeUpdate")){
            $continuar=$this->beforeUpdate($lrequest, $id, $obj);
        }

        //Guardar el registro
        if($continuar){
            if(!$obj->save()){
                $this->msj='No se pudo guardar, por favor intente de nuevo más tarde.';
                $continuar=false;
            }else{

                if($existemodelosdependientes==1){
                    //FORMULARIO POSEE MODELOS DEPENDIENTES
                    $idmodel=$obj->id;
                    $detallesmodel=json_decode($lrequest['detallesmodel'], true);

                    foreach ($detallesmodel as $key => $value) {
                        foreach ($value as $key_model => $value_model) {
                            if($key_model=='Model'){
                                $objmodelo_detalles=$this->getModelo('App\\'.$value_model);
                                $objdetalle=$objmodelo_detalles;
                            }else{
                                if($key_model=='id'){
                                    $objdetalle=$objmodelo_detalles::findOrFail($value_model);
                                }
                                else
                                {
                                    if(substr($key_model,0,2)!="__"){
                                        $objdetalle->$key_model=$value_model;
                                    }
                                    else{
                                        $key_model=str_replace ('__', '', $key_model);
                                        $objdetalle->$key_model=$idmodel;
                                    }                                    
                                }
                            }
                        }
                        if(!$objdetalle->save()){
                            $continuar=false;
                            $mensaje='No se pudo guardar detalles';
                            break;
                        }
                    }
                }
            }
        }

        //Acciones posteriores al guardado
        if($continuar){
            if(method_exists($this, "afterUpdate")){
                $continuar=$this->afterUpdate($obj,$lrequest, $request, $idalterno);
            }
        }        

        //Termina transaccion
        if($continuar){
            DB::commit();
            $type='success';
            $titlemsg='Todo bien';

            if(!isset($request['_editar'])){
                //Validaciones y acciones previas al guardado
                if(method_exists($this, "notificacion")){
                    $this->notificacion($lrequest, $nuevoRegistro, $obj, $idalterno);
                }
            }

        }
        else{
            DB::rollBack();
            $type='error';
            $titlemsg='Algo salio mal';
            $modeloMsj='Los datos no han sido guardados'; 
        }
        //Retornamos al index
        if($retorno!='index'){
            //$retorno .='/'.$obj->id;
            $retorno .='/'.Crypt::encrypt($obj->id);
        }

        //Mensaje de la operación
        $this->msj=$modeloMsj;

        $nombrecontrolador=explode("/",Route::getCurrentRoute()->uri)[0];
        return redirect($nombrecontrolador.'/'.$retorno)
            ->with('msg',$this->msj)
            ->with('title-msg',$titlemsg)
            ->with('type',$type)
            ->with('icon',$type); 
    }

    /**
     * Permite eliminar una entidad del modelo en la BD. Es una eliminacion lógica
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id, $type='logica', $retorno='index')
    {

        if(isset($request['_eliminar'])){
            
            $this->nombremodelo='Bienevaluar';
            //Instanciamos el modelo
            $modelo=$this->getModelo('App\\'.$this->nombremodelo);

            //BORRANDO LA NOTIFICACION ANTERIOR
            $UltimaNotificacion = Notificacion::where("idtipobien", "=", $id)
            ->update(['estatus' => 'V']);

        }
        else
        {
            //Instanciamos el modelo
            $modelo=$this->getModelo('App\\'.$this->nombremodelo); 
        }

        //Cargamos la entidad a eliminar
        if($obj=$modelo::find($id)){
            //Iniciamos transaccion
            DB::beginTransaction();
            $continuar=true;

            $modeloMsj=$this->nombremodelo;

            if( $this->nombremodelo == 'User'){
                 $modeloMsj='Usuario';
            }

            if( $this->nombremodelo == 'Solicitud'){
                 $modeloMsj='Solicitud';
            }

            if( $this->nombremodelo == 'Bienevaluar'){
                 $modeloMsj='Bien a Valuar';
            }

            //Acciones anteriores al borrado
            if(method_exists($this, "afterDelete")){
                $continuar=$this->afterDelete($obj);
            }
            //Eliminar entidad
            if($continuar){
                $this->msj = $modeloMsj.' eliminada correctamente.';

                if($type == 'logica')
                {
                    $obj->estatus = 'E';
                    if(!$obj->save()){
                        $this->msj=$modeloMsj.' no eliminada, por favor intente de nuevo más tarde.';
                        $continuar=false;
                    }
                }
                else
                {
                    if(!$obj->delete()){
                        $this->msj=$modeloMsj.' no eliminada, por favor intente de nuevo más tarde.';
                        $continuar=false;
                    }
                }
            }
            //Acciones posteriores al borrado
            if($continuar){
                if(method_exists($this, "beforeDelete")){
                    $continuar=$this->beforeDelete($obj);
                }
            }
            //Termina transaccion
            if($continuar){
                DB::commit();
                $type='success';
            }
            else{
                DB::rollBack();
                $type='danger';
            }
        }
        else{
            $type='warning';
            $msj=$this->nombremodelo.' not found.';
        }
        return redirect()->route(explode("/",Route::getCurrentRoute()->uri)[0].'.'.$retorno)->with($type,$this->msj);
    }

    /**
     * Permite cargar Datatable en el Index mediante Ajax
     *
     * @param
     * @return Json
     */

    public function loadData(Request $request)
    {//dd($request);
        //$lrequest=$request->getAllRequest();


        //dd($lrequest['columns']);

        //Instanciamos el modelo
        /*$query = DB::table('components')
            ->join('itemlist', 'itemlist.itemnumber', '=', 'components.component')
            ->select('components.component','components.quantity', 'components.job', 'itemlist.description', 'itemlist.cost', 'itemlist.preferredvendor', 'itemlist.type');
            //->orderBy("components.component")
            //->offset($inicio)
            //->limit($cantidad)
            //->get();

        foreach ($lrequest['columns'] as $key => $value) {

            if($value['searchable'] == true && $value['search']['value'] != ''){

                $query->where($value['data'],"=",$value['search']['value']);
                dd($value['data']." = ".$value['search']['value']);

            }

        }

        $resultado=$query->orderBy("components.component")->offset(0)->limit(100)->get();
        dd($resultado);*/

        //$query->where($key,"=",$value);
        $queryall ='';

        //Agregar los plucks (Para ver los permisos)
        if(method_exists($this, "inicializaPlucks")){
            $this->inicializaPlucks();
        }

        //Instanciamos el modelo
        $modelo=$this->getModelo('App\\'.$this->nombremodelo);

        //Agregar la colecciones de objetos que van al index
        if(method_exists($this, "inicializaColeccionPaginada")){

            $coleccion = $this->inicializaColeccionPaginada($modelo,$request->input('start'),$request->input('length'));

        }

        //Cantidad de registros de la coleccion de objetos que van al index
        if(method_exists($this, "cantidadColeccionPaginada")){

            $cantidadColeccionPaginada = $this->cantidadColeccionPaginada($modelo);

        }
        if(!isset($request->noactions)){

            foreach($coleccion as $registro){

                $Actions='';

                if(isset($this->pluck["permisos"]['view'])){

                    $Actions.='<a href="'.route(explode("/",Route::getCurrentRoute()->uri)[0].'.view',$registro->id).'" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="See">
                        <i class="fas fa-search-plus"></i>
                    </a>';

                }
                if(isset($this->pluck["permisos"]['edit'])){

                    $Actions.='<a href="'.route(explode("/",Route::getCurrentRoute()->uri)[0].'.edit',$registro->id).'" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>';

                }
                if(isset($this->pluck["permisos"]['delete'])){

                    $Actions.='<form method="POST" action="'.route(explode("/",Route::getCurrentRoute()->uri)[0].'.delete',$registro->id).'" id="FormDelete'.$registro->id.'" class="d-inline">';

                    $Actions.='<input name="_token" type="hidden" value="'.csrf_token().'"/>';

                    $Actions.='<button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete" onclick="eliminar('.$registro->id.')">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        <i class="far fa-trash-alt"></i>
                    </button>';

                    $Actions.='</form>';
                }

                $registro->Actions=$Actions;

            }

        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($cantidadColeccionPaginada),
            "recordsFiltered" => intval($cantidadColeccionPaginada),
            "data"            => $coleccion
        );

        echo json_encode($json_data);
    }

    //Metodos protegidos

    /**
     * Permite obtener modelo
     * @param
     */
    protected function getModelo($modelo){

        return new $modelo;

    }

    protected function addPluck($key,$pluck){
        $this->pluck[$key]=$pluck;
    }

    protected function addColeccion($key,$coleccion){
        $this->coleccion[$key]=$coleccion;
    }

    protected function addFiltro($key,$filtro,$campo=""){
        $this->filtro[$key]=$filtro;
        if($campo!="")
            $this->filtroconsulta[$campo]=$filtro;
    }

    //Finaliza Automatizacion


    /**
     * Permite verificar si puede ejecutar acciones del controlador y mostrar los botones de acciones en el index del controlador
     * @param type $iduser
     * @param type $controlador
     * @return type $arraybtn
     */
    public function btnfunciones($iduser,$controlador){
        //BUSCAR PERMISOS LIGADOS AL CONTROLADOR DEL USUARIO
        $objPermiso = new Permiso;
        $datas = $objPermiso->VerificarPermisosDelControlador($iduser,$controlador);
        $arraybtn = array();
        if(count($datas)>0){
            foreach ($datas as $data) {
            	if($controlador=='UsersController'){
	                if($data->accion=='changepassword'){
						$arraybtn['changepassword']=true;
					}
					if($data->accion=='permissions'){
						$arraybtn['permissions']=true;
					}
            	}
                if($controlador=='SolicitudController'){
                    if($data->accion=='cotizar'){
                        $arraybtn['cotizar']=true;
                    }
                    if($data->accion=='autorizar'){
                        $arraybtn['autorizar']=true;
                    }
                }
                if($data->accion=='create'){
                    $arraybtn['create']=true;
                }
                if($data->accion=='edit'){
                    $arraybtn['edit']=true;
                }
                if($data->accion=='delete'){
                    $arraybtn['delete']=true;
                }
                if($data->accion=='view'){
                    $arraybtn['view']=true;
                }
            }
        }
        return $arraybtn;
    }

    /**
     * Permite retornar las variables globales que se usan en todo el sistema
     * @param type $iduser
     * @param type $controlador
     * @return type $arraybtn
     */
    public function variablesglobales($nombre_variable){
        $data=null;
        if($nombre_variable=='cerrado_opciones'){
            $data= array(
                'A' => 'Abierto',
                'C' => 'Cerrado',
            );
        }
        if($nombre_variable=='tiposangre'){
            $data = array(
                "Desconocido"=>"Desconocido",
                "A Rh+"=>"A Rh+",
                "A Rh+"=>"A Rh+",
                "A Rh-"=>"A Rh-",
                "B Rh+"=>"B Rh+",
                "B Rh-"=>"B Rh-",
                "AB Rh+"=>"AB Rh+",
                "AB Rh-"=>"AB Rh-",
                "O Rh+"=>"O Rh+",
                "O Rh-"=>"O Rh-"
            );
        }
        if($nombre_variable=='diassemanas'){
            $data = array(
                2 => "Lunes",
                3 => "Martes",
                4 => "Miércoles",
                5 => "Jueves",
                6 => "Viernes",
                7 => "Sábado",
                1 => "Domingo"
            );
        }
        return $data;
    }

    /**
     * Permite actualizar la configuración de la sessión actual
     * @param type $tipo_configuracion
     * @return type
     */
    public function ActualizarSesionConfiguracion($tipo_configuracion=1)
    {
        //BUSCANDO LAS CONFIGURACIONES DEL SITIO WEB
            $ConfiguracionWebs = Configuracionweb::where('tipo', '=', $tipo_configuracion)->get();
            foreach ($ConfiguracionWebs as $ConfiguracionWeb) {
                if($ConfiguracionWeb->tipo==$tipo_configuracion){
                    $nombre = $ConfiguracionWeb->nombre;
                    $parametros = $ConfiguracionWeb->parametros;

                    //session()->forget('Configuracion.Web.'.$nombre);
                    session()->put('Configuracion.Web.'.$nombre, $parametros);
                }
            }
        return true;
    }

    /**
     * Permite crear un slug
     * @param type $iduser
     * @param type $controlador
     * @return type $arraybtn
     */
    public function slugify($text) {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        //lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return '';
        }

        return $text;
    }

     /**
     * Permite formatear un campo para convertir en decimal
     * @param  string $valor $paramname description
     * @return decimal $valor
     */
    public function formatearADecimal($valor){
        $valor = str_replace(",", "", (string)$valor);
        // $valor = str_replace(".", ",", (string)$valor);

        return $valor;
    }

    /**
     * Permite convertir el formato money de un excel a un decimal para el campo en la tabla
     * @param  [money] $numero
     * @return [decimal] $numero
     */
    public function converExcelMoneyADecimal($numero){
        $numero = str_replace("$", "", $numero);
        $numero = str_replace(",", "", $numero);
        $numero = (float)trim($numero);

        return $numero;
    }

    /**
     * Obtener el formato del archivo
     * @param  text $file
     */
    public function typeFile($file){
        $array = explode(".", $file);
        return end( $array );
    }
}
