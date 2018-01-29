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
    
    public function showCourseGrades($id)
    {

    	
    	//get current date
        $today = Carbon::today();

        $course = Course::find(Crypt::decrypt($id));


        $term = Term::where('id', '=', $course->term_id)->first();

        
        $group = Group::where('id', '=', $course->group_id)->first();


    	$students = Student::where('group_id', '=', $course->group_id)->get();



        $all_user = User::get();



    	$student_grades= Student::join('grades', 'students.id', '=', 'grades.student_id')
    	->where('grades.course_id', '=', $course->id)
        ->orderBy('total', 'desc')
        ->get();

        $grades= Grade::join('students', 'grades.student_id', '=', 'students.id')
        ->where('grades.course_id', '=', $course->id)
        ->select('grades.*', 'students.last_name','students.registration_code')
        ->orderBy('total', 'desc')
        ->get();

        
              
        $positions= Student::join('grades', 'students.id', '=', 'grades.student_id')
        ->where('grades.course_id', '=', $course->id)
        ->orderBy('total', 'desc')
        ->pluck('student_id')
        ->toArray();


        
        $class_highest = Grade::where('course_id', '=', $course->id)->max('total');
        $class_lowest = Grade::where('course_id', '=', $course->id)->min('total');
        $class_average = Grade::where('course_id', '=', $course->id)->avg('total');

        //dd($class_highest);

    	


    	return view('/admin.showstudentcoursesgrades', compact(

    		'students', 'today', 'course', 'term', 'group', 'student_grades', 'grades',
            'class_highest', 'class_lowest', 'class_average', 'positions', 'all_user'


    		));
    }

    public function deleteGrade($grade_id)
         {
            
            Grade::destroy(Crypt::decrypt($grade_id));

            flash('Grade has been deleted')->error();

            return back();
         }

}
