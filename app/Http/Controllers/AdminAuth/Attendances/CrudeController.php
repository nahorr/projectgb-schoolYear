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
	
    public function showStudents( School_year $schoolyear, Term $term)
    {

        
        return view('admin.attendances.showstudents', compact('schoolyear', 'term'));

    }

    public function addAttendance($student, School_year $schoolyear, Term $term)
    {

    	$student = Student::find(Crypt::decrypt($student));     

        $attendancecodes = AttendanceCode::pluck('code_name', 'id');

        
        return view('admin.attendances.addattendance', compact('student', 'attendancecodes', 'schoolyear', 'term'));

    }


    public function postAttendance(Request $r, $student, School_year $schoolyear, Term $term) 
    {
         
         $student = Student::find(Crypt::decrypt($student));
    	           

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

        return redirect()->route('showstudentsattendance', ['School_year_id' => $schoolyear->id, 'term_id' => $term->id]);
    }

    public function editAttendance($attendance, School_year $schoolyear, Term $term)
    {

        $attendance = Attendance::find(Crypt::decrypt($attendance));

            
        $attendancecodes = AttendanceCode::pluck('code_name', 'id');


        
        return view('admin.attendances.editattendance', compact('attendance', 'attendancecodes', 'schoolyear', 'term' ));

    }

     public function postAttendanceUpdate(Request $r, $attendance, School_year $schoolyear, Term $term )

        {
        
        $attendance_edit = Attendance::find(Crypt::decrypt($attendance));

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

        return redirect()->route('showstudentsattendance', ['School_year_id' => $schoolyear->id, 'term_id' => $term->id]);


         }

         public function deleteattendance($attendance)
         {
            Attendance::destroy(Crypt::decrypt($attendance));

            flash('Attendance has been deleted')->error();

            return back();
         }



}
