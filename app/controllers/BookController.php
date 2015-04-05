<?php

class BookController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index()
	{

		$books = DB::table('books')->select(array('books.bookID as bookId', 'books.title as title', 'books.quantity as quantity', 'author.fName as fname', 'author.lname as lname'))->join('author', 'author.authorID','=','books.author_authorID')
         
         ->paginate(10);

		return View::make('admin.list_books')->with('books',$books);
	}


	public function store()
	{
		$inputs = Input::all();

		$rules = array(		
			'title'    => 'Required|alpha_num|max:50',
			'quantity'  =>'Required|min:1|numeric|digits:1',
        	'author'=>'Required|alpha_spaces|max:70',
			
		);

		$validationResult = Validator::make($inputs, $rules);

		if ( $validationResult->passes() ) 
		{
			$user = new User;
			$user->UserId = Input::get('UserId');
			$user->password = Hash::make(Input::get('password'));
			$user->Fname = Input::get('FirstName');
			$user->Lname = Input::get('LastName');
			$user->Mname = Input::get('MiddleName');
			$user->ContactNo = Input::get('ContactNo');
			$user->status = 1;
			$user->save();

			$assign = new Assigned;
            $assign->user_id = $user->id;
            $assign->role_id = Input::get('UserType');
            $assign->save();

            Session::put('success_user_created', "You have successfully added a new user.");
            return Redirect::back();

		}
		else
		{
			//return Input::get('password') . " " . Input::get("password_confirmation");
			//return $messages = $validationResult->getMessages()->all();
			return Redirect::back()->withInput()->withErrors($validationResult);
		}
	}
}
