<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eventtype extends Model
{
    public function events()
    {
    	return $this->hasMany('App\Event');
    }

}
