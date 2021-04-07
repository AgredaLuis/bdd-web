<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    //
    protected $table = 'bancos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'descripcion','activo',
    ];

    protected $dates = ['deleted_at'];
}
