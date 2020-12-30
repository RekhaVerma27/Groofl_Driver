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

            $category->category_name        = $data['category_name'];
            $category->parent_id            = $data['parent_id'];
            $category->url                  = $data['url'];
            $category->description          = $data['category_description'];
            $category->save();

            return redirect('/view-category')->with('flash_message_success','Category has been Successfully Added!!'); 
        }
        $levels = Category::where(['parent_id'=>0, 'status'=>1])->get();
    	return view('admin.category.add_category',compact('levels'));
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


            Category::where(['id'=>$id])->update([
                                                'category_name'=>$data['category_name'],
                                                'parent_id'=>$data['parent_id'],
                                                'description'=>$data['category_description'],
                                                'url'=>$data['url']
            ]);
            return redirect('/view-category')->with('flash_message_success','Category has been updated!!');
        }
        $levels = Category::where(['parent_id'=>0, 'status'=>1])->get();
        $categoryDetails = Category::where(['id'=>$id])->first();
        return view('admin.category.edit_category')->with(compact('categoryDetails','levels'));
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
