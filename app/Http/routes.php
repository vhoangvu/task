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

Route::get('/', 'TaskController@index');
  
Route::get('/ajax/list', 'TaskController@ajax_list');
Route::get('/ajax/check/duedate', 'TaskController@ajax_check_duedate');
  
Route::post('/ajax/save', 'TaskController@ajax_save');
Route::post('/ajax/completed/{id}', 'TaskController@ajax_completed');