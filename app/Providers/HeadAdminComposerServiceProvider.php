<?php
    namespace App\Providers;
    use Illuminate\Support\Facades\View;
    use Illuminate\Support\ServiceProvider;

    class HeadAdminComposerServiceProvider extends ServiceProvider
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

            '/admin.headadmin.includes.sidebar',
            '/admin.headadmin.dashboard',
            '/admin.headadmin.home', 
           

            ], 
            
            'App\Http\ViewComposers\HeadAdminSidebarComposer'

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