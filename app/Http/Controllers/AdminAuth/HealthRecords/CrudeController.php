<?php

namespace App\Http\Controllers\AdminAuth\HealthRecords;

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

        foreach ($terms as $t){
            if ($today->between($t->start_date, $t->show_until )){
                $current_term =  $t->term;

            }
                                                         
        }

        //get school school
        $schoolyear = School_year::first();

        

        return view('/admin.healthrecords.showterms', compact('today', 'count', 'group_teacher', 'current_term', 
            'schoolyear', 'students_in_group', 'all_user', 'st_user',  'terms','t'));
   
    }

    public function showStudents($term_id)
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

        //get Hrecords
        $hrecords = HealthRecord::join('students', 'health_records.student_id', '=', 'students.id')
        						->join('terms', 'health_records.term_id', '=', 'terms.id')
        						->select('health_records.*', 'terms.term', 'students.first_name', 'students.last_name')
        						->get();


        
        return view('/admin.healthrecords.showstudents', compact('term','today', 'count', 'group_teacher', 'current_term', 
            'schoolyear', 'students_in_group', 'all_user', 'st_user',  'terms','t', 'hrecords'));

    }

     public function addHRecord($term_id, $student_id)
    {

    	$term = Term::find(Crypt::decrypt($term_id));
    	$student = Student::find(Crypt::decrypt($student_id));
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

        //get Hrecords
        $hrecords = HealthRecord::join('students', 'health_records.student_id', '=', 'students.id')
        						->join('terms', 'health_records.term_id', '=', 'terms.id')
        						->select('health_records.*', 'terms.term', 'students.first_name', 'students.last_name')
        						->get();


        
        return view('/admin.healthrecords.addhrecord', compact('term', 'student', 'today', 'count', 'group_teacher', 'current_term', 
            'schoolyear', 'students_in_group', 'all_user', 'st_user',  'terms','t', 'hrecords'));

    }

    public function postHRecord(Request $r, $term_id, $student_id) 
    {
         $term = Term::find(Crypt::decrypt($term_id));
        $student = Student::find(Crypt::decrypt($student_id));
    	           

        $this->validate(request(), [

            'student_id' => 'required|unique_with:health_records,term_id',
            'term_id' => 'required',
            'weight' => 'required',
            'height' => 'required',
            'comment_nurse' => 'required|numeric|max:5|min:1',
            'comment_doctor' => 'required|numeric|max:5|min:1',
            
            ]);


        HealthRecord::insert([

            'student_id'=>$r->student_id,
            'term_id'=>$r->term_id,
            'weight'=>$r->weight,
            'height'=>$r->height,
            'comment_nurse'=>$r->comment_nurse,
            'comment_doctor'=>$r->comment_doctor,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            
        ]);

       
        flash('Health Record Added Successfully')->success();

        return redirect()->route('showstudentshrecord', [Crypt::encrypt($term->id), Crypt::encrypt($student->id)]);
    }

    public function editHRecord($term_id, $student_id)
    {

    	$term = Term::find(Crypt::decrypt($term_id));
        $student = Student::find(Crypt::decrypt($student_id));
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

        //get Hrecords
        /*$hrecords = HealthRecord::join('students', 'health_records.student_id', '=', 'students.id')
        						->join('terms', 'health_records.term_id', '=', 'terms.id')
        						->select('health_records.*', 'terms.term', 'students.first_name', 'students.last_name')
        						->get();*/

        $hrecord = HealthRecord::where('student_id', '=', $student->id)
        					   ->where('term_id', '=', $term->id)
        					   ->first();
        
        return view('/admin.healthrecords.edithrecord', compact('term', 'student', 'today', 'count', 'group_teacher', 'current_term', 
            'schoolyear', 'students_in_group', 'all_user', 'st_user',  'terms','t', 'hrecord'));

    }

    public function postHRecordUpdate(Request $r,$term_id, $student_id)

        {
        
            $term = Term::find(Crypt::decrypt($term_id));
            $student = Student::find(Crypt::decrypt($student_id));

            $this->validate(request(), [

                
	            
	            'weight' => 'required',
	            'height' => 'required',
	            'comment_nurse' => 'required|numeric|max:5|min:1',
	            'comment_doctor' => 'required|numeric|max:5|min:1',
                
                ]);

	       
	                                
	        $hrecord_edit = HealthRecord::where('term_id', '=', $term->id)
	                            ->where('student_id', '=', $student->id)
	                            ->first();


            
            $hrecord_edit->weight= $r->weight;
            $hrecord_edit->height= $r->height;
            $hrecord_edit->comment_nurse= $r->comment_nurse;
            $hrecord_edit->comment_doctor= $r->comment_doctor;
            

           

            $hrecord_edit->save();

            flash('Health Record Updated Successfully')->success();

            return redirect()->route('showstudentshrecord', [Crypt::encrypt($term->id), Crypt::encrypt($student->id)]);


         }

         public function deleteHRecord($hrecord_id)
         {
            HealthRecord::destroy(Crypt::decrypt($hrecord_id));

            flash('Health record has been deleted')->error();

            return back();
         }
}
