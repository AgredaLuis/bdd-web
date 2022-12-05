<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    //
    protected $table = 'personas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ci', 'nombre','apellido','nacionalidad','genero','estatus_civil','fecha_nacimiento','email','telefono_movil','telefono_local','discapacidad','activo','imagen','trabajo_empresa','trabajo_cargo','trabajo_tiempo_servicio','direccion'/*,'id_estado','id_municipio','id_ciudad'*/,'id_parroquia','ciudad','confirmado',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */    
    public function parroquia()
    {
        return $this->belongsTo(Parroquia::class, 'id_parroquia');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'email','email');
    }

    public function estudianteprograma()
    {
        return $this->belongsTo(EstudiantePrograma::class, 'id_persona');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */  
    public function titulos()
    {
        return $this->hasMany(Titulo::class,'id_persona');
    }
    
}
