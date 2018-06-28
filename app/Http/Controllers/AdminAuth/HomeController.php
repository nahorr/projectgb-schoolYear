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
    public function selectTerm()
    {

        return view('admin.selectTerm');
    }

    public function index($schoolyear, $term)
    {

        $schoolyear = School_year::find($schoolyear);

        $term = Term::find($term);

        $reg_teacher = StafferRegistration::where('school_year_id', '=', $schoolyear->id)->where('term_id', '=', $term->id)->first();

        $regs_students = StafferRegistration::where('school_year_id', '=', $schoolyear->id)->where('term_id', '=', $term->id)->get();

        $regs_students_first = StafferRegistration::where('school_year_id', '=', $schoolyear->id)->where('term_id', '=', $term->id)->first();

        //dd($reg_teacher->group_id);
       
        return view('admin.home', compact('schoolyear', 'term', 'reg_teacher', 'regs_students', 'regs_students_first'));
    }


    public function printRegCode ($student_id)
    {

        $student =  Student::find($student_id);


        $term_tuitions = Fee::get();

        
        $pdf = PDF::loadView('admin.printregcode',compact('student', 'term_tuitions'));

        return $pdf->inline();

    }

    public function printAllRegCode ()
    {

        $term_tuitions = Fee::get();
       
        $pdf = PDF::loadView('admin.printallregcode',compact('term_tuitions'));

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