<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoTitulo extends Model
{
    //

    protected $table = 'tipostitulos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'activo',
    ];

}