<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{

    public $timestamps = false;
    
    protected $dates = ['start_date', 'end_date','show_until'];

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

    public function comments()
    {
    	return $this->hasMany('App\Comment');
    }

    public function attendances()
    {
        return $this->hasMany('App\Attendance');
    }

    public function health_records()
    {
        return $this->hasMany('App\HealthRecord');
    }

    public function psychomotors()
    {
        return $this->hasMany('App\Psychomotor');
    }

    public function effective_areas()
    {
        return $this->hasMany('App\EffectiveArea');
    }

    public function learning_and_accademics()
    {
        return $this->hasMany('App\LearningAndAccademic');
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
