<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminAuthActivity extends Model
{
    protected $fillable = ['admin_id', 'user_agent', 'ip_address', 'ip_city', 'ip_region',];
}
