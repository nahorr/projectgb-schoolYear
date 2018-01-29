<?php

namespace App\Http\Controllers\AdminAuth\ReportCards;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\School_year;
use App\School;
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
use App\HealthRecord;
use \Crypt;
use PDF;
use App\Grade;
use App\Course;
use App\Attendance;
use DB;
use App\Psychomotor;
use App\EffectiveArea;
use App\LearningAndAccademic;

class CrudeController extends Controller
{
    public function Terms()
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

            }
                                                         
        }

        //get school school
        $schoolyear = School_year::first();

        

        return view('/admin.reportcards.terms', compact('today', 'count', 'group_teacher', 'current_term', 
            'schoolyear', 'students_in_group', 'all_user', 'st_user',  'terms','t'));
   
    }

    public function Students($term_id)
    {


        $term = Term::find(Crypt::decrypt($term_id));
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

            }
                                                         
        }
        

               
        //get school school
        $schoolyear = School_year::first();

        

        return view('/admin/reportcards/students', compact('today', 'count', 'teacher', 'group_teacher', 'current_term', 
            'schoolyear', 'students_in_group', 'all_user', 'st_user', 'terms', 'term'));
    }

   

    public function Print($student_id, $term_id )
            {

                //get current date
                $today = Carbon::today();

                $term = Term::find($term_id);
                $next_term = Term::find($term->id+1);
                $terms = Term::get();
                $student = Student::find($student_id);

                $student_user = User::where('registration_code', '=', $student->registration_code)->first();
                $students = Student::where('group_id', '=', $student->group_id)->get();
                $school = School::first();
                $school_year = School_year::first();

                //teacher
                $teacher = Staffer::where('group_id', '=', $student->group_id)->first();
                $student_group = Group::where('id', '=', $student->group_id)->first();

                $course_grade = Course::join('grades', 'courses.id', '=', 'grades.course_id')
                ->where('student_id', '=', $student->id)
                ->where('courses.term_id', '=', $term->id)
                ->get();

                //Rank
                //$mgb_total = DB::table('grades')->groupBy('student_id')->get(['student_id', DB::raw('SUM(total) as sum')]);
                $mgb_total_term_grade = Course::join('grades', 'courses.id', '=', 'grades.course_id')
                                ->where('courses.term_id', '=', $term->id)
                                ->groupBy('student_id')
                                ->get(['student_id', DB::raw('SUM(total) as sum')]);

                $mgb_total_term_grade_sorted = $mgb_total_term_grade->sortByDesc('sum');

                $pluck_mgb_total_term_grade_sorted = $mgb_total_term_grade_sorted->pluck('student_id')->toArray();

                //dd($pluck_mgb_total_term_grade_sorted);

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

                $psychomotor = Psychomotor::where('student_id', '=', $student->id)
                                            ->where('term_id', '=', $term_id)
                                            ->first();

                $effective_areas = EffectiveArea::where('student_id', '=', $student->id)
                                            ->where('term_id', '=', $term_id)
                                            ->first();
                $learnining_accademic = LearningAndAccademic::where('student_id', '=', $student->id)
                                            ->where('term_id', '=', $term_id)
                                            ->first();

                $pdf = PDF::loadView('admin.reportcards.print', 
                    compact('today', 'term', 'next_term', 'terms','student', 'student_user', 'students','school', 'school_year'
                        , 'teacher','student_group', 'course_grade', 'health_record', 'attendance',
                        'attendance_code', 'attendance_present', 'attendance_absent', 'attendance_late',
                        'mgb', 'mgb_lowest', 'mgb_avg', 'pluck_course_id', 'pluck_course_id_min',
                        'pluck_course_id_avg', 'course_grade_all_students', 'sorted', 'sorted_grouped', 'comment_all'
                        , 'psychomotor', 'effective_areas', 'learnining_accademic', 'mgb_total_term_grade', 'mgb_total_term_grade_sorted'
                        , 'pluck_mgb_total_term_grade_sorted'));

                return $pdf->inline('reportcard.pdf');
            }

 

        public function PrintAll($term_id )
            {
               
                $school = School::first();
                $school_year = School_year::first();

                //get current date
                $today = Carbon::today();

                //get current term and terms
                $term = Term::find($term_id);
                $next_term = Term::find($term->id+1);
                
                $terms = Term::get();


                //Class teacher using logged in user
                //teacher
                $teacher = Staffer::where('registration_code', '=', Auth::guard('web_admin')->user()->registration_code)->first();
                

                //students in the teachers group
                $students = Student::where('group_id', '=', $teacher->group_id)->get();

                

                $student_group = Group::where('id', '=', $teacher->group_id)->first();

                //get all registered users 

                
                $student_users = User::get();


 
                
                $course_grades = Course::join('grades', 'courses.id', '=', 'grades.course_id')
                                ->where('courses.term_id', '=', $term->id)
                                ->get();

                //Rank
                //$mgb_total = DB::table('grades')->groupBy('student_id')->get(['student_id', DB::raw('SUM(total) as sum')]);
                $mgb_total_term_grade = Course::join('grades', 'courses.id', '=', 'grades.course_id')
                                ->where('courses.term_id', '=', $term->id)
                                ->groupBy('student_id')
                                ->get(['student_id', DB::raw('SUM(total) as sum')]);

                $mgb_total_term_grade_sorted = $mgb_total_term_grade->sortByDesc('sum');

                $pluck_mgb_total_term_grade_sorted = $mgb_total_term_grade_sorted->pluck('student_id')->toArray();

                //dd($mgb_total_term_grade_sorted);


                //get health records
        
                $health_records = HealthRecord::where('term_id', '=', $term->id)->get();


               
                $attendances = Attendance::where('term_id', '=', $term->id)->get();

              

                $mgb = DB::table('grades')->groupBy('course_id')->get(['course_id', DB::raw('MAX(total) as max')]);



                $mgb_lowest = DB::table('grades')->groupBy('course_id')->get(['course_id', DB::raw('min(total) as min')]);

           
                $mgb_avg = DB::table('grades')->groupBy('course_id')->get(['course_id', DB::raw('avg(total) as avg')]);
                
                

                $pluck_course_id = $mgb->pluck('course_id')->toArray(); 

                $pluck_course_id_min = $mgb_lowest->pluck('course_id')->toArray();
                
                $pluck_course_id_avg = $mgb_avg->pluck('course_id')->toArray(); 


                $course_grade_all_students = Course::join('grades', 'courses.id', '=', 'grades.course_id')
                ->where('courses.group_id', '=', $teacher->group_id)
                ->where('courses.term_id', '=', $term->id)
                ->get();

                
            
                $sorted = $course_grade_all_students->sortByDesc('total'); 

                $sorted_grouped = $course_grade_all_students->sortByDesc('total')->groupBy('course_id');

                //addd comments
                $comment_all = Comment::where('term_id', '=', $term->id)->get();
                
                $psychomotors = Psychomotor::where('term_id', '=', $term_id)->get();

                $effective_areas = EffectiveArea::where('term_id', '=', $term_id)->get();

                $learnining_accademics = LearningAndAccademic::where('term_id', '=', $term_id)->get();

                $pdf = PDF::loadView('admin.reportcards.printall', 
                    compact('today', 'term', 'terms', 'next_term','student', 'student_users', 'students','school', 'school_year'
                        , 'teacher','student_group', 'course_grades', 'health_records', 'attendances',
                        'attendance_code', 'attendance_present', 'attendance_absent', 'attendance_late',
                        'mgb', 'mgb_lowest', 'mgb_avg', 'pluck_course_id', 'pluck_course_id_min',
                        'pluck_course_id_avg', 'course_grade_all_students', 'sorted', 'sorted_grouped', 'comment_all',
                        'psychomotors', 'effective_areas', 'learnining_accademics', 'mgb_total_term_grade', 'mgb_total_term_grade_sorted', 'pluck_mgb_total_term_grade_sorted'));

                return $pdf->inline('allreportcard.pdf');
            }
}
   