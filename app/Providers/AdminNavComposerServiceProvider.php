<?php
    namespace App\Providers;
    use Illuminate\Support\Facades\View;
    use Illuminate\Support\ServiceProvider;

    class AdminNavComposerServiceProvider extends ServiceProvider
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

            'admin/includes/headdashboardtop',
            'admin/home',
            
            ], 
            
            'App\Http\ViewComposers\AdminNavComposer'

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