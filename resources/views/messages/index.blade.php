
@extends('layouts.app')

@section('content')

    <div class="row">

        <div class="col-md-6 col-md-offset-3">

            <h1>Wellcom! {{ $name }}!<button class="btn btn-cancel" onclick="location='/logout'">登出</button></h1>

            <h3>Messages List</h3>

            <div class="panel panel-default">

                <table class="table table-striped task-table">
                    
                    <tbody>
 
                        @foreach($messages as $message)
                            @if($message->deleted_at === "0000-00-00 00:00:00")
                                <tr>
                                    <td class="table-text">
                                        <a href="{{ url("/messages/$message->id") }}">{{ $message->title }}</a>
                                        {{ $message->content }}
                                    </td>
                                    <td>
                                        @if($message->user_id === request()->user()->id)
                                            <form method="POST" action="{{ url('/messages/' . $message->id) }}">

                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                                <button type="submit" id="delete-message-{{ $message->id }}" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash">Delete</i>
                                                </button>

                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <h3>Add a New Message</h3>

            <form method="POST" action="/messages/store">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    Title: <input class='form-control' type="text" name="title"/>
                </div>

                <div class="form-gourp">
                    Content:<textarea class="form-control" name="content"></textarea>
                </div>

                <div class="form-gourp">
                    <button class="btn btn-primary" type="submit">送出</button>
                </div>
            </form>

        </div>
    </div>
@endsection