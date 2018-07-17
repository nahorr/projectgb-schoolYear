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
use App\Admin;
use Excel;
use App\StafferRegistration;
use PDF;
use DB;


class SetUpController extends Controller
{
    

    public function showStaffers()
    {
    	

        return view('admin.superadmin.schoolsetup.staffers.showstaffers');
    }

    public function postMakeSuperAdmin(Request $r, Admin $admin)

    {

         $makesuperadmin = Admin::where('id', '=', $admin->id)->first();
         
         $makesuperadmin->is_super_admin= $r->is_super_admin;
            
         $makesuperadmin->save();

         flash('Staffer is now a Super Admin on this portal')->error();

         return back();

     }

    public function postRemoveSuperAdmin(Request $r, Admin $admin)

    {
        
         $removesuperadmin = Admin::where('id', '=', $admin->id)->first();
         
         $removesuperadmin->is_super_admin= $r->is_super_admin;
            
         $removesuperadmin->save();

         flash('Staffer is no longer a Super Admin on this portal')->success();

         return back();

         
     }

     public function registerStaffers()
    {
        
       return view('admin.superadmin.schoolsetup.staffers.registerstaffers');
    }

    
    public function postRegisterStaffer(Request $request)
    {

         $this->validate(request(), [

            'staffer_id' => 'required|unique_with:staffer_registrations,term_id',
            'school_year_id' => 'required',
            'term_id' => 'required',
            'group_id' => 'required',

            ]);


        StafferRegistration::insert([

            'staffer_id'=>$request->staffer_id,
            'school_year_id'=>$request->school_year_id,
            'term_id'=>$request->term_id,
            'group_id'=>$request->group_id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
 
        ]);
        
        flash('Teacher(Staffer) registered Successfully')->success();
        return back();
    }

    public function editRegisterStaffer(StafferRegistration $registration)
    {
        
       return view('admin.superadmin.schoolsetup.staffers.editregisterstaffer', compact('registration'));
    }

    public function postEditRegisterStaffer(Request $request, StafferRegistration $registration)
    {

        $this->validate(request(), [

            'staffer_id' => 'required|unique_with:staffer_registrations,term_id',
            'school_year_id' => 'required',
            'term_id' => 'required',
            'group_id' => 'required',

            ]);


        $edit_registration = StafferRegistration::where('id', '=', $registration->id)->first();


        $edit_registration->staffer_id= $request->staffer_id;
        $edit_registration->school_year_id= $request->school_year_id;
        $edit_registration->term_id= $request->term_id;
        $edit_registration->group_id= $request->group_id;
        
        $edit_registration->save();
        
        flash('Teacher(Staffer) registration edited Successfully')->success();
        return back();
    }


    public function downloadExcelStaffers($type)
    {
        $data = Staffer::get()->toArray();
        return Excel::create('staffers_download', function($excel) use ($data) {
            $excel->sheet('staffers', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }

    public function downloadExcelGroups($type)
    {
        $data = Group::get()->toArray();
        return Excel::create('groups_download', function($excel) use ($data) {
            $excel->sheet('groups', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }
    
    public function bulkRegisterStaffers(Request $request)
        {
            
            //get current date
            $today = Carbon::today();
            
            //get current school year
            $current_school_year = School_year::where('start_date', '<=', $today)->where('end_date', '>=', $today)->first();

            $current_term = Term::where([['start_date', '<=', $today], ['end_date', '>=', $today]])->first();

            if($request->hasFile('import_file')){
                $path = $request->file('import_file')->getRealPath();

                $data = Excel::load($path, function($reader) {})->get();

                if(!empty($data) && $data->count()){

                    foreach ($data->toArray() as $key => $value) {
                        if(!empty($value)){
                            foreach ($value as $v) {        
                                $insert[] = [

                                    
                                    'staffer_id' => Staffer::where('registration_code', $v['registration_code'])->firstOrFail()->id,
                                    'school_year_id' => $current_school_year->id,
                                    'term_id' => $current_term->id,
                                    'group_id'=>Group::where('name', $v['group_name'])->firstOrFail()->id,
                                    'created_at' => date('Y-m-d H:i:s'),
                                    'updated_at' => date('Y-m-d H:i:s'),
                                    
                                    ];
                            }
                        }
                    }

                    
                    if(!empty($insert)){
                        StafferRegistration::insert($insert);
                        flash('Teacher(Staffer) Bulk Registered Successfully')->success();
                        return back();
                    }

                }

            }

            flash('Please Check your file, Something is wrong there')->error();
            return back();
        }
    
    

     public function printRegisterStaffersPdf()
    {
        $pdf = PDF::loadView('admin.superadmin.schoolsetup.staffers.printregisterstafferspdf');

        return $pdf->inline('staffers.pdf');
    }

    public function printRegisterGroupsPdf()
    {
        $pdf = PDF::loadView('admin.superadmin.schoolsetup.staffers.printregistergroupspdf');

        return $pdf->inline('groups.pdf');
    }
    
    public function postUnRegisterStaffer($registration)
    {
        StafferRegistration::destroy($registration);

        flash('Staffer Registration has been deleted')->error();

        return back();
    }


    public function stafferDetails(Staffer $staffer)
    {
        

        return view('admin.superadmin.schoolsetup.staffers.stafferdetails', compact('staffer'));
    }


    public function addStaffer()
    {

    	//$staffers_groups= Group::join('staffers', 'groups.id', '=', 'staffers.group_id')->get();



    	$staffers_count = Staffer::count();

    	$groups = Group::pluck('name', 'id');

        //dd($groups);

        
        //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        

      

        return view('admin.superadmin.schoolsetup.staffers.addstaffer', compact('staffers_groups','today',
        	'schoolyear', 'staffers_count', 'groups'));
     }

    public function postStaffer(Request $r) 
    {
                       

        $this->validate(request(), [

            //'group_id' => 'required',
            'staffer_number' => 'required|unique:staffers',
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

            //'group_id'=>$r->group_id,
            'staffer_number'=>$r->staffer_number,
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
        //get staffer with this staffer id
        $staffer = Staffer::find($staffer_id);
      

        return view('admin.superadmin.schoolsetup.staffers.editstaffer', compact('staffer'));

        
    }

    public function postStafferUpdate(Request $r, $staffer_id)

        {
        
            $staffer = Staffer::find($staffer_id);

                   
            $this->validate(request(), [
                
            //'group_id' => 'required',
            'staffer_number' => 'required',
            'registration_code' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
                
            ]);


                                
            $staffer_edit = Staffer::where('id', '=', $staffer->id)->first();


            
            //$staffer_edit->group_id= $r->group_id;
            $staffer_edit->staffer_number= $r->staffer_number;
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

                                    
                                    'staffer_number' => $v['staffer_number'],
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
