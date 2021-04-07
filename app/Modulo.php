<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'modulos';

    /**
     * @var array
     */
    protected $fillable = ['id', 'nombreruta', 'idpadre', 'icono', 'nombre', 'orden', 'estatus', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modulo()
    {
        return $this->belongsTo('App\Modulo', 'idpadre');
    }
}
