<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;
use App\Cart;
use App\Coupons;
use App\Category;
use Session;
use Illuminate\Support\Str;
use Auth;
use DB;

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
                $user = User::where(['email'=>$data['email'],'password'=>md5($data['password'])])->first();

	            Session::put('userSession',$data['email']);

                if($user->status == 0)
                {
                    return redirect()->back()->with('flash_message_error','Waiting for Admin Approval');
                }
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
            // Session::put('userSession',$data['email']);
    		// return redirect('/user-dashboard');
            return redirect('/user-login')->with('flash_message_success','Register Successfully!! Please Login');
    	}
    	return view('user.user_register');
    }

    public function userDashboard()
    {
        $products = Product::where(['status'=>1])->get();
        // $categories = Category::where(['status'=>1])->get();
        $categories = Category::with('categories')->where(['parent_id'=>0, 'status'=>1])->get();
        // $products = Products::paginate(2);
        // echo "<pre>"; print_r($categories);die;

    	return view('user.user_dashboard',compact('products','categories'));
    }

    public function userLogout()
    {
        Session::forget('userSession');
        return redirect('/user-login')->with('flash_message_success','loged out Successfully!!');
    }

    public function productDetails($id=null)
    {
        // echo $id; die;
        $categories = Category::where(['status'=>1])->get();
        $productDetails = Product::where(['id'=>$id])->first();
        // echo "<pre>"; print_r($productDetails); die; 
        return view('user.product_details',compact('productDetails','categories'));
    }

    public function addtoCart(Request $request)
    {
        // echo "kukkk"; die;
        if($request->session()->has('userSession'))
        {
            //return "hello";

            // echo $kk = Session::get('userSession'); die;

            $data = $request->all();

            // echo "<pre>"; print_r($data); die;

            // if(empty(Session::get('userSession')))
            // {
            //    echo $data['user_email'] = '';
            // }
            // else
            // {
            //    echo $data['user_email'] = Session::get('userSession');
            // }

            $session_id = Session::get('session_id');

            if(empty($session_id))
            {
                $session_id = Str::random(40);
                Session::put('session_id',$session_id);
            }

            $countProducts = DB::table('carts')->where([
                                                        'product_id'=>$data['product_id'],
                                                        'product_name'=>$data['product_name'],
                                                        'product_price'=>$data['product_price'],
                                                        'product_quantity'=>$data['product_quantity'],
                                                        'session_id'=>$session_id,
                            ])->count();
            if($countProducts>0)
            {
                return redirect()->back()->with('flash_message_error','Product Already exists in Cart!');
            }
            else
            {
                DB::table('carts')->insert([
                                            'product_id'=>$data['product_id'],
                                            'product_name'=>$data['product_name'],
                                            'product_price'=>$data['product_price'],
                                            'product_quantity'=>$data['product_quantity'],
                                            // 'user_email'=>$data['user_email'],
                                            'session_id'=>$session_id,
                ]);
            }

            return redirect('/user-dashboard')->with('flash_message_success','Product has been added in Cart !!');
        }
        else
        {
            return redirect('/user-login');
        }
    }

    public function categories($category_id)
    {
        $categories = Category::where(['status'=>1])->get();
        $products = Product::where(['category_id'=>$category_id])->get();
        $category_name = Category::where(['id'=>$category_id])->first();
        return view('user.category_products')->with(compact('categories','products','category_name'));
    }

    public function cart(Request $request)
    {
        
        // if(Session::has('userSession'))                       // extra video 56
        // {            
        //     $user_email = Auth::user()->email;
        //     $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get(); 
        // } 
        // else
        // {
            $session_id = Session::get('session_id');
            $userCart = DB::table('carts')->where(['session_id'=>$session_id])->get();
        // }                                       // 56 end
       

        foreach($userCart as $key=>$products)
        {
            // echo $products->product_id;

            $productDetails = Product::where(['id'=>$products->product_id])->first();
            // $userCart[$key]->image = "Test";
            $userCart[$key]->image = $productDetails->image;

        }

        // echo "<pre>"; print_r($userCart); die;
        return view('user.cart')->with(compact('userCart'));
    }

// ====================================== Start Update Quantity ============================
    public function updateCartQuantity($id=null,$quantity=null)
    {
        DB::table('carts')->where('id',$id)->increment('product_quantity',$quantity);
        return redirect('/cart')->with('flash_message_success','Product Quantity has been Updated Successfully!');
    }
// ====================================== End Update Quantity ============================

