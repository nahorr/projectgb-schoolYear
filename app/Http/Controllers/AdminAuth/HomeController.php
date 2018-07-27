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
use PDF;
use App\School;
use App\FeeType;
use App\Fee;
use App\StafferRegistration;
use App\StudentRegistration;




class HomeController extends Controller
{
    public function selectTerm()
    {
       
        return view('admin.selectTerm');
    }

    public function selectTermMolal()
    {
       
        return view('admin.selectTermModal');
    }

    public function index(School_year $schoolyear, Term $term)
    {

      
        return view('admin.home', compact('schoolyear', 'term'));
    }


    public function printRegCode ($student, School_year $schoolyear, Term $term)
    {

        $student =  Student::find($student);


        $term_tuitions = Fee::get();

        
        $pdf = PDF::loadView('admin.printregcode',compact('student', 'term_tuitions', 'schoolyear', 'term'));

        return $pdf->inline();

    }

    public function printAllRegCode (School_year $schoolyear, Term $term)
    {

        $term_tuitions = Fee::get();
       
        $pdf = PDF::loadView('admin.printallregcode',compact('term_tuitions', 'schoolyear', 'term'));

        return $pdf->inline();

    }

    public function observationsOnConduct(School_year $schoolyear, Term $term)
    {

        return view('admin.observationsonconduct',compact('schoolyear', 'term'));
    }

    
}