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
    public function roles()
    {
        //$role_guest  = Role::where('name', 'Invitado')->first();
        //return $this->belongsToMany('Role', 'role_id'='4');
        return $this->belongsToMany(Role::class,'role_users');
        //return $this->belongsToMany(Role::where('name', 'Invitado')->first());
    }

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
    public function persona()
    {
        return $this->hasOne(Persona::class, 'email','email');
    }
}
