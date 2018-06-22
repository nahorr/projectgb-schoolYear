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
      

        return view('admin.attendances.showterms');
   
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

     public function postAttendanceUpdate(Request $r, $attendance_id)

        {
        
        $attendance_edit = Attendance::find(Crypt::decrypt($attendance_id));

        $this->validate(request(), [

            'student_id' => 'required',
            'term_id' => 'required',
            'day' => 'required',
            'attendance_code_id' => 'required',
            'teacher_comment' => 'required',
                
                ]);

                          
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
