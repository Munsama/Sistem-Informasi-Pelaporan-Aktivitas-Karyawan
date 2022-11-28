<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    //
    protected $fillable = [
        'position_name'
 
    ];
    
    public function account()
    {
        return $this->hasOne('App\Account');
    }
}
