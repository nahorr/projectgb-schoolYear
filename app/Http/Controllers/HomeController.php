<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\School_year;
use App\Event;
use App\Term;
use Carbon\Carbon;

use App\Http\Requests;
use Auth;
use Image;
use App\Student;
use App\User;

use App\Group;
use App\Attendance;
use App\AttendanceCode;
use Charts;
use \Crypt;
use App\LoginActivity;
use Location;
use App\Grade;
use App\Course;
use App\StafferRegistration;
use App\StudentRegistration;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        return view('home');
    }

    public function selectYearModal()
    {

        return view('selectYearModal');
    }

    public function homeSchoolYear(School_year $schoolyear)
    {
        

        $students_teachers = @StafferRegistration::with('staffer')->with('school_year')->with('term')->with('group')->where('school_year_id', '=', $schoolyear->id)->where('group_id', StudentRegistration::where('school_year_id', '=', $schoolyear->id)->where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->first()->group_id)->get(); 
            


        $class_members = @StudentRegistration::where('school_year_id', '=', $schoolyear->id)->where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->get();
       
        //Attendance
        $attendance_today = Attendance::join('attendance_codes', 'attendances.attendance_code_id', '=', 'attendance_codes.id')
                                      ->where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)
                                      ->where('day', '=', Carbon::today())
                                      ->first();
        $join_term_attendance = Term::join('attendances', 'terms.id', '=', 'attendances.term_id')->get();

        $att_code = AttendanceCode::get();

        //get events
       // $events = Event::where('group_id', '=', $student->group_id)->orderBy('start_date', 'desc')->paginate(3);

        //$upcomming_events = Event::where('group_id', '=', $student->group_id)->whereDate('start_date', '>', $today)->count();

        //$active_events = Event::where('group_id', '=', $student->group_id)->where('start_date', '<=', $today)
                    //->Where('end_date', '>=', $today)->count();

        //$expired_events = Event::where('group_id', '=', $student->group_id)->whereDate('end_date', '<', $today )->count();


        //Start of School statistics - school year
        //school max, min, total, count, school average
        $school_max_school_year = Grade::where('school_year_id', $schoolyear->id)->max('total');
        $school_min_school_year = Grade::where('school_year_id', $schoolyear->id)->min('total');
        $school_total_school_year = Grade::where('school_year_id', $schoolyear->id)->sum('total');
        $school_count_school_year = Grade::where('school_year_id', $schoolyear->id)->count('total');
        $school_avg_school_year = Grade::where('school_year_id', $schoolyear->id)->avg('total');

        //Start of School statistics - All school years
        //school max, min, total, count, school average
        $school_max = Grade::max('total');
        $school_min = Grade::min('total');
        $school_total = Grade::sum('total');
        $school_count = Grade::count('total');
        $school_avg = Grade::avg('total');

        //student stats - school year
        $student_max_school_year = Grade::where('school_year_id', $schoolyear->id)->where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->max('total');
        $student_min_school_year = Grade::where('school_year_id', $schoolyear->id)->where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->min('total');
        $student_total_school_year = Grade::where('school_year_id', $schoolyear->id)->where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->sum('total');
        $student_count_school_year = Grade::where('school_year_id', $schoolyear->id)->where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->count('total');
        $student_avg_school_year = Grade::where('school_year_id', $schoolyear->id)->where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->avg('total');
      
        //student stats - All school year
        $student_max = Grade::where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->max('total');
        $student_min = Grade::where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->min('total');
        $student_total = Grade::where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->sum('total');
        $student_count = Grade::where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->count('total');
        $student_avg = Grade::where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->avg('total');


        //class statistics - school year
        $student_class_max_school_year = Grade::where('school_year_id', $schoolyear->id)->where('group_id', '=', StudentRegistration::where('school_year_id', '=', $schoolyear->id)->where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->first()->group_id)->max('total');
                
        $student_class_min_school_year = Grade::where('school_year_id', $schoolyear->id)->where('group_id', '=', StudentRegistration::where('school_year_id', '=', $schoolyear->id)->where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->first()->group_id)->min('total'); 

        $student_class_avg_school_year = Grade::where('school_year_id', $schoolyear->id)->where('group_id', '=', StudentRegistration::where('school_year_id', '=', $schoolyear->id)->where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->first()->group_id)->avg('total');  



        //class statistics - All school year
        $student_class_max = @Course::join('grades', 'courses.id', '=', 'grades.course_id')
                ->where('courses.group_id', '=', StudentRegistration::where('school_year_id', '=', $schoolyear->id)->where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->first()->group_id)
                ->max('total');

        $student_class_min = @Course::join('grades', 'courses.id', '=', 'grades.course_id')
                ->where('courses.group_id', '=', StudentRegistration::where('school_year_id', '=', $schoolyear->id)->where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->first()->group_id)
                ->min('total'); 

        $student_class_avg = @Course::join('grades', 'courses.id', '=', 'grades.course_id')
                ->where('courses.group_id', '=', StudentRegistration::where('school_year_id', '=', $schoolyear->id)->where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->first()->group_id)
                ->avg('total');        
               

        //School-Student-Class Statistics- school year
        $school_class_student_chart = Charts::multi('bar', 'material')
                // Setup the chart settings
                ->title("School-Student-Class $schoolyear->school_year Statistics")
                // A dimension of 0 means it will take 100% of the space
                ->dimensions(0, 235) // Width x Height
                // This defines a preset of colors already done:)
                ->template("material")
                ->responsive(true)
                // You could always set them manually
                ->colors(['#2196F3', '#F44336', '#FFC107'])
                // Setup the diferent datasets (this is a multi chart)
                ->dataset('School', [$school_min_school_year,$school_max_school_year,$school_avg_school_year])
                ->dataset('Student', [$student_min_school_year,$student_max_school_year,$student_avg_school_year])
                ->dataset('Class', [$student_class_min_school_year,$student_class_max_school_year,$student_class_avg_school_year])
                // Setup what the values mean
                ->labels(['Minimum', 'Maximum', 'Average']); 

        
        return view('homeSchoolYear', compact('students_teacher', 'schoolyear', 'term', 'class_members', 'attendance_today', 'att_code','school_max', 'school_min', 'school_avg', 'school_class_student_chart', 'school_max_school_year', 'school_min_school_year', 'school_avg_school_year', 'join_term_attendance'));
    }

    

}
