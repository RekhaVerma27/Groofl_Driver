<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function viewProducts(Request $req)
    {
    	$products = Product::get();

    	if($products->count()){
           return response()->json($data = [
           'status' => 200,
           'msg'=>'Success',
           'product' => $products
           ]);
       }
       else{
           return response()->json($data = [
           'status' => 201,
           'msg' => 'Data Not Found'
           ]);
       }
    }
}
