<?php

namespace App\Http\Controllers\AdminAuth\AttendanceCodes;

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
use App\Fee;
use App\Feetype;
use App\Eventtype;
use App\AttendanceCode;

class SetUpController extends Controller
{
    public function showCodes()
    {
    	

    	$codes= AttendanceCode::get();

    	
        //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();



        return view('/admin.superadmin.schoolsetup.attendancecodes.showcodes', compact('codes','today', 
        	'schoolyear'));
    }

    public function addCode()
    {

		$codes= AttendanceCode::get();   	    	
        //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        
        return view('/admin.superadmin.schoolsetup.attendancecodes.addcode', compact('codes','today', 
        	'schoolyear'));
     }

     public function postCode(Request $r) 
	    {
	                       

	        $this->validate(request(), [

	            'code_name' => 'required|unique:attendance_codes',
	            
	            ]);


	        AttendanceCode::insert([

	            'code_name'=>$r->code_name,
	            'created_at' => date('Y-m-d H:i:s'),
	            'updated_at' => date('Y-m-d H:i:s'),
	            
	        ]);

	       
	        flash('Attendance Code Added Successfully')->success();

	        return redirect()->route('showattendancecodes');
	    }

	    public function editCode($code_id)
    {

		$code= AttendanceCode::find($code_id);   	    	
        //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();



        return view('/admin.superadmin.schoolsetup.attendancecodes.editcode', compact('code','today', 
        	'schoolyear'));
     }

     public function postCodeUpdate(Request $r, $code_id)

        {
        
        $code= AttendanceCode::find($code_id);   	    	
        //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();


        


             $this->validate(request(), [

                
            'code_name' => 'required',
                
                ]);


                                
            $code_edit = AttendanceCode::where('id', '=', $code->id)->first();


            
            $code_edit->code_name= $r->code_name;
            

           

            $code_edit->save();

            flash('Attendance Code Updated Successfully')->success();

            return redirect()->route('showattendancecodes');


         }

         public function deleteCode($code_id)
         {
            AttendanceCode::destroy($code_id);

            flash('Attendance Code has been deleted')->error();

            return back();
         }

}
