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
    return view('main');
});

Route::any('/tickets', array('uses' => 'TicketsController@index', 'as' => 'showalltickets'));
Route::get('/tickets/{id}', array('uses' => 'TicketsController@show', 'as' => 'showticket'));

Route::get('/floors', array('uses' => 'FloorsController@select', 'as' => 'selectfloor'));
Route::get('/floors/{id}', array('uses' => 'FloorsController@show', 'as' => 'showallfloors'));
Route::post('/floors', array('uses' => 'FloorsController@select', 'as' => 'selectfloor'));

Route::post('/savefloors', array('uses' => 'FloorsController@update', 'as' => 'updatefloors'));
Route::get('/addtable/{floor}', array('uses' => 'FloorsController@add', 'as' => 'addtable'));

Route::get('/products', array('uses' => 'ProductsController@index', 'as' => 'showallproducts'));
Route::get('/product/{id}', array('uses' => 'ProductsController@edit', 'as' => 'editproduct'));

Route::get('/categories', array('uses' => 'CategoriesController@index', 'as' => 'showallcategories'));
Route::get('/categories/{id}', array('uses' => 'CategoriesController@edit', 'as' => 'editcategories'));

Route::get('/charts', array('uses' => 'ChartsController@index', 'as' => 'showallcharts'));

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', ['as' =>'auth/login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'auth/logout', 'uses' => 'Auth\AuthController@getLogout']);
 
Route::post('pdf', 'TicketsController@invoice');



