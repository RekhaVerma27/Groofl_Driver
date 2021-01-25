@extends('driver.layouts.master')


@section('content')    
<div class="container">
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

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2>Accepted Orders</h2></div>
                <table class="table">
                  <thead>
                    <tr>
                      <th>Order Id</th>
                      <th>Ordered Product</th>
                      <th>Payment Method</th>
                      <th>Grand Total</th>
                      <th>Ordered Date</th>
                      <th>Order Status</th>
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

                      		<form action="{{url('/update-order-status/'.$order->id)}}" method="post">@csrf
		                  		<td>
		                  			<select name="order_status">
		                  				<option disabled="">--Select Status--</option>
		                  				<option value="New"        @if($order->order_status == 'New')        selected @endif>New</option>
		                  				<option value="Pending"    @if($order->order_status == 'Pending')    selected @endif>Pending</option>
		                  				<option value="In Process" @if($order->order_status == 'In Process') selected @endif>In Process</option>
		                  				<option value="Shipped"    @if($order->order_status == 'Shipped')    selected @endif>Shipped</option>
                              <option value="Delivered"  @if($order->order_status == 'Delivered')  selected @endif>Delivered</option>
                              <option value="Cancelled"  @if($order->order_status == 'Cancelled')  selected @endif>Cancelled</option>
                              <option value="Paid"       @if($order->order_status == 'Paid')       selected @endif>Paid</option>
		                  			</select>

		                  			<input type="submit" name="" value="Update Status" class="btn-sm btn-success">
		                  		</td>
                      	    </form>

                      	</tr>
                      	@endforeach
                      </tbody>
                </table>

            </div>
            <br>
        </div>
    </div>
</div>
@endsection