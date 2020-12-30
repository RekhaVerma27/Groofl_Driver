@extends('admin.layouts.master')
@section('title','edit Coupon')
@section('content')

<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	   <!-- Content Header (Page header) -->
	   <section class="content-header">
	      <div class="header-icon">
	         <i class="fa fa-product-hunt"></i>
	      </div>
	      <div class="header-title">
	         <h1>Edit Coupon</h1>
	         <small>Edit Coupons</small>
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
	                  <form method="post" action="{{ url('/edit-coupon/'.$couponDetails->id) }}" enctype="multipart/form-data" class="col-sm-6" name="edit_coupon" id="edit_coupon">
	                  	@csrf
	                     <div class="form-group">
	                        <label>Coupon Code</label>
	                        <input type="text" name="coupon_code" id="coupon_code" class="form-control" value="{{ $couponDetails->coupon_code }}" required>
	                     </div>
	                     <div class="form-group">
	                        <label>Amount</label>
	                        <input type="text" name="amount" id="amount" class="form-control" value="{{ $couponDetails->amount }}" required>
	                     </div>
	                     <div class="form-group">
	                        <label>Amount Type</label>
	                        <select name="amount_type" id="amount_type" class="form-control">
	                        	<option @if($couponDetails->amount_type=="Percentage") selected @endif value="Percentage">Percentage</option>
	                        	<option @if($couponDetails->amount_type=="Fixed") selected @endif value="Fixed">Fixed</option>
	                        </select>
	                     </div>
	                     <div class="form-group">
	                        <label>Expiry Date</label>
	                        <input type="text" name="expiry_date" value="{{ $couponDetails->expiry_date }}" id="datepicker" class="form-control" required>
	                     </div>
	                     <div class="reset-button">
	                        <input type="submit" name="submit" value="Edit Coupon" class="btn btn-success">
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