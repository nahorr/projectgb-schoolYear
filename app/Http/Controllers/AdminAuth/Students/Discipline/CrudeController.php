<?php

namespace App\Http\Controllers\AdminAuth\Students\Discipline;

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
use App\DailyActivity;
use App\DisciplinaryRecord;
use File;

use Notification;
use App\Notifications\DisciplinaryRecordPosted;


class CrudeController extends Controller
{
    public function allStudents()
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

        //get drecords
        $drecords = DisciplinaryRecord::get();



    	return view('admin.students.discipline.allstudents', compact('today', 'count', 'group_teacher', 'current_term', 
            'schoolyear', 'students_in_group', 'all_user', 'st_user',  'terms', 'student_activities', 'drecords'));
    }

    public function studentDRecords($student_id)
    {

        $student = Student::find($student_id);
        
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

        //get drecords
        $drecords = DisciplinaryRecord::where('student_id', '=', $student->id)->get();

        return view('admin.students.discipline.studentdrecords', compact( 'student', 'today', 'count', 'group_teacher', 'current_term', 
            'schoolyear', 'students_in_group', 'all_user', 'st_user',  'terms', 'student_activities', 'drecords'));
    }

    public function addDRecord($student_id)
    {

        $student = Student::find($student_id);
        
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

        //get drecords
        $drecords = DisciplinaryRecord::where('student_id', '=', $student->id)->get();

        return view('admin.students.discipline.adddrecord', compact( 'student', 'today', 'count', 'group_teacher', 'current_term', 
            'schoolyear', 'students_in_group', 'all_user', 'st_user',  'terms', 'student_activities', 'drecords'));
    }

    public function postDRecord(Request $r, $student_id)
    {
        $student = Student::find($student_id);

        $this->validate(request(), [

            'student_id' => 'required',
            'term_id' => 'required',
            'group_id' => 'required',
            'drecord_date' => 'required',
            'drecord_description' => 'required',
            'drecord_file' => 'mimes:pdf,doc,jpeg,bmp,png|max:10000',
            
            
            ]);

        if($r->hasFile('drecord_file')){
            $drecord_file = $r->file('drecord_file');
            $filename = time() . '.' . $drecord_file->getClientOriginalExtension();
            $destinationPath = public_path().'/disciplinary_records/' ;
            $drecord_file->move($destinationPath,$filename);
            
        } else {
            $filename = $r->drecord_file;
        }



        DisciplinaryRecord::insert([

            'student_id'=>$r->student_id,
            'term_id'=>$r->term_id,
            'group_id'=>$r->group_id,
            'drecord_date'=>$r->drecord_date,
            'drecord_description'=>$r->drecord_description,
            'drecord_file'=>$filename,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
                       
        ]);

   
        $student->notify(new DisciplinaryRecordPosted("A new Disciplinary Record has been posted."));
       
        flash('Record Added Successfully')->success();

        return redirect()->route('discipline_student', [$student->id]);
    }

    public function editDRecord($drecord_id, $student_id)
    {

        $drecord = DisciplinaryRecord::find($drecord_id);
        $student = Student::find($student_id);
        
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


        return view('admin.students.discipline.editdrecord', compact( 'drecord', 'student', 'today', 'count', 'group_teacher', 'current_term', 
            'schoolyear', 'students_in_group', 'all_user', 'st_user',  'terms', 'student_activities'));
    }

    public function postEditDRecord(Request $r, $drecord_id, $student_id)

        {
        
        $drecord = DisciplinaryRecord::find($drecord_id);
        $student = Student::find($student_id);

        $this->validate(request(), [

            'student_id' => 'required',
            'term_id' => 'required',
            'group_id' => 'required',
            'drecord_date' => 'required',
            'drecord_description' => 'required',
            'drecord_file' => 'mimes:pdf,doc,jpeg,bmp,png|max:10000',
            
            
            ]);

        if($r->hasFile('drecord_file')){
            $drecord_file = $r->file('drecord_file');
            $filename = time() . '.' . $drecord_file->getClientOriginalExtension();
                // Delete current image before uploading new image
                if($drecord->drecord_file !== null) {
                     $file = public_path('disciplinary_records/' . $drecord->drecord_file);

                    if (File::exists($file)) {
                        unlink($file);
                    }

                }

            $destinationPath = public_path().'/disciplinary_records/' ;
            $drecord_file->move($destinationPath,$filename);
            
        } else {
            $filename = $r->drecord_file;
        }
                
                                        
        $drecord_edit = DisciplinaryRecord::where('id', '=', $drecord->id)->first();
        
        $drecord_edit->drecord_date= $r->drecord_date;
        $drecord_edit->drecord_description= $r->drecord_description;
        $drecord_edit->drecord_file= $filename;
        
        $drecord_edit->save();

        $student->notify(new DisciplinaryRecordPosted("A new Disciplinary Record has been Edited."));

        flash('Activity Updated Successfully')->success();

        return redirect()->route('discipline_student', [$student->id]);


         }

         public function deleteDRecord($drecord_id)
         {
            DisciplinaryRecord::destroy($drecord_id);

            flash('Record has been deleted')->error();

            return back();
         }


}
