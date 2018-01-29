<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\School_year;
use App\Event;
use App\Term;
use Carbon\Carbon;
use App\Course;
use Auth;
use Image;
use App\Student;
use App\Section;

use App\Grade;
use App\Group;

class CurrentReportCardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {

        //get current date
        $today = Carbon::today();

        //Authenticated user;
        $user = Auth::user();

        $reg_code = $user->registration_code;

        $student = Student::where('registration_code', '=', $reg_code)->first();
        
        //get studnt group
        $student_group = Group::where('id','=', $student->group_id)->first();

        //get school year
        $school_year = School_year::first();
        

        //get term
        $terms = Term::get();

        //get current term
        foreach ($terms as $t){
            if ($today->between($t->start_date, $t->show_until )){
                $current_term =  $t->term;

            }
                                                         
        }
       
        
        $course_grade = Course::join('grades', 'courses.id', '=', 'grades.course_id')
        ->where('student_id', '=', $student->id)
        ->where('courses.term_id', '=', $t->id)
        ->get();




        return view('/currentreportcard', compact('school_year', 'grade', 'today', 'terms', 'count', 'student', 'termId', 'course_grade', 'student_group'));
    }


    // public function show($id)
    // {

    //     //get current date
    //     $today = Carbon::today();

    //     $findterm = Term::find($id);

    //     //dd($course->course_code);

    //     $term_id = $findterm->id;

    //     $user = Auth::user();

    //     $reg_code = $user->registration_code;

    //     $student = Student::where('registration_code', '=', $reg_code)->first();

    //     $student_group = Group::where('id','=', $student->group_id)->first();

    //     //get school year
    //     $school_year = School_year::first();

               
    //    $course_grade = Course::join('grades', 'courses.id', '=', 'grades.course_id')
    //     ->where('student_id', '=', $student->id)
    //     ->where('courses.term_id', '=', $findterm->id)
    //     ->get();


    //     return view('showreportCardTerm', compact('school_year', 'today', 'findterm', 'student', 'term_id', 'grade', 'course', 'student_group', 'course_grade'));

    //     //return view('show', compact('grade', 'course'));
    // }


}
