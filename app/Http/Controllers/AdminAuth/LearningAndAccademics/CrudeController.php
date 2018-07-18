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
    public function showStudents(School_year $schoolyear, Term $term)
    {
        //get records
        $learningandaccademics = LearningAndAccademic::join('students', 'learning_and_accademics.student_id', '=', 'students.id')
        						->join('terms', 'learning_and_accademics.term_id', '=', 'terms.id')
        						->select('learning_and_accademics.*', 'terms.term', 'students.first_name', 'students.last_name')
        						->get();

        return view('admin.learningandaccademics.showstudents', compact('schoolyear', 'term', 'learningandaccademics'));

    }

    public function addLearningAndAccademic(School_year $schoolyear, Term $term, Student $student)
    {
        
        return view('admin.learningandaccademics.addlearningandaccademic', compact('schoolyear', 'term', 'student'));

    }



    public function postLearningAndAccademic(Request $r, School_year $schoolyear, Term $term, Student $student) 
    {
         
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

        return redirect()->route('showstudentslearningandaccademics', [$schoolyear->id, $term->id]);
    }


       public function editLearningAndAccademic(School_year $schoolyear, Term $term, Student $student)
    {      

        $learningandaccademic = LearningAndAccademic::where('student_id', '=', $student->id)
        					   ->where('term_id', '=', $term->id)
        					   ->first();
        
        return view('admin.learningandaccademics.editlearningandaccademic', compact('schoolyear', 'term', 'student', 'learningandaccademic'));

    }


    public function postLearningAndAccademicUpdate(Request $r,School_year $schoolyear, Term $term, Student $student)

        {
                   
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

            return redirect()->route('showstudentslearningandaccademics', [$schoolyear->id, $term->id]);


         }

        public function deleteLearningAndAccademic($learningandaccademic)
         {
            LearningAndAccademic::destroy(Crypt::decrypt($learningandaccademic));

            flash('Learning And Accademic has been deleted')->error();

            return back();
         }

}
