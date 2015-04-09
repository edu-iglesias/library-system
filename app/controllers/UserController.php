<?php

class UserController extends BaseController {

	public function index()
	{
		$users = DB::table('users') 
		 ->join('assigned_roles', 'users.id', '=', 'assigned_roles.user_id')
		 ->join('roles', 'assigned_roles.role_id', '=', 'roles.id')
		 ->select('*', 'users.id')
		 ->paginate(10);

		return View::make('admin.list_user')->with('users',$users);
	}

	public function create()
	{
		return View::make('admin.create_user');
	}

	public function store()
	{
		$inputs = Input::all();

		$rules = array(		
			'UserId'    => 'Required|numeric|digits:9|unique:users,UserId',
			'password'  =>'Required|min:5|Confirmed|max:20',
        	'password_confirmation'=>'Required|min:5|max:20',
			'FirstName'     => 'Required|alpha_spaces|max:50',
			'LastName'     => 'Required|alpha_spaces|max:50',
			'MiddleName'     => 'Required|alpha_spaces|max:50',
			'ContactNo' => 'Required',
			'UserType'  => 'Required|in:2,3,',
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
			return Redirect::back()->withInput()->withErrors($validationResult);
		}
	}

	public function activate($id)
	{
		$user = User::find($id);
		$user->status = 1;
		$user->update();
		Session::put('status', "You have successfully activated the user.");
		return Redirect::back();
	}


	public function deactivate($id)
	{
		$user = User::find($id);
		$user->status = 0;
		$user->update();
		Session::put('status', "You have successfully deactivated the user.");
		return Redirect::back();
	}

	public function userlogin()
	{

		$status = 'FAILED';

		$user = new User();
		$uname = Input::get('username1');
		$pword = Input::get('password1');

	    if(Auth::attempt(array('UserId' => $uname, 'password' => $pword)))
	    {
	    	$roleId = Assigned::where('user_id','=',Auth::id())->first(); // check it's role

    		if($roleId->role_id == 1) // if user is not student or faculty, it will be forced to logout
			{
				Auth::logout();
			}
			else
			{
	    		$status = 'SUCCESS';
			}
	    }
	                	
	    return array('status' => $status);
    }

    public function edit($id)
    {
    	if($id == 1) // Disables the editing of an admin user
    	{
    		return Redirect::back();
    	}

    	$user = User::find($id);
    	$roleId = Assigned::where('user_id','=',$user->id )->first();

    	Session::put('UserId', $user->UserId);
		Session::put('Fname',$user->Fname);
		Session::put('Lname',$user->Lname);
		Session::put('Mname',$user->Mname);
		Session::put('ContactNo',$user->ContactNo);
		Session::put('UserType',$roleId->role_id);

    	return View::make('admin.edit_user');
    }

    public function update($id)
    {
    	$inputs = Input::all();

    	$user = User::find($id);
	    $roleId = Assigned::where('user_id','=',$user->id )->first();

    	if(Input::get('UserId') == $user->UserId)
    	{
    		$user_id_rule = '';
    	}
    	else
    	{
    		$user_id_rule = 'Required|numeric|digits:9|unique:users,UserId';
    	}

    	if(Input::get('password') != "")
    	{
    		$password_rule = 'Required|min:5|Confirmed|max:20';
    		$password_confirmation_rule = 'Required|min:5|max:20';
    	}
    	else
    	{
    		$password_rule = '';
    		$password_confirmation_rule = '';
    	}

    	$rules = array(		
			'UserId'    => $user_id_rule,
			'password'  => $password_rule,
        	'password_confirmation'=> $password_confirmation_rule,
			'FirstName'     => 'Required|alpha_spaces|max:50',
			'LastName'     => 'Required|alpha_spaces|max:50',
			'MiddleName'     => 'Required|alpha_spaces|max:50',
			'ContactNo' => 'Required',
			'UserType'  => 'Required|in:2,3,',
		);


		$validationResult = Validator::make($inputs, $rules);

		if ( $validationResult->passes() ) 
		{

	    	$user->UserId = Input::get('UserId');

	    	if(Input::get('password') != "")
	    	{
				$user->password = Hash::make(Input::get('password'));
	    	}

			$user->Fname = Input::get('FirstName');
			$user->Lname = Input::get('LastName');
			$user->Mname = Input::get('MiddleName');
			$user->ContactNo = Input::get('ContactNo');
			$user->status = 1;
			$user->save();

			$assign = Assigned::where('user_id','=',$user->id )->first();
	        $assign->user_id = $user->id;
	        $assign->role_id = Input::get('UserType');
	        $assign->save();

	        Session::put('success_user_created', 'You have successfully edited the user information.');

	        return Redirect::to('/admin/users');
	    }
	    else
	    {
	    	return Redirect::back()->withInput()->withErrors($validationResult);
	    }
	}

	public function userlogout()
	{
		Auth::logout();
		Session::flush();
		Session::put('logout_successful', 'You have successfully logout.');
		return Redirect::to('/user');
	}

	public function userArchives()
	{
		$archives = Archive::where('user_id','=', Auth::id())
			->join('books', 'archives.book_id', '=', 'books.bookID')
			->get();

		return View::make('user.user_archives')->with('archives', $archives);
	}

}
