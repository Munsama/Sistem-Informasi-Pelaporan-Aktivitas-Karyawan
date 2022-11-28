<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'NIK', 'password', 'position_id', 'department_id', 'leader_id', 'role_id'
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

    // public function role()
    // {
    //     return $this->belongsTo('App\Role','role_id');
    // }
 
    // public function hasRoles($roles)
    // {
    //     $this->have_role = $this->getUserRoles();
        
    //     if(is_array($roles)){
    //         foreach($roles as $need_role){
    //             if($this->cekUserRoles($need_role)) {
    //                 return true;
    //             }
    //         }
    //     } else{
    //         return $this->cekUserRoles($roles);
    //     }
    //     return false;
    // }
    // private function getUserRoles()
    // {
    //    return $this->role()->getResults();
    // }
    
    // private function cekUserRoles($role)
    // {
    //     return (strtolower($role)==strtolower($this->have_role->role_name)) ? true : false;
    // }
}


