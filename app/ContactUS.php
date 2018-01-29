<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUS extends Model
{
    public $table = 'contactus';
 
	public $fillable = ['first_name', 'last_name', 'phone', 'email','message'];
}
