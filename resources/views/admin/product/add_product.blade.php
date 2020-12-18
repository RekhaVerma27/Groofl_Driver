@extends('admin.layouts.master')
@section('title','Add Product')
@section('content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	   <!-- Content Header (Page header) -->
	   <section class="content-header">
	      <div class="header-icon">
	         <i class="fa fa-product-hunt"></i>
	      </div>
	      <div class="header-title">
	         <h1>Add Product</h1>
	         <small>Add Products</small>
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
	                  <form method="post" action="{{ url('/add-product') }}" enctype="multipart/form-data" class="col-sm-6">
	                  	@csrf

	                  	<div class="form-group">
	                  	   <label>SelectCategory</label>
	                  	   <select name="category" class="form-control">
	                  	   	<option selected="" disabled="">Please Select Category</option>
	                  	   	@foreach($categories_dropdown as $categories_list)
	                  	   	<option value="{{$categories_list->category_name}}">{{$categories_list->category_name}}</option>
	                  	   	@endforeach
	                  	   </select> 
	                  	</div>

	                     <div class="form-group">
	                        <label>Product Name</label>
	                        <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Enter Product Name" required>
	                     </div>
	                     <div class="form-group">
	                        <label>Product Quantity</label>
	                        <input type="text" name="product_quantity" id="product_quantity" class="form-control" placeholder="Enter Product Quantity" required>
	                     </div>
	                     <div class="form-group">
	                        <label>Product Price</label>
	                        <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter Product Price" required>
	                     </div>
	                     <div class="form-group">
	                        <label>Picture upload</label>
	                        <input type="file" name="image">
	                        <input type="hidden" name="old_picture">
	                     </div>
	                     <div class="reset-button">
	                        <input type="submit" name="submit" value="Add Product" class="btn btn-success">
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