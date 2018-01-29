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
use Charts;
use \Crypt;



class CourseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index()
    {
        
        //get current date
        $today = Carbon::today(); 



        //get Authenticated user
        $user = Auth::user();

        //get user reg code
        $reg_code = $user->registration_code;

        //get student 
        $student = Student::where('registration_code', '=', $reg_code)->first();



        //get studnt group
        $student_group = Group::where('id','=', $student->group_id)->first();  

    
        //get term
        $terms = Term::get();

        foreach ($terms as $t){
            if ($today->between($t->start_date, $t->show_until )){
                $termId =  $t->id;

            }
                                                         
        }

        $current_courses = Course::where('term_id', '=', $termId)
                            ->where('group_id', '=', $student->group_id)
                            ->get();



             
        $count = 0;
        foreach ($current_courses as $course){
            
                $count = $count + 1;
                   
        }
       
        //get events
        $events = Event::where('group_id', '=', $student->group_id)
                ->where('term_id', '=', $termId)
                ->paginate(2);

        //Start of School statistics
        //school max, min, total, count, school average
        $school_max = Grade::max('total');
        $school_min = Grade::min('total');
        $school_total = Grade::sum('total');
        $school_count = Grade::count('total');
        $school_avg = Grade::avg('total');

        $chart_student_average = Charts::create('bar', 'highcharts')
                ->title('Year School Wide Statistics')
                ->elementLabel('Grade(%)')
                ->labels(['School Minimum', 'School Maximum', 'School Average'])
                ->values([ $school_min, $school_max, $school_avg])
                ->dimensions(0,230);  


        return view('/courses', compact('terms', 'termId', 'events', 'current_courses', 'count', 
            'student', 'chart_student_average', 'school_max', 'school_min', 'school_avg'));
    }

  

    
    public function show($id)
    {

        //get current date
        $today = Carbon::today();

        $course = Course::find(Crypt::decrypt($id));

        
        $course_id = $course->id;

       

        $user = Auth::user();

        $reg_code = $user->registration_code;

        $student = Student::where('registration_code', '=', $reg_code)->first();


        $student_group = Group::where('id','=', $student->group_id)->first();

        $class_members = Student::where('group_id', '=', $student->group_id)->get();

       
        $student_grades= Student::join('grades', 'students.id', '=', 'grades.student_id')
        ->where('grades.course_id', '=', $course->id)
        ->orderBy('total', 'desc')
        ->get();


      
        $positions= Student::join('grades', 'students.id', '=', 'grades.student_id')
        ->where('grades.course_id', '=', $course->id)
        ->orderBy('total', 'desc')
        ->pluck('student_id')
        ->toArray();


        
        $class_highest = Grade::where('course_id', '=', $course->id)->max('total');
        $class_lowest = Grade::where('course_id', '=', $course->id)->min('total');
        $class_average = Grade::where('course_id', '=', $course->id)->avg('total');

               
        //get term

        $terms = Term::get();

        foreach ($terms as $t){
            if ($today->between($t->start_date, $t->end_date )){
                $current_term =  $t->term;

            }
                                                         
        }

        foreach ($terms as $t){
            if ($today->between($t->start_date, $t->end_date )){
                $termId =  $t->id;

            }
        }


        $grade = Grade::where('student_id', '=', $student->id)
        ->where('course_id', '=', $course_id)
        ->first();

        $chart_ca = Charts::create('pie', 'highcharts')
                ->title('Course Statistics _ % of total Score')
                ->labels(['1st CA', '2nd CA', '3rd CA', '4th CA', 'Final Exam'])
                ->values([ @$grade->first_ca, @$grade->second_ca, @$grade->third_ca, @$grade->fourth_ca, @$grade->exam ])
                ->dimensions(0,260);

        $chart_class_stats = Charts::create('bar', 'highcharts')
                ->title('Class Statistics')
                ->labels(['Class Minimum', 'Class Maximum', 'Class Average'])
                ->values([ $class_lowest, $class_highest, $class_average])
                ->dimensions(0,230);

        $chart_total_score = Charts::create('percentage', 'justgage')
                ->title('Your total Score')
                ->elementLabel('%')
                ->values([@$grade->total,0,100])
                ->responsive(false)
                ->height(260)
                ->width(0);

       
                

        return view('/show', compact('current_term', 'today', 'terms', 'student', 'termId', 'grade', 'course', 'student_group',
            'student_grades', 'positions','class_highest',
            'class_lowest', 'class_average', 'chart_ca', 'chart_class_stats', 'chart_total_score', 'class_members' ));

    }

    
}
