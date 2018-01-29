<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DisciplinaryRecord extends Model
{
    protected $dates = ['drecord_date'];
    
	public function term()
    {
        return $this->belongsTo('App\Term');
    }
    
    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    public function student()
    {
        return $this->belongsTo('App\Student');
    }
}
