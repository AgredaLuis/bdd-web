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
    public function hasReferencia($ref){
        if(Referencia::where('referencia','=',$ref)->exists()){
            $referencia = Referencia::where('referencia','=',$ref)->first();
        }else{
            return false;
        }
        
        if($this->referencia == $referencia->referencia && $this->fechaPago == $referencia->fecha && $this->monto == $referencia->monto){
            return true;
        }
        return false;
    }
}
