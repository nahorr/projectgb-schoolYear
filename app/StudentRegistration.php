<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentRegistration extends Model
{
    public function student()
    {
        return $this->belongsTo('App\Student');
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
