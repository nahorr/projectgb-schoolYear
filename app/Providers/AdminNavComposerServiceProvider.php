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

            'admin.selectSchoolyear',
            'admin.selectTerm',
            'admin.selectTermModal',
            'admin/includes/headdashboardtop',
            'admin/home',
            'admin/addComment',
            'admin/editComment',
            'admin/printregcode',
            'admin/printallregcode',
            'admin/profile',
            'admin.attendances.showstudents',
            'admin.attendances.addattendance',
            'admin.attendances.editattendance',
            'admin.attendances.showterms',
            'admin.admincourses',
            'admin.showadmincourses',
            'admin.superadmin.schoolsetup.courses.assign',
            'admin.showstudentcoursesgrades',
            'admin.addGrades',
            'admin.editGrades',
            'admin.reportcards.terms',
            'admin/reportcards/students',
            'admin.reportcards.print',
            'admin.reportcards.printall',
            'admin.attendances.showstudents',
            'admin.attendances.addattendance',
            'admin.attendances.editattendance',
            'admin.observationsonconduct',
            'admin.effectiveareas.showstudents',
            'admin.effectiveareas.addeffectivearea',
            'admin.effectiveareas.editeffectivearea',
            'admin.psychomotors.showstudents',
            'admin.psychomotors.addpsychomotor',
            'admin.psychomotors.editpsychomotor',
            'admin.learningandaccademics.showstudents',
            'admin.learningandaccademics.addlearningandaccademic',
            'admin.learningandaccademics.editlearningandaccademic',
            'admin.healthrecords.showstudents',
            'admin.healthrecords.addhrecord',
            'admin.healthrecords.edithrecord',
            'admin/banstudents',
            'admin.students.messages.allstudents',
            'admin.students.messages.viewstudentmessage',
            'admin.students.messages.replystudentmessage',
            'admin.students.messages.showstudents',
            'admin.students.messages.sendmessagetostudent',
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