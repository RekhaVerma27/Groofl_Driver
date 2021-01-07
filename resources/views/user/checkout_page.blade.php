@extends('user.layouts.master')
@section('title','Checkout')

@section('content')

    <!-- Start Cart  -->
    <div class="cart-box-main">
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
            <div class="row">
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="checkout-address">
                        <div class="title-left">
                            <h3>Delivery address</h3>
                        </div>
                        <a href="{{url('/add-address')}}"><input type="submit" name="submit" value="Add Address"> </a>
                        <form class="needs-validation" novalidate method="post" action="{{url('/place-order')}}">@csrf
                            <div class="mb-3">
                                <label for="username">Please Choose Delivery Address</label>
                                <hr class="mb-4">
                                
                                @foreach($addresses as $address)
                                <div class="custom-control custom-radio">
                                    <input id="{{$address->id}}" name="address_id" value="{{$address->id}}" type="radio" class="custom-control-input" required>
                                    <label class="custom-control-label" for="{{$address->id}}">{{$address->address}}, {{$address->city}}, {{$address->state}}, {{$address->pincode}}</label>
                                </div>
                                @endforeach
                            </div>
                            <hr class="mb-4">
                            <div class="title"> <span>Payment</span> </div>

                            <div class="d-block my-3">
                                <div class="custom-control custom-radio">
                                    <input id="cod" name="payment_method" type="radio" value="cod" class="custom-control-input" checked required>
                                    <label class="custom-control-label"  for="cod">Cash on Delivery</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input id="stp" name="payment_method" type="radio" value="stripe" class="custom-control-input" required>
                                    <label class="custom-control-label" for="stp">Stripe</label>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="cc-name">Name on card</label>
                                    <input type="text" class="form-control" id="cc-name" placeholder="" required> <small class="text-muted">Full name as displayed on card</small>
                                    <div class="invalid-feedback"> Name on card is required </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cc-number">Credit card number</label>
                                    <input type="text" class="form-control" id="cc-number" placeholder="" required>
                                    <div class="invalid-feedback"> Credit card number is required </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="cc-expiration">Expiration</label>
                                    <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                                    <div class="invalid-feedback"> Expiration date required </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="cc-expiration">CVV</label>
                                    <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                                    <div class="invalid-feedback"> Security code required </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="payment-icon">
                                        <ul>
                                            <li><img class="img-fluid" src="images/payment-icon/1.png" alt=""></li>
                                            <li><img class="img-fluid" src="images/payment-icon/2.png" alt=""></li>
                                            <li><img class="img-fluid" src="images/payment-icon/3.png" alt=""></li>
                                            <li><img class="img-fluid" src="images/payment-icon/5.png" alt=""></li>
                                            <li><img class="img-fluid" src="images/payment-icon/7.png" alt=""></li>
                                        </ul>
                                    </div>
                                </div>
                            </div> -->
                            <hr class="mb-1">
                        
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="odr-box">
                                <div class="title-left">
                                    <h3>Shopping cart</h3>
                                </div>
                                <?php $total_amount = 0; ?>
                                <?php $grand_total = 0; ?>
                                @foreach($userCarts as $userCart)
                                <div class="rounded p-2 bg-light">
                                    <div class="media mb-2 border-bottom">
                                        <div class="media-body"> <a href="detail.html">{{$userCart->product_name}}</a>
                                            <div class="small text-muted">Price: Rs. {{$userCart->product_price}}<span class="mx-2">|</span>Qty : {{$userCart->product_quantity}}<span class="mx-2">|</span>Sub total : {{$userCart->product_quantity * $userCart->product_price}}</div>
                                        </div>
                                        <div>
                                        	<img class="img-fluid" style="height: 100px" src="{{url('/upload/product/'.$userCart->image)}}" alt="" />
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    $total_amount = $total_amount + ($userCart->product_price*$userCart->product_quantity);
                                ?>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <!-- <div class="order-box">
                                <div class="title-left">
                                    <h3>Your order</h3>
                                </div>
                                <div class="d-flex">
                                    <div class="font-weight-bold">Product</div>
                                    <div class="ml-auto font-weight-bold">Total</div>
                                </div>
                                <hr class="my-1">
                                <div class="d-flex">
                                    <h4>Sub Total</h4>
                                    <div class="ml-auto font-weight-bold"> $ 440 </div>
                                </div>
                                <div class="d-flex">
                                    <h4>Discount</h4>
                                    <div class="ml-auto font-weight-bold"> $ 40 </div>
                                </div>
                                <hr class="my-1">
                                <div class="d-flex">
                                    <h4>Coupon Discount</h4>
                                    <div class="ml-auto font-weight-bold"> $ 10 </div>
                                </div>
                                <div class="d-flex">
                                    <h4>Tax</h4>
                                    <div class="ml-auto font-weight-bold"> $ 2 </div>
                                </div>
                                <div class="d-flex">
                                    <h4>Shipping Cost</h4>
                                    <div class="ml-auto font-weight-bold"> Free </div>
                                </div>
                                <hr>
                                <div class="d-flex gr-total">
                                    <h5>Grand Total</h5>
                                    <div class="ml-auto h5"> $ 388 </div>
                                </div>
                                <hr> </div>
                        </div> -->
                        <div class="order-box">
                        <div class="title-left">
                            <h3>Your order</h3>
                        </div>
                        @if(!empty(Session::get('CouponAmount')))
                        <div class="d-flex">
                            <h4>Sub Total</h4>
                            <div class="ml-auto font-weight-bold"> Rs. <?php echo $total_amount; ?> </div>
                        </div>
                        <hr class="my-1">
                        <div class="d-flex">
                            <h4>Coupon Discount<br><span>( <?php echo Session::get('CouponCode') ?> )</span></h4>
                            <div class="ml-auto font-weight-bold"> Rs. <?php echo Session::get('CouponAmount'); ?> </div>
                        </div>
                        <hr>
                        <div class="d-flex gr-total">
                            <h5>Grand Total</h5>
                            <div class="ml-auto h5"> Rs. <?php echo $grand_total = $total_amount - Session::get('CouponAmount'); ?> </div>
                        </div>
                        <hr>
                        @else
                        <hr>
                        <div class="d-flex gr-total">
                            <h5>Grand Total</h5>
                            <div class="ml-auto h5"> Rs. <?php echo $grand_total = $total_amount; ?> </div>
                        </div>
                        <hr>
                        @endif
                    </div>
                        <div class="col-12 d-flex shopping-box"> <button type="submit" class="ml-auto btn hvr-hover">Place Order</button> </div>
                        <input type="hidden" value="{{$grand_total}}" name="grand_total">
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->

@endsection