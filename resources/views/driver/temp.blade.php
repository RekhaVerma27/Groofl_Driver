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
                // echo $kk = Auth::guard('driver')->id; die;
                // echo $kk = auth()->guard('driver')->id(); die;
                 // $user = Driver::where('email',session('driverSession'))->first();
                // $notification = $user->notifications()->where('id',$notification_id)->first(); 
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