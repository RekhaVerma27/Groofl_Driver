<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Driver;
use App\Orders;
use Session;
use Auth;
class DriverController extends Controller
{
    public function driverLogin(Request $request)
    {
    	if($request->isMethod('post'))
    	{
    		$data = $request->input();
	         $driverCount = Driver::where(['email'=>$data['email'],'password'=>md5($data['password'])])->count();
	         // echo "<pre>"; print_r($adminCount); die;

	         if($driverCount>0)
	         {
	         	// $kk = Auth::guard('driver')->user()->age;

	         	// echo "<pre>"; print_r($kk); die;
	         	$driver = Driver::where(['email'=>$data['email'],'password'=>md5($data['password'])])->first();

	         	// echo $driver->name; die;

	         	// echo "<pre>"; print_r($id); die;

	            Session::put('driverSession',$data['email']);
                if($driver->status == 0)
                {
                    return redirect()->back()->with('flash_message_error','Waiting for Admin Approval');
                }

	             // return redirect('/driver-dashboard')->with(compact('driver'));
	             return view('driver.driver_dashboard')->with(compact('driver'));
	         }
	         else
	         {
	             return redirect('/driver-login')->with('flash_message_error','Invalid Username or Password');
	         }
    	}
    	return view('driver.driver_login');
    }

    public function driverRegister(Request $request)
    {
    	if($request->isMethod('post'))
    	{
    		$data = $request->all();
            // echo "<pre>"; print_r($data); die;
    		$driver = new Driver;

    		$driver->name       = $data['name'];
    		$driver->email      = $data['email'];
    		$driver->password   = md5($data['password']);
            $driver->latitude   =  '';
            $driver->longitude  =  '';
            $driver->age        = $data['age'];
            $driver->mobile_no  = $data['mobile_no'];
            $driver->license    = $data['license'];
            $driver->address    = $data['address'];

    		$driver->save();
    		// Session::put('driverSession',$data['email']);
    		return redirect('/driver-login')->with('flash_message_success','Register Successfully!! Please Login');
    	}
    	return view('driver.driver_register');
    }

    public function driverDashboard()
    {
    	return view('driver.driver_dashboard');
    }

    public function driverLogout()
    {
        Session::forget('driverSession');
        return redirect('/driver-login')->with('flash_message_success','loged out Successfully!!');
    }

    public function driverLatLng(Request $request,$id=null)
    {
        if($request->isMethod('post'))
        {
            $data = $request->Input();
            // echo "<pre>"; print_r($data); die;
             $latitude = $data['latitude'];
            $longitude = $data['longitude'];

            // echo "<pre>"; print_r($data); die;

            if(true)
            {
                

                // $id = Driver::user()->id;
            	// echo $id; die;
                Driver::where('id',$id)->update([
                                                'latitude'=>$latitude,
                                                'longitude'=>$longitude,
                                                ]);
               // echo  $latitude = $data['latitude'];
               //  echo $longitude = $data['longitude'];
                $driver = Driver::where(['id'=>$id])->first();
                // echo $loc ; die;
                // return redirect('home')->with(compact('data'));
                return view('driver.driver_dashboard')->with(compact('driver'));
            }
            else
            {
                return redirect()->back()->with('flash_message_error','Invalid Username Or Paasword');
            }

        }
        //sleep(500000);

         return redirect('/home');
    }

    public function driverMap(Request $request,$id=null)
    {

        $locationDetails = Driver::find($id);    // user
        $driver = Driver::find($id);    // user
        $locations = Driver::get();    // all data from user table

        // echo "<pre>"; print_r($locations); die;

        return view('driver.driver_map',compact('locationDetails','locations','driver'));
    }

    public function orders()
    {
        // echo "rekha";

        // echo Session::get('driverSession'); die;

        $driver = Driver::where(['email'=>Session::get('driverSession')])->first();

        $orders = Orders::all();

        // return redirect('/driver-dashboard')->with(compact('orders','driver'));
        return view('driver.driver_dashboard')->with(compact('orders','driver'));
        // echo "string";
    }
    
}
