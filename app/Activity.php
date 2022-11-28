<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //
    protected $fillable = [
        'date', 'user_id', 'classification_id',	'equipment_id',	'start_time', 'finish_time', 
        'description',	'report', 'efficiency_id', 'competency_id'
        
    ];
    public function user()
    {
        return $this->belongsTo('App\Account');
    }
    public function leader()
    {
        return $this->belongsTo('App\Leader');
    }
}
