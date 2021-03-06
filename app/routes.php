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
	//return View::make('hello');
	return Redirect::to('/user');
});

Route::get('/admin', 'AdminController@index');
Route::post('/admin', 'AdminController@login');
Route::get('/admin/logout', 'AdminController@logout');

Route::get('/admin/dashboard', 'AdminController@dashboard');


Route::get('/admin/changepass/{id}', 'AdminController@editpass');
Route::post('/admin/changepass/{id}', 'AdminController@changepass');


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
Route::get('/admin/books/search', 'BookController@search');

Route::get('/admin/books/category', 'BookController@category');
Route::get('/admin/books/category/create', 'BookController@categoryCreate');
Route::post('/admin/books/category/create', 'BookController@categoryStore');
Route::get('/admin/books/category/edit/{id}', 'BookController@categoryEdit');
Route::post('/admin/books/category/edit/{id}', 'BookController@categoryUpdate');

Route::get('/admin/books/borrowed','AdminController@booksBorrowed');

Route::get('/admin/archives','AdminController@adminArchives');

Route::get('/user/changepass/{id}', 'UserController@editpass');
Route::post('/user/changepass/{id}', 'UserController@changepass');








// -- -- -- - -- -- -USER --- --- -- -- -//

Route::get('/user/home', function()
{
	$user = User::find(Auth::id())->get();
	
	return View::make('user.index')->with('user',$user);
});

Route::get('/user', function()
{
	return View::make('user.login');
});


Route::post('/userLogin', 'UserController@userlogin');
Route::get('/user/logout', 'UserController@userlogout');

Route::get('/user/books','BookController@listBooks');
Route::post('/user/books','BookController@doBorrowBooks');

Route::get('/user/books/borrowed','BookController@borrowedBooks');
Route::post('/user/books/borrowed','BookController@returnBooks');

Route::get('/user/archives','UserController@userArchives');



//  - -- - - - -- - -END OF USER - - -- - -- //




Route::get('/test', function()
{
 	return Route::getCurrentRoute()->getPath();
});
