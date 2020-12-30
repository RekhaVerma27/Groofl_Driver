<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Driver;
use App\User;
use Auth;
use Session;
use Illuminate\Support\Facades\Validator;

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
        Session::forget('adminSession');
        return redirect('/admin-login')->with('flash_message_success','loged out Successfully!!');
    }

    public function viewDrivers()
    {
        $drivers = Driver::all();
        return view('admin.drivers.view_drivers',compact('drivers'));
    }

    public function editDrivers(Request $request,$id=null)
    {
        if($request->isMethod('post'))
        {
            $validator = Validator::make($request->all(), [
                        'email' => 'required|email|unique:drivers,email,'.$id,
                    ]);

            if ($validator->fails()) {
                        return redirect()->back()
                                    ->withErrors($validator)
                                    ->withInput();
                    }

            // echo "<pre>"; print_r($validation); die;

            $data = $request->all();

            // echo "<pre>"; print_r($data); die;

            Driver::where(['id'=>$id])->update([
                                                    'name'=>$data['name'],
                                                    'email'=>$data['email'],
                                                    'age'=>$data['age'],
                                                    'mobile_no'=>$data['mobile_no'],
                                                    'license'=>$data['license'],
                                                    'address'=>$data['address']
                                                ]);
            return redirect('/view-drivers')->with('flash_message_success','Driver Data has been updated!!');
        }

        $driverDetails = Driver::where(['id'=>$id])->first();
        return view('admin.drivers.edit_drivers',compact('driverDetails'));
    }

    public function updateDriverStatus(Request $request,$id=null)
    {
        $data = $request->all();
        Driver::where('id',$data['id'])->update(['status'=>$data['status']]);
    }

    public function updateBlockDriverStatus(Request $request,$id=null)
    {
        $data = $request->all();
        Driver::where('id',$data['id'])->update(['block_status'=>$data['block_status']]);
    }

    public function blockedDrivers()
    {
        $blockDriverList = Driver::where(['block_status' => 1 ])->get();
        return view('admin.drivers.blocked_drivers')->with(compact('blockDriverList'));
    }

    public function viewUsers()
    {
        $users = User::all();
        return view('admin.users.view_users',compact('users'));
    }

    public function editUsers(Request $request,$id=null)
    {
        if($request->isMethod('post'))
        {
            $validator = Validator::make($request->all(), [
                        'email' => 'required|email|unique:users,email,'.$id,
                    ]);

            if ($validator->fails()) {
                        return redirect()->back()
                                    ->withErrors($validator)
                                    ->withInput();
                    }

            // echo "<pre>"; print_r($validation); die;

            $data = $request->all();

            // echo "<pre>"; print_r($data); die;

            User::where(['id'=>$id])->update([
                                                    'name'=>$data['name'],
                                                    'email'=>$data['email'],
                                              ]);     
            return redirect('/view-users')->with('flash_message_success','User Data has been updated!!');
        }

        $userDetails = User::where(['id'=>$id])->first();
        return view('admin.users.edit_users',compact('userDetails'));
    }

    public function updateUserStatus(Request $request,$id=null)
    {
        $data = $request->all();
        User::where('id',$data['id'])->update(['status'=>$data['status']]);
    }

    public function updateBlockUserStatus(Request $request,$id=null)
    {
        $data = $request->all();
        User::where('id',$data['id'])->update(['block_status'=>$data['block_status']]);
    }

    public function blockedUsers()
    {
        $blockUserList = User::where(['block_status' => 1 ])->get();
        return view('admin.users.blocked_users')->with(compact('blockUserList'));
    }
    
    public function autoComplete()
    {
        return view('admin.drivers.auto_complete');
    }
}
