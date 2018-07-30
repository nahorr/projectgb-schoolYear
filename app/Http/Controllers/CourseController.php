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
use App\StudentRegistration;



class CourseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index(School_year $schoolyear)
    {
         //get current school year
        $current_school_year = School_year::where([['start_date', '<=', Carbon::today()], ['show_until', '>=', Carbon::today()]])->first();

        //Start of School statistics
        //school max, min, total, count, school average
        $school_max_school_year = Grade::where('school_year_id', $schoolyear->id)->max('total');
        $school_min_school_year = Grade::where('school_year_id', $schoolyear->id)->min('total');
        $school_total_school_year = Grade::where('school_year_id', $schoolyear->id)->sum('total');
        $school_count_school_year = Grade::where('school_year_id', $schoolyear->id)->count('total');
        $school_avg_school_year = Grade::where('school_year_id', $schoolyear->id)->avg('total');

        $chart_student_average = Charts::create('bar', 'highcharts')
                ->title(" $current_school_year->school_year School Wide Statistics")
                ->elementLabel('Grade(%)')
                ->labels(['School Minimum', 'School Maximum', 'School Average'])
                ->values([ $school_min_school_year, $school_max_school_year, $school_avg_school_year])
                ->dimensions(0,230);  


        return view('currentcourses', compact( 'current_school_year', 'schoolyear', 'chart_student_average', 'school_max', 'school_min', 'school_avg'));
    }

  

    
    public function showCourse(School_year $schoolyear, Term $term, $course)
    {

        $course = Course::find(Crypt::decrypt($course));

        $student = Student::where('registration_code', '=', Auth::user()->registration_code)->first();

        $class_members = @StudentRegistration::where('school_year_id', '=', $schoolyear->id)->where('term_id', $term->id)->where('group_id', '=', StudentRegistration::where('school_year_id', '=', $schoolyear->id)->where('term_id', '=', $term->id)->where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->first()->group_id)->get();
 
        $student_grades= Student::join('grades', 'students.id', '=', 'grades.student_id')->where('grades.course_id', '=', $course->id)->orderBy('total', 'desc')->get();
      
        $positions= Student::join('grades', 'students.id', '=', 'grades.student_id')->where('grades.course_id', '=', $course->id)->orderBy('total', 'desc')->pluck('student_id')->toArray();


        
        $class_highest = Grade::where('course_id', '=', $course->id)->max('total');
        $class_lowest = Grade::where('course_id', '=', $course->id)->min('total');
        $class_average = Grade::where('course_id', '=', $course->id)->avg('total');


        $grade = Grade::where('student_id', '=', $student->id)->where('course_id', '=', $course->id)->first();

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

       
                

        return view('showcourse', compact( 'schoolyear', 'term', 'grade', 'course', 'student_grades', 'positions','class_highest',
            'class_lowest', 'class_average', 'chart_ca', 'chart_class_stats', 'chart_total_score', 'class_members' ));

    }

    
}
