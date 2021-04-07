<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property int $id
 * @property int $iduser
 * @property int $idmodulo
 * @property string $estatus
 * @property string $created_at
 * @property string $updated_at
 */
class Permiso extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permisos';

    /**
     * @var array
     */
    protected $fillable = ['id', 'iduser', 'idmodulo','estatus', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'iduser');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modulo()
    {
        return $this->belongsTo('App\Modulo', 'idmodulo');
    }

    /**
     * Verifica si tiene permiso para acceder a esa ruta la cantidad de picking totales
     */
    public function VerificarPermiso($iduser, $nombreruta)
    {
        $sql ='
            SELECT
                count(*) AS valido
            FROM permisos AS Permiso
            WHERE
                Permiso.iduser='.$iduser.'
                AND Permiso.idmodulo IN (
                    SELECT
                        id
                    FROM modulos AS Modulo
                    WHERE Modulo.nombreruta="'.$nombreruta.'"
                    AND Modulo.estatus ="A"
                )
                AND Permiso.estatus ="A"
        ';
        $data = DB::select($sql);
        if($data[0]->valido>0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Permite crear el menu del usuario segun sus permisos
     */
    public function menu($idpadre=0,$iduser,$ruta,$accion)
    {

        $valret='';
        $sql ='
            SELECT
                Modulo.id,
                Modulo.controlador,
                Modulo.accion,
                Modulo.nombreruta,
                Modulo.idpadre,
                Modulo.icono,
                Modulo.nombre,
                Modulo.orden
            FROM modulos AS Modulo
            INNER JOIN permisos Permiso ON Permiso.idmodulo=Modulo.id
            WHERE
                Permiso.iduser='.$iduser.'
                AND Permiso.estatus="A"
                AND Modulo.idpadre='.$idpadre.'
                AND Modulo.nombre IS NOT null
            ORDER BY Modulo.orden DESC
        ';
        $opciones = DB::select($sql);
        if(count($opciones)>0)
        {
            foreach($opciones as $opcion)
            {
                $hijos=$this->menu($opcion->id,$iduser,$ruta,$accion);
                $show='';
                $active='';
                if($opcion->controlador!=''){
                    //VERIFICAMOS SI TIENE VARIOS CONTRALADORES
                    if(explode('@',$opcion->controlador)>0){
                        $array=explode('@',$opcion->controlador);
                        for($i=0;$i<count($array);$i++){
                            if(strpos($ruta, $array[$i]) !== false){
                                $show='show';
                                // if($opcion->accion == $accion){
                                    $active='active';
                                // }
                                break;
                            }
                        }
                    }else{
                        if(strpos($ruta, $opcion->controlador) !== false){
                            $show='show';
                            // if($opcion->accion == $accion){
                                $active='active';
                            // }
                        }
                    }
                }
                if($hijos!=''){
                    //TIENE HIJOS
                    $valret.='
                        <li class="nav-item '.$active.'">
                            <a class="nav-link '.$active.'" href="#" data-toggle="collapse" data-target="#collapse'.$opcion->id.'" aria-expanded="true" aria-controls="collapse'.$opcion->id.'">
                                <i class="fa-fw '.$opcion->icono.'"></i>
                                <span>'.$opcion->nombre.'</span>
                            </a>
                            <div id="collapse'.$opcion->id.'" class="collapse '.$show.'" aria-labelledby="headingTwo" data-parent="#accordionSidebar" >
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <h6 class="collapse-header">'.$opcion->nombre.'</h6>
                                    '.$hijos.'
                                </div>
                            </div>
                        </li>';
                }
                else{
                    $href=route($opcion->nombreruta);
                    $valret.='
                        <a class="collapse-item '.$active.'" href="'.$href.'">'.$opcion->nombre.'</a>
                    ';
                }
            }
        }
        return $valret;
    }

    /**
     * Verifica los permisos que tiene el usuario referido al controlador
     */
    public function VerificarPermisosDelControlador($iduser, $controlador)
    {
        $sql ='
            SELECT
                Permiso.iduser,
                Permiso.idmodulo,
                Permiso.estatus,
                Modulo.accion
            FROM permisos AS Permiso
            INNER JOIN modulos AS Modulo ON Modulo.id=Permiso.idmodulo
            WHERE
                Permiso.iduser='.$iduser.'
                AND Modulo.controlador="'.$controlador.'"
                AND Modulo.idpadre <> 0
                AND Modulo.estatus ="A"
                AND Permiso.estatus ="A"
        ';
        $data = DB::select($sql);
        return $data;
    }

    /**
     * Permite eliminar todos los permisos del usuario
     */
    public function DeletePermisosPorLoteDeUsuario($iduser)
    {
        $sql ='
            DELETE FROM permisos
            WHERE iduser = '.$iduser.'
        ';
        $data = DB::select($sql);
        return true;
    }
}
