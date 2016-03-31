<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests;
use App\Response;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function delete(Request $request, Response $response)
    {
        if($request->user()->id === $response->user_id){
            $response->deleted_at = Carbon::now()->toDateTimeString();
            $response->save();
        }
        return redirect('/messages/' . $response->message->id);
    }
}
