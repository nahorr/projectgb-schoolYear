<?php

namespace App\Http\Controllers\AdminAuth\EffectiveAreas;

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
use App\EffectiveArea;
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

        

        return view('/admin.effectiveareas.showterms', compact('today', 'count', 'group_teacher', 'current_term', 
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
        $effectiveareas = EffectiveArea::join('students', 'effective_areas.student_id', '=', 'students.id')
        						->join('terms', 'effective_areas.term_id', '=', 'terms.id')
        						->select('effective_areas.*', 'terms.term', 'students.first_name', 'students.last_name')
        						->get();


        
        return view('/admin.effectiveareas.showstudents', compact('term','today', 'count', 'group_teacher', 'current_term', 
            'schoolyear', 'students_in_group', 'all_user', 'st_user',  'terms','t', 'effectiveareas'));

    }

     public function addEffectiveArea($term_id, $student_id)
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

       

        
        return view('/admin.effectiveareas.addeffectivearea', compact('term', 'student', 'today', 'count', 'group_teacher', 'current_term', 
            'schoolyear', 'students_in_group', 'all_user', 'st_user',  'terms','t'));

    }

    public function postEffectiveArea(Request $r, $term_id, $student_id) 
    {
         $term = Term::find(Crypt::decrypt($term_id));
         $student = Student::find(Crypt::decrypt($student_id));
    	           

        $this->validate(request(), [

            'student_id' => 'required|unique_with:effective_areas,term_id',
            'term_id' => 'required',
            'punctuality' => 'required|numeric|max:5|min:1',
            'creativity' => 'required|numeric|max:5|min:1',
            'reliability' => 'required|numeric|max:5|min:1',
            'neatness' => 'required|numeric|max:5|min:1',
            
            ]);


        EffectiveArea::insert([

            'student_id'=>$r->student_id,
            'term_id'=>$r->term_id,
            'punctuality'=>$r->punctuality,
            'creativity'=>$r->creativity,
            'reliability'=>$r->reliability,
            'neatness'=>$r->neatness,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            
        ]);

       
        flash('Effective Area Added Successfully')->success();

        return redirect()->route('showstudentseffectiveareas', [Crypt::encrypt($term->id), Crypt::encrypt($student->id)]);
    }

    public function editEffectiveArea($term_id, $student_id)
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

        $effectivearea = EffectiveArea::where('student_id', '=', $student->id)
        					   ->where('term_id', '=', $term->id)
        					   ->first();
        
        return view('/admin.effectiveareas.editeffectivearea', compact('term', 'student', 'today', 'count', 'group_teacher', 'current_term', 
            'schoolyear', 'students_in_group', 'all_user', 'st_user',  'terms','t', 'effectivearea'));

    }

    public function postEffectiveAreaUpdate(Request $r,$term_id, $student_id)

        {
            $term = Term::find(Crypt::decrypt($term_id));
            $student = Student::find(Crypt::decrypt($student_id));
                

            $this->validate(request(), [

                
	            
	            'punctuality' => 'required|numeric|max:5|min:1',
	            'creativity' => 'required|numeric|max:5|min:1',
	            'reliability' => 'required|numeric|max:5|min:1',
	            'neatness' => 'required|numeric|max:5|min:1',
                
                ]);

	        
                                          
	        $effectivarea_edit = EffectiveArea::where('term_id', '=', $term->id)
	                            ->where('student_id', '=', $student->id)
	                            ->first();


            
            $effectivarea_edit->punctuality= $r->punctuality;
            $effectivarea_edit->creativity= $r->creativity;
            $effectivarea_edit->reliability= $r->reliability;
            $effectivarea_edit->neatness= $r->neatness;
            

           

            $effectivarea_edit->save();

            flash('Effective Area Updated Successfully')->success();

            return redirect()->route('showstudentseffectiveareas', [Crypt::encrypt($term->id), Crypt::encrypt($student->id)]);


         }

         public function deleteEffectiveArea($effectivearea_id)
         {
            EffectiveArea::destroy(Crypt::decrypt($effectivearea_id));

            flash('Effective Area has been deleted')->error();

            return back();
         }
}
