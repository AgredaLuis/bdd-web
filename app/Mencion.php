<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mencion extends Model
{
    //
    protected $table = 'menciones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre','id_programa','activo',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */ 
    public function programa()
    {
        return $this->belongsTo(Programa::class, 'id_programa');
    }
    
}