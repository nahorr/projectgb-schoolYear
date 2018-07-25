<?php

namespace App\Http\Controllers\AdminAuth\Students\Messages;

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
use App\Comment;
use App\HealthRecord;
use App\Attendance;
use App\AttendanceCode;
use \Crypt;
use App\DailyActivity;
use App\DisciplinaryRecord;
use File;
use App\Message;

use Notification;
use App\Notifications\DisciplinaryRecordPosted;

class CrudeController extends Controller
{
    public function allStudents(School_year $schoolyear, Term $term)
    {

    	return view('admin.students.messages.allstudents', compact('schoolyear', 'term'));
    	
    }


    public function viewStudentMessage(School_year $schoolyear, Term $term, $message)
    {
    	$message = Message::find($message);
      

    	return view('admin.students.messages.viewstudentmessage', compact('schoolyear', 'term', 'message'));
    	
    }

    public function deleteMessageForStaffer(Request $r, School_year $schoolyear, Term $term, $message)
     {
        $message = Message::find($message);

        $message_to_delete = Message::where('id', '=', $message->id)->first();
     
        $message_to_delete->staffer_delete= $r->staffer_delete;
            
        $message_to_delete->save();


        flash('Message has been deleted')->error();

        return redirect()->route('messages_allstudents', [$schoolyear->id, $term->id]);
     }

    public function sendMessageToStudent($user_id)
    {
        $user = User::find($user_id);

        //get current date
        $today = Carbon::today();

        //get teacher's section and group

        $reg_code = Auth::guard('web_admin')->user()->registration_code;

        $teacher = Staffer::where('registration_code', '=', $reg_code)->first();


        //get students in group_section
        $students_in_group = Student::where('group_id', '=', $teacher->group_id)
        ->get();

        $all_user = User::get();

             
        
        $count = 0;
        foreach ($students_in_group as $students) {
            $count = $count+1;
        }

        $group_teacher = Group::where('id', '=', $teacher->group_id)->first();
        

        //get terms
        $terms = Term::get();


        //get school school
        $schoolyear = School_year::first();

       

        return view('admin.students.messages.sendmessagetostudent', compact('today', 'count', 'group_teacher', 'current_term', 
            'schoolyear', 'students_in_group', 'all_user', 'st_user',  'terms', 'student_activities', 'user'));
        
    }

          public function postSendMessageToStudent(Request $r, $user_id)
            {
                $user = User::find($user_id);

                $this->validate(request(), [

                    'user_id' => 'required',
                    'staffer_id' => 'required',
                    'subject' => 'required',
                    'sent_staffer' => 'required',
                    'body' => 'required',
                    'message_file' => 'mimes:pdf,doc,jpeg,bmp,png|max:10000',
                    
                   ]);

                if($r->hasFile('message_file')){
                    $message_file = $r->file('message_file');
                    $filename = time() . '.' . $message_file->getClientOriginalExtension();
                    $destinationPath = public_path().'/messages/' ;
                    $message_file->move($destinationPath,$filename);
                    
                } else {
                    $filename = $r->message_file;
                }

                Message::insert([

                    'user_id'=>$r->user_id,
                    'staffer_id'=>$r->staffer_id,
                    'sent_staffer'=>$r->sent_staffer,
                    'subject'=>$r->subject,
                    'body'=>$r->body,
                    'message_file'=>$filename,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                               
                ]);

           
                //$student->notify(new DisciplinaryRecordPosted("A new Disciplinary Record has been posted."));
               
                flash('Messages Sent Successfully')->success();

                return back();
            }

    public function replyStudentMessage(School_year $schoolyear, Term $term, $message)
    {
        $message = Message::find($message);

        $message_replied_with_same_id = Message::where('message_replied', '=', $message->id)->get();

       

        return view('admin.students.messages.replystudentmessage', compact('schoolyear', 'term', 'message', 'message_replied_with_same_id'));
        
    }

     public function postReplyStudentMessage(Request $r, $message)
    {
        $message = Message::find($message);

        $this->validate(request(), [

            'user_id' => 'required',
            'staffer_id' => 'required',
            'message_replied' => 'required',
            'subject' => 'required',
            'sent_to_student' => 'required',
            'body' => 'required',
            'message_file' => 'mimes:pdf,doc,jpeg,bmp,png|max:10000',
            
           ]);

        if($r->hasFile('message_file')){
            $message_file = $r->file('message_file');
            $filename = time() . '.' . $message_file->getClientOriginalExtension();
            $destinationPath = public_path().'/messages/' ;
            $message_file->move($destinationPath,$filename);
            
        } else {
            $filename = $r->message_file;
        }

        Message::insert([

            'user_id'=>$r->user_id,
            'staffer_id'=>$r->staffer_id,
            'message_replied'=>$r->message_replied,
            'sent_to_student'=>$r->sent_to_student,
            'subject'=>$r->subject,
            'body'=>$r->body,
            'message_file'=>$filename,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
                       
        ]);


       
        flash('Messages Sent Successfully')->success();

        return back();
    }

}
