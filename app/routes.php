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

Route::get('/admin', 'AdminController@index');
Route::post('/admin', 'AdminController@login');
Route::get('/admin/logout', 'AdminController@logout');

Route::get('/admin/dashboard', 'AdminController@dashboard');


Route::get('/admin/users/create', 'UserController@create');
Route::post('/admin/users/create', 'UserController@store');
Route::get('/admin/users/edit/{id}', 'UserController@edit');
Route::post('/admin/users/edit/{id}', 'UserController@update');
Route::get('/admin/users', 'UserController@index');
Route::get('/admin/users/activate/{id}', 'UserController@activate');
Route::get('/admin/users/deactivate/{id}', 'UserController@deactivate');


Route::get('/admin/books', 'BookController@index');
Route::get('/admin/books/create', 'BookController@create');
Route::post('/admin/books/create', 'BookController@store');
Route::get('/admin/books/edit/{id}', 'BookController@edit');
Route::post('/admin/books/edit/{id}', 'BookController@update');



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

Route::get('/user/books','BookController@listBooks');
Route::post('/user/books','BookController@doBorrowBooks');


//  - -- - - - -- - -END OF USER - - -- - -- //

