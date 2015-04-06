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

		$books = DB::table('books')->select(array('books.bookID as bookId', 'books.title as title', 'books.quantity as quantity', 'books.author as author'))
         
         ->paginate(10);

		return View::make('admin.list_books')->with('books',$books);
	}

	public function create()
	{
		return View::make('admin.create_book');
	}


	public function store()
	{
		$inputs = Input::all();

		$rules = array(		
			'title'    => 'Required|alpha_num|max:50',
			'quantity'  =>'Required|numeric|max:1',
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

            Session::put('success_book_created', "You have successfully added a new user.");
            return Redirect::back();

		}
		else
		{
			//return Input::get('password') . " " . Input::get("password_confirmation");
			//return $messages = $validationResult->getMessages()->all();
			return Redirect::back()->withInput()->withErrors($validationResult);
		}
	}

	public function listBooks()
	{
		$books = DB::table('books')->paginate(10);
		return View::make('user.list_of_books')->with('books',$books);
	}

	public function doBorrowBooks()
	{
		$inputs = Input::all();

		$maxQuantity =  Input::get('maxQuantity');

		$numberOfBooksBorrowed = DB::table('borrows')->where("user_id","=",Auth::id())->sum('quantity');
		$numberOfBooksYouCanStillBorrow = 4 - $numberOfBooksBorrowed;
		
		// Check the limits of books you can still borrow
		if($numberOfBooksBorrowed >= 4)
		{
			Session::put('borrowing_error', "You have reach the max limit of borrowed books (5).");
			return Redirect::back();
		}

		// Change the max quantity to your numbers of books you can still borrow
		if($numberOfBooksYouCanStillBorrow  < $maxQuantity)
		{
			$maxQuantity = $numberOfBooksYouCanStillBorrow;
		}
		
		// Validate Book ID if it is a number

		if ( is_numeric(Input::get('bookID')) ) 
		{
			$book = Book::where("bookID","=",Input::get('bookID'))->first();
			$maxQuantity = $book->quantity;	// Get Available number of books

			$rules = array(		
				'bookID'    => "required|numeric",
				'quantity'  =>"Required|min:1|max:$maxQuantity|numeric|digits:1",
			);

			// Check other validations like quantity must be a number
			$validationResult = Validator::make($inputs, $rules);

			if ( $validationResult->passes() ) 
			{
				$borrow = new Borrow;
				$borrow->user_id = Auth::id();
				$borrow->book_id = Input::get('bookID');
				$borrow->quantity = Input::get('quantity');
				$borrow->save();

				// Compute the quantity left after borrow
				$quantityLeft = $maxQuantity - Input::get('quantity');

				//$updateBook = Book::where('bookID', '=', Input::get('bookID'))->first();

				$book->quantity =  $quantityLeft;
				$book->save();

				Session::put('borrowing_success', "You have successfully borrowed the book.");
				return Redirect::back();

			}
			else
			{
				Session::put('borrowing_error', $validationResult->messages()->first());
				return Redirect::back();
			}
			
		}
		else
		{
			Session::put('borrowing_error', 'Book ID must be a number' );
			return Redirect::back();
		}






	}
}
