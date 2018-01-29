<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\School;
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

use App\ContactUS;
use Mail;

class HomePublicController extends Controller
{
    public function index()
    {
      	//get school info
        $school = School::first();
        //get current date
        $schoolyear = School_year::first();
        
        //get current date
        $today = Carbon::today();

          

        return view('homepublic.index', compact('school', 'schoolyear', 'today'));
    }

    public function features()
    {
        //get school info
        $school = School::first();
        //get current date
        $schoolyear = School_year::first();
        
        //get current date
        $today = Carbon::today();

          

        return view('homepublic.features', compact('school', 'schoolyear', 'today'));
    }

    public function contact()
    {
        //get school info
        $school = School::first();
        //get current date
        $schoolyear = School_year::first();
        
        //get current date
        $today = Carbon::today();

          

        return view('homepublic.contact', compact('school', 'schoolyear', 'today'));
    }

    public function postContact(Request $request)
    {

                  
        $this->validate($request, [
        'first_name' => 'required',
        'last_name' => 'required',
        'phone' => 'required',
        'email' => 'required|email',
        'message' => 'required'
        ]);
 
       ContactUS::create($request->all());

       Mail::send('homepublic.contactemail',
       array(
           'first_name' => $request->get('first_name'),
           'last_name' => $request->get('last_name'),
           'phone' => $request->get('phone'),
           'email' => $request->get('email'),
           'user_message' => $request->get('message')
       ), function($message)
   {
       $message->from('nahorr@gmail.com');
       $message->to('nnamdi@totalgrades.com', 'Admin')->subject('TotalGrades-Contact Page');
   });

       flash('Your message was sent successfully. We will be contacting you soon!')->success();
      
        return back();  
    }

    public function videos()
    {
        $today = Carbon::today();

        return view('homepublic.videos', compact('today'));
    }

  
}
