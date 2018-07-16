<?php
    namespace App\Providers;
    
    use Illuminate\Support\Facades\View;
    use Illuminate\Support\ServiceProvider;

    class SuperAdminNavComposerServiceProvider extends ServiceProvider
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

            'admin.superadmin.schoolsetup',
            'admin.superadmin.schoolsetup.showschoolyear',
            'admin.superadmin.schoolsetup.addschoolyear',
            'admin.superadmin.schoolsetup.editschoolyear',
            'admin.superadmin.schoolsetup.showterms',
            'admin.superadmin.schoolsetup.addterm',
            'admin.superadmin.schoolsetup.editterm',
            'admin.superadmin.schoolsetup.terms.schoolyears',
            'admin.superadmin.schoolsetup.showgroups',
            'admin.superadmin.schoolsetup.addgroup',
            'admin.superadmin.schoolsetup.editgroup',
            'admin.superadmin.schoolsetup.showcoursesterms',
            'admin.superadmin.schoolsetup.courses.schoolyears',
            'admin.superadmin.schoolsetup.showcoursesgroups',
            'admin.superadmin.schoolsetup.showcourses',
            'admin.superadmin.schoolsetup.addcourse',
            'admin.superadmin.schoolsetup.editcourse',
            'admin.superadmin.schoolsetup.students.showgroups',
            'admin.superadmin.schoolsetup.students.showregisteredstudents',
            'admin.superadmin.schoolsetup.students.printregisterstudentspdf',
            'admin.superadmin.schoolsetup.students.addnewstudents',
            'admin.superadmin.schoolsetup.students.viewallstudents',
            'admin.superadmin.schoolsetup.students.editstudent',
            'admin.superadmin.schoolsetup.staffers.showstaffers',
            'admin.superadmin.schoolsetup.staffers.stafferdetails',
            'admin.superadmin.schoolsetup.staffers.registerstaffers',
            'admin.superadmin.schoolsetup.staffers.editregisterstaffer',
            'admin.superadmin.schoolsetup.staffers.printregisterstafferspdf',
            'admin.superadmin.schoolsetup.staffers.printregistergroupspdf',
            'admin.superadmin.schoolsetup.staffers.addstaffer',
            'admin.superadmin.schoolsetup.staffers.editstaffer',
            'admin.superadmin.schoolsetup.fees.showfees',
            'admin.superadmin.schoolsetup.fees.addfee',

            ], 
            
            'App\Http\ViewComposers\SuperAdminNavComposer'
        );

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