<?php

namespace App\Http\Controllers\AdminAuth\Psychomotors;

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
use App\Psychomotor;
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

        

        return view('/admin.psychomotors.showterms', compact('today', 'count', 'group_teacher', 'current_term', 
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
        $psychomotors = Psychomotor::join('students', 'psychomotors.student_id', '=', 'students.id')
        						->join('terms', 'psychomotors.term_id', '=', 'terms.id')
        						->select('psychomotors.*', 'terms.term', 'students.first_name', 'students.last_name')
        						->get();


        
        return view('/admin.psychomotors.showstudents', compact('term','today', 'count', 'group_teacher', 'current_term', 
            'schoolyear', 'students_in_group', 'all_user', 'st_user',  'terms','t', 'psychomotors'));

    }

     public function addPsychomotor($term_id, $student_id)
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

       

        
        return view('/admin.psychomotors.addpsychomotor', compact('term', 'student', 'today', 'count', 'group_teacher', 'current_term', 
            'schoolyear', 'students_in_group', 'all_user', 'st_user',  'terms','t'));

    }

    public function postPsychomotor(Request $r, $term_id, $student_id) 
    {
         $term = Term::find(Crypt::decrypt($term_id));
         $student = Student::find(Crypt::decrypt($student_id));
    	           

        $this->validate(request(), [

            'student_id' => 'required|unique_with:psychomotors,term_id',
            'term_id' => 'required',
            'hand_writting' => 'required|numeric|max:5|min:1',
            'vabal_fluency' => 'required|numeric|max:5|min:1',
            'games_sport' => 'required|numeric|max:5|min:1',
            'handling_of_tools' => 'required|numeric|max:5|min:1',
            
            ]);


        Psychomotor::insert([

            'student_id'=>$r->student_id,
            'term_id'=>$r->term_id,
            'hand_writting'=>$r->hand_writting,
            'vabal_fluency'=>$r->vabal_fluency,
            'games_sport'=>$r->games_sport,
            'handling_of_tools'=>$r->handling_of_tools,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            
        ]);

       
        flash('Psychomotor Added Successfully')->success();

        return redirect()->route('showstudentspsychomotors', [Crypt::encrypt($term->id), Crypt::encrypt($student->id)]);
    }

       public function editPsychomotor($term_id, $student_id)
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

       

        $psychomotor = Psychomotor::where('student_id', '=', $student->id)
        					   ->where('term_id', '=', $term->id)
        					   ->first();
        
        return view('/admin.psychomotors.editpsychomotor', compact('term', 'student', 'today', 'count', 'group_teacher', 'current_term', 
            'schoolyear', 'students_in_group', 'all_user', 'st_user',  'terms','t', 'psychomotor'));

    }

    public function postPsychomotorUpdate(Request $r,$term_id, $student_id)

        {
            $term = Term::find(Crypt::decrypt($term_id));
            $student = Student::find(Crypt::decrypt($student_id));
       
            $this->validate(request(), [

                
	            
	            'hand_writting' => 'required|numeric|max:5|min:1',
	            'vabal_fluency' => 'required|numeric|max:5|min:1',
	            'games_sport' => 'required|numeric|max:5|min:1',
	            'handling_of_tools' => 'required|numeric|max:5|min:1',
                
                ]);

	   

	                                
	        $psychomotor_edit = Psychomotor::where('term_id', '=', $term->id)
	                            ->where('student_id', '=', $student->id)
	                            ->first();


            
            $psychomotor_edit->hand_writting= $r->hand_writting;
            $psychomotor_edit->vabal_fluency= $r->vabal_fluency;
            $psychomotor_edit->games_sport= $r->games_sport;
            $psychomotor_edit->handling_of_tools= $r->handling_of_tools;
            

           

            $psychomotor_edit->save();

            flash('Psychomotor Updated Successfully')->success();

            return redirect()->route('showstudentspsychomotors', [Crypt::encrypt($term->id), Crypt::encrypt($student->id)]);


         }

          public function deletePsychomotor($psychomotor_id)
         {
            Psychomotor::destroy(Crypt::decrypt($psychomotor_id));

            flash('Psychomotor has been deleted')->error();

            return back();
         }


    
}
