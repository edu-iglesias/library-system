<?php

class AdminController extends BaseController {

	public function index()
	{
		return View::make('admin.index');
	}

	public function login()
	{
		$userdata = array(
        	'UserId'     => Input::get('userId'),
        	'password'  => Input::get('password')
    	);


    	// authenticate userId and password through user table
    	if (Auth::attempt($userdata)) 
    	{
    		$roleId = Assigned::where('user_id','=',Auth::id())->first();

    		if($roleId->role_id != 1) // if user is not admin, it will be forced to logout
			{
				Auth::logout();
				Session::put('login_failure','Authentication Failed. Please try again.');
				return  Redirect::back()->withInput();
			}


            $user = User::find(Auth::id());
            Session::put('admin_firstname',$user->Fname);
            Session::put('admin_lastname',$user->Lname);
			return Redirect::to('/admin/dashboard');

    	}
    	else
    	{
    		Session::put('login_failure','Authentication Failed. Please try again.');
    		return  Redirect::back()->withInput();
    	}
    }

    public function logout()
	{
		Auth::logout();
		Session::flush();
		Session::put('logout_successful', 'You have successfully logout.');
		return Redirect::to('/admin');
	}

    public function dashboard()
    {
        $user = User::find(Auth::id())->get();
    	return View::make('admin.dashboard')->with('user',$user);
    }

    public function adminArchives()
    {
        $archives = DB::table('archives')
            ->join('books', 'archives.book_id', '=', 'books.bookID')
            ->get();

        return View::make('admin.admin_archives')->with('archives', $archives);
    }

    public function booksBorrowed()
    {
        $books = DB::table('books')
            ->join('borrows', 'books.bookID', '=', 'borrows.book_id')
            ->get();

        return View::make('admin.list_borrowed_books')->with('books', $books);
    }


}
