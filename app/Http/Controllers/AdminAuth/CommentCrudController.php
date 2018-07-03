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
    public function addComment($student_id, $schoolyear_id, $term_id)
    {

        $student = Student::find(Crypt::decrypt($student_id));

        $schoolyear = School_year::find($schoolyear_id);

        $term =Term::find(Crypt::decrypt($term_id));


    	return view('admin.addComment', compact('student', 'schoolyear', 'term'));
    }

    public function postComment(Request $r , $schoolyear_id, $term_id) 
    {           
        $schoolyear = School_year::find($schoolyear_id);

        $term =Term::find($term_id);

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

       

    	return redirect()->route('adminhomeSchoolyearTerm', [ 'schoolyear_id' => $schoolyear->id, 'term_id' => $term->id]);;
    }

    public function editComment($comment_id, $student_id, $schoolyear_id, $term_id)
    {

        $comment = Comment::find(Crypt::decrypt($comment_id));
        $student = Student::find($student_id);
        $schoolyear = School_year::find($schoolyear_id);
        $term =Term::find($term_id);
        
        return view('admin.editComment', compact('comment', 'student'));
    }


    public function postCommentUpdate(Request $r, $comment_id)

    {
         $this->validate(request(), [

            
            'comment_teacher'=> 'required|max:225',
            
            ]);


        $student_comment =Comment::find(Crypt::decrypt($comment_id));

  
        $student_comment->comment_teacher= $r->comment_teacher;
            
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
