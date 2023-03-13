<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
	protected $table = 'role_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'user_id','is_activated','is_predefined','token',
    ];

    public function role(){

    	$usuario = User::where("id", "=", Auth::user()->id)->first();
    	#Retorna el tipo de usuario
		return $usuario->user;

    }
    
}