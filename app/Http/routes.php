<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

use Scheduler\Task;
use Illuminate\Http\Request;

Route::group(['middleware' => ['web', 'cors']], function () {

    Route::get('/', ['as' => 'home', function () {
      return view('home');
    }]);

    Route::get('new', ['as' => 'new', function () {
      return view('create');
    }]);

});

Route::group(['prefix' => 'api'], function () {

  Route::resource('division', 'DivisionController', ['only' => [
    'index', 'show'
  ]]);

  Route::resource('proker', 'ProkerController', ['only' => [
    'index', 'show', 'store', 'destroy', 'update'
  ]]);

  Route::get('division/{id}/proker', ['as' => 'division.proker', 
    'uses' => 'DivisionController@proker']
  );

  Route::get('timeline', ['as' => 'timeline', 'uses' => 'ProkerController@timeline']);

});