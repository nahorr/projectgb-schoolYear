<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //ordinal
        Blade::directive('ordinal', function ($number) {
            $ends = array('th','st','nd','rd','th','th','th','th','th','th');
            if ((($number % 100) >= 11) && (($number%100) <= 13))
                return $number. 'th';
            else
            return $number. $ends[$number % 10];
        });
       
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
