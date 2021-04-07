<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parroquia extends Model
{
	protected $table = 'parroquias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre','id_municipio',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'id_municipio');
    }

}
