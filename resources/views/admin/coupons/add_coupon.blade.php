@extends('admin.layouts.master')
@section('title','Add Coupon')
@section('content')

<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	   <!-- Content Header (Page header) -->
	   <section class="content-header">
	      <div class="header-icon">
	         <i class="fa fa-product-hunt"></i>
	      </div>
	      <div class="header-title">
	         <h1>Add Coupon</h1>
	         <small>Add Coupons</small>
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
	                     <a class="btn btn-add " href="{{ url('/view-coupons') }}"> 
	                     <i class="fa fa-list"></i>  View Coupons </a>  
	                  </div>
	               </div>
	               <div class="panel-body">
	                  <form method="post" action="{{ url('/add-coupon') }}" enctype="multipart/form-data" class="col-sm-6" name="add_coupon" id="add_coupon">
	                  	@csrf
	                     <div class="form-group">
	                        <label>Coupon Code</label>
	                        <input type="text" name="coupon_code" id="coupon_code" class="form-control" placeholder="Enter Coupon Code" required>
	                     </div>
	                     <div class="form-group">
	                        <label>Amount</label>
	                        <input type="text" name="amount" id="amount" class="form-control" placeholder="Enter Amount" required>
	                     </div>
	                     <div class="form-group">
	                        <label>Amount Type</label>
	                        <select name="amount_type" id="amount_type" class="form-control">
	                        	<option value="Percentage">Percentage</option>
	                        	<option value="Fixed">Fixed</option>
	                        </select>
	                     </div>
	                     <div class="form-group">
	                        <label>Expiry Date</label>
	                        <input type="text" name="expiry_date" id="datepicker" class="form-control" autocomplete="off" required>
	                     </div>
	                     <div class="reset-button">
	                        <input type="submit" name="submit" value="Add Coupon" class="btn btn-success">
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