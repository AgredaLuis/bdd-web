<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
	protected $table = 'municipios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre','id_estado',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function parroquias()
    {
        return $this->hasMany(Parroquia::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'id_estado');
    }

}
