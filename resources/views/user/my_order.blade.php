@extends('user.layouts.master')
@section('title','My Orders')
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
        <div class="container">
            <center><h1 style="font-size: 55px">My Orders</h1></center>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Order Id</th>
                                    <th>Ordered Product</th>
                                    <th>Payment Method</th>
                                    <th>Grand Total</th>
                                    <th>Ordered Date</th>
                                    <th>Order Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($orders as $order)
                            	<tr>
                            		<td>{{$order->id}}</td>
                        			<td>@foreach($order->orders as $key=> $orderPro)
                        				{{$orderPro->product_name}} ({{$orderPro->product_quantity}}) <br>
                        			@endforeach</td>
                            		<td>{{$order->payment_method}}</td>
                            		<td>{{$order->grand_total}}</td>
                            		<td>{{$order->created_at}}</td>
                            		<td>{{$order->order_status}}</td>
                            		<td>
                            			<a href="">View Details</a>
                            		</td>
                            	</tr>
                            	@endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Cart -->

@endsection