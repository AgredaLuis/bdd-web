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
        'nombre','mencion','descripcion','perfil','titulo','activo','id_area','id_grado','id_modalidad',
    ];
    
}
