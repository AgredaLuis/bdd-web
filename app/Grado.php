<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    //
    protected $table = 'grados';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'descripcion','titulo','activo',
    ];

    protected $dates = ['deleted_at'];
}
