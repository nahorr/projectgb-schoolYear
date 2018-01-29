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
class TermController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }


    public function show($id)
    {

        $user = Auth::user();

        $reg_code = $user->registration_code;

        $student = Student::where('registration_code', '=', $reg_code)->first();

        $student_group = Group::where('id','=', $student->group_id)->first();


        //get current date
        $today = Carbon::today();

        //get events
        $events = Event::where('group_id', '=', '$student->group_id')->paginate(2);    

        $term = Term::find(Crypt::decrypt($id));

        $term_id = $term->id;

               
        
        
        //get term

        $terms = Term::get();

        foreach ($terms as $t){
            if ($today->between($t->start_date, $t->end_date )){
                $current_term =  $t->term;

            }
                                                         
        }
        

        $term_courses = Course::where('term_id', '=', $term_id)
                            ->where('group_id', '=', $student->group_id)
                            ->get();


        $count = 0;
        foreach ($term_courses as $course){
            
                $count = $count + 1;
                   
        }

        //Start of School statistics - current term
      
        //class statistics - current term
        $class_term_max = Course::join('grades', 'courses.id', '=', 'grades.course_id')
                ->where('courses.group_id', '=', $student->group_id)
                ->where('courses.term_id', '=', $term->id)
                ->max('total');

        $class_term_min = Course::join('grades', 'courses.id', '=', 'grades.course_id')
                ->where('courses.group_id', '=', $student->group_id)
                ->where('courses.term_id', '=', $term->id)
                ->min('total'); 

        $class_term_avg = Course::join('grades', 'courses.id', '=', 'grades.course_id')
                ->where('courses.group_id', '=', $student->group_id)
                ->where('courses.term_id', '=', $term->id)
                ->avg('total');        
               
        //student statistics - current term
        $student_term_max = Course::join('grades', 'courses.id', '=', 'grades.course_id')
                ->where('grades.student_id', '=', $student->id)
                ->where('courses.term_id', '=', $term->id)
                ->max('total');

        $student_term_min = Course::join('grades', 'courses.id', '=', 'grades.course_id')
                ->where('grades.student_id', '=', $student->id)
                ->where('courses.term_id', '=', $term->id)
                ->min('total'); 

        $student_term_avg = Course::join('grades', 'courses.id', '=', 'grades.course_id')
                ->where('grades.student_id', '=', $student->id)
                ->where('courses.term_id', '=', $term->id)
                ->avg('total'); 

        //School-Student-Class Statistics- current term
        $class_student_term_chart = Charts::multi('bar', 'material')
                // Setup the chart settings
                ->title("Student-Class Term Statistics")
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
       


        return view('/showtermcourses', 
        	compact('term_courses', 
        			'today', 'term', 'events', 'terms','term_id', 'student_group',
        			'student', 'grade', 'course', 'count', 'class_student_term_chart',
                    'student_term_max', 'student_term_avg', 'student_term_min'
                ));

        }
}
