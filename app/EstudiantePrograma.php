<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstudiantePrograma extends Model
{
    //
    protected $table = 'estudiantesprogramas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'activo','id_nucleo_programa','id_persona','condicion',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */    
    public function nucleoprograma()
    {
        return $this->belongsTo(NucleoPrograma::class, 'id_nucleo_programa');
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }
    
}