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
use File;

class AdminUserController extends Controller
{
    public function profile()
    {
        
        return view('admin.profile');
    }


    public function update_avatar(Request $request)
    {

        // Handle the user upload of avatar
    	if($request->hasFile('avatar')){
            //$user = Auth::user();
    		$avatar = $request->file('avatar');
    		$filename = time() . '.' . $avatar->getClientOriginalExtension();

            // Delete current image before uploading new image
            if (Auth::guard('web_admin')->user()->avatar !== 'default.jpg') {
                 $file = public_path('/assets/img/staffers/' . Auth::guard('web_admin')->user()->avatar);

                if (File::exists($file)) {
                    unlink($file);
                }

            }

    		Image::make($avatar)->resize(300, 300)->save( public_path('/assets/img/staffers/' . $filename ) );

    		//$user = Auth::user();
    		Auth::guard('web_admin')->user()->avatar = $filename;
    		Auth::guard('web_admin')->user()->save();
    	}

    	return view('admin.profile');

    }

    	
}
