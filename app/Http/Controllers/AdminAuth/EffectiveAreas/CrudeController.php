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
    
    public function showStudents(School_year $schoolyear, Term $term)
    {

        //get Effective Areas records
        $effectiveareas = EffectiveArea::join('students', 'effective_areas.student_id', '=', 'students.id')
        						->join('terms', 'effective_areas.term_id', '=', 'terms.id')
        						->select('effective_areas.*', 'terms.term', 'students.first_name', 'students.last_name')
        						->get();
       
        return view('admin.effectiveareas.showstudents', compact('schoolyear', 'term', 'effectiveareas'));

    }

     public function addEffectiveArea(School_year $schoolyear, Term $term, Student $student)
    {
        
        return view('admin.effectiveareas.addeffectivearea', compact('schoolyear', 'term', 'student'));

    }

    public function postEffectiveArea(Request $r, School_year $schoolyear, Term $term, Student $student) 
    { 

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

        return redirect()->route('showstudentseffectiveareas', [$schoolyear->id, $term->id]);
    }

    public function editEffectiveArea(School_year $schoolyear, Term $term, Student $student)
    {


        $effectivearea = EffectiveArea::where('student_id', '=', $student->id)
        					   ->where('term_id', '=', $term->id)
        					   ->first();
        
        return view('admin.effectiveareas.editeffectivearea', compact('schoolyear', 'term', 'student', 'effectivearea'));

    }

    public function postEffectiveAreaUpdate(Request $r, School_year $schoolyear, Term $term, Student $student)

        {
            
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

            return redirect()->route('showstudentseffectiveareas', [$schoolyear->id, $term->id]);


         }

         public function deleteEffectiveArea($effectivearea)
         {
            EffectiveArea::destroy(Crypt::decrypt($effectivearea));

            flash('Effective Area has been deleted')->error();

            return back();
         }
}
