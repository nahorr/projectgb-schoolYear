<?php

namespace App\Http\Controllers\AdminAuth\Staffers;

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
use Excel;


class SetUpController extends Controller
{
    

    public function showStaffers()
    {
    	

    	$staffers_groups= Group::join('staffers', 'groups.id', '=', 'staffers.group_id')->get();



    	$staffers_count = Staffer::count();

    	$groups = Group::get();


        //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        
      

        return view('/admin.superadmin.schoolsetup.staffers.showstaffers', compact('staffers_groups','today',
        	'schoolyear', 'staffers_count', 'groups'));
    }

    public function addStaffer()
    {

    	$staffers_groups= Group::join('staffers', 'groups.id', '=', 'staffers.group_id')->get();



    	$staffers_count = Staffer::count();

    	$groups = Group::pluck('name', 'id');

        //dd($groups);

        
        //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        

      

        return view('/admin.superadmin.schoolsetup.staffers.addstaffer', compact('staffers_groups','today',
        	'schoolyear', 'staffers_count', 'groups'));
     }

    public function postStaffer(Request $r) 
    {
                       

        $this->validate(request(), [

            'group_id' => 'required',
            'registration_code' => 'required|unique:staffers',
            'first_name' => 'required',
            'last_name' => 'required',
            //'gender' => 'required',
            //'dob' => 'required',
            //'status' => 'required',
            //'date_enrolled' => 'required',
            //'nationality' => 'required',
            //'national_card_number' => 'required',
            //'passport_number' => 'required',
            //'phone' => 'required',
            //'state' => 'required',
            //'address' => 'required',

            ]);


        Staffer::insert([

            'group_id'=>$r->group_id,
            'registration_code'=>$r->registration_code,
            'title'=>$r->title,
            'first_name'=>$r->first_name,
            'last_name'=>$r->last_name,
            'gender'=>$r->gender,
            'employment_status'=>$r->employment_status,
            'date_of_employment'=>$r->date_of_employment,
            'nationality'=>$r->nationality,
            'national_card_number'=>$r->national_card_number,
            'passport_number'=>$r->passport_number,
            'phone'=>$r->phone,
            'state'=>$r->state,
            'current_address'=>$r->current_address,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
 
        ]);

       
        flash('Teacher(Staffer) Added Successfully')->success();

        return redirect()->route('showstaffers');
    }

    public function editStaffer($staffer_id)
    {

        $staffer = Staffer::find($staffer_id);

        $staffers_groups= Group::join('staffers', 'groups.id', '=', 'staffers.group_id')->get();



    	$staffers_count = Staffer::count();

    	$groups = Group::pluck('name', 'id');
        
        //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        
        
      

        return view('/admin.superadmin.schoolsetup.staffers.editstaffer', compact('staffer', 'staffers_groups','today', 'schoolyear', 'staffers_count', 'groups'));

        
    }

    public function postStafferUpdate(Request $r, $staffer_id)

        {
        
        $staffer = Staffer::find($staffer_id);

        $staffers_groups= Group::join('staffers', 'groups.id', '=', 'staffers.group_id')->get();



    	$staffers_count = Staffer::count();

    	$groups = Group::get();
        
        //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        
        //get logged in user
        $teacher_logged_in = Auth::guard('web_admin')->user();

        
        $reg_code = $teacher_logged_in->registration_code;

        $teacher = Staffer::where('registration_code', '=', $reg_code)->first();


             $this->validate(request(), [

                
            'group_id' => 'required',
            'registration_code' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
                
                ]);


                                
            $staffer_edit = Staffer::where('id', '=', $staffer->id)->first();


            
            $staffer_edit->group_id= $r->group_id;
            $staffer_edit->registration_code= $r->registration_code;
            $staffer_edit->title= $r->title;
            $staffer_edit->first_name= $r->first_name;
            $staffer_edit->last_name= $r->last_name;
            $staffer_edit->gender= $r->gender;
            $staffer_edit->employment_status= $r->employment_status;
            $staffer_edit->date_of_employment= $r->date_of_employment;
            $staffer_edit->nationality= $r->nationality;
            $staffer_edit->national_card_number= $r->national_card_number;
            $staffer_edit->passport_number= $r->passport_number;
            $staffer_edit->phone= $r->phone;
            $staffer_edit->state= $r->state;
            $staffer_edit->current_address= $r->current_address;

           

            $staffer_edit->save();

            flash('Teacher(Staffer) Updated Successfully')->success();

            return redirect()->route('showstaffers');


         }

         public function deletestaffer($staffer_id)
         {
            Staffer::destroy($staffer_id);

            flash('Staffer has been deleted')->error();

            return back();
         }

        public function importStaffers(Request $request)
        {
            
          
            if($request->hasFile('import_file')){
                $path = $request->file('import_file')->getRealPath();

                $data = Excel::load($path, function($reader) {})->get();

                if(!empty($data) && $data->count()){

                    foreach ($data->toArray() as $key => $value) {
                        if(!empty($value)){
                            foreach ($value as $v) {        
                                $insert[] = [

                                    
                                    
                                    'registration_code' => $v['registration_code'],
                                    'title' => $v['title'],
                                    'first_name'=>$v['first_name'],
                                    'last_name'=>$v['last_name'],
                                    'gender'=>$v['gender'],
                                    'employment_status'=>$v['employment_status'],
                                    'date_of_employment'=>$v['date_of_employment'],
                                    'nationality'=>$v['nationality'],
                                    'national_card_number'=>$v['national_card_number'],
                                    'passport_number'=>$v['passport_number'],
                                    'phone'=>$v['phone'],
                                    'state'=>$v['state'],
                                    'current_address'=>$v['current_address'],
                                    'group_id' => $v['group_id'],
                                    
                                    
                                    ];
                            }
                        }
                    }

                    
                    if(!empty($insert)){
                        Staffer::insert($insert);
                        flash('Teacher(Staffer) Uploaded Successfully')->success();
                        return redirect()->route('showstaffers');
                    }

                }

            }

            flash('Please Check your file, Something is wrong there')->error();
            return back();
        }

}