// ====================================== Start Delete Cart ============================
    public function deleteCartProduct($id=null)
    {
        DB::table('carts')->where('id',$id)->delete();
        return redirect('/cart')->with('flash_message_error','Product has been deleted!');
    }
// ====================================== End Delete Cart ============================

// ====================================== Start Apply Coupon Code ============================
    public function applyCoupon(Request $request)
    {
        if($request->coupon_code == Session::get('CouponCode'))
        {
            return redirect()->back()->with('flash_message_error','This Coupon is Already Applied!');
        }

        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        if($request->isMethod('post'))
        {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $couponCount = Coupons::where('coupon_code',$data['coupon_code'])->count();
            if($couponCount == 0)
            {
                return redirect()->back()->with('flash_message_error','Coupon code does not exists !');
            }
            else
            {
                // echo "Success"; die;
                $couponDetails = Coupons::where('coupon_code',$data['coupon_code'])->first();

                // Coupon code status
                if($couponDetails->status==0)
                {
                    return redirect()->back()->with('flash_message_error','Coupon Code is not Active !');
                }
                
                // Check Coupon Expiry Data
                $expiry_date = $couponDetails->expiry_date;
                $current_date = date('Y-m-d');
                if($expiry_date < $current_date)
                {
                    return redirect()->back()->with('flash_message_error','Coupon Code is Expired');
                }

                //--------------------------------- Coupon is Ready for discount
                // $session_id = Session::get('session_id');
                // $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get(); //old

                if(Auth::check())                       // extra video 56
                {            
                    $user_email = Auth::user()->email;
                    $userCart = DB::table('carts')->where(['user_email'=>$user_email])->get(); 
                } 
                else
                {
                    $session_id = Session::get('session_id');
                    $userCart = DB::table('carts')->where(['session_id'=>$session_id])->get();
                }                                       // 56 end

                $total_amount = 0;
                foreach($userCart as $item)
                {
                    $total_amount = $total_amount + ($item->product_price*$item->product_quantity);
                }
                
                // echo $total_amount; die;

                //--------------------------------- Coupon is Ready for discount end

                // Check if Coupon amount is fixed or percentage
                if($couponDetails->amount_type=="Fixed")
                {
                     $couponAmount = $couponDetails->amount;
                }
                else
                {
                    $couponAmount = $total_amount * ($couponDetails->amount/100);
                }

                // Add Coupon Code in Session
                Session::put('CouponAmount',$couponAmount);
                Session::put('CouponCode',$data['coupon_code']);
                return redirect()->back()->with('flash_message_success','Coupon Code is Successfully Applied, you are availing Discount');

            } // secound if end
        } // first if end
    }
// ====================================== End Apply Coupon Code ============================

    public function addAddress(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            $id = User::where(['email'=>Session::get('userSession')])->first()->id;
            // echo "<pre>"; print_r($data); die;
            // echo "<pre>"; print_r($kk); die;

            DB::table('addresses')->insert([
                'user_id' => $id,
                'address' => $data['address'],
                'country' => $data['country'],
                'state'   => $data['state'],
                'city'    => $data['city'],
                'pincode' => $data['pincode']
            ]);

            return redirect('/view-address')->with('flash_message_success','Address Successfully Added!');

            // Auth::guard('user')user()->id;
        }
        return view('user.add_address');
    }

    public function viewAddress()
    {
        $id = User::where(['email'=>Session::get('userSession')])->first()->id;

        $addresses = DB::table('addresses')->where(['user_id'=>$id])->get();
        // echo "<pre>"; print_r($addresses); die;
        return view('user.view_address',compact('addresses'));
    }

    public function checkoutPage()
    {
        $id = User::where(['email'=>Session::get('userSession')])->first()->id;

        $addresses = DB::table('addresses')->where(['user_id'=>$id])->get();
        // echo "<pre>"; print_r($addresses); die;
        return view('user.checkout_page',compact('addresses'));
    }

    public function orderReview(Request $request)
    {
        // echo "rekhas"; die;
        if($request->isMethod('post'))
        {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $addressData = DB::table('addresses')->where(['id'=>$data['address_id']])->first();
            // echo $addressData->address; die;
            // echo "<pre>"; print_r($addressData); die;

            DB::table('delivery_addresses')->insert([
                                               'user_id'=>$addressData->user_id,
                                               'address'=>$addressData->address,
                                               'country'=>$addressData->country,
                                               'state'  =>$addressData->state,
                                               'city'   =>$addressData->city,
                                               'pincode'=>$addressData->pincode,

            ]);
            return "Rekha";
        }
        
    }
} //main end


