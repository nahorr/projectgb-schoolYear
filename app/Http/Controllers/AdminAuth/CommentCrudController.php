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
    public function addComment($student, School_year $schoolyear, Term $term)
    {

        $student = Student::find(Crypt::decrypt($student));

        //$schoolyear = School_year::find($schoolyear);

        //$term =Term::find(Crypt::decrypt($term));


    	return view('admin.addComment', compact('student', 'schoolyear', 'term'));
    }

    public function postComment(Request $r , School_year $schoolyear, Term $term) 
    {           
        //$schoolyear = School_year::find($schoolyear_id);

        //$term =Term::find($term_id);

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

    public function editComment($comment, $student, School_year $schoolyear, Term $term)
    {

        $comment = Comment::find(Crypt::decrypt($comment));
        $student = Student::find($student);
        //$schoolyear = School_year::find($schoolyear_id);
        //$term =Term::find($term_id);
        
        return view('admin.editComment', compact('comment', 'student', 'schoolyear', 'term'));
    }


    public function postCommentUpdate(Request $r, $comment, School_year $schoolyear, Term $term)

    {
         $this->validate(request(), [

            
            'comment_teacher'=> 'required|max:225',
            
            ]);


        $student_comment =Comment::find(Crypt::decrypt($comment));

  
        $student_comment->comment_teacher= $r->comment_teacher;
            
        $student_comment->save();

        return redirect()->route('adminhomeSchoolyearTerm', [ 'schoolyear_id' => $schoolyear->id, 'term_id' => $term->id]);

     }

     public function deleteComment($comment)
         {
            Comment::destroy(Crypt::decrypt($comment));

            flash('Comment has been deleted')->error();

            return back();
         }
}
