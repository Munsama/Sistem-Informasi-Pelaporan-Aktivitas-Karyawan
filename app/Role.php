<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $fillable = [
        'role_name'
        
    ];
    
    public function account()
    {
        return $this->hasOne('App\Account');
    }
}
