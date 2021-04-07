<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Configuracionweb extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'configuracionweb';

    /**
     * @var array
     */
    protected $fillable = ['nombre', 'parametros', 'tipo', 'created_at', 'updated_at'];
}
