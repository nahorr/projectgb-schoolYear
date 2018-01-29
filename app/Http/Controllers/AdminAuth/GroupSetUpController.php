<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\School_year;
use Carbon\Carbon;
use App\Student;
use App\Staffer;
use App\Group;
use App\User;
use App\Event;
use App\Term;
use Image;
use Auth;


class GroupSetUpController extends Controller
{
    public function showGroups()
    {

        return view('admin.superadmin.schoolsetup.showgroups');
    }

    public function addGroup()
    {

    	return view('admin.superadmin.schoolsetup.addgroup');
    }

    public function postGroup(Request $r) 
    {   

        $this->validate(request(), [

            'name' => 'required|unique:groups',
            
            ]);


        Group::insert([

            'name'=>$r->name,
            'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),                   
            
        ]);

       
        flash('Group Added Successfully')->success();

        return redirect('/schoolsetup/showgroups');
    }


    public function editGroup($group_id)
    {
        //find group
        $group = Group::find($group_id);

        return view('admin.superadmin.schoolsetup.editgroup', compact('group'));
    }


    public function postGroupUpdate(Request $r, $group_id)

    {
         $this->validate(request(), [

            'name' => 'required',
            
            ]);


        $group = Group::find($group_id);

        $group_edit = Group::where('id', '=', $group->id)->first();
     
        $group_edit->name= $r->name; 
          
        $group_edit->save();

        flash('Group Updated Successfully')->success();

        return back();


     }

     public function deleteGroup($group_id)
     {
        Group::destroy($group_id);

        flash('Group has been deleted')->error();

        return back();
     }
}
