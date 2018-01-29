<?php

namespace App\Http\Controllers\AdminAuth\GroupEvents;

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
use \Crypt;

class SetUpController extends Controller
{
    public function showGroupEvents ()
    {
    	

    	//get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        //get teacher's section and group
        $teacher = Auth::guard('web_admin')->user();

     
        $teacher = Staffer::where('registration_code', '=', $teacher->registration_code)->first();


        //get students in group_section
        $students_in_group = Student::where('group_id', '=', $teacher->group_id)
        ->get();

       
        $count = 0;
        foreach ($students_in_group as $students) {
        	$count = $count+1;
        }

        $group_teacher = Group::where('id', '=', $teacher->group_id)->first();
        

        //get terms
        $terms = Term::get();

        $groupevent_current_term = Event::where('group_id', '=', $teacher->group_id)->get();
                                         
        
        return view('/admin.groupevents.showgroupevents', compact('today', 'schoolyear', 'teacher', 
        	'students_in_group', 'count', 'group_teacher', 'current_term', 'groupevent_current_term', 'terms'));
    }

    public function addGroupEvent ($group_id, $term_id)
    {
        
        $group = Group::find(Crypt::decrypt($group_id));

        $term = Term::find(Crypt::decrypt($term_id));

        //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        //get teacher's section and group
        $teacher = Auth::guard('web_admin')->user();

     
        $teacher = Staffer::where('registration_code', '=', $teacher->registration_code)->first();


        //get students in group_section
        $students_in_group = Student::where('group_id', '=', $teacher->group_id)
        ->get();

       
        $count = 0;
        foreach ($students_in_group as $students) {
            $count = $count+1;
        }

        $group_teacher = Group::where('id', '=', $teacher->group_id)->first();
        

        //get terms
        $terms = Term::get();

        $groupevent_current_term = Event::where('group_id', '=', $teacher->group_id)->get();
       
        
        return view('/admin.groupevents.addgroupevent', compact('today', 'schoolyear', 'teacher', 'group', 'term',
            'students_in_group', 'count', 'group_teacher', 'current_term', 'groupevent_current_term', 'terms'));
    }

    public function postGroupEvent(Request $r, $group_id, $term_id) 
    {
        $group = Group::find(Crypt::decrypt($group_id));

        $term = Term::find(Crypt::decrypt($term_id));            

        $this->validate(request(), [

            'group_id' => 'required',
            'term_id' => 'required',
            'type' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            
            
            ]);


        Event::insert([

            
            'group_id'=>$r->group_id,
            'term_id'=>$r->term_id,
            'type'=>$r->type,
            'description'=>$r->description,
            'start_date'=>$r->start_date,
            'end_date'=>$r->end_date,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            
        ]);

       
        flash('Event Added Successfully')->success();

        return redirect()->route('groupevents', [Crypt::encrypt($group->id), Crypt::encrypt($term->id)]);
    }

    public function editGroupEvent ($event_id)
    {
        
        $event = Event::find(Crypt::decrypt($event_id));

        $group = Group::where('id', '=', $event->group_id )->first();
        $term = Term::where('id', '=', $event->term_id )->first();

        //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        //get teacher's section and group
        $teacher = Auth::guard('web_admin')->user();

     
        $teacher = Staffer::where('registration_code', '=', $teacher->registration_code)->first();


        //get students in group_section
        $students_in_group = Student::where('group_id', '=', $teacher->group_id)
        ->get();

       
        $count = 0;
        foreach ($students_in_group as $students) {
            $count = $count+1;
        }

        $group_teacher = Group::where('id', '=', $teacher->group_id)->first();
        

        //get terms
        $terms = Term::get();

        
       
        
        return view('/admin.groupevents.editgroupevent', compact('event','today', 'schoolyear', 'teacher', 'group', 'term',
            'students_in_group', 'count', 'group_teacher', 'terms'));
    }

    public function postGroupEventUpdate(Request $r, $event_id)

        {
        
       
             $this->validate(request(), [

                'group_id' => 'required',
                'term_id' => 'required',
                'type' => 'required',
                'description' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                
                ]);

                $event = Event::find(Crypt::decrypt($event_id));
                $group = Group::where('id', '=', $event->group_id )->first();
                $term = Term::where('id', '=', $event->term_id )->first();
                

                $today = Carbon::today();
                $schoolyear = School_year::first();


                                        
                $event_edit = Event::where('id', '=', $event->id)
                                    ->where('group_id', '=', $group->id)
                                    ->where('term_id', '=', $term->id)
                                    ->first();


                    
                    $event_edit->type= $r->type;
                    $event_edit->description= $r->description;
                    $event_edit->start_date= $r->start_date;
                    $event_edit->end_date= $r->end_date;
                    

                   

                    $event_edit->save();

                    flash('Event Updated Successfully')->success();

                    return redirect()->route('groupevents');


         }

         public function postGroupEventDelete($event_id)
         {
            Event::destroy(Crypt::decrypt($event_id));

            flash('Event has been deleted')->error();

            return back();
         }


}
