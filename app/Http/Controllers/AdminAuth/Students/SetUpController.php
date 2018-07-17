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
use PDF;


class SetUpController extends Controller
{
    public function showGroups()
    {   
        
        return view('admin.superadmin.schoolsetup.students.showgroups');
    }

    public function showStudents(Group $group)
    {

        return view('admin.superadmin.schoolsetup.students.showregisteredstudents', compact('group'));
    }

     
    public function postRegisterStudent(Request $request)
    {

         $this->validate(request(), [

            'student_id' => 'required|unique_with:student_registrations,term_id',
            'school_year_id' => 'required',
            'term_id' => 'required',
            'group_id' => 'required',

            ]);


        StudentRegistration::insert([

            'student_id'=>$request->student_id,
            'registration_code'=>Student::where('id',$request->student_id)->first()->registration_code,
            'school_year_id'=>$request->school_year_id,
            'term_id'=>$request->term_id,
            'group_id'=>$request->group_id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
    
        ]);
        
        flash('Student registered Successfully')->success();
        return back();
    }

    public function postDeleteRegisterStudent($registration)
    {
        StudentRegistration::destroy($registration);

        flash('Student Registration has been deleted')->error();

        return back();
    }

    public function printRegisterStudentsPdf()
    {
        $pdf = PDF::loadView('admin.superadmin.schoolsetup.students.printregisterstudentspdf');

        return $pdf->inline('students.pdf');
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



    public function editStudent(Student $student)
    {
      
        return view('admin.superadmin.schoolsetup.students.editstudent', compact('student'));
    }

    public function postStudentUpdate(Request $r, Student $student)

        {
             $this->validate(request(), [

                'student_number' => 'required',
                'registration_code' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'gender' => 'required',
                'dob' => 'required',
                'email' => 'required',
                
                ]);


                                
            $student_edit = Student::where('id', '=', $student->id)->first();


            
            $student_edit->student_number= $r->student_number;
            $student_edit->registration_code= $r->registration_code;
            $student_edit->first_name= $r->first_name;
            $student_edit->last_name= $r->last_name;
            $student_edit->gender= $r->gender;
            $student_edit->dob= $r->dob;
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

            return redirect()->route('viewallstudents');


         }

         public function deleteStudent($student)
         {
            Student::destroy($student);

            flash('Student has been deleted')->error();

            return back();
         }

        public function downloadExcelStudents($type)
        {
            $data = Student::get()->toArray();
            return Excel::create('students_download', function($excel) use ($data) {
                $excel->sheet('students', function($sheet) use ($data)
                {
                    $sheet->fromArray($data);
                });
            })->download($type);
        }

        
        public function importRegisterStudents(Request $request, Group $group)
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

                                    'registration_code' => $v['registration_code'],
                                    'student_id' => Student::where('registration_code', $v['registration_code'])->firstOrFail()->id,
                                    'school_year_id' => $current_school_year->id,                           
                                    'group_id' => $group->id,
                                    'term_id' => $current_term->id,
                                    'created_at' => date('Y-m-d H:i:s'),
                                    'updated_at' => date('Y-m-d H:i:s'),
                                    
                                    ];
                            }
                        }
                    }

                    
                    if(!empty($insert)){
                        StudentRegistration::insert($insert);
                        return back()->with('success','Insert Record successfully.');
                    }

                }

            }

            return back()->with('error','Please Check your file, Something is wrong there.');
        }

        public function importStudents(Request $request)
        {
                       

            if($request->hasFile('import_file')){
                $path = $request->file('import_file')->getRealPath();

                $data = Excel::load($path, function($reader) {})->get();

                if(!empty($data) && $data->count()){

                    foreach ($data->toArray() as $key => $value) {
                        if(!empty($value)){
                            foreach ($value as $v) {        
                                $insert[] = [

                                    
                                    'student_number' => $v['student_number'],
                                    'registration_code' => $v['registration_code'], 
                                    'first_name'=>$v['first_name'],
                                    'last_name'=>$v['last_name'],
                                    'gender'=>$v['gender'],
                                    'dob'=>$v['dob'],
                                    'date_enrolled'=>$v['date_enrolled'],
                                    'date_graduated'=>$v['date_graduated'],
                                    'date_unenrolled'=>$v['date_unenrolled'],
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
                        flash('Student(s) Uploaded Successfully')->success();
                        return redirect()->route('viewallstudents');
                    }

                }

            }

            return back()->with('error','Please Check your file, Something is wrong there.');
        }

    
}
