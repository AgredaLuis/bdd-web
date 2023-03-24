<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referencia extends Model
{

    protected $table='referencias';
    protected $primaryKey="id";
    protected $fillable = [
        'referencia',
        'descripcion',
        'monto',
        'fecha'
    ];
}
