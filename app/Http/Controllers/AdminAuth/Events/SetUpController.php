<?php

namespace App\Http\Controllers\AdminAuth\Events;

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
    public function showEvents()
    {
        
              
        //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        $events_join = Event::leftJoin('eventtypes', 'events.eventtype_id', '=', 'eventtypes.id')
                         ->leftJoin('groups', 'events.group_id', '=', 'groups.id' )
                         ->leftJoin('terms', 'events.term_id', '=', 'terms.id')
                         ->select('events.*', 'groups.name', 'terms.term', 'eventtypes.event_type')
                         ->get();
         //dd($fees_join);              
       
        return view('/admin.superadmin.schoolsetup.events.showevents', compact('today', 'schoolyear', 'events_join'));
    }

     public function addEvent()
    {

         //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        $groups = Group::pluck('name', 'id');

        $terms = Term::pluck('term', 'id');

        $eventtypes = Eventtype::pluck('event_type', 'id');

        


        return view('/admin.superadmin.schoolsetup.events.addevent', compact('today', 'schoolyear', 'groups', 'terms', 'eventtypes'));
     }

    public function postEvent(Request $r) 
    {
                       

        $this->validate(request(), [

            'description' => 'required',
            'group_id' => 'required',
            'term_id' => 'required',
            'eventtype_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            
            
            ]);


        Event::insert([

            'description'=>$r->description,
            'group_id'=>$r->group_id,
            'term_id'=>$r->term_id,
            'eventtype_id'=>$r->eventtype_id,
            'start_date'=>$r->start_date,
            'end_date'=>$r->end_date,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            
        ]);

       
        flash('Event Added Successfully')->success();

        return redirect()->route('showevents');
    }

     public function editEvent($event_id, $group_id, $term_id, $eventtype_id)
    {

        
        
        $event = Event::find($event_id);
        $group = Group::find($group_id);
        $term = Term::find($term_id);
        $eventtype = Eventtype::find($eventtype_id);

        

        $today = Carbon::today();

        $schoolyear = School_year::first();

        

        return view('/admin.superadmin.schoolsetup.events.editevent', compact('event','today', 
            'schoolyear', 'group', 'term', 'eventtype'));

        

        
    }

    public function postEventUpdate(Request $r, $event_id, $group_id, $term_id, $eventtype_id)

        {
        
       
             $this->validate(request(), [

 				'description' => 'required',
            	'group_id' => 'required',
            	'term_id' => 'required',
            	'eventtype_id' => 'required',
            	'start_date' => 'required',
            	'end_date' => 'required',
                
                ]);

        $event = Event::find($event_id);
        $group = Group::find($group_id);
        $term = Term::find($term_id);
        $eventtype = Eventtype::find($eventtype_id);

        $today = Carbon::today();
        $schoolyear = School_year::first();


                                
        $event_edit = Event::where('id', '=', $event->id)
                            ->where('group_id', '=', $group->id)
                            ->where('term_id', '=', $term->id)
                            ->where('eventtype_id', '=', $eventtype->id)
                            ->first();


            
            $event_edit->description= $r->description;
            $event_edit->start_date= $r->start_date;
            $event_edit->end_date= $r->end_date;
            

           

            $event_edit->save();

            flash('Event Updated Successfully')->success();

            return redirect()->route('showevents');


         }

         public function deleteEvent($event_id)
         {
            Event::destroy($event_id);

            flash('Event has been deleted')->error();

            return back();
         }
}
