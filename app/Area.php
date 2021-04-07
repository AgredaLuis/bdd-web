<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
     //
    protected $table = 'areas';

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
