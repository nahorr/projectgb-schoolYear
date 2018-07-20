<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\School_year;
use App\Event;
use App\Term;
use Carbon\Carbon;
use App\Course;
use Auth;
use Image;
use App\Student;
use App\Grade;
use App\Group;
use \Crypt;
use Charts;
use App\StudentRegistration;

class TermController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }


    public function showTermCourses(School_year $schoolyear, $term)
    {


        $term = Term::find(Crypt::decrypt($term));
        

        $term_courses = Course::where('term_id', '=', $term->id)
                            ->where('group_id', '=', StudentRegistration::where('school_year_id', '=', $schoolyear->id)->where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->first()->group_id)
                            ->get();


    
        //Start of School statistics - current term
      
        //class statistics - current term
        $class_term_max = Grade::where('school_year_id', $schoolyear->id)->where('term_id', $term->id)->where('group_id',StudentRegistration::where('school_year_id', '=', $schoolyear->id)->where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->first()->group_id)->max('total');                 
       
        $class_term_min = Grade::where('school_year_id', $schoolyear->id)->where('term_id', $term->id)->where('group_id',StudentRegistration::where('school_year_id', '=', $schoolyear->id)->where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->first()->group_id)->min('total'); 

        $class_term_avg = Grade::where('school_year_id', $schoolyear->id)->where('term_id', $term->id)->where('group_id',StudentRegistration::where('school_year_id', '=', $schoolyear->id)->where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->first()->group_id)->avg('total');        
               
        //student statistics - current term
        $student_term_max = Grade::where('school_year_id', $schoolyear->id)->where('term_id', $term->id)->where('group_id',StudentRegistration::where('school_year_id', '=', $schoolyear->id)->where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->first()->group_id)->where('student_id', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->max('total');

        $student_term_min = Grade::where('school_year_id', $schoolyear->id)->where('term_id', $term->id)->where('group_id',StudentRegistration::where('school_year_id', '=', $schoolyear->id)->where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->first()->group_id)->where('student_id', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->min('total'); 

        $student_term_avg = Grade::where('school_year_id', $schoolyear->id)->where('term_id', $term->id)->where('group_id',StudentRegistration::where('school_year_id', '=', $schoolyear->id)->where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->first()->group_id)->where('student_id', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->avg('total'); 

        //School-Student-Class Statistics- current term
        $class_student_term_chart = Charts::multi('bar', 'material')
                // Setup the chart settings
                ->title("Student-Class $term->term $schoolyear->school_year Statistics")
                // A dimension of 0 means it will take 100% of the space
                ->dimensions(0, 230) // Width x Height
                // This defines a preset of colors already done:)
                ->template("material")
                ->responsive(true)
                // You could always set them manually
                // ->colors(['#2196F3', '#F44336', '#FFC107'])
                // Setup the diferent datasets (this is a multi chart)
                //->dataset('School', [$school_min,$school_max,$school_avg])
                ->dataset('Student', [$student_term_min,$student_term_max,$student_term_avg])
                ->dataset('Class', [$class_term_min, $class_term_max, $class_term_avg])
                // Setup what the values mean
                ->labels(['Minimum', 'Maximum', 'Average']); 
       


        return view('showtermcourses', 
        	compact( 'schoolyear', 'term_courses', 'term','class_student_term_chart',
                    'student_term_max', 'student_term_avg', 'student_term_min'));

        }
}
