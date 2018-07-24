<?php

namespace App\Http\ViewComposers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\School_year;
use Carbon\Carbon;
use App\Student;
use App\Staffer;
use App\Course;
use App\School;
use App\Admin;
use App\Event;
use App\Group;
use App\User;
use App\Term;
use Image;
use Auth;
use File;
use App\StafferRegistration;
use App\StudentRegistration;
use PDF;
use App\Feetype;

Class SuperAdminNavComposer {	
	
	public function compose (View $view)
    {
    	//get current date
        $today = Carbon::today();

        //get school information
        $school = School::first();

        //get all school years
        $schoolyears = School_year::orderBy('start_date', 'desc')->get();

        //get current school year
        $current_school_year = School_year::where('start_date', '<=', $today)->where('show_until', '>=', $today)->first();
        
        //get all terms
        $terms = Term::get();

        $current_term = Term::where([['start_date', '<=', $today], ['show_until', '>=', $today]])->first();

        $admin_users = Admin::get();
            
        $teacher = Staffer::where('registration_code', '=', Auth::guard('web_admin')->user()->registration_code)->first();

        $groups = Group::get();

        $feetypes = Feetype::get();

        //Staffers
        $staffers = Staffer::get();

        $current_staffers_registrations = @StafferRegistration::with('staffer')->with('school_year')->with('term')->with('group')->where('staffer_registrations.school_year_id', '=', $current_school_year->id)->where('staffer_registrations.term_id', '=', $current_term->id)->get();

        //Students
        $students = Student::get();

        $current_students_registrations = @StudentRegistration::with('student')->with('school_year')->with('term')->with('group')->where('student_registrations.school_year_id', '=', $current_school_year->id)->where('student_registrations.term_id', '=', $current_term->id)->get();

       // dd($current_students_registrations);

        //$join_current_teachers_registrations = StafferRegistration::leftJoin('staffers', 'staffer_registrations.staffer_id', '=', 'staffers.id')->leftjoin('school_years', 'staffer_registrations.school_year_id', '=', 'school_years.id')->leftjoin('terms', 'staffer_registrations.term_id', '=', 'terms.id')
        //->leftjoin('groups', 'staffer_registrations.group_id', '=', 'groups.id')
                                //->where('staffer_registrations.school_year_id', '=', $current_school_year->id)->where('staffer_registrations.term_id', '=', $current_term->id)->get();

        //$current_staffers_registrations = StafferRegistration::where('school_year_id', '=', $current_school_year->id)->where('term_id', '=', $current_term->id)->get();

        //$current_registered_groups =  StafferRegistration::where('school_year_id', '=', $current_school_year->id)->where('term_id', '=', $current_term->id)->pluck('group_id')->all();

        //$current_unregistered_groups = Group::whereNotIn('id', $current_registered_groups)->select('name')->get();

              


        //dd($group_join);

        //put variables in views
        $view
        ->with('today', $today )
        ->with('school', $school)
        ->with('schoolyears', $schoolyears)
        ->with('current_school_year', $current_school_year)
        ->with('terms', $terms)
        ->with('current_term', $current_term)
        ->with('admin_users', $admin_users)
        ->with('teacher', $teacher)
        ->with('staffers', $staffers)
        ->with('groups', $groups)
        ->with('feetypes', $feetypes)
        ->with('students', $students)
        ->with('current_staffers_registrations', $current_staffers_registrations)
        ->with('current_students_registrations', $current_students_registrations);   
    }
}



