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
                

        //get current date
        $today = Carbon::today();

        //get Authenticated user
        $user = Auth::user();

        //all_users
        $all_users = User::get();

        //get user reg code
        $reg_code = $user->registration_code;


        $student = Student::where('registration_code', '=', $reg_code)->first();

        $student_group = Group::where('id','=', $student->group_id)->first();

        $class_members = Student::where('group_id', '=', $student_group->id)->get();
        $class_members_count = Student::where('group_id', '=', $student_group->id)->count();

        //Attendance
        $attendance_today = Attendance::join('attendance_codes', 'attendances.attendance_code_id', '=', 'attendance_codes.id')
                                    ->where('student_id', '=', $student->id)
                                    ->where('day', '=', $today)
                                    ->first();
       

        $att_code = AttendanceCode::get();

        //get events
        $events = Event::where('group_id', '=', $student->group_id)->orderBy('start_date', 'desc')->paginate(3);

        $upcomming_events = Event::where('group_id', '=', $student->group_id)->whereDate('start_date', '>', $today)->count();

        $active_events = Event::where('group_id', '=', $student->group_id)->where('start_date', '<=', $today)
                    ->Where('end_date', '>=', $today)->count();

        $expired_events = Event::where('group_id', '=', $student->group_id)->whereDate('end_date', '<', $today )->count();

        //Start of School statistics - school year
        //school max, min, total, count, school average
        $school_max = Grade::max('total');
        $school_min = Grade::min('total');
        $school_total = Grade::sum('total');
        $school_count = Grade::count('total');
        $school_avg = Grade::avg('total');

      
        //student stats - school year
        $student_max = Grade::where('student_id', '=', $student->id)->max('total');
        $student_min = Grade::where('student_id', '=', $student->id)->min('total');
        $student_total = Grade::where('student_id', '=', $student->id)->sum('total');
        $student_count = Grade::where('student_id', '=', $student->id)->count('total');
        $student_avg = Grade::where('student_id', '=', $student->id)->avg('total');

        //class statistics - school year
        $student_class_max = Course::join('grades', 'courses.id', '=', 'grades.course_id')
                ->where('courses.group_id', '=', $student->group_id)
                ->max('total');

        $student_class_min = Course::join('grades', 'courses.id', '=', 'grades.course_id')
                ->where('courses.group_id', '=', $student->group_id)
                ->min('total'); 

        $student_class_avg = Course::join('grades', 'courses.id', '=', 'grades.course_id')
                ->where('courses.group_id', '=', $student->group_id)
                ->avg('total');        
               

        //School-Student-Class Statistics- school year
        $school_class_student_chart = Charts::multi('bar', 'material')
                // Setup the chart settings
                ->title("School-Student-Class Year Statistics")
                // A dimension of 0 means it will take 100% of the space
                ->dimensions(0, 230) // Width x Height
                // This defines a preset of colors already done:)
                ->template("material")
                ->responsive(true)
                // You could always set them manually
                // ->colors(['#2196F3', '#F44336', '#FFC107'])
                // Setup the diferent datasets (this is a multi chart)
                ->dataset('School', [$school_min,$school_max,$school_avg])
                ->dataset('Student', [$student_min,$student_max,$student_avg])
                ->dataset('Class', [$student_class_min,$student_class_max,$student_class_avg])
                // Setup what the values mean
                ->labels(['Minimum', 'Maximum', 'Average']); 

        
        return view('/home', compact('events', 'class_members', 'all_users' , 'class_members_count','attendance_today', 'att_code',
                                     'upcomming_events', 'active_events', 'expired_events', 'school_max', 'school_min', 'school_avg', 'school_class_student_chart'


            ));
    }

    

}
