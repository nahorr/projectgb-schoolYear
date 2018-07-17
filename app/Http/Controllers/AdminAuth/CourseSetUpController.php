<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\School_year;
use Carbon\Carbon;
use App\Student;
use App\Staffer;
use App\Course;
use App\Group;
use App\Event;
use App\Term;
use App\User;
use Excel;
use Image;
use Auth;
use DB;



class CourseSetUpController extends Controller
{
    public function schoolyears()
    {
            
        return view('admin.superadmin.schoolsetup.courses.schoolyears');
    }

    public function showCoursesTerms($schoolyear_id)
    {
    	//find school year
        $schoolyear = School_year::find($schoolyear_id);

        //get term associated with the school year found above
        $terms_schoolyear = Term::where('school_year_id', '=', $schoolyear->id)->get();

    
        return view('admin.superadmin.schoolsetup.showcoursesterms', compact('schoolyear', 'terms_schoolyear'));
    }

    public function showCoursesGroups($schoolyear_id, $term_id)
    {

       	$term = Term::find($term_id);

        $schoolyear = School_year::find($schoolyear_id);

        return view('admin.superadmin.schoolsetup.showcoursesgroups', compact('schoolyear', 'term', 'courses_term'));
    }

    public function bulkUploadCourses(Request $request, $schoolyear, $term)
        {
           
            $schoolyear = School_year::find($schoolyear);

            $term = Term::find($term);

            if($request->hasFile('import_file')){
                $path = $request->file('import_file')->getRealPath();

                $data = Excel::load($path, function($reader) {})->get();

                if(!empty($data) && $data->count()){

                    foreach ($data->toArray() as $key => $value) {
                        if(!empty($value)){
                            foreach ($value as $v) {        
                                $insert[] = [

                                    'course_code' => $v['course_code'],
                                    'name' => $v['course_name'],  
                                    'term_id' => $term->id,
                                    'group_id'=>Group::where('name', $v['group_name'])->first()->id,
                                    //'staffer_id' => Staffer::where('registration_code', $v['staffer_assigned_to'])->first()->id,
                                    'created_at' => date('Y-m-d H:i:s'),
                                    'updated_at' => date('Y-m-d H:i:s'),
                                    
                                    ];
                            }
                        }
                    }

                    
                    if(!empty($insert)){
                        Course::insert($insert);
                        flash('Courses Bulk Uploaded Successfully')->success();
                        return back();
                    }

                }

            }

            flash('Please Check your file, Something is wrong there')->error();
            return back();
        }
    

    public function showCourses($schoolyear_id, $term_id, $group_id)
    {

        $schoolyear = School_year::find($schoolyear_id);

        $term = Term::find($term_id);

        $group = Group::find($group_id);
        
        $courses = Course::where('group_id', '=', $group->id)->where('term_id', '=', $term->id)->get();
    
        return view('admin.superadmin.schoolsetup.showcourses', compact('schoolyear', 'term', 'group',  'courses'));
    }

    public function addCourse($schoolyear_id, $term_id, $group_id)
    {

    	$schoolyear = School_year::find($schoolyear_id);

        $term = Term::find($term_id);

        $group = Group::find($group_id);

        $courses = Course::where('group_id', '=', $group->id)->where('term_id', '=', $term->id)->get();

        return view('admin.superadmin.schoolsetup.addcourse', compact('today', 'teacher', 'teacher_logged_in', 'schoolyear','group', 'term', 'courses'));
    }

    public function postCourse(Request $r, $schoolyear_id, $term_id, $group_id) 
    {
        $schoolyear = School_year::find($schoolyear_id);
        $term = Term::find($term_id);
        $group = Group::find($group_id);
        
        $this->validate(request(), [

            'term_id' => 'required',
            'group_id' => 'required',
            'course_code' => 'required|unique:courses',
            'name' => 'required',
       
            ]);

        Course::insert([

            'term_id'=>$r->term_id,
    		'group_id'=>$r->group_id,
            'course_code'=>$r->course_code,
            'name'=>$r->name,
            'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
       
        ]);

               
        flash('Course Added Successfully')->success();

        
        return redirect()->route('showcourses', [ 'school_year_id' => $schoolyear->id, 'term_id' => $term->id, 'group_id' => $group->id]);
    }

    public function editCourse($schoolyear_id, $course_id, $term_id, $group_id)
    {
        $schoolyear = School_year::find($schoolyear_id);
        
        $course = Course::find($course_id);

        $term = Term::find($term_id);

        $group = Group::find($group_id);
        
                
        return view('admin.superadmin.schoolsetup.editcourse', compact('schoolyear', 'course', 'term', 'group'));
    }



    public function postCourseUpdate(Request $r, $id, $group_id, $term_id)

    {
        $this->validate(request(), [

            'term_id' => 'required',
            'group_id' => 'required',
            'course_code' => 'required',
            'name' => 'required',
                
            ]);

        $course = Course::find($id);
        $group = Group::find($group_id);
        $term = Term::find($term_id);
        
                
        $course_edit = Course::where('id', '=', $course->id)->first();
        
        $course_edit->course_code= $r->course_code;

        $course_edit->name= $r->name;
        
          
        $course_edit->save();

        flash('Course Updated Successfully')->success();

        return redirect()->route('showcourses', ['group_id' => $group->id, 'term_id' => $term->id ]);


     }

     public function deleteCourse($id)
     {
        Course::destroy($id);

        flash('Course has been deleted')->error();

        return back();
     }


    public function importCourses(Request $request, $group_id, $term_id)
    {
       
        $group = Group::find($group_id);
        $term = Term::find($term_id);

        if($request->hasFile('import_file')){
            $path = $request->file('import_file')->getRealPath();

            $data = Excel::load($path, function($reader) {})->get();

            if(!empty($data) && $data->count()){

                foreach ($data->toArray() as $key => $value) {
                    if(!empty($value)){
                        foreach ($value as $v) {        
                            $insert[] = [

                                'term_id' => $term->id,
                                'group_id' => $group->id,
                                'course_code' => $v['course_code'], 
                                'name' => $v['name'],
                                'staffer_id' => $v['staffer_id'],
                                ];
                        }
                    }
                }

                
                if(!empty($insert)){
                    Course::insert($insert);
                    return back()->with('success','Insert Record successfully.');
                }

            }

        }

        return back()->with('error','Please Check your file, Something is wrong there.');
    }



    
}
