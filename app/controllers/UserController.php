<?php

class UserController extends BaseController {

	public function index()
	{
		$users = DB::table('users') 
		 ->join('assigned_roles', 'users.id', '=', 'assigned_roles.user_id')
		 ->join('roles', 'assigned_roles.role_id', '=', 'roles.id')
		 ->paginate(1);

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
			'UserId'    => 'Required|numeric|digits:9',
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
			//return Input::get('password') . " " . Input::get("password_confirmation");
			//return $messages = $validationResult->getMessages()->all();
			return Redirect::back()->withInput()->withErrors($validationResult);
		}
	}





}
