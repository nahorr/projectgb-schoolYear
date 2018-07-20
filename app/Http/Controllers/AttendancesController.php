<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\School_year;
use App\Event;
use App\Term;
use Carbon\Carbon;

use App\Http\Requests;
use Auth;
use Image;
use App\Student;
use App\User;

use App\Group;
use App\Attendance;
use App\AttendanceCode;
use \Crypt;

class AttendancesController extends Controller
{
    public function showTerms(School_year $schoolyear)
    {
                        

        return view('attendances.showterms', compact('schoolyear'));
    }

    public function showDays(School_year $schoolyear, $term)
    {
                

        $term = Term::find(Crypt::decrypt($term));

        $att_attCode = Attendance::join('attendance_codes', 'attendances.attendance_code_id', '=', 'attendance_codes.id')
                                    ->where('student_id', '=', Student::where('registration_code', '=', Auth::user()->registration_code)->first()->id)
                                    ->where('term_id', '=', $term->id)
                                    ->orderBy('day', 'desc')
                                    ->paginate(30);

        
        return view('attendances.days', compact( 'schoolyear', 'term', 'att_attCode'));
    }
}
