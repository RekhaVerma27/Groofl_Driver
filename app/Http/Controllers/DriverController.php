<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Notification;
use App\Driver;
use App\DriverAcceptedOrder;
use App\User;
use App\Orders;
use App\OrdersProduct;
use Session;
use Auth;
use Illuminate\Support\Facades\Hash;

class DriverController extends Controller
{
    // use AuthenticatesUsers; 

    /**
     * Create a new controller instance.
     *
     * @return void
     */

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

                // $user = Driver::where(['email'=>Session::get('driverSession')])->first();

                // foreach ($user->unreadNotifications as $notification) {
                //     // echo $notification->type;
                //     // echo $notification->id;
                //     // echo $notification->data['letter']['title'];
                // }
                // die;

                 return view('driver.driver_dashboard')->with(compact('driver'));
             }
             else
             {
                 return redirect('/driver-login')->with('flash_message_error','Invalid Username or Password');
             }

             // $order = Orders::all();

             //        if($order!=null)
             //        {
             //            // echo "<pre>"; print_r($order)->with('flash_message_success','Successfully'); die;
             //           echo return view('driver.driver_login')->with('flash_message_success','Successfully'); die;
             //        }

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
            // $driver->password   = Hash::make($data['password']);
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
        // $driver = Driver::where('email'=>Session::get('driverSession'))->first();
        $driver = Driver::where(['email'=>Session::get('driverSession')])->first();
    	return view('driver.driver_dashboard')->with(compact('driver'));
    }

    public function driverLogout()
    {
        // Auth::guard('driver')->logout();
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
                // echo $kk = Auth::guard('driver')->id; die;
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

    public function markAsRead()
    {
        $driver = Driver::where(['email'=>Session::get('driverSession')])->first();

        $driver->unreadNotifications->markAsRead();
        // return redirect()->back();
        return view('driver.driver_dashboard')->with(compact('driver'));
    } 

    public function markAsUnRead()
    {
        $driver = Driver::where(['email'=>Session::get('driverSession')])->first();

        // $driver->readNotifications->markAsUnRead();
        $driver->readNotifications()->update(['read_at' => null]);
        // return redirect()->back();
        return view('driver.driver_dashboard')->with(compact('driver'));
    }

    public function viewNotification(Request $request, $order_id = null, $notificationid=null)
    {
        // echo $notificationid; die;
        $driver = Driver::where(['email'=>Session::get('driverSession')])->first();
        // echo $order_id; die;
        $orderDetails = Orders::where(['id'=>$order_id])->first();
        // echo "<pre>"; print_r($orderDetails); die;

        $orderProducts = OrdersProduct::where(['order_id'=>$order_id])->get();
        // echo "<pre>"; print_r($orderProducts); die;

        // $notification = $driver->notifications()->find($notificationid);
        // if($notification) {
        //     $notification->markAsRead();
        // }

        return view('driver.view_notification')->with(compact('driver','orderDetails','orderProducts','notificationid'));
    }

    public function driverAcceptOrder($order_id = null, $notificationid = null)
    {
        // echo "rekha";
        $driver_id = Driver::where(['email'=>Session::get('driverSession')])->first()->id;
        
        $drivers = Driver::get();
        
        // echo $order_id; echo "<br>";
        // echo $driver_id; die;

        // $accept = new DriverAcceptedOrder;

        // $accept->order_id = $order_id;
        // $accept->driver_id = $driver_id;

        // $accept->save();

        Orders::where(['id'=>$order_id])->update([
                                                'driver_id' => $driver_id,
        ]);

        // $notification = $driver->notifications()->find($notificationid);
        // if($notification) {
        //     $notification->delete();
        // }

        foreach ($drivers as $driver){
            // dd($driver->notifications);die;
            foreach ($driver->notifications as $notification) {
                // dd($notification->data);die;
                $allorderid = $notification->data['letter']['body'];
                // echo "<pre>"; print_r($notification->data); die;

                if($allorderid==$order_id)
                {
                    // echo "true";
                    // $notification->delete();
                    $notification->markAsRead();
                }
            }
        }
        // die;

        // echo "done"; die;
        $driver = Driver::where(['email'=>Session::get('driverSession')])->first();
        return view('driver.driver_dashboard')->with(compact('driver'));
    }
    
    public function driverDismissOrder(Request $request, $order_id = null, $notificationid=null)
    {
        // echo $notificationid; echo "<br>"; echo $order_id;

        $driver = Driver::where(['email'=>Session::get('driverSession')])->first();

        $notification = $driver->notifications()->find($notificationid);
        if($notification) {
            $notification->markAsRead();
        }

        return view('driver.driver_dashboard')->with(compact('driver'));

    }

    public function acceptedOrders()
    {
        $driver = Driver::where(['email'=>Session::get('driverSession')])->first();
        
        $driver_id = Driver::where(['email'=>Session::get('driverSession')])->first()->id;

        // $driver->id;

        // $order_ids = DriverAcceptedOrder::where(['driver_id'=>$driver_id])->get('order_id');
        // // echo "<pre>"; print_r($order_id); die;
        // foreach($order_ids as $order_id)
        // {
        //     $orders  = Orders::where(['id'=>$order_id])->get();

        //     echo "<pre>"; print_r($orders); die;
        // }

        $orders  = Orders::where(['driver_id'=>$driver_id])->get();

        // echo "<pre>"; print_r($orders); die;

        return view('driver.accepted_orders')->with(compact('driver','orders'));
    }

    public function updateOrderStatus(Request $request, $id=null)
    {
        // echo "rekha";
        if($request->isMethod('post'))
        {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            Orders::where(['id'=>$id])->update([
                                                'order_status' => $data['order_status'],
            ]);

            return redirect()->back()->with('flash_message_success','Order Status Updated!');
        }
        
        return redirect()->back();
    }
}
