<?php

namespace App\Http\Controllers\Messages\MessageToTeacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Message;
use App\Student;
use App\Staffer;

class CrudeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showMessages()
    {
    	return view('messages.messagetoteacher');
    }

    public function sendMessageToTeacher($teacher_id)
    {
    	
    	$teacher = Staffer::find($teacher_id);

    	return view('messages.sendmessagetoteacher', compact('teacher'));
    }

    public function postSendMessageToTeacher(Request $r, $teacher_id)
    {
        $teacher = Staffer::find($teacher_id);

        $this->validate(request(), [

            'user_id' => 'required',
            'staffer_id' => 'required',
            'subject' => 'required',
            'sent_student' => 'required',
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
            'sent_student'=>$r->sent_student,
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
}
