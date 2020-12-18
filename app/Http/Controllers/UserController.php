<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;

class UserController extends Controller
{
    public function userLogin(Request $request)
    {
    	if($request->isMethod('post'))
    	{
    		$data = $request->input();

	         $userCount = User::where(['email'=>$data['email'],'password'=>md5($data['password'])])->count();
	         // echo "<pre>"; print_r($adminCount); die;

	         if($userCount>0)
	         {
	            Session::put('userSession',$data['email']);
	             return redirect('/user-dashboard');
	         }
	         else
	         {
	             return redirect('/user-login')->with('flash_message_error','Invalid Username or Password');
	         }
    	}
    	return view('user.user_login');
    }

    public function userRegister(Request $request)
    {
    	if($request->isMethod('post'))
    	{
    		$data = $request->all();

    		$user = new user;

    		$user->name = $data['name'];
    		$user->email = $data['email'];
    		$user->password = md5($data['password']);

    		$user->save();
            Session::put('userSession',$data['email']);
    		return redirect('/user-dashboard');
    	}
    	return view('user.user_register');
    }

    public function userDashboard()
    {
    	return view('user.user_dashboard');
    }

    public function userLogout()
    {
        Session::flush();
        return redirect('/user-login')->with('flash_message_success','loged out Successfully!!');
    }
}


