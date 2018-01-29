<?php

namespace App\Http\Controllers\AdminAuth;

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
use App\Comment;
use PDF;
use App\School;
use App\FeeType;
use App\Fee;
use App\StafferRegistration;
use App\StudentRegistration;




class HomeController extends Controller
{
    
    public function index()
    {

     return view('admin.home');
    }

    public function printRegCode ($student_id)
    {

        //get current date
        $today = Carbon::today();

        $student =  Student::find($student_id);
        $school = School::first();

        $school_year = School_year::first();
        //get teacher's section and group
        $teacher = Auth::guard('web_admin')->user();

        $reg_code = $teacher->registration_code;

        $teacher = Staffer::where('registration_code', '=', $reg_code)->first();

        $class = Group::where('id', '=', $teacher->group_id)->first();


        $term_tuitions = Fee::where('group_id', '=',$teacher->group_id )->get();

        $terms = Term::get();

         $pdf = PDF::loadView('admin.printregcode',compact('today', 'student', 'school', 'school_year', 'class', 'term_tuitions', 'terms'));

         return $pdf->inline();

    }

    public function printAllRegCode ()
    {

         //get current date
        $today = Carbon::today();
        $school = School::first();

        $school_year = School_year::first();
        //get teacher's section and group
        $teacher = Auth::guard('web_admin')->user();

        $reg_code = $teacher->registration_code;

        $teacher = Staffer::where('registration_code', '=', $reg_code)->first();

        $class = Group::where('id', '=', $teacher->group_id)->first();
        $term_tuitions = Fee::where('group_id', '=',$teacher->group_id )->get();
        $terms = Term::get();

        //get students in group_section
        $students = Student::where('group_id', '=', $teacher->group_id)->get();

        $pdf = PDF::loadView('admin.printallregcode',compact('today', 'students', 'school', 'school_year', 'class', 'term_tuitions','terms'));

        return $pdf->inline();

    }

    public function observationsOnConduct()
    {

        //get current date
        $today = Carbon::today();

        //get teacher's section and group
        $teacher = Auth::guard('web_admin')->user();

        $reg_code = $teacher->registration_code;

        $teacher = Staffer::where('registration_code', '=', $reg_code)->first();


        //get students in group_section
        $students_in_group = Student::where('group_id', '=', $teacher->group_id)
        ->get();

               
       $all_user = User::get();

             
        
        $count = 0;
        foreach ($students_in_group as $students) {
            $count = $count+1;
        }

        $group_teacher = Group::where('id', '=', $teacher->group_id)->first();
        

        //get terms
        $terms = Term::get();

        foreach ($terms as $t){
            if ($today->between($t->start_date, $t->show_until )){
                $current_term =  $t->term;

                //get all comments
                //addd comments
                $comment_current_term = Comment::where('term_id', '=', $t->id)
                                    ->get();
            }
                                                         
        }

        
        //get school school
        $schoolyear = School_year::first();

        

        return view('/admin.observationsonconduct', compact('today', 'count', 'group_teacher', 'current_term', 
            'schoolyear', 'students_in_group', 'all_user', 'st_user', 'comment_current_term', 'terms'));
    }

    
}