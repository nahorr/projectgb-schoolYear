<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyActivity extends Model
{
	protected $dates = ['activity_date', 'due_date'];
    
	public function term()
    {
        return $this->belongsTo('App\Term');
    }
    
    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    
}
