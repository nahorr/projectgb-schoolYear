<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School_year extends Model
{
    //protected $dateFormat = 'Y-m-d H:i';

    protected $dates = ['start_date', 'end_date'];

    public function staffer_registrations()
    {
        return $this->hasMany('App\StafferRegistration');
    }

    public function student_registrations()
    {
        return $this->hasMany('App\StudentRegistration');
    }
    
}