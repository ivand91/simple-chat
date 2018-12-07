<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Message;

class MainController extends Controller
{
    public function getOnlineUsers() {
        $onlineUsers = User::where('is_online', 1)->pluck('username');
        return response()->json(['onlineUsers' => $onlineUsers]);
    }

    public function getMessages() {
        $messages = Message::all();
        $data = [];
        
        foreach($messages as $message) {
            array_push($data, [$message->id, $message->text, $message->user->id, $message->user->username]);
        }

        return response()->json(['messages' => $data]);
    }

    public function sendMessage() {
        if(!empty(request('message'))) {
            $message = new Message();
            $text = request('message');
            $userId = request('userId');
            $message->text = $text;
            $message->user_id = $userId;
            $message->save();

            broadcast(new \App\Events\MessageSent($message->id, $text, $userId));
            
        }
    }
}
