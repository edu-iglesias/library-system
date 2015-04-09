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


            $user = User::find(Auth::id());
            Session::put('admin_firstname',$user->Fname);
            Session::put('admin_lastname',$user->Lname);
            Session::put('admin_id',$user->id);
            
			return View::make('/admin/dashboard')->with('userid',$user->id);

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



    public function adminArchives()
    {
        $archives = DB::table('archives')
            ->join('books', 'archives.book_id', '=', 'books.bookID')
            ->get();

        return View::make('admin.admin_archives')->with('archives', $archives);
    }

    public function booksBorrowed()
    {
        
    }

    public function editpass($id)
    {
        $user = User::find($id);
        
        
        return View::make('admin.edit_pass')->with('user',$user);
    }

    public function changepass($id)
    {
       $inputs = Input::all();

        $user = User::find($id);

        $userpass=$user->password;

        $newpass = $inputs['newpass'];
        
        if(!Hash::check($inputs['oldpass'], Auth::user()->password))
        {
            $oldpass = 'Required|min:5|max:20|Confirmed';
        }
        else
        {
            $oldpass = '';
        }

        if($inputs['confirmpass'] != $inputs['newpass'])
        {
            $conf = 'Required|min:5|max:20|Confirmed';
        }
        else
        {
            $conf = '';
        }
       

        $rules = array(     
            'oldpass'  => $oldpass,
            'newpass'  => 'Required|min:5|max:20',
            'confirmpass'  => $conf,
             
        );


        $validationResult = Validator::make($inputs, $rules);

        if ( $validationResult->passes() ) 
        {

            $user->password = Hash::make(Input::get('newpass'));

            $user->save();

           
            Session::put('success_user_created', 'You have successfully edited your password.');

            return Redirect::to('/admin/users');
        }
        else
        {
            return Redirect::back()->withInput()->withErrors($validationResult);
        }
    }


}
