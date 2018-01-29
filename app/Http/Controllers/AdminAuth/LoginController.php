<?php

namespace App\Http\Controllers\AdminAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Class needed for login and Logout logic
use Illuminate\Foundation\Auth\AuthenticatesUsers;

//Auth facade
use Auth;
use App\School_year;


class LoginController extends Controller
{

	//Where to redirect admin/staff after login.
    protected $redirectTo = '/admin_home';
    
    //Trait
    use AuthenticatesUsers;

    //Custom guard for admin/staff
    protected function guard()
    {
      return Auth::guard('web_admin');
    }

    //Shows admin/staff login form
   public function showLoginForm()
   {

       $school_year = School_year::first();

       return view('admin.auth.login', compact('school_year'));
   }


}
