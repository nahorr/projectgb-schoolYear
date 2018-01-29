<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Image;
use App\Student;
use App\Section;
use Carbon\Carbon;
use App\School_year;
use App\Event;
use App\Term;
use File;
use App\Group;
use App\Staffer;


class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function profile(){

        
                

        return view('/profile');

        

    	
    }

    public function update_avatar(Request $request){

    
        $user = Auth::user();

        $reg_code = $user->registration_code;

        $student = Student::where('registration_code', '=', $reg_code)->first();

        

        $student_group = Group::where('id','=', $student->group_id)->first();




        $next_group = Group::where('id','=', $student->group_id+2)->first();

        
        $student_teacher = Staffer::where('group_id', '=', $student_group->id )->first();

        $students_all = Student::where('group_id', '=', $student_group->id)->get();

                              
        //get term

        $terms = Term::get();

    	

        // Handle the user upload of avatar
    	if($request->hasFile('avatar')){
            //$user = Auth::user();
    		$avatar = $request->file('avatar');
    		$filename = time() . '.' . $avatar->getClientOriginalExtension();

            // Delete current image before uploading new image
            if ($user->avatar !== 'default.jpg') {
                 $file = public_path('assets/img/students/' . $user->avatar);

                if (File::exists($file)) {
                    unlink($file);
                }

            }

    		Image::make($avatar)->resize(300, 300)->save( public_path('assets/img/students/' . $filename ) );

    		//$user = Auth::user();
    		$user->avatar = $filename;
    		$user->save();
    	}

    	return view('/profile', compact('user', 'student', 'student_group', 'student_teacher') );

    }
}
