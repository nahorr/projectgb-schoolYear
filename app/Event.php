<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $dates = ['start_date', 'end_date'];

    

    public function term()
    {
        return $this->belongsTo('App\Term');
    }

    public function eventtype()
    {
    	return $this->belongsTo('App\Eventtype');
    }

    public function group()
    {
    	return $this->belongsTo('App\Group');
    }

}
