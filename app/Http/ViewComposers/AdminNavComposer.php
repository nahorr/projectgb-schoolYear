<?php

namespace App\Http\ViewComposers;
use Illuminate\Http\Request;

use Illuminate\View\View;
use App\Repositories\UserRepository;


use App\School_year;
use App\Event;
use App\Term;
use Carbon\Carbon;

use App\Http\Requests;
use Auth;
use Image;
use App\Student;
use App\Group;
use App\Staffer;
use App\User;
use App\Comment;
use PDF;
use App\School;
use App\FeeType;
use App\Fee;
use App\StafferRegistration;
use App\StudentRegistration;



Class AdminNavComposer {

	
	
	public function compose (View $view)
    {
        
    	//get current date
        $today = Carbon::today();

        //get school information
        $school = School::first();

        //get school years
        $school_years = School_year::get();

        //get current school year
        $current_school_year = School_year::where([['start_date', '<=', $today], ['end_date', '>=', $today]])->first();
        
        //get logged in teacher/admin/staffer
        $teacher = Staffer::where('registration_code', '=', Auth::guard('web_admin')->user()->registration_code)->first();

        //get all admin/staffer/teacher's registrations.  
        //note also that a teacher schould have one registration for the current school year and like wise for every school year.
        $registrations_teacher = StafferRegistration::where('staffer_id', '=', $teacher->id)->get();

        //get current registration for admin/staffer/teacher. The idea is to get the current group_id from it.
        $current_registration_teacher = StafferRegistration::where('school_year_id', '=', $current_school_year->id)->where('staffer_id', '=', $teacher->id)->first();
        
        //get all students registered in teachers current group in the current school year. 
        $students_in_teacher_current_group = StudentRegistration::where('school_year_id', '=', $current_school_year->id)->where('group_id', '=', $current_registration_teacher->group_id)->get();

        //get all users                      
        $all_users = User::get();
        
        //get terms
        $terms = Term::get();

        //put variables in views
        $view
        ->with('today', $today )
        ->with('school', $school)
        ->with('school_years', $school_years)
        ->with('current_school_year', $current_school_year)
        ->with('teacher', $teacher)
        ->with('registrations_teacher', $registrations_teacher)
        ->with('current_registration_teacher', $current_registration_teacher)
        ->with('students_in_teacher_current_group', $students_in_teacher_current_group)
        ->with('all_users', $all_users)
        ->with('terms', $terms);
       
    }
}



