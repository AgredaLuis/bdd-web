<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */ 
    public function users()
	{
  		return $this->belongsToMany(User::class,'role_users');
	}

}