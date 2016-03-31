<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests;
use App\Message;
use App\Response;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request){

    	$name = $request->user()->name;
        $messages = App\Message::all();
        return view('messages.index', ['messages' => $messages, 'name' => $name]);
    }

    public function store(Request $request){

        $request->user()->messages()->create($request->all());
        return redirect('/messages');
    }

    public function show(Message $message)
    {
    	return view('messages.show', ['message' => $message]);
    }

    public function addResponse(Request $request, Message $message){
        $response = new Response;
        $response->user_id = request()->user()->id;
        $response->content = $request['content'];
        $response->title = $request['title'];
        $message->responses()->save($response);
        return redirect("/messages/$message->id");
    }

    public function delete(Request $request, Message $message)
    {
        if($request->user()->id == $message->user_id){
            $message->deleted_at = Carbon::now()->toDateTimeString();
            $message->save();
        }
        return redirect('/messages');
    }
}
