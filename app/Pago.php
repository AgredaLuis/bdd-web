<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table='pagos';

    protected $primaryKey="id";

    protected $fillable=['codigo','descripcion','monto'];

}
