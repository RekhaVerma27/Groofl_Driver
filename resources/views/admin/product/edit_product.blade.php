@extends('admin.layouts.master')
@section('title','Edit Product')
@section('content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	   <!-- Content Header (Page header) -->
	   <section class="content-header">
	      <div class="header-icon">
	         <i class="fa fa-product-hunt"></i>
	      </div>
	      <div class="header-title">
	         <h1>Edit Product</h1>
	         <small>Edit Products</small>
	      </div>
	   </section>

	   <!-- ======================================================================================== -->

	   @if(Session::has('flash_message_success'))
	   	<div class="alert alert-sm alert-success alert-block" role="alert">
	   		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	   			<span aria-hidden="true">&times;</span>
	   		</button>
	   		<strong>{!! session('flash_message_success') !!}</strong>
	   	</div>
	   @endif

	   @if(Session::has('flash_message_error'))
	   	<div class="alert alert-sm alert-danger alert-block" role="alert">
	   		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	   			<span aria-hidden="true">&times;</span>
	   		</button>
	   		<strong>{!! session('flash_message_error') !!}</strong>
	   	</div>
	   @endif

	   <!-- ======================================================================================== -->

	   <!-- Main content -->
	   <section class="content">
	      <div class="row">
	         <!-- Form controls -->
	         <div class="col-sm-12">
	            <div class="panel panel-bd lobidrag">
	               <div class="panel-heading">
	                  <div class="btn-group" id="buttonlist"> 
	                     <a class="btn btn-add " href="{{url('view-products')}}"> 
	                     <i class="fa fa-list"></i>  View Products </a>  
	                  </div>
	               </div>
	               <div class="panel-body">
	                  <form method="post" action="{{ url('/edit-product/'.$productDetails->id) }}" enctype="multipart/form-data" class="col-sm-6">
	                  	@csrf

	                  	{{--<div class="form-group">
	                  	   <label>SelectCategory</label>
	                  	   <select name="category" class="form-control">
	                  	   	<!-- <option selected="" disabled="">Please Select Category</option> -->
	                  	   	@foreach($categories_dropdown as $categories_list)
	                  	   	<option {{ $categories_list->category_name == $productDetails->category ? 'selected':'' }} value="{{$categories_list->category_name}}">{{$categories_list->category_name}}</option>
	                  	   	@endforeach
	                  	   </select> 
	                  	</div>--}}

	                  	{{-- <div class="form-group">
	                  	    <label>Under Category</label>
	                  	    <select name="category_id" id="category_id" class="form-control">
	                  	    	<?php echo $categories_dropdown; ?>
	                  	    </select>
	                  	 </div> --}}

	                  	 <div class="form-group">
	                    	<label>Category</label>
                        	<select class="form-control" name="category" id="category">
                            <!-- <option selected>Select category</option> -->
                            @foreach ($categories as $item)
                            <option value="{{ $item->id }}" @if( $item->id == $procat) selected @endif>{{ $item->category_name }}</option>
                            @endforeach
                        </select>
	                    </div>
	                    
                      
                        <div class="form-group">
	                    	<label>Subcategory</label>
                        	<select class="form-control" name="subcategory" id="subcategory">
                            
                        	</select>
	                    </div>

	                     <div class="form-group">
	                        <label>Product Name</label>
	                        <input type="text" name="product_name" value="{{$productDetails->product_name}}" id="product_name" class="form-control" placeholder="Enter Product Name" required>
	                     </div>
	                     <div class="form-group">
	                        <label>Product Quantity</label>
	                        <input type="text" name="product_quantity" value="{{$productDetails->product_quantity}}" id="product_quantity" class="form-control" placeholder="Enter Product Quantity" required>
	                     </div>
	                     <div class="form-group">
	                        <label>Product Price</label>
	                        <input type="number" name="product_price" value="{{$productDetails->product_price}}" id="product_price" class="form-control" placeholder="Enter Product Price" required>
	                     </div>
	                     <div class="form-group">
	                        <label>Picture upload</label>
	                        <input type="file" name="image">
	                        <input type="hidden" name="current_image" value="{{ $productDetails->image }}">
	                        @if(!empty($productDetails->image))
	                        	<img style="width: 100px; margin-top: 10px;" src="{{ url('/upload/product/'.$productDetails->image) }}">
	                        @endif
	                     </div>
	                     <div class="reset-button">
	                        <input type="submit" name="submit" value="Edit Product" class="btn btn-success">
	                     </div>
	                  </form>
	               </div>
	            </div>
	         </div>
	      </div>
	   </section>
	   <!-- /.content -->
	</div>

	<!-- /.content-wrapper -->
@endsection