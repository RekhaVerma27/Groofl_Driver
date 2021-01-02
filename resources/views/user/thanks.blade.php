@extends('user.layouts.master')
@section('title','Thanks')
@section('content')

    <!-- Start Cart  -->
    <div class="cart-box-main">
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
        <div class="cart-box-main">
            <div class="container">
                <h1 align="center">Thanks For Purchasing With Us!</h1> <br/><br/>
                <div class="row">
                    <div class="col-lg-12">
                        <div align="center">
                            <h2>Your COD order has been placed !!</h2>
                            <p>Your Order Number is {{Session::get('order_id')}} and Total Payable about is Rs. {{Session::get('grand_total')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <!-- End Cart -->

    <?php

    Session::forget('order_id');
    Session::forget('grand_total');

    Session::forget('CouponCode');
    Session::forget('CouponAmount');

    ?>

@endsection