<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Product;
use App\Category;
use Image;

class ProductController extends Controller
{
    public function addProduct(Request $request)
    {
    	if($request->isMethod('post'))
    	{
    		$data = $request->all();
    		//dd($data);

    		$product 	= new Product;

            $product->product_name      = $data['product_name'];
    		$product->product_quantity 	= $data['product_quantity'];
    		$product->product_price     = $data['product_price'];
            $product->category          = $data['category'];

    		//Upload image

    		if($request->hasFile('image'))
    		{
    			$img_tmp = $request->file('image');				// isko echo karke check kar sakte hai

    			if($img_tmp->isValid())
    			{
	    			//image path code
	    			$extension = $img_tmp->getClientOriginalExtension();
	    			$filename  = rand(111,99999).'.'.$extension;
	    			$img_path  = 'upload/product/'.$filename;

	    			//Image Size
	    			Image::make($img_tmp)->resize(500,500)->save($img_path);

	    			$product->image = $filename;
    			}
    		}

    		$product->save();
    		return redirect('/view-products')->with('flash_message_success','Product has been Successfully Added!!'); 
    		
    	}
        $categories_dropdown = Category::where(['status'=>1])->get();
        // echo "<pre>"; print_r($categories_dropdown); die;
    	return view('admin.product.add_product')->with(compact('categories_dropdown'));
    }

    public function viewProducts()
    {
    	$products = Product::get();  	

    	return view('admin.product.view_products')->with(compact('products'));
    }

    public function updateStatus(Request $request,$id=null)
    {
        $data = $request->all();
        Product::where('id',$data['id'])->update(['status'=>$data['status']]);
    }

    public function editProduct(Request $request, $id=null)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();

            // echo "<pre>"; print_r($data); die;

            if($request->hasFile('image'))
            {
                $img_tmp = $request->file('image');             

                if($img_tmp->isValid())
                {
                    //image path code
                    $extension = $img_tmp->getClientOriginalExtension();
                    $filename  = rand(111,99999).'.'.$extension;
                    $img_path  = 'upload/product/'.$filename;

                    //Image Size
                    Image::make($img_tmp)->resize(500,500)->save($img_path);
                }
            } 
            else
            {
                $filename = $data['current_image']; 
            }

            Product::where(['id'=>$id])->update([
                                                    'category'=>$data['category'],
                                                    'product_name'=>$data['product_name'],
                                                    'product_quantity'=>$data['product_quantity'],
                                                    'product_price'=>$data['product_price'],
                                                    'image'=>$filename
                                                ]);
            return redirect('/view-products')->with('flash_message_success','Product has been updated!!');
        }
        $productDetails = Product::where(['id'=>$id])->first();
        $categories_dropdown = Category::where(['status'=>1])->get();
        return view('admin.product.edit_product')->with(compact('categories_dropdown','productDetails'));
    }

    public function deleteProduct($id=null)
    {
        Product::where(['id'=>$id])->delete();
        Alert::Success('Deleted','Success Message');
        return redirect()->back();
    }
}
