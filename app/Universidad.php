<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Universidad extends Model
{
    //

    protected $table = 'universidades';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'activo',
    ];

}