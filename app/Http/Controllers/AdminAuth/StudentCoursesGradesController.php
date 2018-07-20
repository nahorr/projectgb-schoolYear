<?php

namespace App\Http\Controllers\AdminAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Event;

use App\Http\Requests;
use App\School_year;

use App\Term;
use Carbon\Carbon;
use App\Course;
use Auth;
use Image;
use App\Student;


use App\Grade;
use App\Group;

use App\User;
use \Crypt;

class StudentCoursesGradesController extends Controller
{
    
    public function showCourseGrades($course, School_year $schoolyear, Term $term)
    {

        $course = Course::find(Crypt::decrypt($course));

   
        $group = Group::where('id', '=', $course->group_id)->first();

    
    	$student_grades= Student::join('grades', 'students.id', '=', 'grades.student_id')
    	->where('grades.course_id', '=', $course->id)
        ->orderBy('total', 'desc')
        ->get();

        $grades= Grade::join('students', 'grades.student_id', '=', 'students.id')
        ->where('grades.course_id', '=', $course->id)
        ->select('grades.*', 'students.last_name','students.registration_code')
        ->orderBy('total', 'desc')
        ->get();

        /*$regsss= \App\StudentRegistration::with('student')->with('school_year')->with('term')->with('group')->where('term_id', $term->id)->where('group_id', \App\StafferRegistration::where('school_year_id', '=', $schoolyear->id)->where('term_id', '=', $term->id)->where('staffer_id', \App\Staffer::where('registration_code', '=', Auth::guard('web_admin')->user()->registration_code)->first()->id)->first()->group_id)->get();*/

    //dd($regsss);
              
        $positions= Student::join('grades', 'students.id', '=', 'grades.student_id')
        ->where('grades.course_id', '=', $course->id)
        ->orderBy('total', 'desc')
        ->pluck('student_id')
        ->toArray();


        
        $class_highest = Grade::where('course_id', '=', $course->id)->max('total');
        $class_lowest = Grade::where('course_id', '=', $course->id)->min('total');
        $class_average = Grade::where('course_id', '=', $course->id)->avg('total');

        //dd($class_highest);


    	return view('admin.showstudentcoursesgrades', compact(

    		'schoolyear', 'term', 'course', 'group', 'student_grades', 'grades',
            'class_highest', 'class_lowest', 'class_average', 'positions', 'all_user'


    		));
    }

    public function deleteGrade($grade, School_year $schoolyear, Term $term)
         {
            
            Grade::destroy(Crypt::decrypt($grade));

            flash('Grade has been deleted')->error();

            return back();
         }

}
