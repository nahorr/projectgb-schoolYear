<?php

namespace App\Http\Controllers\AdminAuth\LearningAndAccademics;

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
use App\LearningAndAccademic;
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

        

        return view('/admin.learningandaccademics.showterms', compact('today', 'count', 'group_teacher', 'current_term', 
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
        $learningandaccademics = LearningAndAccademic::join('students', 'learning_and_accademics.student_id', '=', 'students.id')
        						->join('terms', 'learning_and_accademics.term_id', '=', 'terms.id')
        						->select('learning_and_accademics.*', 'terms.term', 'students.first_name', 'students.last_name')
        						->get();


        
        return view('/admin.learningandaccademics.showstudents', compact('term','today', 'count', 'group_teacher', 'current_term', 
            'schoolyear', 'students_in_group', 'all_user', 'st_user',  'terms','t', 'learningandaccademics'));

    }

         public function addLearningAndAccademic($term_id, $student_id)
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

       

        
        return view('/admin.learningandaccademics.addlearningandaccademic', compact('term', 'student', 'today', 'count', 'group_teacher', 'current_term', 
            'schoolyear', 'students_in_group', 'all_user', 'st_user',  'terms','t'));

    }



    public function postLearningAndAccademic(Request $r, $term_id, $student_id) 
    {
         $term = Term::find(Crypt::decrypt($term_id));
         $student = Student::find(Crypt::decrypt($student_id));
    	           

        $this->validate(request(), [

            'student_id' => 'required|unique_with:learning_and_accademics,term_id',
            'term_id' => 'required',
            'class_work' => 'required|numeric|max:5|min:1',
            'home_work' => 'required|numeric|max:5|min:1',
            'project' => 'required|numeric|max:5|min:1',
            'note_taking' => 'required|numeric|max:5|min:1',
            
            ]);


        LearningAndAccademic::insert([

            'student_id'=>$r->student_id,
            'term_id'=>$r->term_id,
            'class_work'=>$r->class_work,
            'home_work'=>$r->home_work,
            'project'=>$r->project,
            'note_taking'=>$r->note_taking,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            
        ]);

       
        flash('Learning And Accademic Added Successfully')->success();

        return redirect()->route('showstudentslearningandaccademics', [Crypt::encrypt($term->id), Crypt::encrypt($student->id)]);
    }


       public function editLearningAndAccademic($term_id, $student_id)
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

       

        $learningandaccademic = LearningAndAccademic::where('student_id', '=', $student->id)
        					   ->where('term_id', '=', $term->id)
        					   ->first();
        
        return view('/admin.learningandaccademics.editlearningandaccademic', compact('term', 'student', 'today', 'count', 'group_teacher', 'current_term', 
            'schoolyear', 'students_in_group', 'all_user', 'st_user',  'terms','t', 'learningandaccademic'));

    }


    public function postLearningAndAccademicUpdate(Request $r,$term_id, $student_id)

        {
            $term = Term::find(Crypt::decrypt($term_id));
            $student = Student::find(Crypt::decrypt($student_id));
       
            $this->validate(request(), [

                
	            
	            'class_work' => 'required|numeric|max:5|min:1',
	            'home_work' => 'required|numeric|max:5|min:1',
	            'project' => 'required|numeric|max:5|min:1',
	            'note_taking' => 'required|numeric|max:5|min:1',
                
                ]);

	        
	                                
	        $learningandaccademic_edit = LearningAndAccademic::where('term_id', '=', $term->id)
	                            ->where('student_id', '=', $student->id)
	                            ->first();


            
            $learningandaccademic_edit->class_work= $r->class_work;
            $learningandaccademic_edit->home_work= $r->home_work;
            $learningandaccademic_edit->project= $r->project;
            $learningandaccademic_edit->note_taking= $r->note_taking;
            

           

            $learningandaccademic_edit->save();

            flash('Learning And Accademic Updated Successfully')->success();

            return redirect()->route('showstudentslearningandaccademics', [Crypt::encrypt($term->id), Crypt::encrypt($student->id)]);


         }

        public function deleteLearningAndAccademic($learningandaccademic_id)
         {
            LearningAndAccademic::destroy(Crypt::decrypt($learningandaccademic_id));

            flash('Learning And Accademic has been deleted')->error();

            return back();
         }

}
