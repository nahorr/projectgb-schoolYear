<?php

namespace App\Http\Controllers\AdminAuth\LoginActivity;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Carbon\Carbon;
use App\School;
use App\User;
use Location;
use App\AdminAuthActivity;
use App\Admin;

class AdminAuthActivityController extends Controller
{
    

    public function adminAuthActivities()
	{
		//get School info
        $school = School::first();

        //get current date
        $today = Carbon::today();

        $admins = Admin::get();

	    $adminauthactivities = AdminAuthActivity::latest()->paginate(10);

	   	   
	    return view('admin.superadmin.schoolsetup.logs.adminsloginactivities', compact('school', 'today', 'admins', 
	    	'adminauthactivities'));
	}


	
}
