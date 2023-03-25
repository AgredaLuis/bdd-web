<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password','is_activated','predefined',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */

     // Definicion de las relaciones con otras tablas
    public function roles(){
        return $this->belongsToMany(Role::class,'role_users');
    }
    public function persona(){
        return $this->hasOne(Persona::class);
    }
    // Fin de relaciones

    public function authorizeRoles($roles){
        abort_unless($this->hasAnyRole($roles), 401);    return true;
    }
    
    public function hasAnyRole($roles){
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        }else {
            if ($this->hasRole($roles)) {
                return true; 
            }   
        }    
        return false;
    }
    
    public function hasRole($role){
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }    
        return false;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
}
