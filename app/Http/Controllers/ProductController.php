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

            // $product->category_id       = $data['category_id'];
            $product->category_id       = $data['subcategory'];
            $product->product_name      = $data['product_name'];
    		$product->product_quantity 	= $data['product_quantity'];
    		$product->product_price     = $data['product_price'];

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
        // $categories_dropdown = Category::where(['status'=>1])->get();
        // echo "<pre>"; print_r($categories_dropdown); die;

        // Category Dropdown Code
            $categories = Category::where(['parent_id'=>0, 'status'=>1])->get();
            // echo "<pre>"; print_r($categories); die;
            $categories_dropdown = "<option value='' selected disabled >Select</option>";

            foreach($categories as $cat)
            {
                $categories_dropdown .= "<option value='".$cat->id."'>".$cat->category_name."</option>";
                $sub_categories = Category::where(['parent_id'=>$cat->id, 'status'=>1])->get();
                // echo "<pre>"; print_r($sub_categories); die;
                foreach($sub_categories as $sub_cat)
                {
                    $categories_dropdown .="<option value='".$sub_cat->id."'>&nbsp;--&nbsp;".$sub_cat->category_name."</option>";
                }
            }
            // echo "<pre>"; print_r($categories_dropdown); die;

        // $categoris = Category::where('parent_id',0)->get();

    	return view('admin.product.add_product')->with(compact('categories_dropdown','categories'));
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
                                                    // 'category_id'=>$data['category_id'],
                                                    'category_id'=>$data['subcategory'],
                                                    'product_name'=>$data['product_name'],
                                                    'product_quantity'=>$data['product_quantity'],
                                                    'product_price'=>$data['product_price'],
                                                    'image'=>$filename
                                                ]);
            return redirect('/view-products')->with('flash_message_success','Product has been updated!!');
        }
        $productDetails = Product::where(['id'=>$id])->first();

        $parent_id = Category::where(['id'=>$productDetails->category_id])->first()->parent_id;
        $subcat_id = Category::where(['id'=>$productDetails->category_id])->first()->id;

        // $categories_dropdown = Category::where(['status'=>1])->get();

        // Category Dropdown Code
            $categories  = Category::where(['parent_id'=>0, 'status'=>1])->get();
            $categories_dropdown = "<option value='' selected disabled >Select</option>";

            foreach($categories as $cat)
            {
                if($cat->id==$productDetails->category_id)
                {
                    $selected = "selected";
                }
                else
                {
                    $selected = "";
                }

                $categories_dropdown .="<option value='".$cat->id."' ".$selected.">".$cat->category_name."</option>";
            
                // Code for Sub Categories
                    $sub_categories = Category::where(['parent_id'=>$cat->id, 'status'=>1])->get();

                    foreach($sub_categories as $sub_cat)
                    {
                        if($sub_cat->id==$productDetails->category_id)
                        {
                            $selected = "selected";
                        }
                        else
                        {
                            $selected = "";
                        }

                        $categories_dropdown .="<option value='".$sub_cat->id."' ".$selected.">&nbsp;--&nbsp".$sub_cat->category_name."</option>";
                    } // second foreach end
            } // first foreach end
        return view('admin.product.edit_product')->with(compact('categories_dropdown','productDetails', 'categories','parent_id','subcat_id'));
    }

    public function deleteProduct($id=null)
    {
        Product::where(['id'=>$id])->delete();
        Alert::Success('Deleted','Success Message');
        return redirect()->back();
    }
}
