<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\School_year;
use Carbon\Carbon;
use App\Student;
use App\Staffer;
use App\Group;
use App\Event;
use App\User;
use App\Term;
use Image;
use Auth;


class TermSetUpController extends Controller
{

	public function schoolYears()
    {

        return view('admin.superadmin.schoolsetup.terms.schoolyears');
    }

    public function showTerms($schoolyear_id)
    {
        //find school Year
        $schoolyear = School_year::find($schoolyear_id);
        
        //get term associated with found school year id above
        $schoolyear_terms = Term::where('school_year_id', '=', $schoolyear->id)->get();

    
        return view('admin.superadmin.schoolsetup.showterms', compact('schoolyear', 'schoolyear_terms'));
    }

    
    public function addTerm($schoolyear_id)
    {

    	//find school year
        $schoolyear = School_year::find($schoolyear_id);
        
        //get term associated with found school year id above
        $schoolyear_terms = Term::where('school_year_id', '=', $schoolyear->id)->get();


        return view('admin.superadmin.schoolsetup.addterm', compact('schoolyear', 'schoolyear_term'));
    }

     public function postTerm(Request $r, $schoolyear_id) 
    {     
        //find term
        $schoolyear = School_year::find($schoolyear_id);

        $this->validate(request(), [

            'school_year_id' => 'required',
            'term' => 'required|unique_with:terms,school_year_id',
            'start_date' => 'required|unique_with:terms,school_year_id',
            'end_date'=> 'required|unique_with:terms,school_year_id',
            'show_until'=> 'required|unique_with:terms,school_year_id',

            ]);

        Term::insert([

            'school_year_id'=>$r->school_year_id,
            'term'=>$r->term,
            'start_date'=>$r->start_date,
            'end_date'=>$r->start_date,
            'show_until'=>$r->show_until,                   
            
        ]);

       
        flash('Term Added Successfully')->success();

        return redirect()->route('setupshowterms', [$schoolyear->id]);
    }

    
    
    public function editTerm($schoolyear_id, $term_id)
    {

        //fing school Year
        $schoolyear = School_year::find($schoolyear_id);

        //find term
        $term = Term::find($term_id);

                        
        $term_edit = Term::where('id', '=', $term->id)->first();


        return view('admin.superadmin.schoolsetup.editterm', compact('schoolyear', 'term', 'term_edit'));
    }



        public function postTermUpdate(Request $r, $term_id)

        {
             $this->validate(request(), [

                
                'start_date' => 'required',
                'end_date'=> 'required',
                'show_until'=> 'required',
                
                ]);

            //find term
            $term = Term::find($term_id);
           
            $term_edit = Term::where('id', '=', $term->id)->first();

            $term_edit->start_date= $r->start_date;
            $term_edit->end_date= $r->end_date;
            $term_edit->show_until= $r->show_until;
              

            $term_edit->save();

            flash('Term Updated Successfully')->success();

            return back();


         }

         public function deleteTerm($term_id)
         {
            Term::destroy($term_id);

            flash('Term has been deleted')->error();

            return back();
         }

    	
}
