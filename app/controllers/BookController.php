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
         
         ->get();

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
			'title'    => 'Required|alpha_spaces|max:50',
			'quantity'  =>'Required|numeric',
        	'author'=>'Required|max:70',
			
		);

		$validationResult = Validator::make($inputs, $rules);

		if ( $validationResult->passes() ) 
		{
			$book = new Book;
			$book->title = Input::get('title');
			$book->quantity = Input::get('quantity');
			$book->category_categoryID = Input::get('selected');
			$book->author = Input::get('author');
			
			$book->save();

			

            Session::put('success_book_created', "You have successfully added a new book.");
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
		$books = DB::table('books')->get();

		return View::make('user.list_of_books')->with('books',$books);
	}

	public function edit($id)
    {
    

    	$book = Book::find($id);
    	

    	Session::put('title', $book->title);
		Session::put('quantity',$book->quantity);
		Session::put('category_categoryID',$book->category_categoryID);
		Session::put('author',$book->author);


    	return View::make('admin.edit_book');
    }

    public function update($id)
    {
    	$inputs = Input::all();

    	$book = Book::find($id);
	    


    	$rules = array(		
			'title'    => 'Required|alpha_spaces|max:50',
			'quantity'  =>'Required|numeric',
			
        	'author'=>'Required|max:70',
		);


		$validationResult = Validator::make($inputs, $rules);

		if ( $validationResult->passes() ) 
		{


			$book->title = Input::get('title');
			$book->quantity = Input::get('quantity');
			$book->category_categoryID = Input::get('selected1');
			$book->author = Input::get('author');
			
			$book->save();

	        return Redirect::to('/admin/books');
	    }
	    else
	    {
	    	return Redirect::back()->withInput()->withErrors($validationResult);
	    }
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
			Session::put('borrowing_error', "You have reach the max limit of borrowed books (4).");
			return Redirect::back();
		}

		// Change the max quantity to your numbers of books you can still borrow
		if($numberOfBooksYouCanStillBorrow  < $maxQuantity)
		{
			$maxQuantity = $numberOfBooksYouCanStillBorrow;
		}
		$max1  = $maxQuantity;
		// Validate Book ID if it is a number

		if ( is_numeric(Input::get('bookID')) ) 
		{
			$book = Book::where("bookID","=",Input::get('bookID'))->first();
			$maxQuantity = $book->quantity;	// Get Available number of books

			$rules = array(		
				'bookID'    => "required|numeric",
				'quantity'  =>"Required|min:1|max:$max1|numeric|digits:1",
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

	public function borrowedBooks()
	{
		$books = DB::table('books')
					 ->join('borrows', 'books.bookID', '=', 'borrows.book_id')
					 ->where('borrows.user_id','=', Auth::id())

		->get();

		//return $books;

		return View::make('user.list_of_books_borrowed')->with('books',$books);
	}

	public function returnBooks()
	{
		$inputs = Input::all();

		if ( is_numeric(Input::get('bookID')) ) 
		{
			$book = Borrow::where("book_id","=",Input::get('bookID'))
				->where("user_id","=",Auth::id())
				->first();

			$numberOfFetchedRows = count($book);

			// Check if you really do have that book
			if($numberOfFetchedRows == 0)
			{
				Session::put('borrowing_error', 'Unknown Book ID' );
				return Redirect::back();
			}

			$maxQuantity = $book->quantity;

			$rules = array(		
				'bookID'    => "required|numeric",
				'quantity'  =>"Required|min:1|max:$maxQuantity|numeric|digits:1",
			);

			$validationResult = Validator::make($inputs, $rules);
			
			if ( $validationResult->passes() ) 
			{
				// If you will return all
				if($maxQuantity == Input::get('quantity'))
				{
					// Inserting to Archives
					date_default_timezone_set("Asia/Manila");
					$date_today = date('Y-m-d H:i:s');

					$archive = new Archive;
					$archive->book_id = Input::get('bookID');
					$archive->user_id = Auth::id();
					$archive->quantity = Input::get('quantity');
					$archive->date_borrowed = $book->created_at;
					$archive->date_returned = $date_today;
					$archive->save();

					//updating the list of books
					$listOfBooks = Book::find(Input::get('bookID'));
					$listOfBooks->quantity = $listOfBooks->quantity + Input::get('quantity');
					$listOfBooks->save();

					// Removing from the borred table
					$book->delete();

					Session::put('borrowing_success', "You have successfully returned all copies of the book.");
		 			return Redirect::back();
				}
				else // If you will not return all
				{
					// Inserting to Archives
					date_default_timezone_set("Asia/Manila");
					$date_today = date('Y-m-d H:i:s');

					$archive = new Archive;
					$archive->book_id = Input::get('bookID');
					$archive->user_id = Auth::id();
					$archive->quantity = Input::get('quantity');
					$archive->date_borrowed = $book->created_at;
					$archive->date_returned = $date_today;
					$archive->save();

					//updating the list of books
					$listOfBooks = Book::find(Input::get('bookID'));
					$listOfBooks->quantity = $listOfBooks->quantity + Input::get('quantity');
					$listOfBooks->save();

					// Removing from the borred table
					$book->quantity = $book->quantity - Input::get('quantity');
					$book->save();

					Session::put('borrowing_success', "You have successfully returned some copies of the book.");
		 			return Redirect::back();

				}
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

	public function search() 
	{

	    $q = Input::get('search');
		return View::make('admin.list_search')->with('title',$n);
	}

	public function category()
	{
		$categories = DB::table('category')->get();
		return View::make('admin.list_of_category')->with('categories',$categories);
	}

	public function categoryCreate()
	{
		return View::make('admin.create_category');
	}

	public function categoryStore()
	{
		$inputs = Input::all();

		$rules = array(		
			'categoryName'    => 'Required|max:30|unique:category,categoryName',
		);

		$validationResult = Validator::make($inputs, $rules);

		if ( $validationResult->passes() ) 
		{
			$category = new Category;
			$category->categoryName = Input::get('categoryName');
        	$category->save();

            Session::put('success_category_created', "You have successfully added a new category.");
            return Redirect::back();
		}
		else
		{
			return Redirect::back()->withInput()->withErrors($validationResult);
		}
	}

	public function categoryEdit($id)
	{
		$categories = Category::find($id);

		Session::put('categoryName', $categories->categoryName);
		return View::make('admin.edit_category');
	}

	public function categoryUpdate($id)
	{
		$inputs = Input::all();

		$category = Category::find($id);

		$nameRule = " ";

		if($category->categoryName != Input::get('categoryName'))
		{
			$nameRule = 'required|max:30|unique:category,categoryName';
		}


		$rules = array(		
			'categoryName'    => $nameRule,
		);

		$validationResult = Validator::make($inputs, $rules);

		if ( $validationResult->passes() ) 
		{
			$category->categoryName = Input::get('categoryName');
        	$category->save();

            Session::put('success_category_updated', "You have successfully updated the category.");
            return Redirect::to('/admin/books/category');
		}
		else
		{
			return Redirect::back()->withInput()->withErrors($validationResult);
		}
		


	}


}
