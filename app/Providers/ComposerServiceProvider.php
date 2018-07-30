<?php
    namespace App\Providers;
    use Illuminate\Support\Facades\View;
    use Illuminate\Support\ServiceProvider;

    class ComposerServiceProvider extends ServiceProvider
    {
        /**
        * Register bindings in the container.
        *
        * @return void
        */
    public function boot()
    {
        // Using class based composers...
        View::composer(
            [

            //'selectTerm',
            'layouts/includes/dashboard',
            'layouts.includes.headdashboardtop',
            'layouts.includes.sidebar',
            'home',
            'homeSchoolYear',
            'selectYearModal',
            'profile', 
            'showcourse',  
            '/show', 
            'reportcards',
            'currentcourses', 
            'showtermcourses',
            '/layouts.includes.sidebar', 
            '/reportcards', 
            'showtermreportcard',
            '/pdfshowtermreportcard',
            'attendances.showterms',
            'attendances.days',
            'dailyactivity/activities',
            'discipline/records',
            'messages/messagetoteacher',
            'messages/sendmessagetoteacher',
            'messages.viewsentmessages',
            'messages.readstaffermessage',
            'messages.replystaffermessage',

            ], 
            
            'App\Http\ViewComposers\NavComposer'

        );
        

        // Using Closure based composers...
        //View::composer('dashboard', function ($view) {
            //
        //});
    }

     
    /**
    * Register the service provider.
    *
    * @return void
    */
    public function register()
    {
        //
    }
}