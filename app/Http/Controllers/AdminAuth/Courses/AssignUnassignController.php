<?php

namespace App\Http\Controllers\AdminAuth\Courses;

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
use DB;
use App\Course;
use Excel;

class AssignUnassignController extends Controller
{
    public function assignCourse($course_id, $group_id, $term_id)
    {

       
        $course = Course::find($course_id);

        $group = Group::find($group_id);
        $term = Term::find($term_id);
        
        $today = Carbon::today();

        $schoolyear = School_year::first();

        //get all teachers
        $staffers = Staffer::get();

        //get logged in user
        $teacher_logged_in = Auth::guard('web_admin')->user();

        
        $reg_code = $teacher_logged_in->registration_code;

        $teacher = Staffer::where('registration_code', '=', $reg_code)->first();

        return view('/admin.superadmin.schoolsetup.courses.assign', compact('today', 'teacher', 'teacher_logged_in', 'schoolyear','group', 'term', 'course', 'staffers'));
    }

    public function postAssignCourse(Request $r, $course_id, $group_id, $term_id)
    {

       $course = Course::find($course_id);


		$this->validate(request(), [

		    'staffer_id' => 'required',
		    		    
		    ]);


		$assign_staffer = Course::where('id', '=', $course->id)->first();
       	$assign_staffer->staffer_id = $r->staffer_id;
            
	    $assign_staffer->save();

	    $group = Group::find($group_id);
        $term = Term::find($term_id);


		flash('Instructor has been assigned successfully')->success();

        return redirect()->route('showcourses', ['group_id' => $group->id, 'term_id' => $term->id ]);

		
        
    }

    public function postUnassignCourse(Request $r, $course_id)
    {

       	$course = Course::find($course_id);
       	$unassign_course = Course::where('id', '=', $course->id)->first();
       	$unassign_course->staffer_id = $r->staffer_id;
            
	    $unassign_course->save();

		flash('Instructor has been unassigned successfully')->error();

        return back();
        
    }
}
