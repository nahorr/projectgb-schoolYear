<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    public function school_year()
    {
    	return $this->belongsTo(School_year::class);
    }

    public function term()
    {
    	return $this->belongsTo(Term::class);
    }

    public function group()
    {
    	return $this->belongsTo(Group::class);
    }

    public function student()
    {
    	return $this->belongsTo(Student::class);
    }

    public function course()
    {
    	return $this->belongsTo(Course::class);
    }
    
}
