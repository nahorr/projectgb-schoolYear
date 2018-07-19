<?php

namespace App\Http\ViewComposers;
use Illuminate\Http\Request;

use Illuminate\View\View;
use App\Repositories\UserRepository;


use Carbon\Carbon;
use Auth;
use App\Student;
use App\Group;
use App\School_year;
use App\Term;
use App\Staffer;
use App\Fee;
use App\Feetype;
use App\School;
use App\LoginActivity;
use Location;
use App\StafferRegistration;
use App\StudentRegistration;
use App\User;



Class NavComposer {

    public function getIp(){
        $ip; 
        if (getenv("HTTP_CLIENT_IP")) 
        $ip = getenv("HTTP_CLIENT_IP"); 
        else if(getenv("HTTP_X_FORWARDED_FOR")) 
        $ip = getenv("HTTP_X_FORWARDED_FOR"); 
        else if(getenv("REMOTE_ADDR")) 
        $ip = getenv("REMOTE_ADDR"); 
        else 
        $ip = "UNKNOWN";
        return $ip; 
        
    }

	
	
	public function compose(View $view)
    {
        
    	//initialize number for irregular table numbering
        $number_init = 1;

        //get current date
        $today = Carbon::today();

        //school
        $school = School::first();

        //get school years
        $school_years = School_year::orderBy('start_date', 'desc')->get();

        //get current school year
        $current_school_year = School_year::where([['start_date', '<=', $today], ['end_date', '>=', $today]])->first();

        //get term
        $terms = Term::get();

        $current_term = Term::where([['start_date', '<=', $today], ['end_date', '>=', $today]])->first();

        //Students, Users and Registrations
        $all_users = User::get();

        $student = Student::where('registration_code', '=', Auth::user()->registration_code)->first();

        $registrations_student = StudentRegistration::with('student')->with('school_year')->with('term')->with('group')->where('student_id', '=', $student->id)->get();

        //teachers
        $registrations_teachers = StafferRegistration::with('staffer')->with('school_year')->with('term')->with('group')->get();

        
        $feetype = Feetype::get();

        //login Activity skip 1
        $login_activity = LoginActivity::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'desc')->skip(1)->take(1)->first();;

        //get ip address of logged in user
        $ip_address = $this->getIp();

        $location = Location::get($ip_address);
        
        //dd($registrations_teachers);
        
        //put variables in views
        $view
        ->with('number_init', $number_init )
        ->with('today', $today )
        ->with('school', $school) 
        ->with('all_users', $all_users )
        //->with('reg_code', $reg_code )
        ->with('student', $student )
        //->with('student_group', $student_group )
        //->with('school_year', $school_year )
        ->with('school_years', $school_years )
        ->with('current_school_year', $current_school_year)
        ->with('current_term', $current_term)
        ->with('registrations_student', $registrations_student)
        ->with('registrations_teachers', $registrations_teachers)
        ->with('terms', $terms )
        //->with('students_teacher', $students_teacher )
        ->with('feetype', $feetype)
        ->with('login_activity', $login_activity)
        ->with('ip_address', $ip_address)
        ->with('location', $location);
        //->with('student_teacher', $student_teacher );
        

    }
}



