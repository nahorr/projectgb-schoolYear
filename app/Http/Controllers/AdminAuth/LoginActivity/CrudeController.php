<?php

namespace App\Http\Controllers\AdminAuth\LoginActivity;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\LoginActivity;
use Auth;
use Carbon\Carbon;
use App\School;
use App\User;
use Location;


class CrudeController extends Controller
{
    

    public function index()
	{
		//get School info
        $school = School::first();

        //get current date
        $today = Carbon::today();

        $users = User::get();

	    $loginActivities = LoginActivity::latest()->paginate(10);

	   	   
	    return view('admin.superadmin.schoolsetup.logs.studentsloginactivities', compact('school', 'today', 'users', 
	    	'loginActivities'));
	}

		
}
