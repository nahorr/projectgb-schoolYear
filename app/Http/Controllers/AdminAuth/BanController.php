<?php

namespace App\Http\Controllers\AdminAuth;

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
use \Crypt;

class BanController extends Controller
{
    public function banstudents()
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

        foreach ($terms as $t){
            if ($today->between($t->start_date, $t->show_until )){
                $current_term =  $t->term;

            }
                                                         
        }
        

               
        //get school school
        $schoolyear = School_year::first();

        

        return view('/admin/banstudents', compact('today', 'count', 'teacher', 'group_teacher', 'current_term', 
            'schoolyear', 'students_in_group', 'all_user', 'st_user', 'terms'));
    }

    public function posteditBan(Request $r, $user_id)

    {
         

         $user = User::find(Crypt::decrypt($user_id));

         $ban_student = User::where('id', '=', $user->id)->first();
		 
		 $ban_student->status= $r->status;
            
		 $ban_student->save();

		 flash('Student has been banned from using the portal')->error();

         return back();

     }

      public function posteditUnBan(Request $r, $user_id)

    {
         

         $user = User::find(Crypt::decrypt($user_id));

         $unban_student = User::where('id', '=', $user->id)->first();
		 
		 $unban_student->status= $r->status;
            
		 $unban_student->save();

		 flash('Student has been unbaned. Student can now use the portal')->success();

         return back();

     }
}
