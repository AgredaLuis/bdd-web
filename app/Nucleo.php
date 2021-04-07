<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nucleo extends Model
{
    //

    protected $table = 'nucleos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'activo',
    ];

}
