<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StafferRegistration extends Model
{
    public function staffer()
    {
        return $this->belongsTo('App\Staffer');
    }

    public function school_year()
    {
        return $this->belongsTo('App\School_year');
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
