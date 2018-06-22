<?php

namespace App\Http\Controllers\AdminAuth\Attendances;

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
use App\HealthRecord;
use App\Attendance;
use App\AttendanceCode;
use \Crypt;

class CrudeController extends Controller
{
	public function showTerms()
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


        //get school school
        $schoolyear = School_year::first();

        

        return view('/admin.attendances.showterms', compact('today', 'count', 'group_teacher', 'current_term', 
            'schoolyear', 'students_in_group', 'all_user', 'st_user',  'terms'));
   
    }


    public function showStudents()
    {

        
        return view('admin.attendances.showstudents');

    }

    public function addAttendance($student_id)
    {

    	$student = Student::find(Crypt::decrypt($student_id));     

        $attendancecodes = AttendanceCode::pluck('code_name', 'id');

        
        return view('admin.attendances.addattendance', compact('student', 'attendancecodes'));

    }


    public function postAttendance(Request $r, $student_id) 
    {
         
         $student = Student::find(Crypt::decrypt($student_id));
    	           

        $this->validate(request(), [

            'student_id' => 'required',
            'term_id' => 'required',
            'day' => 'required|unique_with:attendances,student_id, term_id',
            'attendance_code_id' => 'required',
            'teacher_comment' => 'required',
            
            
            ]);


        Attendance::insert([

            'student_id'=>$r->student_id,
            'term_id'=>$r->term_id,
            'day'=>$r->day,
            'attendance_code_id'=>$r->attendance_code_id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'teacher_comment'=>$r->teacher_comment,
            
        ]);

       
        flash('Attendance Added Successfully')->success();

        return redirect()->route('showstudentsattendance');
    }

    public function editAttendance($attendance_id)
    {

        $attendance = Attendance::find(Crypt::decrypt($attendance_id));

            
        $attendancecodes = AttendanceCode::pluck('code_name', 'id');


        
        return view('admin.attendances.editattendance', compact('attendance', 'attendancecodes'));

    }

     public function postAttendanceUpdate(Request $r, $student_id)

        {
        
        $student = Student::find(Crypt::decrypt($student_id));

        $this->validate(request(), [

            'student_id' => 'required',
            'term_id' => 'required',
            'day' => 'required',
            'attendance_code_id' => 'required',
            'teacher_comment' => 'required',
                
                ]);

      
        //get current date
        $today = Carbon::today();

                
                                        
        $attendance_edit = Attendance::where('student_id', '=', $student->id)
                                        ->where('day', '=', $today)
                                        ->first();


                    
        $attendance_edit->attendance_code_id= $r->attendance_code_id;
        $attendance_edit->teacher_comment= $r->teacher_comment;
                   
            

           

        $attendance_edit->save();

        flash('Attendance Updated Successfully')->success();

        return redirect()->route('showstudentsattendance');


         }

         public function deleteattendance($attendance_id)
         {
            Attendance::destroy(Crypt::decrypt($attendance_id));

            flash('Attendance has been deleted')->error();

            return back();
         }



}
