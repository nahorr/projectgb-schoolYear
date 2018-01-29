<?php

namespace App\Http\Controllers\AdminAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Event;

use App\Http\Requests;
use App\School_year;

use App\Term;
use Carbon\Carbon;
use App\Course;
use Auth;
use Image;
use App\Student;
use App\User;


use App\Grade;
use App\Group;
use App\Comment;
use \Crypt;

class CommentCrudController extends Controller
{
    public function addComment($student_id, $term_id)
    {

    	
    	//get current date
        $today = Carbon::today();

        $student = Student::find(Crypt::decrypt($student_id));

        $term =Term::find(Crypt::decrypt($term_id));

        $group = Group::where('id', '=', $student->group_id)->first();

        $all_user = User::get();

        

    	return view('/admin.addComment', compact('today','student', 'term','group', 'all_user'));
    }

    public function postComment(Request $r) 
    {

               

    	$this->validate(request(), [

    		'student_id' => 'required|unique_with:comments,term_id',
            'term_id' => 'required',
            'comment_teacher'=> 'required|max:225',
            
    		]);


    	Comment::insert([

    		'student_id'=>$r->student_id,
    		'term_id'=>$r->term_id,
    		'comment_teacher'=>$r->comment_teacher,
    		'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
    		   		
    		
    	]);

       

    	return redirect()->route('adminhome');
    }

    public function editComment($student_id, $term_id)
    {

         //get current date
        $today = Carbon::today();

        $student = Student::find(Crypt::decrypt($student_id));

        $term =Term::find(Crypt::decrypt($term_id));

        $group = Group::where('id', '=', $student->group_id)->first();

        $all_user = User::get();

        $student_comment = Comment::where('student_id', '=', $student->id)
                                 ->where('term_id', '=', $term->id)
                                 ->first();
        

        return view('/admin.editComment', compact('today','student', 'term','group', 'student_comment', 'all_user'));
    }


    public function postCommentUpdate(Request $r, $student_id, $term_id)

    {
         $this->validate(request(), [

            
            'comment_teacher'=> 'required|max:225',
            
            ]);


         $student = Student::find(Crypt::decrypt($student_id));

        $term =Term::find(Crypt::decrypt($term_id));

         $student_comment = Comment::where('student_id', '=', $student->id)
                                 ->where('term_id', '=', $term->id)
                                 ->first();


                 

            $student_comment->comment_teacher= $r->comment_teacher;
            
                       
            

            //$student_grades->total = $r->total;
            

            $student_comment->save();

            return redirect()->route('adminhome');

     }

     public function deleteComment($comment_id)
         {
            Comment::destroy(Crypt::decrypt($comment_id));

            flash('Comment has been deleted')->error();

            return back();
         }
}
