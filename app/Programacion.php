<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programacion extends Model
{
    //

    protected $table = 'programaciones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'inicio', 'fin', 'observacion', 'id_tipoprogramacion', 'id_nucleoprograma', 'activo',
    ];

}