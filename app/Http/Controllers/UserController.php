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
use App\StafferRegistration;
use App\StudentRegistration;


class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function profile(School_year $schoolyear, Term $term)
    {         
        $students_teacher = StafferRegistration::with('staffer')->with('school_year')->with('term')->with('group')->where('school_year_id', '=', $schoolyear->id)->where('term_id', '=', $term->id)->where('group_id', StudentRegistration::where('school_year_id', '=', $schoolyear->id)->where('term_id', '=', $term->id)->where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)->first()->group_id)->first();

        return view('profile', compact('schoolyear', 'term', 'students_teacher'));
	
    }

    public function update_avatar(Request $request, School_year $schoolyear, Term $term)
    {
    
        // Handle the user upload of avatar
    	if($request->hasFile('avatar')){
    		$avatar = $request->file('avatar');
    		$filename = time() . '.' . $avatar->getClientOriginalExtension();

            // Delete current image before uploading new image
            if (Auth::user()->avatar !== 'default.jpg') {
                 $file = public_path('assets/img/students/' . Auth::user()->avatar);

                if (File::exists($file)) {
                    unlink($file);
                }

            }

    		Image::make($avatar)->resize(300, 300)->save( public_path('assets/img/students/' . $filename ) );

    		//$user = Auth::user();
    		Auth::user()->avatar = $filename;
    		Auth::user()->save();
    	}

    	        return redirect()->route('userprofile', [ $schoolyear->id, $term->id]);


    }
}
