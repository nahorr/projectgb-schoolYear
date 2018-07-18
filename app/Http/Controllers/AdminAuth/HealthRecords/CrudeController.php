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
    
    public function showStudents(School_year $schoolyear, Term $term)
    {

        //get Hrecords
        $hrecords = HealthRecord::join('students', 'health_records.student_id', '=', 'students.id')
        						->join('terms', 'health_records.term_id', '=', 'terms.id')
        						->select('health_records.*', 'terms.term', 'students.first_name', 'students.last_name')
        						->get();
    
        return view('admin.healthrecords.showstudents', compact( 'schoolyear', 'term', 'hrecords'));

    }

     public function addHRecord(School_year $schoolyear, Term $term, Student $student)
    {
        
        return view('admin.healthrecords.addhrecord', compact( 'schoolyear', 'term', 'student'));

    }

    public function postHRecord(Request $r, School_year $schoolyear, Term $term, Student $student) 
    {
         
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

        return redirect()->route('showstudentshrecord', [$schoolyear->id, $term->id]);
    }

    public function editHRecord(School_year $schoolyear, Term $term, Student $student)
    {
        $hrecord = HealthRecord::where('student_id', '=', $student->id)
                               ->where('term_id', '=', $term->id)
                               ->first();

        return view('admin.healthrecords.edithrecord', compact( 'schoolyear', 'term', 'student', 'hrecord'));

    }

    public function postHRecordUpdate(Request $r, School_year $schoolyear, Term $term, Student $student)

        {
        
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

            return redirect()->route('showstudentshrecord', [$schoolyear->id, $term->id]);


         }

         public function deleteHRecord($hrecord)
         {
            HealthRecord::destroy(Crypt::decrypt($hrecord));

            flash('Health record has been deleted')->error();

            return back();
         }
}
