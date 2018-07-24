<?php

namespace App\Http\ViewComposers;
use Illuminate\Http\Request;

use Illuminate\View\View;
use App\Repositories\UserRepository;


use Carbon\Carbon;
use Auth;
use App\Student;
use App\Group;
use App\School_year;
use App\Term;
use App\Staffer;
use App\Fee;
use App\Feetype;
use App\School;
use App\LoginActivity;
use Location;
use App\StafferRegistration;
use App\StudentRegistration;
use App\User;
use App\Attendance;
use App\AttendanceCode;
use App\Grade;
use App\Course;
use Charts;



Class NavComposer {

    public function getIp(){
        $ip; 
        if (getenv("HTTP_CLIENT_IP")) 
        $ip = getenv("HTTP_CLIENT_IP"); 
        else if(getenv("HTTP_X_FORWARDED_FOR")) 
        $ip = getenv("HTTP_X_FORWARDED_FOR"); 
        else if(getenv("REMOTE_ADDR")) 
        $ip = getenv("REMOTE_ADDR"); 
        else 
        $ip = "UNKNOWN";
        return $ip; 
        
    }

	
	
	public function compose(View $view)
    {
        
    	//initialize number for irregular table numbering
        $number_init = 1;

        //get current date
        $today = Carbon::today();

        //school
        $school = School::first();

        //get school years
        $school_years = School_year::orderBy('start_date', 'desc')->get();

        //get current school year
        $current_school_year = @School_year::where([['start_date', '<=', $today], ['show_until', '>=', $today]])->first();

        //get term
        $terms = Term::get();

        $current_term = @Term::where([['start_date', '<=', $today], ['show_until', '>=', $today]])->first();

        //Students, Users and Registrations
        $all_users = User::get();

        $student = Student::where('registration_code', '=', Auth::user()->registration_code)->first();

        $registrations_student = StudentRegistration::with('student')->with('school_year')->with('term')->with('group')->where('student_id', '=', $student->id)->get();

        //teachers
        $registrations_teachers = StafferRegistration::with('staffer')->with('school_year')->with('term')->with('group')->get();

        
        $feetype = Feetype::get();

        //login Activity skip 1
        $login_activity = LoginActivity::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'desc')->skip(1)->take(1)->first();;

        //get ip address of logged in user
        $ip_address = $this->getIp();

        $location = Location::get($ip_address);

        //home page defaults to current school_year and current term//
        $students_teacher_current = @StafferRegistration::with('staffer')->with('school_year')->with('term')->with('group')->where('school_year_id', '=', $current_school_year->id)->where('term_id', '=', $current_term->id)->where('group_id', StudentRegistration::where('school_year_id', '=', $current_school_year->id)->where('term_id', '=', $current_term->id)->where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->first()->group_id)->first();       


        $class_members_current = @StudentRegistration::where('school_year_id', '=', $current_school_year->id)->where('term_id', '=', $current_term->id)->where('group_id', '=', StudentRegistration::where('school_year_id', '=', $current_school_year->id)->where('term_id', '=', $current_term->id)->where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->first()->group_id)->get();
       
        //Attendance
        $attendance_today = Attendance::join('attendance_codes', 'attendances.attendance_code_id', '=', 'attendance_codes.id')
                                      ->where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)
                                      ->where('day', '=', Carbon::today())
                                      ->first();

        $att_code = AttendanceCode::get();

        $attendance_records = Attendance::with('student')->with('term')->get();

        $school_max = Grade::max('total');
        $school_min = Grade::min('total');
        $school_total = Grade::sum('total');
        $school_count = Grade::count('total');
        $school_avg = Grade::avg('total');

      
        //student stats - school year
        $student_max = Grade::where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->max('total');
        $student_min = Grade::where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->min('total');
        $student_total = Grade::where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->sum('total');
        $student_count = Grade::where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->count('total');
        $student_avg = Grade::where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->avg('total');

         //class statistics - school year
        $student_class_max_current = @Course::join('grades', 'courses.id', '=', 'grades.course_id')
                ->where('courses.group_id', '=', StudentRegistration::where('school_year_id', '=', $current_school_year->id)->where('term_id', '=', $current_term->id)->where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->first()->group_id)
                ->max('total');

        $student_class_min_current = @Course::join('grades', 'courses.id', '=', 'grades.course_id')
                ->where('courses.group_id', '=', StudentRegistration::where('school_year_id', '=', $current_school_year->id)->where('term_id', '=', $current_term->id)->where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->first()->group_id)
                ->min('total'); 

        $student_class_avg_current = @Course::join('grades', 'courses.id', '=', 'grades.course_id')
                ->where('courses.group_id', '=', StudentRegistration::where('school_year_id', '=', $current_school_year->id)->where('term_id', '=', $current_term->id)->where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->first()->group_id)
                ->avg('total');        
               

        //School-Student-Class Statistics- school year
        $school_class_student_chart_current = Charts::multi('bar', 'material')
                // Setup the chart settings
                ->title("School-Student-Class Year Statistics")
                // A dimension of 0 means it will take 100% of the space
                ->dimensions(0, 230) // Width x Height
                // This defines a preset of colors already done:)
                ->template("material")
                ->responsive(true)
                // You could always set them manually
                ->colors(['#2196F3', '#F44336', '#FFC107'])
                // Setup the diferent datasets (this is a multi chart)
                ->dataset('School', [$school_min,$school_max,$school_avg])
                ->dataset('Student', [$student_min,$student_max,$student_avg])
                ->dataset('Class', [$student_class_min_current,$student_class_max_current,$student_class_avg_current])
                // Setup what the values mean
                ->labels(['Minimum', 'Maximum', 'Average']); 


        $current_courses = @Course::where('term_id', $current_term->id)->where('group_id', '=', StudentRegistration::where('school_year_id', '=', $current_school_year->id)->where('term_id', '=', $current_term->id)->where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->first()->group_id)->get();

        $staffers = Staffer::get();
        
        //dd($registrations_teachers);
        
        //put variables in views
        $view
        ->with('number_init', $number_init )
        ->with('today', $today )
        ->with('school', $school) 
        ->with('all_users', $all_users )
        //->with('reg_code', $reg_code )
        ->with('student', $student )
        //->with('student_group', $student_group )
        //->with('school_year', $school_year )
        ->with('school_years', $school_years )
        ->with('current_school_year', $current_school_year)
        ->with('current_term', $current_term)
        ->with('registrations_student', $registrations_student)
        ->with('registrations_teachers', $registrations_teachers)
        ->with('terms', $terms )
        //->with('students_teacher', $students_teacher )
        ->with('feetype', $feetype)
        ->with('login_activity', $login_activity)
        ->with('ip_address', $ip_address)
        ->with('location', $location)
        ->with('students_teacher_current', $students_teacher_current )
        ->with('class_members_current', $class_members_current)
        ->with('attendance_today', $attendance_today)
        ->with('att_code', $att_code)
        ->with('attendance_records', $attendance_records)
        ->with('school_max', $school_max)
        ->with('school_min', $school_min)
        ->with('school_total', $school_total)
        ->with('school_count', $school_count)
        ->with('school_avg', $school_avg)
        ->with('student_max', $student_max)
        ->with('student_min', $student_min)
        ->with('student_total', $student_total)
        ->with('student_count', $student_count)
        ->with('student_avg', $student_avg)
        ->with('student_class_max_current', $student_class_max_current)
        ->with('student_class_min_current', $student_class_min_current)
        ->with('student_class_avg_current', $student_class_avg_current)
        ->with('school_class_student_chart_current', $school_class_student_chart_current)
        ->with('current_courses', $current_courses)
        ->with('staffers', $staffers);
        

    }
}



