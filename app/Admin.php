<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

//Notification for Seller
use App\Notifications\AdminResetPasswordNotification;

use App\Staffer;

class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'registration_code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //Send password reset notification
      public function sendPasswordResetNotification($token)
      {
          $this->notify(new AdminResetPasswordNotification($token));
      }

      public function staffer()
    {
        return $this->hasOne('App\Staffer');
    }
}