<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    //
    protected $table = 'programas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','nombre','descripcion','inicio','perfil','titulo','activo','id_area','id_grado','id_modalidad',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */    
    public function area()
    {
        return $this->belongsTo(Area::class, 'id_area');
    }

    public function grado()
    {
        return $this->belongsTo(Grado::class, 'id_grado');
    }

    public function modalidad()
    {
        return $this->belongsTo(Modalidad::class, 'id_modalidad');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */ 
    public function menciones()
    {
        return $this->hasMany(Mencion::class,'id_programa','id');
    }
    
}
