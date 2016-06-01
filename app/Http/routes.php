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

//use App\Http\Controllers\TicketsController;


Route::get('/', function () {
	if (Auth::check())
	{
	    // The user is logged in...
	    return view('main');

	}
	else return redirect()->action('Auth\AuthController@getLogin');
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');


Route::any('/tickets', array('middleware' => 'auth', 'uses' => 'TicketsController@index', 'as' => 'showalltickets'));
Route::get('/tickets/{id}', array('middleware' => 'auth', 'uses' => 'TicketsController@show', 'as' => 'showticket'));

Route::get('/floors', array('middleware' => 'auth', 'uses' => 'FloorsController@select', 'as' => 'selectfloor'));
Route::get('/floors/{id}', array('middleware' => 'auth', 'uses' => 'FloorsController@show', 'as' => 'showallfloors'));
Route::post('/floors', array('middleware' => 'auth', 'uses' => 'FloorsController@select', 'as' => 'selectfloor'));

Route::post('/savefloors', array('middleware' => 'auth', 'uses' => 'FloorsController@update', 'as' => 'updatefloors'));
Route::get('/addtable/{floor}', array('middleware' => 'auth', 'uses' => 'FloorsController@add', 'as' => 'addtable'));

Route::get('/products', array('middleware' => 'auth', 'uses' => 'ProductsController@index', 'as' => 'showallproducts'));
Route::get('/product/{id}', array('middleware' => 'auth', 'uses' => 'ProductsController@edit', 'as' => 'editproduct'));

Route::get('/categories', array('middleware' => 'auth', 'uses' => 'CategoriesController@index', 'as' => 'showallcategories'));
Route::get('/categories/{id}', array('middleware' => 'auth', 'uses' => 'CategoriesController@edit', 'as' => 'editcategories'));

Route::get('/charts', array('middleware' => 'auth', 'uses' => 'ChartsController@index', 'as' => 'showallcharts'));

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', ['as' =>'auth/login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'auth/logout', 'uses' => 'Auth\AuthController@getLogout']);

// Registration routes...
//Route::get('auth/register', 'Auth\AuthController@getRegister');
//Route::post('auth/register', 'Auth\AuthController@postRegister');
 
Route::post('ticketspdf', array('middleware' => 'auth', 'uses' => 'TicketsController@ticketspdf'));
Route::get('/ticketpdf/{receipt}', array('middleware' => 'auth', 'uses' => 'TicketsController@ticketpdf', 'as' => 'ticketpdf'));


