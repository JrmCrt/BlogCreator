<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use App\User;
use App\Category;
use App\Message;
use Input;
use App\Blog;
use Auth;
use App\Notification;

class MessageController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function send($id)
    {	
        $recipient = User::find($id);
        return view('messagesend' , ['recipient' => $recipient]);
    }

    public function doSend($id)
    {   
        $recipient = User::find($id);
        $message = new Message;
        $message->id_sender = Auth::id();
        $message->id_recipient = $recipient->id;
        $message->text = Input::get('content');
        $message->save();

        $notification = new Notification;
        $notification->id_user = $id;
        $notification->url = '/message/list';
        $notification->icon = 'envelope';
        $notification->content = 'New message from ' . Auth::user()->name;
        $notification->save();

        return view('messagesend' , ['recipient' => $recipient, 'info' => 'Message sent']);
    }

    public function getMessages()
    {   
        $messages = Message::where('id_recipient', Auth::id() )->where('recipient_deleted', null)->orderBy('created_at', 'desc')->get();
        if(!is_null($messages))
            foreach($messages as $message){
                $m = Message::find($message->id);
                $m->seen = 1;
                $m->save();
            }
        return view('messages', ['messages' => $messages]);
    }

    public function remove($id)
    {   
        $message = Message::find($id);
        $message->recipient_deleted = 1;
        $message->save();
        return redirect()->back()->with('info', 'Message removed !');
    }

    public function removeSent($id)
    {   
        $message = Message::find($id);
        $message->sender_deleted = 1;
        $message->save();
        return redirect()->back()->with('info', 'Message removed !');
    }

    public function getMessagesSent()
    {   
        $messages = Message::where('id_sender', Auth::id() )->where('sender_deleted', null)->orderBy('created_at', 'desc')->get();
        return view('messagessent', ['messages' => $messages]);
    }
    
}
