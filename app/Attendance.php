<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    
    //protected $dates = ['day'];

    public function student()

    {
    	return $this->belongsTo(Student::class);
    }

    public function term()
    {
    	return $this->belongsTo(Term::class);
    }

    public function attandance_code()
    {
    	return $this->belongsTo('App\AttendanceCode');
    }
}
