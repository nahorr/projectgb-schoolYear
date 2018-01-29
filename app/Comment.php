<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

	public $timestamps = true;

    public function student()
    {
        return $this->belongsTo('App\Student');
    }

    public function term()
    {
        return $this->belongsTo('App\Term');
    }
}
