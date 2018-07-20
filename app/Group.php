<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Student;
use App\Staffer;
use App\Section;

class Group extends Model
{
    public function students()
    {
    	return $this->hasMany('App\Student');
    }

    public function staffers()
    {
    	return $this->hasMany('App\Staffer');
    }

    public function courses()
    {
    	return $this->hasMany('App\Course');
    }

    public function events()
    {
        return $this->hasMany('App\Event');
    }

    public function fees()
    {
        return $this->hasMany('App\Fee');
    }

    public function daily_activities()
    {
        return $this->hasMany('App\DailyActivity');
    }

     public function disciplinary_records()
    {
        return $this->hasMany('App\DisciplinaryRecord');
    }

    public function staffer_registrations()
    {
        return $this->hasMany('App\StafferRegistration');
    }

    public function student_registrations()
    {
        return $this->hasMany('App\StudentRegistration');
    }

    public function grades()
    {
        return $this->hasMany('App\Grade');
    }
}
