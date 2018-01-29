<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feetype extends Model
{
    public function fees()
    {
    	return $this->hasMany('App\Fee');
    }

        
}
