<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leader extends Model
{
    //
    protected $fillable = [
        'leader_name'
        
    ];
    
    public function account()
    {
        return $this->hasOne('App\Account');
    }
    public function activity()
    {
        return $this->hasMany('App\Activity');
    }
}
