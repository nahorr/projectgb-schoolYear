<?php

namespace App\Http\Controllers\AdminAuth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

//Validator facade used in validator method
use Illuminate\Support\Facades\Validator;

//Admin Model
use App\Admin;

//Auth Facade used in guard
use Auth;


class RegisterController extends Controller
{


	protected $redirectPath = 'admin_home';

 //shows registration form to admin/staff

	    public function showRegistrationForm()
	  	{
	      return view('admin.auth.register');
	  	}

  //Handles registration request for admin/staff

	    public function register(Request $request)
	    {

	       //Validates data
	        $this->validator($request->all())->validate();

	       //Create admin/staff
	        $admin = $this->create($request->all());

	        //Authenticates admin/staff
	        $this->guard()->login($admin);

	       //Redirects admin/staff
	        return redirect($this->redirectPath);
	    }


	    //Validates user's Input

	    protected function validator(array $data)
	    {
	        return Validator::make($data, [
	            'name' => 'required|max:255',
	            'email' => 'required|email|max:255|unique:admins',
	            'registration_code' => 'required|string|exists:staffers,registration_code|unique:admins',
	            'password' => 'required|min:6|confirmed',
	        ]);
	    }


	    //Create a new admin/staff instance after a validation.

	    protected function create(array $data)
	    {
	        return Admin::create([
	            'name' => $data['name'],
	            'email' => $data['email'],
	            'registration_code' => $data['registration_code'],
	            'password' => bcrypt($data['password']),
	        ]);
	    }


	    //Get the guard to authenticate admin/staff

	   protected function guard()
	   {
	       return Auth::guard('web_admin');
	   }


}
