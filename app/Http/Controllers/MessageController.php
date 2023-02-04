<?php

namespace App\Http\Controllers;

use App\Events\Messages;

use Illuminate\Http\Request;
use App\Models\message;
 
class MessageController extends Controller
{
    //
    public function getchat () {

        $messages=message::all();

        return view('chat',['messages'=>$messages]);
    }
    public function getmessages ($id) {
        $messages=message::where('from','=',$id)->where('to','=',auth()->user()->id)->orWhere('from','=',auth()->user()->id)->where('to','=',$id)->get();
        // this is for marke messages as read 
        $unread=$messages->where('is_read',0);
        foreach ($messages as $key => $value) {
            if($value->is_read==0 and $value->to == auth()->user()->id){
                $value->is_read=1;
                $value->save();

            }
        }
        // return view('messages.conversation',['messages'=>$messages]);
  

        return response()->json($messages);
    }
    public function sendmessage(){
        $from=auth()->user()->id;
        $to=request('to');
        $text=request('message');
        $message=new message();
        $message->from=$from;
        $message->to=$to;
        $message->message=$text;
        $message->is_read=0;
        $message->save();
        // sending message in pusher
        event(new Messages($text,$to,$from));


    }

    public function welcome () {

        $messages=message::all();

        return view('welcome',['messages'=>$messages]);
    }
}
