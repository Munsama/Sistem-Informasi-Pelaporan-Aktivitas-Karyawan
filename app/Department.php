<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    protected $fillable = [
        'department_name'
        
    ];
    
    public function account()
    {
        return $this->hasOne('App\Account');
    }
}
