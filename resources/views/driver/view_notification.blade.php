
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

  <div class="container">
 	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>



  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          @if($driver->unreadNotifications->count() )
            <span class="badge badge-danger"> {{$driver->unreadNotifications->count()}}</span>
            @endif
            <span><i class="fa fa-bell"></i></span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="btn btn-link"  href="{{route('markAsRead')}}">Mark All as Read</a>
          @foreach($driver->unreadNotifications as $notification)
            <a class="dropdown-item">
                {{--{{ $notification->type }}--}}

                {{ $notification->data['letter']['title'] }}
            </a>
            @endforeach
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{$driver->name}}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{url('/driver-map/'.$driver->id)}}">Driver Map</a>
          <a class="dropdown-item" href="{{url('/driver-logout')}}">Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
</div>
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

        
           {{-- @foreach($driver->unreadNotifications as $notifications)
                <div class="alert alert-sm alert-success alert-block" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>{{ $notifications->data['letter']['title'] }}</strong>
            </div>
            @endforeach
    
        <div class="col-md-12">
            <!-- <h2>Read Notifications</h2> -->
            @foreach($driver->readNotifications as $readnotifications)
                <h4>{{ $readnotifications->data['letter']['title'] }}</h4>
            @endforeach
        </div>
        --}} <br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>Customer Detail</h2></div>

                <div class="card-body">
                  <form>
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label"><h6>Name</h6></label>
                      <div class="col-sm-4">
                        <input type="text" readonly class="form-control-plaintext" value="{{$orderDetails->name}}">
                      </div>
                      <label for="staticEmail" class="col-sm-2 col-form-label"><h6>Email</h6></label>
                      <div class="col-sm-4">
                        <input type="text" readonly class="form-control-plaintext" value="{{$orderDetails->user_email}}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <!-- <label for="staticEmail" class="col-sm-2 col-form-label"><h6>Mobile No</h6></label>
                      <div class="col-sm-4">
                        <input type="text" readonly class="form-control-plaintext" >
                      </div> -->
                      <label for="staticEmail" class="col-sm-2 col-form-label"><h6>Address</h6></label>
                      <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" value="{{$orderDetails->address}}, {{$orderDetails->city}}, {{$orderDetails->state}} {{$orderDetails->pincode}}">
                      </div>
                    </div>
                  </form>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header"><h2>Order Detail</h2></div>

                <div class="card-body">
                 
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">S.No.</th>
                        <th scope="col">Item Description</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $key=1; ?>
                      @foreach($orderProducts as $orderProduct)
                      <tr>
                        <th scope="row">{{$key++}}</th>
                        <td>{{$orderProduct->product_name}}</td>
                        <td>{{$orderProduct->product_quantity}}</td>
                        <td>{{$orderProduct->product_price}}</td>
                        <td>{{$orderProduct->product_quantity * $orderProduct->product_price}} </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table><br>
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-4 col-form-label"><h6>Sub Total</h6></label>
                      <div class="col-sm-4">
                        <input type="text" readonly class="form-control-plaintext" value="Rs. {{$orderDetails->grand_total}}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-4 col-form-label"><h6>Delivery Charge</h6> </label>
                      <div class="col-sm-4">
                        <input type="text" readonly class="form-control-plaintext" value="Rs. {{$orderDetails->shipping_charges}}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-4 col-form-label"><h6>Total Amount</h6></label>
                      <div class="col-sm-4">
                        <input type="text" readonly class="form-control-plaintext" value="Rs. {{$orderDetails->grand_total + $orderDetails->shipping_charges}}">
                      </div>

                    </div>

                    <a href="{{url('/driver-accept-order/'.$orderDetails->id.'/'.$notificationid)}}"><input type="submit" name="" value="Accept" class="btn btn-success"></a>
                      <a href="{{url('/driver-dismiss-order/'.$orderDetails->id.'/'.$notificationid)}}"><input type="submit" name="" value="Dismiss" class="btn btn-danger"></a>
                </div>
            </div>
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