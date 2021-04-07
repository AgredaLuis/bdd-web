<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Titulo extends Model
{
	protected $table = 'titulos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo', 'id_universidad','id_persona','validado','id_tipotitulo',
    ];    

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */  
    public function persona()
    {
        return $this->hasOne(Persona::class, 'id_persona', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */    
    public function universidad()
    {
        return $this->belongsTo(Universidad::class, 'id_universidad');
    }

    public function tipotitulo()
    {
        return $this->belongsTo(TipoTitulo::class, 'id_universidad');
    }
	   
}