<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Admin;
use App\Section;
use App\Group;
use App\Course;


class Staffer extends Model
{
	public $fillable = ['group_id'];

    public function admin()
    {
        return $this->belongsTo('App\Admin');
    }

    
    public function group()
    {

        return $this->belongsTo('App\Group');
    }


    public function courses()
    {
        return $this->hasMany('App\Course');
    }

    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    public function staffer_registrations()
    {
        return $this->hasMany('App\StafferRegistration');
    }

        
}
