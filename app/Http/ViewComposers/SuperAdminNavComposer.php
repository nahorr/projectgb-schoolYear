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
use App\Event;
use App\Group;
use App\User;
use App\Term;
use Image;
use Auth;
use File;

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
        $current_school_year = School_year::where('start_date', '<=', $today)->where('end_date', '>=', $today)->first();
        
        //get all terms
        $terms = Term::get();
            
        $teacher = Staffer::where('registration_code', '=', Auth::guard('web_admin')->user()->registration_code)->first();

        $groups = Group::get();

        $staffers = Staffer::get();

        $students = Student::get();

        //put variables in views
        $view
        ->with('today', $today )
        ->with('school', $school)
        ->with('schoolyears', $schoolyears)
        ->with('current_school_year', $current_school_year)
        ->with('terms', $terms)
        ->with('teacher', $teacher)
        ->with('staffers', $staffers)
        ->with('groups', $groups)
        ->with('students', $students);    
    }
}



