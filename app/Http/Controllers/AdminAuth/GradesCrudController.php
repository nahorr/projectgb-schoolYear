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
use \Crypt;

class GradesCrudController extends Controller
{
    public function addGrades($student_id, $course_id)
    {

    	
    	//get current date
        $today = Carbon::today();

        $student = Student::find(Crypt::decrypt($student_id));

        $course = Course::find(Crypt::decrypt($course_id));

        $term = Term::where('id', '=', $course->term_id)->first();

        $group = Group::where('id', '=', $course->group_id)->first();


    	$students = Student::where('group_id', '=', $course->group_id)->get();



    	return view('/admin.addGrades', compact('student',

    		'students', 'today', 'course', 'term', 'group'

    		));
    }

    public function postGrades(Request $r, $student_id, $course_id) 
    {

        $student = Student::find(Crypt::decrypt($student_id));     
        $course = Course::find(Crypt::decrypt($course_id));
        
    	$this->validate(request(), [

    		'student_id' => 'required|unique_with:grades,course_id',
            'course_id' => 'required',
            'first_ca'=> 'required|numeric|max:10|min:0',
            'second_ca'=> 'required|numeric|max:10|min:0',
            'third_ca'=> 'required|numeric|max:10|min:0',
            'fourth_ca'=> 'required|numeric|max:10|min:0',
            'exam'=> 'required|numeric|max:60|min:0',

    		]);


    	Grade::insert([

    		'student_id'=>$r->student_id,
    		'course_id'=>$r->course_id,
    		'first_ca'=>$r->first_ca,
    		'second_ca'=>$r->second_ca,
    		'third_ca'=>$r->third_ca,
    		'fourth_ca'=>$r->fourth_ca,
    		'exam'=>$r->exam,
            'total'=>$r->first_ca+$r->second_ca+$r->third_ca+$r->fourth_ca+$r->exam,
    		
    		
    	]);

       return redirect()->route('showstudentcoursesgrades', [Crypt::encrypt($course->id)]);

    	//return back();
    }

    public function editGrades($student_id, $course_id)
    {

         $today = Carbon::today();

         

         $student = Student::find(Crypt::decrypt($student_id));

         $course = Course::find(Crypt::decrypt($course_id));

         $term = Term::where('id', '=', $course->term_id)->first();

         $group = Group::where('id', '=', $course->group_id)->first();

         //dd($student);

         


         $student_grades= Grade::where('grades.course_id', '=', $course->id)
        ->where('grades.student_id', '=', $student->id)
        ->first();





        return view('/admin.editGrades', compact( 'student',

            'students', 'today', 'course', 'term', 'group', 'student_grades', 'grades'

            ));
    }


    public function postGradeUpdate(Request $r, $student_id, $course_id)

    {
         $student = Student::find(Crypt::decrypt($student_id));

         $course = Course::find(Crypt::decrypt($course_id));

         $this->validate(request(), [

            'first_ca'=> 'required|numeric|max:10|min:0',
            'second_ca'=> 'required|numeric|max:10|min:0',
            'third_ca'=> 'required|numeric|max:10|min:0',
            'fourth_ca'=> 'required|numeric|max:10|min:0',
            'exam'=> 'required|numeric|max:60|min:0',

            ]);

         

         $student_grades = Grade::where('student_id', '=', $student->id)
                                 ->where('course_id', '=', $course->id)
                                 ->first();
         

            $student_grades->first_ca = $r->first_ca;
            $student_grades->second_ca = $r->second_ca;
            $student_grades->third_ca = $r->third_ca;
            $student_grades->fourth_ca = $r->fourth_ca;
            $student_grades->exam = $r->exam;
            $student_grades->total = $r->first_ca+$r->second_ca+$r->third_ca+$r->fourth_ca+$r->exam;

            //$student_grades->total = $r->total;
            

            $student_grades->save();

            return redirect()->route('showstudentcoursesgrades', [Crypt::encrypt($course->id)]);



     }

     
    


    
}
