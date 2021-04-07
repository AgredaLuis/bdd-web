<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
	protected $table = 'estados';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function municipios()
    {
        return $this->hasMany(Municipio::class);
    }

}
