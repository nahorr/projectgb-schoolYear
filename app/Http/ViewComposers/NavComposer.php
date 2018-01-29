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
        
    	//get current date
        $today = Carbon::today();

        //school
        $school = School::first();

        //get Authenticated user
        $user = Auth::user();

        //get user reg code
        $reg_code = $user->registration_code;

        //get student 
        $student = Student::where('registration_code', '=', $reg_code)->first();

        //get studnt group
        $student_group = Group::where('id','=', $student->group_id)->first();

        $student_teacher = Staffer::where('group_id', '=', $student_group->id )->first();

              
        //get school year
        $school_year = School_year::first();

        //get term
        $terms = Term::get();

       
        $feetype = Feetype::get();

        //login Activity skip 1
        $login_activity = LoginActivity::where('user_id', '=', $user->id)->orderBy('created_at', 'desc')->skip(1)->take(1)->first();;

        //get ip address of logged in user
        $ip_address = $this->getIp();

        $location = Location::get($ip_address);
        
        
        
        //put variables in views
        $view
        ->with('school', $school)
        ->with('today', $today )
        ->with('user', $user )
        ->with('reg_code', $reg_code )
        ->with('student', $student )
        ->with('student_group', $student_group )
        ->with('school_year', $school_year )
        ->with('terms', $terms )
        ->with('login_activity', $login_activity)
        ->with('ip_address', $ip_address)
        ->with('location', $location)
        ->with('student_teacher', $student_teacher );
        

    }
}



