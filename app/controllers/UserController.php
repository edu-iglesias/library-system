<?php

class UserController extends BaseController {

	public function create()
	{
		return View::make('admin.create_user');
	}

	public function store()
	{
		$inputs = Input::all();

		$rules = array(		
			'UserId'    => 'Required|numeric|digits:9',
			'CardNo'    => 'Required|max:30',
			'Lname'     => 'Required|alpha_num|max:50',
			'FirstName'     => 'Required|alpha_num|max:50',
			'LastName'     => 'Required|alpha_num|max:50',
			'MiddleName'     => 'Required|alpha_num|max:50',
			'ContactNo' => 'Required',
			'UserType'  => 'Required|in:1,2,',
		);

		$validationResult = Validator::make($inputs, $rules);

		if ( $validationResult->passes() ) 
		{
			return 'Good Job. No Errors';
		}
		else
		{
			return Redirect::back()->withInput()->withErrors($validationResult);
		}
	}





}
