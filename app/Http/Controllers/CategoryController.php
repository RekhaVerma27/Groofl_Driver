<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Category;
use Image;

class CategoryController extends Controller
{
    public function addCategory(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();

            $category = new Category;
            $category->category_name = $data['category_name'];

            //Upload image

            if($request->hasFile('image'))
            {
                $img_tmp = $request->file('image');             // isko echo karke check kar sakte hai

                if($img_tmp->isValid())
                {
                    //image path code
                    $extension = $img_tmp->getClientOriginalExtension();
                    $filename  = rand(111,99999).'.'.$extension;
                    $img_path  = 'upload/category/'.$filename;

                    //Image Size
                    Image::make($img_tmp)->resize(500,500)->save($img_path);

                    $category->image = $filename;
                }
            }

            $category->save();

            return redirect('/view-category')->with('flash_message_success','Category has been Successfully Added!!'); 
        }
    	return view('admin.category.add_category');
    }

    public function viewCategory()
    {
        $categories = Category::get();
    	return view('admin.category.view_category',compact('categories'));
    }

    public function updateStatus(Request $request,$id=null)
    {
        $data = $request->all();
        Category::where('id',$data['id'])->update(['status'=>$data['status']]);
    }

    public function editCategory(Request $request,$id=null)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;

            if($request->hasFile('image'))
            {
                $img_tmp = $request->file('image');             

                if($img_tmp->isValid())
                {
                    //image path code
                    $extension = $img_tmp->getClientOriginalExtension();
                    $filename  = rand(111,99999).'.'.$extension;
                    $img_path  = 'upload/category/'.$filename;

                    //Image Size
                    Image::make($img_tmp)->resize(500,500)->save($img_path);
                }
            } 
            else
            {
                $filename = $data['current_image']; 
            }

            Category::where(['id'=>$id])->update([
                                                    'category_name'=>$data['category_name'],
                                                    'image'=>$filename
                                                ]);
            return redirect('/view-category')->with('flash_message_success','Category has been updated!!');
        }
        $categoryDetails = Category::where(['id'=>$id])->first();
        return view('admin.category.edit_category')->with(compact('categoryDetails'));
    }

    public function deleteCategory($id=null)
    {
        Category::where(['id'=>$id])->delete();
        Alert::Success('Deleted','Success Message');
        return redirect()->back();
    }

    public function currentOrders()
    {
    	return view('admin.orders.current_orders');
    }

    public function pastOrders()
    {
    	return view('admin.orders.past_orders');
    }
}
