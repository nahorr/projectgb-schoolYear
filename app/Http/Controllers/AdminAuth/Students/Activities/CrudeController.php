<?php

namespace App\Http\Controllers\AdminAuth\Students\Activities;

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
use App\Attendance;
use App\AttendanceCode;
use \Crypt;
use App\DailyActivity;
use File;

use Notification;
use App\Notifications\DailyActivityPosted;

class CrudeController extends Controller
{
    public function showStudentsActivityTypes()
    {
    	//get current date
        $today = Carbon::today();

        //get teacher's section and group
        $teacher_admin = Auth::guard('web_admin')->user();

        $reg_code = $teacher_admin->registration_code;

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


        //get school school
        $schoolyear = School_year::first();

        //$student_activities = StudentActivity::get();

     
       
    	return view('admin.students.activities.showstudentsactivitytypes', 
    				compact('today', 'count', 'group_teacher', 'current_term', 
            'schoolyear', 'students_in_group', 'all_user', 'st_user',  'terms', 'student_activities'));
    }

     public function dailyActivities()
    {
        //get current date
        $today = Carbon::today();

        //get teacher's section and group
        $teacher_admin = Auth::guard('web_admin')->user();

        $reg_code = $teacher_admin->registration_code;

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


        //get school school
        $schoolyear = School_year::first();

        $daily_activities = DailyActivity::where('group_id', '=', $teacher->group_id)->orderBy('created_at', 'desc')->paginate(10);

     
       
        return view('admin.students.activities.dailyactivities', 
                    compact('today', 'count', 'group_teacher', 'current_term', 
            'schoolyear', 'students_in_group', 'all_user', 'st_user',  'terms', 'daily_activities'));
    }

    public function addDailyActivity()
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


        //get school school
        $schoolyear = School_year::first();

        $daily_activities = DailyActivity::orderBy('created_at', 'desc')->paginate(10);

     
       
        return view('admin.students.activities.adddailyactivity', 
                    compact('today', 'count', 'group_teacher', 'current_term', 
            'schoolyear', 'students_in_group', 'all_user', 'st_user',  'terms', 'daily_activities'));
    }

    public function postDailyActivity(Request $r)
    {


        $this->validate(request(), [

            'term_id' => 'required',
            'group_id' => 'required',
            'activity_name' => 'required',
            'activity_date' => 'required',
            'due_date' => 'required',
            'activity_description' => 'required',
            'activity_file' => 'required|mimes:pdf,doc|max:10000',
            
            
            ]);

        if($r->hasFile('activity_file')){
            $activity_file = $r->file('activity_file');
            $filename = time() . '.' . $activity_file->getClientOriginalExtension();
            $destinationPath = public_path().'/daily_activities/' ;
            $activity_file->move($destinationPath,$filename);
            
        }


        DailyActivity::insert([

            'term_id'=>$r->term_id,
            'group_id'=>$r->group_id,
            'activity_name'=>$r->activity_name,
            'activity_description'=>$r->activity_description,
            'activity_date'=>$r->activity_date,
            'due_date'=>$r->due_date,
            'activity_file'=>$filename,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
                       
        ]);

        //get teacher's section and group
        $teacher = Auth::guard('web_admin')->user();

        $reg_code = $teacher->registration_code;

        $teacher = Staffer::where('registration_code', '=', $reg_code)->first();

        $students = Student::where('group_id', '=', $teacher->group_id )->get();

        foreach ($students as $student) {
 
            $student->notify(new DailyActivityPosted("A new activity has been posted."));
        }
       
        flash('Activity Added Successfully')->success();

        return redirect()->route('dailyactivities');
    }

    public function editDailyActivity($activity_id)
    {
        //find activity with id
        $daily_activity = DailyActivity::find($activity_id);

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


        //get school school
        $schoolyear = School_year::first();

 
        return view('admin.students.activities.editdailyactivity', 
                    compact('today', 'count', 'group_teacher', 'current_term', 
            'schoolyear', 'students_in_group', 'all_user', 'st_user',  'terms', 'daily_activity'));
    }

    public function postEditDailyActivity(Request $r, $activity_id)

        {
        
        //find activity with id
        $daily_activity = DailyActivity::find($activity_id);

        $this->validate(request(), [

            'term_id' => 'required',
            'group_id' => 'required',
            'activity_name' => 'required',
            'activity_date' => 'required',
            'due_date' => 'required',
            'activity_description' => 'required',
                
                ]);
                
                                        
        $daily_activity_edit = DailyActivity::where('id', '=', $daily_activity->id)->first();


                    
        $daily_activity_edit->activity_name= $r->activity_name;
        $daily_activity_edit->activity_description= $r->activity_description;
        $daily_activity_edit->activity_date= $r->activity_date;
        $daily_activity_edit->due_date= $r->due_date;         
    
        $daily_activity_edit->save();

        flash('Activity Updated Successfully')->success();

        return redirect()->route('dailyactivities');


         }

         public function deleteActivity($activity_id)
         {
            DailyActivity::destroy($activity_id);

            flash('Activity has been deleted')->error();

            return back();
         }


}
