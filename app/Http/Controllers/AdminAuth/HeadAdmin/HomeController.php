<?php

namespace App\Http\Controllers\AdminAuth\HeadAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
use App\Course;
use App\School;

class HomeController extends Controller
{
     
    public function index()

    {
		//get School info
        $school = School::first();

        //get school year info
        $school_year = School_year::first();

        //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        $students_count = Student::count();
        
        $staffers_count = Staffer::count();

        $courses_count = Course::count();

        $groups_count = Group::count();

             

        return view('/admin.headadmin.home', compact('school','school_year', 'today','schoolyear', 'students_count', 'staffers_count', 'courses_count', 'groups_count'));
    }

}
