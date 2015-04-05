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
				return  Redirect::back();
			}

			return Redirect::to('/admin/dashboard');
    	}
    	else
    	{
    		Session::put('login_failure','Authentication Failed. Please try again.');
    		return  Redirect::back();
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
    	return View::make('admin.dashboard');
    }


}
