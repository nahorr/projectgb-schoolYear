<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\School_year;
use Carbon\Carbon;
use App\Student;
use App\Staffer;
use App\Course;
use App\School;
use App\Event;
use App\Group;
use App\User;
use App\Term;
use Image;
use Auth;




class SchoolYearSetUpController extends Controller
{
    public function showSchoolYear()
    {

        $schoolyears = School_year::orderBy('start_date')->get();

       
        return view('admin.superadmin.schoolsetup.showschoolyear', compact('schoolyears'));
    }

     public function addSchoolYear()
    {
        return view('admin.superadmin.schoolsetup.addschoolyear');
    }

    public function postAddSchoolYear(Request $r) 
    {

        $this->validate(request(), [

            'school_year' => 'required',
            'start_date' => 'required',
            'end_date'=> 'required',
            'show_until'=> 'required',
            
            ]);
        
        School_year::insert([

            'school_year'=>$r->school_year,
            'start_date'=>$r->start_date,
            'end_date'=>$r->end_date,
            'show_until'=>$r->show_until,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            
            
        ]);

       return redirect()->route('showschoolyear');
    
    }
    
    public function editSchoolYear($id)
    {

        $school_year = School_year::find($id);
        
        $school_year_edit = School_year::where('id', '=', $school_year->id)->first();
        
        return view('admin.superadmin.schoolsetup.editschoolyear', compact('school_year', 'school_year_edit'));
    }


    public function postSchoolYearUpdate(Request $r, $id)

    {
        $this->validate(request(), [

            'school_year' => 'required',
            'start_date' => 'required',
            'end_date'=> 'required',
            'show_until'=> 'required',
            
            ]);

         
        $school_year = School_year::find($id);

        $school_year_edit = School_year::where('id', '=', $school_year->id)->first();

        $school_year_edit->school_year= $r->school_year;
        $school_year_edit->start_date= $r->start_date;
        $school_year_edit->end_date= $r->end_date;
        $school_year_edit->show_until= $r->show_until;
            
        $school_year_edit->save();

        flash('School Year Updated Successfully')->success();

        return back();
 
     }

     public function deleteSchoolYear($school_year_id)
         {
            School_year::destroy($school_year_id);

            flash('School Year has been deleted')->error();

            return back();
         }
}
