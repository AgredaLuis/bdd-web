<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NucleoPrograma extends Model
{
    //
    protected $table = 'nucleosprogramas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cod_udo'/*,'cod_cnu','dependencia','inicio','sede','comentario'*/,'activo','id_nucleo','id_programa',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */    
    public function nucleo()
    {
        return $this->belongsTo(Nucleo::class, 'id_nucleo');
    }

    public function programa()
    {
        return $this->belongsTo(Programa::class, 'id_programa');
    }

    public function estudianteprograma()
    {
        return $this->belongsTo(EstudiantePrograma::class, 'id_nucleo_programa');
    }
    
}