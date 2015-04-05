<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('/admin', function()
{
	return View::make('admin.index');
});



Route::get('/admin/users/create', 'UserController@create');
Route::post('/admin/users/create', 'UserController@store');
Route::get('/admin/users', 'UserController@index');
Route::get('/admin/users/activate/{id}', 'UserController@activate');
Route::get('/admin/users/deactivate/{id}', 'UserController@deactivate');


Route::get('/admin/books', 'BookController@index');
Route::post('/admin/books/create', 'BookController@store');


// -- -- -- - -- -- -USER --- --- -- -- -//

Route::get('/user/home', function()
{
	return View::make('user.index');
});

Route::get('/user', function()
{
	return View::make('user.login');
});



Route::post('/userLogin', 'UserController@userlogin');


//  - -- - - - -- - -END OF USER - - -- - -- //

