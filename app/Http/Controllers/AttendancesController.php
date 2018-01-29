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
    public function showTerms()
    {
                

        
        //get current date
        $today = Carbon::today();

        //get Authenticated user
        $user = Auth::user();

        //all_users
        $all_users = User::get();

        //get user reg code
        $reg_code = $user->registration_code;


        $student = Student::where('registration_code', '=', $reg_code)->first();

        $student_group = Group::where('id','=', $student->group_id)->first();

        

        return view('/attendances/terms');
    }

    public function showDays($term_id)
    {
                

        $term = Term::find(Crypt::decrypt($term_id));

        //get current date
        $today = Carbon::today();

        //get Authenticated user
        $user = Auth::user();

        //all_users
        $all_users = User::get();

        //get user reg code
        $reg_code = $user->registration_code;


        $student = Student::where('registration_code', '=', $reg_code)->first();

        $student_group = Group::where('id','=', $student->group_id)->first();

        $att_attCode = Attendance::join('attendance_codes', 'attendances.attendance_code_id', '=', 'attendance_codes.id')
                                    ->where('student_id', '=', $student->id)
                                    ->where('term_id', '=', $term->id)
                                    ->orderBy('day', 'desc')
                                    ->paginate(7);


        return view('/attendances/days', compact('term', 'att_attCode'));
    }
}
