<?php

namespace App\Http\Controllers\AdminAuth\HeadAdmin;

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
use App\Course;
use App\School;
use DataTables;

class StudentsController extends Controller
{
    

    
    
    public function showStudents()
     {
		//get School info
        $school = School::first();

        //get school year info
        $school_year = School_year::first();

        //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        $groups = Group::get();

        $all_students = Student::all();

        $all_users = User::all();

        return view('/admin.headadmin.students.showstudents', compact('school','school_year', 'today','schoolyear', 'groups', 'all_students', 'all_users'));
    }

    public function getStudentsData()
    {

        $students = \DB::table('students')->join('groups', 'students.group_id', '=', 'groups.id')
                            ->select(['students.id', 'students.registration_code', 'students.first_name', 'students.last_name', 'students.gender','groups.name']);

        return Datatables::of($students)

            ->addColumn('action', function ($student) {
                return '<a href="/headadmin/students/showstudent/'.$student->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-eye-open"></i> Detailed View</a>';
            })->make(true);
        
        //return Datatables::of(Student::query())->make(true);
    }

    public function showStudent($student_id)
     {
        //find student
        $student = Student::find($student_id);

        //get School info
        $school = School::first();

        //get school year info
        $school_year = School_year::first();

        //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        $groups = Group::get();

        $all_students = Student::all();

        $all_users = User::all();

        return view('/admin.headadmin.students.showstudent', compact('student', 'school','school_year', 'today','schoolyear', 'groups', 'all_students', 'all_users'));
    }

    public function showStudentTerms($student_id)
     {
        //find student
        $student = Student::find($student_id);

        //get School info
        $school = School::first();

        //get school year info
        $school_year = School_year::first();

        //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        $groups = Group::get();

        $all_students = Student::all();

        $all_users = User::all();

        $terms = Term::get();

        $courses = Course::get();

        return view('/admin.headadmin.students.terms.showterms', compact('student', 'school','school_year', 'today','schoolyear', 'groups', 'all_students', 'all_users', 'terms', 'courses'));
    }

    public function showStudentTermCourses($student_id, $term_id)
     {
        //find student
        $student = Student::find($student_id);

        $term_find = Term::find($term_id);

        //get School info
        $school = School::first();

        //get school year info
        $school_year = School_year::first();

        //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        $groups = Group::get();

        $all_students = Student::all();

        $all_users = User::all();

        $terms = Term::get();

        $courses = Course::get();

        $courses_term_group = Course::where('term_id', '=', $term_find->id)->where('group_id', '=', $student->group_id)->get();

        return view('/admin.headadmin.students.terms.showcourses', compact('student', 'term_find', 'school','school_year', 'today','schoolyear', 'groups', 'all_students', 'all_users', 'terms', 'courses', 'courses_term_group'));
    }
}
