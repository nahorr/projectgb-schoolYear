<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;

use App\Http\Requests;
use App\School_year;

use App\Term;
use Carbon\Carbon;
use App\Course;
use Auth;
use Image;
use App\Student;


use App\Grade;
use App\Group;
use App\Comment;
use App\Staffer;
use App\HealthRecord;
use App\Attendance;

use DB;
use PDF;
use \Crypt;


class ReportCardsController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
                

        //get events
        $events = Event::paginate(2);



        return view('/reportcards', compact('events'));
    }

    public function show($id)
    {

        //get current date
        $today = Carbon::today();

        $term = Term::find(Crypt::decrypt($id));

        $term_id = $term->id;

        $next_term_id = $term_id +1;

        $next_term = Term::find( $next_term_id);

       // dd($next_term);
               
        $user = Auth::user();

        $reg_code = $user->registration_code;

        $student = Student::where('registration_code', '=', $reg_code)->first();



        $student_group = Group::where('id','=', $student->group_id)->first();


        $next_group = Group::where('id','=', $student->group_id+2)->first();

        
        $student_teacher = Staffer::where('group_id', '=', $student_group->id )->first();

        $students_all = Student::where('group_id', '=', $student_group->id)->get();

                              
        //get term

        $terms = Term::get();

        //dd($student_group);


        
        $course_grade = Course::join('grades', 'courses.id', '=', 'grades.course_id')
        ->where('student_id', '=', $student->id)
        ->where('courses.term_id', '=', $term->id)
        ->get();


        //dd($course_grade->sum('total')/$course_grade->count());

        
        $mgb = DB::table('grades')->groupBy('course_id')->get(['course_id', DB::raw('MAX(total) as max')]);



        $mgb_lowest = DB::table('grades')->groupBy('course_id')->get(['course_id', DB::raw('min(total) as min')]);

   
        $mgb_avg = DB::table('grades')->groupBy('course_id')->get(['course_id', DB::raw('avg(total) as avg')]);
        
        

        $pluck_course_id = $mgb->pluck('course_id')->toArray(); 

        $pluck_course_id_min = $mgb_lowest->pluck('course_id')->toArray();
        
        $pluck_course_id_avg = $mgb_avg->pluck('course_id')->toArray(); 


        //$mgb_sum = DB::table('grades')->groupBy('course_id')->get(['course_id', DB::raw('sum(total) as max')]);

        


        $course_grade_all_students = Course::join('grades', 'courses.id', '=', 'grades.course_id')
        ->where('courses.group_id', '=', $student->group_id)
        ->where('courses.term_id', '=', $term->id)
        ->get();



        //$mgb_rank = DB::table('grades')->groupBy('course_id')->select('course_id', DB::raw('sum(total) as sum'), DB::raw('@r:=@r+1 as rank'),DB::raw('@l:=total'))->get();
        
    
        $sorted = $course_grade_all_students->sortByDesc('total');



        $sorted_grouped = $course_grade_all_students->sortByDesc('total')->groupBy('course_id');

        //dd($sorted_grouped);

        

        //addd comments
        $comment_all = Comment::where('student_id', '=', $student->id)
                                    ->where('term_id', '=', $term_id)
                                    ->first();

       //get health records
        
        $health_record = HealthRecord::where('student_id', '=', $student->id)
                        ->where('term_id', '=', $term->id)
                        ->first();
       
        $attendance = Attendance::where('student_id', '=', $student->id)
                                    ->where('term_id', '=', $term->id)
                                    ->count();

        $attendance_code = Attendance::join('attendance_codes', 'attendances.attendance_code_id', '=', 'attendance_codes.id')
                                    ->where('student_id', '=', $student->id)
                                    ->where('term_id', '=', $term->id)
                                    ->get();


        $attendance_present = $attendance_code->where('code_name', '=', 'Present')->count();
        $attendance_absent = $attendance_code->where('code_name', '=', 'Absent')->count();
        $attendance_late = $attendance_code->where('code_name', '=', 'Late')->count();

        
                  
        
        return view('/showtermreportcard', 
        	compact('today', 'term','terms','term_id', 'student_group',
        			'student', 'grade', 'course', 'course_grade',
                    'mgb', 'mgb_lowest', 'mgb_avg', 
                    'pluck_course_id', 'pluck_course_id_min', 'pluck_course_id_avg',
                    'comment_all', 'student_teacher', 'students_all', 'next_group',
                    'sorted_grouped', 'next_term', 'health_record', 'attendance_present',
                    'attendance_absent', 'attendance_late', 'attendance'
                    ));

        }

        public function pdfshow($id)
            {

                //get current date
                $today = Carbon::today();

                $term = Term::find(Crypt::decrypt($id));

                $term_id = $term->id;

                       
                $user = Auth::user();

                $reg_code = $user->registration_code;

                $student = Student::where('registration_code', '=', $reg_code)->first();



                $student_group = Group::where('id','=', $student->group_id)->first();


                $next_group = Group::where('id','=', $student->group_id+2)->first();

                
                $student_teacher = Staffer::where('group_id', '=', $student_group->id )->first();

                $students_all = Student::where('group_id', '=', $student_group->id)->get();

                                      
                //get term

                $terms = Term::get();

                //dd($student_group);


                
                $course_grade = Course::join('grades', 'courses.id', '=', 'grades.course_id')
                ->where('student_id', '=', $student->id)
                ->where('courses.term_id', '=', $term->id)
                ->get();

                //dd($course_grade->sum('total')/$course_grade->count());

                
                $mgb = DB::table('grades')->groupBy('course_id')->get(['course_id', DB::raw('MAX(total) as max')]);



                $mgb_lowest = DB::table('grades')->groupBy('course_id')->get(['course_id', DB::raw('min(total) as min')]);

           
                $mgb_avg = DB::table('grades')->groupBy('course_id')->get(['course_id', DB::raw('avg(total) as avg')]);
                
                

                $pluck_course_id = $mgb->pluck('course_id')->toArray(); 

                $pluck_course_id_min = $mgb_lowest->pluck('course_id')->toArray();
                
                $pluck_course_id_avg = $mgb_avg->pluck('course_id')->toArray(); 


                $course_grade_all_students = Course::join('grades', 'courses.id', '=', 'grades.course_id')
                ->where('courses.group_id', '=', $student->group_id)
                ->where('courses.term_id', '=', $term->id)
                ->get();

                
            
                $sorted = $course_grade_all_students->sortByDesc('total');

                $sorted_grouped = $course_grade_all_students->sortByDesc('total')->groupBy('course_id');

                


                //addd comments
                $comment_all = Comment::where('student_id', '=', $student->id)
                                            ->where('term_id', '=', $term_id)
                                            ->first();

                //get health records
                $health_record = HealthRecord::where('student_id', '=', $student->id)
                        ->where('term_id', '=', $term->id)
                        ->first();

               
                $attendance = Attendance::where('student_id', '=', $student->id)
                                            ->where('term_id', '=', $term->id)
                                            ->count();

                $attendance_code = Attendance::join('attendance_codes', 'attendances.attendance_code_id', '=', 'attendance_codes.id')
                                            ->where('student_id', '=', $student->id)
                                            ->where('term_id', '=', $term->id)
                                            ->get();


                $attendance_present = $attendance_code->where('code_name', '=', 'Present')->count();
                $attendance_absent = $attendance_code->where('code_name', '=', 'Absent')->count();
                $attendance_late = $attendance_code->where('code_name', '=', 'Late')->count();
              


               /* $pdf = PDF::loadView('pdfshowtermreportcard', 
                    compact('today', 'term','terms','term_id', 'student_group',
                            'student', 'grade', 'course', 'course_grade',
                            'mgb', 'mgb_lowest', 'mgb_avg', 
                            'pluck_course_id', 'pluck_course_id_min', 'pluck_course_id_avg',
                            'comment_all', 'student_teacher', 'students_all', 'next_group', 'sorted_grouped'          
                            ))->setPaper('a0')->setOrientation('landscape');

                return $pdf->download('reportcard.pdf');



                }*/
}
}
