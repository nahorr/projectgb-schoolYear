<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


use App\User;
use App\Section;
use App\Group;
use App\Course;
use App\Grade;

class Student extends Model
{
    use Notifiable;

    protected $dates = ['dob'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    
    public function group()
    {

        return $this->belongsTo('App\Group');
    }


    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    
    public function grades()
    {
        return $this->hasMany('App\Grade');
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

     public function disciplinary_records()
    {
        return $this->hasMany('App\DisciplinaryRecord');
    }

    public function student_registrations()
    {
        return $this->hasMany('App\StudentRegistration');
    }


}