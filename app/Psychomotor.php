<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Psychomotor extends Model
{
    public function student()
    {
    	return $this->belongsTo(Student::class);
    }

    public function term()
    {
    	return $this->belongsTo(Term::class);
    }
}
