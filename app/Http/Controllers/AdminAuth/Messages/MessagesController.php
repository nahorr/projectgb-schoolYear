<?php

namespace App\Http\Controllers\AdminAuth\Messages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ContactUS;
use Carbon\Carbon;
use App\School;
use DataTables;

class MessagesController extends Controller
{
    
	public function contactUs()
     {
		//get School info
        $school = School::first();

        //get current date
        $today = Carbon::today();

        $contact_us = ContactUs::get();


        return view('/admin.superadmin.schoolsetup.messages.contactus', compact('school','today', 'contact_us'));
    }

    public function getContactUsData()
    {

        $contactus = ContactUS::select(['id', 'first_name', 'last_name', 'phone', 'email', 'message', 'created_at']);

        return Datatables::of($contactus)
				->addColumn('action', function ($contact) {
                return '<a href="/schoolsetup/messages/messagedetails/'.$contact->id.'    " class="btn btn-xs btn-primary"><i class="glyphicon         glyphicon-eye-open"></i>View</a>'.'&nbsp;'.
                    '<a href="/schoolsetup/messages/postmessagedelete/'.$contact->id.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i>Delete</a>';
            })->make(true);
    }

    public function messageDetails($message_id)
     {
        $message = ContactUS::find($message_id);
        //get School info
        $school = School::first();

        //get current date
        $today = Carbon::today();

        $contact_us = ContactUs::get();


        return view('/admin.superadmin.schoolsetup.messages.messagedetails', compact('message', 'school','today', 'contact_us'));
    }

    public function deleteMessage($message_id)
         {
            ContactUs::destroy($message_id);

            flash('Message has been deleted')->error();

            return back();
         }
}
