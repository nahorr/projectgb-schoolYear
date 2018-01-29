<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{

    protected $dates = ['due_date'];

    public function feetype()
    {
    	return $this->belongsTo('App\Feetype');
    }

    public function group()
    {
    	return $this->belongsTo('App\Group');
    }

    public function term()
    {
    	return $this->belongsTo('App\Term');
    }

}
