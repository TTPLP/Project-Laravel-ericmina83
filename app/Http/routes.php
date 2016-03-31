<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::group(['middleware' => 'auth'], function() {
    // lots of routes that require auth middleware
    
    Route::get('/', function () {
        return redirect('/messages');;
    });


    Route::get('/tasks', 'TaskController@index');
    Route::post('/task', 'TaskController@store');
    Route::delete('/task/{task}', 'TaskController@destroy');

    Route::get('/messages', 'MessageController@index');
	Route::post('/messages/store', 'MessageController@store');
    Route::get('/messages/{message}', 'MessageController@show');
    Route::post('/messages/{message}/addResponse', 'MessageController@addResponse');
    Route::post('/messages/{message}', 'MessageController@delete');

    Route::post('/responses/{response}', 'ResponseController@delete');

});


Route::auth();

