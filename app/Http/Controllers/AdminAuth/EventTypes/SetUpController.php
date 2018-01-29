<?php

namespace App\Http\Controllers\AdminAuth\EventTypes;

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
use App\Eventtype;


class SetUpController extends Controller
{
    public function showEventTypes()
    {
    	

    	$eventtypes= Eventtype::get();

    	
        //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        
       
      

        return view('/admin.superadmin.schoolsetup.eventtypes.showeventtypes', compact('eventtypes','today', 
        	'schoolyear'));
    }

    public function addEventType()
    {

		$eventtypes= Eventtype::get();   	    	
        //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        
        

      

        return view('/admin.superadmin.schoolsetup.eventtypes.addeventtype', compact('eventtypes','today', 
        	'schoolyear'));
     }

      public function postEventType(Request $r) 
    {
                       

        $this->validate(request(), [

            'event_type' => 'required|unique:eventtypes',
            
            ]);


        Eventtype::insert([

            'event_type'=>$r->event_type,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            
        ]);

       
        flash('Event Type Added Successfully')->success();

        return redirect()->route('showeventtypes');
    }

    public function editEventType($eventtype_id)
    {

		$eventtype= Eventtype::find($eventtype_id);   	    	
        //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        
        

      

        return view('/admin.superadmin.schoolsetup.eventtypes.editeventtype', compact('eventtype','today', 
        	'schoolyear'));
     }

     public function postEventTypeUpdate(Request $r, $eventtype_id)

        {
        
        $eventtype = Eventtype::find($eventtype_id);

        $today = Carbon::today();

        $schoolyear = School_year::first();

        


             $this->validate(request(), [

                
            'event_type' => 'required',
                
                ]);


                                
            $eventtype_edit = Eventtype::where('id', '=', $eventtype->id)->first();


            
            $eventtype_edit->event_type= $r->event_type;
            

           

            $eventtype_edit->save();

            flash('Event Type Updated Successfully')->success();

            return redirect()->route('showeventtypes');


         }

         public function deleteEventType($eventtype_id)
         {
            Eventtype::destroy($eventtype_id);

            flash('Event Type has been deleted')->error();

            return back();
         }


}
