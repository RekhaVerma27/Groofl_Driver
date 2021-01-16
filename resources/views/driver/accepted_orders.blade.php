
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awasome -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Driver Dashoard</title>
  </head>
  <body>

    @include('driver.layouts.header')
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
		                  				<option value="Processing" @if($order->order_status == 'Processing') selected @endif>Processing</option>
		                  				<option value="Pick up" @if($order->order_status == 'Pick up') selected @endif>Pick up</option>
		                  				<option value="On the way" @if($order->order_status == 'On the way') selected @endif>On the way</option>
		                  				<option value="Delivered" @if($order->order_status == 'Delivered') selected @endif>Delivered</option>
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

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </body>
</html>