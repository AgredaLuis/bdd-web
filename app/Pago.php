<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table='pagos';

    protected $primaryKey="id";

    protected $fillable=['rerefencia','descripcion','monto'];

    public function persona(){
        return $this->belongsTo(Persona::class, 'persona_id');
    }
}
