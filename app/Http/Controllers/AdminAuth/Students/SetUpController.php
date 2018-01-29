<?php

namespace App\Http\Controllers\AdminAuth\Students;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\StudentRegistration;
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
    public function showGroups()
    {   
        $today = Carbon::today();
        
        $current_school_year = School_year::where('start_date', '<=', $today)->where('end_date', '>=', $today)->first();

        $current_students_registrations = StudentRegistration::where('school_year_id', '=', $current_school_year->id)->get();
        

        return view('admin.superadmin.schoolsetup.students.showgroups', compact( 'current_students_registrations'));
    }

    public function showStudents($group_id)
    {

        $group = Group::find($group_id);

        $today = Carbon::today();
        
        $current_school_year = School_year::where('start_date', '<=', $today)->where('end_date', '>=', $today)->first();

        $registered_students = StudentRegistration::where('group_id', '=', $group->id)->where('school_year_id', '=', $current_school_year->id)->get();

        return view('admin.superadmin.schoolsetup.students.showregisteredstudents', compact('group', 'registered_students'));
    }

     public function viewAllStudents()
    {

        return view('admin.superadmin.schoolsetup.students.viewallstudents');
    }

    public function addNewStudents()
    {

        return view('admin.superadmin.schoolsetup.students.addnewstudents');
    }

    public function postAddNewStudents(Request $r)
    {
        
        $this->validate(request(), [

            'student_number' => 'required|unique:students',
            'registration_code' => 'required|unique:students',
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'email' => 'required',
            ]);

        Student::insert([

            'student_number'=>$r->student_number,
            'registration_code'=>$r->registration_code,
            'first_name'=>$r->first_name,
            'last_name'=>$r->last_name,
            'gender'=>$r->gender,
            'dob'=>$r->dob,
            'date_enrolled'=>$r->date_enrolled,
            'date_graduated'=>$r->date_graduated,
            'date_unenrolled'=>$r->date_unenrolled,
            'nationality'=>$r->nationality,
            'national_card_number'=>$r->national_card_number,
            'passport_number'=>$r->passport_number,
            'phone'=>$r->phone,
            'email'=>$r->email,
            'state'=>$r->state,
            'current_address'=>$r->current_address,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
 
        ]);

       
        flash('Student Added Successfully')->success();

        return redirect()->route('viewallstudents');
    }

    public function addStudent($id)
    {

    	//get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        $group = Group::find($id);

    
        //get logged in user
        $teacher_logged_in = Auth::guard('web_admin')->user();

        
        $reg_code = $teacher_logged_in->registration_code;

        $teacher = Staffer::where('registration_code', '=', $reg_code)->first();

      

        return view('/admin.superadmin.schoolsetup.students.addstudent', compact('today', 'teacher', 'teacher_logged_in', 'schoolyear', 'term', 'group'));
    }

    public function postStudent(Request $r, $group_id) 
    {
        $group = Group::find($group_id);
               

        $this->validate(request(), [

            'group_id' => 'required',
            'registration_code' => 'required|unique:students',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
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


        Student::insert([

            'group_id'=>$r->group_id,
            'registration_code'=>$r->registration_code,
            'first_name'=>$r->first_name,
            'last_name'=>$r->last_name,
            'gender'=>$r->gender,
            'dob'=>$r->dob,
            'status'=>$r->status,
            'date_enrolled'=>$r->date_enrolled,
            'nationality'=>$r->nationality,
            'national_card_number'=>$r->national_card_number,
            'passport_number'=>$r->passport_number,
            'phone'=>$r->phone,
            'email'=>$r->email,
            'state'=>$r->state,
            'current_address'=>$r->current_address,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
 
        ]);

       
        flash('Student Added Successfully')->success();

        return redirect()->route('showstudents', ['group_id' => $group->id]);
    }

    public function editStudent($group_id, $student_id)
    {

        $group = Group::find($group_id);

        $student_with_id = Student::find($student_id);
        //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        $students = Student::where('group_id', '=', $group->id)->get();
        $students_count = Student::where('group_id', '=', $group->id)->count();

    
        //get logged in user
        $teacher_logged_in = Auth::guard('web_admin')->user();

        
        $reg_code = $teacher_logged_in->registration_code;

        $teacher = Staffer::where('registration_code', '=', $reg_code)->first();

      

        return view('/admin.superadmin.schoolsetup.students.editstudent', compact('today', 'teacher', 'teacher_logged_in', 'schoolyear', 'students', 'group', 'students_count', 'student_with_id'));
    }

    public function postStudentUpdate(Request $r, $group_id, $student_id)

        {
        
            $group = Group::find($group_id);

            $student_with_id = Student::find($student_id);
            //get current date
            $today = Carbon::today();

            $schoolyear = School_year::first();

            $students = Student::where('group_id', '=', $group->id)->get();
            $students_count = Student::where('group_id', '=', $group->id)->count();

        
            //get logged in user
            $teacher_logged_in = Auth::guard('web_admin')->user();

            
            $reg_code = $teacher_logged_in->registration_code;

            $teacher = Staffer::where('registration_code', '=', $reg_code)->first();

             $this->validate(request(), [

                
            'group_id' => 'required',
            'registration_code' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
                
                ]);


                                
            $student_edit = Student::where('id', '=', $student_with_id->id)->first();


            
            $student_edit->group_id= $r->group_id;
            $student_edit->registration_code= $r->registration_code;
            $student_edit->first_name= $r->first_name;
            $student_edit->last_name= $r->last_name;
            $student_edit->gender= $r->gender;
            $student_edit->dob= $r->dob;
            $student_edit->status= $r->status;
            $student_edit->date_enrolled= $r->date_enrolled;
            $student_edit->nationality= $r->nationality;
            $student_edit->national_card_number= $r->national_card_number;
            $student_edit->passport_number= $r->passport_number;
            $student_edit->phone= $r->phone;
            $student_edit->email= $r->email;
            $student_edit->state= $r->state;
            $student_edit->current_address= $r->current_address;

           

            $student_edit->save();

            flash('Student Updated Successfully')->success();

            return redirect()->route('showstudents', ['group_id' => $group->id]);


         }

         public function deletestudent($student_id)
         {
            Student::destroy($student_id);

            flash('Student has been deleted')->error();

            return back();
         }


         public function importStudents(Request $request, $group_id)
        {
           // Get current data from items table
            $students = Student::pluck('registration_code')->toArray();

            $group = Group::find($group_id);
            

            if($request->hasFile('import_file')){
                $path = $request->file('import_file')->getRealPath();

                $data = Excel::load($path, function($reader) {})->get();

                if(!empty($data) && $data->count()){

                    foreach ($data->toArray() as $key => $value) {
                        if(!empty($value)){
                            foreach ($value as $v) {        
                                $insert[] = [

                                    
                                    'group_id' => $group->id,
                                    'registration_code' => $v['registration_code'], 
                                    'first_name'=>$v['first_name'],
                                    'last_name'=>$v['last_name'],
                                    'gender'=>$v['gender'],
                                    'dob'=>$v['dob'],
                                    'status'=>$v['status'],
                                    'date_enrolled'=>$v['date_enrolled'],
                                    'nationality'=>$v['nationality'],
                                    'national_card_number'=>$v['national_card_number'],
                                    'passport_number'=>$v['passport_number'],
                                    'phone'=>$v['phone'],
                                    'email'=>$v['email'],
                                    'state'=>$v['state'],
                                    'current_address'=>$v['current_address'],
                                    'created_at' => date('Y-m-d H:i:s'),
                                    'updated_at' => date('Y-m-d H:i:s'),
                                    
                                    ];
                            }
                        }
                    }

                    
                    if(!empty($insert)){
                        Student::insert($insert);
                        return back()->with('success','Insert Record successfully.');
                    }

                }

            }

            return back()->with('error','Please Check your file, Something is wrong there.');
        }

    
}
