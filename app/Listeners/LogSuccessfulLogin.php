<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\LoginActivity;
use Request;
use Location;



class LogSuccessfulLogin
{
    public function getIp(){
        $ip; 
        if (getenv("HTTP_CLIENT_IP")) 
        $ip = getenv("HTTP_CLIENT_IP"); 
        else if(getenv("HTTP_X_FORWARDED_FOR")) 
        $ip = getenv("HTTP_X_FORWARDED_FOR"); 
        else if(getenv("REMOTE_ADDR")) 
        $ip = getenv("REMOTE_ADDR"); 
        else 
        $ip = "75.159.179.128";
        return $ip; 
        
    }

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */

    //change 'ip_address'    =>  Location::get($this->getIp())->cityName,
    //to 'ip_address'    =>  Location::get('75.159.179.128')->cityName,
    //in production 
    public function handle(Login $event)
    {
        if(\Request::is('login')){
            LoginActivity::create([
            'user_id'       =>  $event->user->id,
            'user_agent'    =>  \Illuminate\Support\Facades\Request::header('User-Agent'),
            'ip_address'    =>  $this->getIp(),
            'ip_city'       =>  Location::get($this->getIp())->cityName,
            'ip_region'     =>  Location::get($this->getIp())->regionName,
            
            ]);
        }
    }
}
