<?php

namespace App\Http\Controllers\AdminAuth\FeeTypes;

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
    
    public function showFeeTypes()
    {
    	

    	$feetypes= Feetype::get();

    	
        //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        
       
      

        return view('/admin.superadmin.schoolsetup.feetypes.showfeetypes', compact('feetypes','today', 
        	'schoolyear'));
    }

    public function addFeeType()
    {

		$feetypes= Feetype::get();   	    	
        //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        
        

      

        return view('/admin.superadmin.schoolsetup.feetypes.addfeetype', compact('feetype','today', 
        	'schoolyear'));
     }

    public function postFeeType(Request $r) 
    {
                       

        $this->validate(request(), [

            'fee_type' => 'required|unique:feetypes',
            
            ]);


        Feetype::insert([

            'fee_type'=>$r->fee_type,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            
        ]);

       
        flash('Fee Type Added Successfully')->success();

        return redirect()->route('showfeetypes');
    }

    public function editFeetype($feetype_id)
    {

        $feetype = Feetype::find($feetype_id);

        $today = Carbon::today();

        $schoolyear = School_year::first();



      

        return view('/admin.superadmin.schoolsetup.feetypes.editfeetype', compact('feetype', 'today', 
        	'schoolyear'));

        

        
    }

    public function postFeeTypeUpdate(Request $r, $feetype_id)

        {
        
        $feetype = Feetype::find($feetype_id);

        $today = Carbon::today();

        $schoolyear = School_year::first();

        


             $this->validate(request(), [

                
            'fee_type' => 'required',
                
                ]);


                                
            $feetype_edit = Feetype::where('id', '=', $feetype->id)->first();


            
            $feetype_edit->fee_type= $r->fee_type;
            

           

            $feetype_edit->save();

            flash('Fee Type Updated Successfully')->success();

            return redirect()->route('showfeetypes');


         }

         public function deletefeetype($feetype_id)
         {
            Feetype::destroy($feetype_id);

            flash('Fee Type has been deleted')->error();

            return back();
         }
}
