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
use File;

class AdminUserController extends Controller
{
    public function profile(){

    	//get current date
        $today = Carbon::today();

        //get teacher's section and group
        $teacher = Auth::guard('web_admin')->user();

        $admin_user = Auth::guard('web_admin')->user();

         
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

               
        

        return view('/admin.profile', compact('admin_user', 'teacher', 'today', 'count', 'group_teacher', 'current_term', 'schoolyear', 'students_in_group', 'all_user', 'st_user', 'terms'));
    }


    public function update_avatar(Request $request){

       //get current date
        $today = Carbon::today();

        $teacher = Auth::guard('web_admin')->user();
        
        $admin_user = Auth::guard('web_admin')->user();

        

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

    	

        // Handle the user upload of avatar
    	if($request->hasFile('avatar')){
            //$user = Auth::user();
    		$avatar = $request->file('avatar');
    		$filename = time() . '.' . $avatar->getClientOriginalExtension();

            // Delete current image before uploading new image
            if ($admin_user->avatar !== 'default.jpg') {
                 $file = public_path('/assets/img/staffers/' . $admin_user->avatar);

                if (File::exists($file)) {
                    unlink($file);
                }

            }

    		Image::make($avatar)->resize(300, 300)->save( public_path('/assets/img/staffers/' . $filename ) );

    		//$user = Auth::user();
    		$admin_user->avatar = $filename;
    		$admin_user->save();
    	}

    	return view('/admin.profile', compact('teacher','admin_user','today', 'count', 'group_teacher', 
            'current_term', 'schoolyear', 'students_in_group', 'all_user', 'st_user', 'terms'));

    }

    	
}
