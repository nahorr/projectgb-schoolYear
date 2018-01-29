<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Student;

class Course extends Model
{

    public $fillable = ['group_id','term_id', 'course_code', 'name', 'staffer_id'];

    public function term()
    {
    	return $this->belongsTo('App\Term');
    }

    public function group()
    {
    	return $this->belongsTo('App\Group');
    }

    public function grades()
    {
        return $this->hasMany('App\Grade');
    }

    public function staffer()
    {
        return $this->belongsTo('App\Staffer');
    }
}
