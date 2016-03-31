@extends('layouts.app')

@section('content')

	 <div class="row">

        <div class="col-md-6 col-md-offset-3">
        	<h1>{{ $message->title }}</h1>

            <h3>
                {{ $message->content }}
            </h3>

            <button class="btn btn-cancel" onclick="location='/messages'">上一頁</button>

            <h3>Responses List</h3>


            <div class="panel panel-default col-md-offset-1">
                <table class="table table-striped task-table">
                    <tbody>
                        @foreach($message->responses as $response)
                            @if($response->deleted_at === "0000-00-00 00:00:00")
                                <tr>
                                    <td class="table-text">

                                        <h4>{{ $response->title }}</h4>

                                        <div class="col-md-offset-1">
                                            {{ $response->content }}
                                        </div>

                                    </td>

                                    <td class="table-text">
                                        @if($response->user_id == request()->user()->id)
                                            <form method="POST" action="{{ url('/responses/' . $response->id) }}">
                    
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                                <button type="submit" id="delete-response-{{ $response->id }}" class="btn btn-danger">
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

            <h3>Add a New Response</h3>

            <form method="POST" action="/messages/{{ $message->id }}/addResponse">
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
