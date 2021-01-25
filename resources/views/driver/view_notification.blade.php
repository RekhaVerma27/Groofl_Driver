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
@endsection