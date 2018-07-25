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
    public function banstudents(School_year $schoolyear, Term $term)
    {        

        return view('admin/banstudents', compact('schoolyear','term'));
    }

    public function posteditBan(Request $r, School_year $schoolyear, Term $term, $user)

    {
         

         $user = User::find(Crypt::decrypt($user));

         $ban_student = User::where('id', '=', $user->id)->first();
		 
		 $ban_student->status= $r->status;
            
		 $ban_student->save();

		 flash('Student has been banned from using the portal')->error();

         return back();

     }

      public function posteditUnBan(Request $r, School_year $schoolyear, Term $term, $user)

    {
         

         $user = User::find(Crypt::decrypt($user));

         $unban_student = User::where('id', '=', $user->id)->first();
		 
		 $unban_student->status= $r->status;
            
		 $unban_student->save();

		 flash('Student has been unbaned. Student can now use the portal')->success();

         return back();

     }
}
