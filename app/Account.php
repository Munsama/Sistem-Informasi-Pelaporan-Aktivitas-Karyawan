<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'name', 'NIK', 'password', 'position_id', 'department_id', 'leader_id', 'role_id'
    ];
    
    public function position()
    {
        return $this->belongsTo('App\Position');
    }
    public function department()
    {
        return $this->belongsTo('App\Department');
    }
    public function leader()
    {
        return $this->belongsTo('App\Leader');
    }
    public function role()
    {
        return $this->belongsTo('App\Role');
    }
    public function activity()
    {
        return $this->hasMany('App\Activity');
    }
}