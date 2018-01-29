<?php

namespace App\Http\Controllers\AdminAuth\Fees;

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

class SetUpController extends Controller
{
    public function showFees()
    {
        
              
        //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        $fees_join = Fee::leftJoin('feetypes', 'fees.feetype_id', '=', 'feetypes.id')
                         ->leftJoin('groups', 'fees.group_id', '=', 'groups.id' )
                         ->leftJoin('terms', 'fees.term_id', '=', 'terms.id')
                         ->select('fees.*', 'groups.name', 'terms.term', 'feetypes.fee_type')
                         ->get();
         //dd($fees_join);              
       
        return view('/admin.superadmin.schoolsetup.fees.showfees', compact('today', 'schoolyear', 'fees_join'));
    }

    public function addFee()
    {

         //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        $groups = Group::pluck('name', 'id');

        $terms = Term::pluck('term', 'id');

        $feetypes = Feetype::pluck('fee_type', 'id');

        


        return view('/admin.superadmin.schoolsetup.fees.addfee', compact('today', 'schoolyear', 'groups', 'terms', 'feetypes'));
     }

    public function postFee(Request $r) 
    {
                       

        $this->validate(request(), [

            'amount' => 'required',
            'group_id' => 'required',
            'term_id' => 'required',
            'due_date' => 'required',
            'feetype_id' => 'required',
            
            ]);


        Fee::insert([

            'amount'=>$r->amount,
            'group_id'=>$r->group_id,
            'term_id'=>$r->term_id,
            'due_date'=>$r->due_date,
            'feetype_id'=>$r->feetype_id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            
        ]);

       
        flash('Fee Added Successfully')->success();

        return redirect()->route('showfees');
    }

    public function editFee($fee_id, $group_id, $term_id, $feetype_id)
    {

        
        
        $fee = Fee::find($fee_id);
        $group = Group::find($group_id);
        $term = Term::find($term_id);
        $feetype = Feetype::find($feetype_id);

        

        $today = Carbon::today();

        $schoolyear = School_year::first();

        

        return view('/admin.superadmin.schoolsetup.fees.editfee', compact('fee','today', 
            'schoolyear', 'group', 'term', 'feetype', 'fees_join'));

        

        
    }

    public function postFeeUpdate(Request $r, $fee_id, $group_id, $term_id, $feetype_id)

        {
        
       
             $this->validate(request(), [

                
            
            'amount' => 'required',
            'due_date' => 'required'
                
                ]);

        $fee = Fee::find($fee_id);
        $group = Group::find($group_id);
        $term = Term::find($term_id);
        $feetype = Feetype::find($feetype_id);

        $today = Carbon::today();
        $schoolyear = School_year::first();


                                
        $fee_edit = Fee::where('id', '=', $fee->id)
                            ->where('group_id', '=', $group->id)
                            ->where('term_id', '=', $term->id)
                            ->where('feetype_id', '=', $feetype->id)
                            ->first();


            
            $fee_edit->amount= $r->amount;
            $fee_edit->due_date= $r->due_date;
            

           

            $fee_edit->save();

            flash('Fee Updated Successfully')->success();

            return redirect()->route('showfees');


         }

         public function deletefee($fee_id)
         {
            Fee::destroy($fee_id);

            flash('Fee has been deleted')->error();

            return back();
         }
}
