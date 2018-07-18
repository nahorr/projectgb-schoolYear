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
	
    public function showStudents(School_year $schoolyear, Term $term)
    {

        //get records
        $psychomotors = Psychomotor::join('students', 'psychomotors.student_id', '=', 'students.id')
        						->join('terms', 'psychomotors.term_id', '=', 'terms.id')
        						->select('psychomotors.*', 'terms.term', 'students.first_name', 'students.last_name')
        						->get();

        return view('admin.psychomotors.showstudents', compact('schoolyear', 'term','psychomotors'));

    }

     public function addPsychomotor(School_year $schoolyear, Term $term, Student $student)
    {
        
        return view('admin.psychomotors.addpsychomotor', compact('schoolyear', 'term', 'student'));

    }

    public function postPsychomotor(Request $r, School_year $schoolyear, Term $term, Student $student) 
    {
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

        return redirect()->route('showstudentspsychomotors', [$schoolyear->id, $term->id]);
    }

       public function editPsychomotor(School_year $schoolyear, Term $term, Student $student)
    {

        $psychomotor = Psychomotor::where('student_id', '=', $student->id)
        					   ->where('term_id', '=', $term->id)
        					   ->first();
        
        return view('admin.psychomotors.editpsychomotor', compact( 'schoolyear', 'term', 'student','psychomotor'));

    }

    public function postPsychomotorUpdate(Request $r, School_year $schoolyear, Term $term, Student $student)

        {
                   
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

            return redirect()->route('showstudentspsychomotors', [$schoolyear->id, $term->id]);


         }

          public function deletePsychomotor($psychomotor)
         {
            Psychomotor::destroy(Crypt::decrypt($psychomotor));

            flash('Psychomotor has been deleted')->error();

            return back();
         }


    
}
