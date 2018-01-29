<?php

namespace App\Http\Controllers\AdminAuth\Schools;

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
use Excel;
use App\School;

class SetUpController extends Controller
{
     public function showSchools()
    {

        //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        $schools = School::get();

        return view('/admin.superadmin.schoolsetup.schools.showschools', compact('today', 'schoolyear', 'schools'));
    }

    public function addSchool()
    {

    	//get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        $schools = School::get();


         return view('/admin.superadmin.schoolsetup.schools.addschool', compact('today', 'schoolyear', 'schools'));
    }

    public function postSchool(Request $r) 
    {
        
        $this->validate(request(), [

            'name' => 'required',
            'address' => 'required|max:255',
            'city' => 'required',
            'state' => 'required',
            'postal_code' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'motto' => 'required|max:255',
            

            ]);


        School::insert([

            'name'=>$r->name,
            'address'=>$r->address,
            'city'=>$r->city,
            'state'=>$r->state,
            'postal_code'=>$r->postal_code,
            'phone'=>$r->phone,
            'email'=>$r->email,
            'motto'=>$r->motto,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
 
        ]);

       
        flash('School Added Successfully')->success();

        return redirect()->route('showschools');
    }

     public function editSchool($id)
    {

    	//get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        $school = School::find($id);



         return view('/admin.superadmin.schoolsetup.schools.editschool', compact('today', 'schoolyear', 'school'));
    }

    public function postSchoolUpdate(Request $r, $school_id)

        {
        
            $school = School::find($school_id);

            //get current date
            $today = Carbon::today();

            $schoolyear = School_year::first();


            $this->validate(request(), [

            	'name' => 'required',
	            'address' => 'required|max:255',
	            'city' => 'required',
	            'state' => 'required',
	            'postal_code' => 'required',
	            'phone' => 'required',
	            'email' => 'required|email',
	            'motto' => 'required|max:255',
                
                ]);


                                
            $school_edit = School::where('id', '=', $school->id)->first();


            
            $school_edit->name= $r->name;
            $school_edit->address= $r->address;
            $school_edit->city= $r->city;
            $school_edit->state= $r->state;
            $school_edit->postal_code= $r->postal_code;
            $school_edit->phone= $r->phone;
            $school_edit->email= $r->email;
            $school_edit->motto= $r->motto;

           

            $school_edit->save();

            flash('Scholl Updated Successfully')->success();

            return redirect()->route('showschools');


         }

         public function deleteSchool($school_id)
         {
            School::destroy($school_id);

            flash('School has been deleted')->error();

            return back();
         }
}
