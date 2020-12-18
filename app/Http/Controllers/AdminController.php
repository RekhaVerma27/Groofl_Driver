<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Auth;
use Session;

class AdminController extends Controller
{
    public function adminLogin(Request $request)
    {
    	if($request->isMethod('post'))
    	{
    		$data = $request->input();

	         $adminCount = Admin::where(['email'=>$data['email'],'password'=>md5($data['password'])])->count();
	         // echo "<pre>"; print_r($adminCount); die;

	         if($adminCount>0)
	         {
	            Session::put('adminSession',$data['email']);
	             return redirect('admin-dashboard');
	         }
	         else
	         {
	             return redirect('/')->with('flash_message_error','Invalid Username or Password');
	         }
    	}
    	return view('admin.admin_login');
    }

    public function adminRegister(Request $request)
    {
    	if($request->isMethod('post'))
    	{
    		$data = $request->all();

    		$admin = new Admin;

    		$admin->name = $data['name'];
    		$admin->email = $data['email'];
    		$admin->password = md5($data['password']);

    		$admin->save();

    		return redirect('/admin-dashboard');
    	}
    	return view('admin.admin_register');
    }

    public function adminDashboard()
    {
    	return view('admin.admin_dashboard');
    }

    public function adminLogout()
    {
        Session::flush();
        return redirect('/admin-login')->with('flash_message_success','loged out Successfully!!');
    }
    
}
