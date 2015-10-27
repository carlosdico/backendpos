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

use App\Http\Controllers\TicketsController;

Route::get('/', function () {
    return view('welcome');
});

Route::any('/tickets', array('uses' => 'TicketsController@index', 'as' => 'showalltickets'));
Route::any('/floors', array('uses' => 'FloorsController@index', 'as' => 'showallfloors'));

