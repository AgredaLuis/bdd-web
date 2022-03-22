<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoProgramacion extends Model
{
    //

    protected $table = 'tiposprogramaciones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'activo',
    ];

}