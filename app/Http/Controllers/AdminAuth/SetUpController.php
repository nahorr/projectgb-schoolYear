<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\School_year;
use Carbon\Carbon;
use App\Student;
use App\Staffer;
use App\Course;
use App\School;
use App\Event;
use App\Group;
use App\User;
use App\Term;
use Image;
use Auth;
use File;

class SetUpController extends Controller
{
    
    public function schoolSetUp()
    {

        $groups_count = Group::count();

        $students_count = Student::count();
        
        $staffers_count = Staffer::count();

        $courses_count = Course::count();

        return view('admin.superadmin.schoolsetup', compact('groups_count','students_count', 'staffers_count', 'courses_count'));
    }

    public function update_logo(Request $request)

    {
        //get school information
        $school = School::first();

        // Handle the user upload of avatar
        if($request->hasFile('logo')){
            $logo = $request->file('logo');
            $filename = time() . '.' . $logo->getClientOriginalExtension();

            // Delete current image before uploading new image
            if ($school->logo !== 'default_logo.jpg') {
                 $file = public_path('/assets/img/logo/' . $school->logo);

                if (File::exists($file)) {
                    unlink($file);
                }
            }

            Image::make($logo)->resize(300, 300)->save( public_path('/assets/img/logo/' . $filename ) );
           
            $school->logo = $filename;
            $school->save();
        }

        return back();
    }

        	
}
