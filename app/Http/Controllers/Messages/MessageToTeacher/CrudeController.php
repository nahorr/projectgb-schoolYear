<?php

namespace App\Http\Controllers\Messages\MessageToTeacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Message;
use App\Student;
use App\Staffer;
use App\School_year;
use Auth;

class CrudeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showMessages(School_year $schoolyear)
    {
    	$receivedMessages = Message::where('user_id', Auth::user()->id)->where('sent_to_student', Auth::user()->id)->get();

        return view('messages.messagetoteacher', compact('schoolyear', 'receivedMessages'));
    }

    public function sendMessageToTeacher(School_year $schoolyear, $teacher)
    {
    	
    	$teacher = Staffer::find($teacher);

    	return view('messages.sendmessagetoteacher', compact( 'schoolyear', 'teacher'));
    }

    public function postSendMessageToTeacher(Request $r, School_year $schoolyear, $teacher)
    {
        $teacher = Staffer::find($teacher);

        $this->validate(request(), [

            'user_id' => 'required',
            'staffer_id' => 'required',
            'subject' => 'required',
            'sent_to_staffer' => 'required',
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
            'sent_to_staffer'=>$r->sent_to_staffer,
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

    public function viewSentMessages(School_year $schoolyear)
    {
        
        $sentMessages = Message::where('user_id', Auth::user()->id)->get();

        return view('messages.viewsentmessages', compact( 'schoolyear', 'sentMessages'));
    }

    public function deleteMessageForStudent(Request $r, Message $message)
    {
        
        $deleteMessage = Message::where('id', $message->id)->first();

        $deleteMessage->user_delete = $r->user_delete;

        $deleteMessage->save();

        flash('Message deleted')->error();
        
        return back();
    }
}
