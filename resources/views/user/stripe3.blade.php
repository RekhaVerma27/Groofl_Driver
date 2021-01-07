@extends('user.layouts.master')
@section('title','Stripe')
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
                    <div class="col-lg-6">
                        <div align="center">
                            <h2>Your Order Has Been Placed !!</h2>
                            <p>Your Order Number is {{Session::get('order_id')}} and Total Payable about is Rs. {{Session::get('grand_total')}}</p>
                            <b>Please Make Payment By Entering Your Credit Or Debit Card</b>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <script src="https://js.stripe.com/v3/"></script>

                        <form action="/stripe" method="post" id="payment-form">@csrf
                          <div class="form">
                            <b>Total Amount</b>
                            <input type="text" name="total_amount" placeholder="Enter Total Amount" class="form-control">
                            <b>Your Name</b>
                            <input type="text" name="name" placeholder="Enter Your Name" class="form-control">
                            <b>Card Number</b>

                            @if(!empty($cards))
                            
                              @foreach($cards as $card)
                              <div>
                                <input type="radio" class="" name="card" value="{{$card->id}}"> **** {{$card->last4}} &nbsp;&nbsp;{{$card->exp_month}}/{{$card->exp_year}}
                              </div>
                              @endforeach
                              
                            @else
                              <div id="card-element" class="form-control">
                                <!-- A Stripe Element will be inserted here. -->
                              </div>

                              <!-- Used to display form errors. -->
                              <div id="card-errors" role="alert" ></div>
                            @endif

                           {{--<!-- <a onclick="myFunction()">add new</a> -->
                            <div id="myDIV">
                              @foreach($cards as $card)
                              <div>
                                <input type="radio" class="" name="card" value="{{$card->id}}"> **** {{$card->last4}} &nbsp;&nbsp;{{$card->exp_month}}/{{$card->exp_year}}
                              </div>
                              @endforeach
                              <a onclick="myFunction()">add new</a>
                            </div>
                            <div id="myDIV2" style="display: none;">
                              <div id="card-element" class="form-control">
                                <!-- A Stripe Element will be inserted here. -->
                              </div>

                              <!-- Used to display form errors. -->
                              <div id="card-errors" role="alert" >
                            </div>--}}


                          </div>
                          
                          <button class="btn btn-success btn-mini" style="float: right; margin-top: 10px;">Submit Payment</button>
                      
                        </form>
                        <script>
                        function myFunction() {
                          var x = document.getElementById("myDIV");
                          var y = document.getElementById("myDIV2");
                          if (x.style.display === "none") {
                            x.style.display = "block";
                            y.style.display = "none";
                          } else {
                            x.style.display = "none";
                            y.style.display = "block";
                          }
                        }
                        </script>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <!-- End Cart -->

    <script>
        // Create a Stripe client.
        var stripe = Stripe('pk_test_51I42lDHfrmRAqAIlGhoI0HO5UnKTutRZBv1qjlFRKyaWncz030uuNtJaK5KHBnWv7rbdMNlARz3kZuhaMpt7oreL00y5u7bN4Y');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
          base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
              color: '#aab7c4'
            }
          },
          invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
          }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');
        // Handle real-time validation errors from the card Element.
        card.on('change', function(event) {
          var displayError = document.getElementById('card-errors');
          if (event.error) {
            displayError.textContent = event.error.message;
          } else {
            displayError.textContent = '';
          }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
          event.preventDefault();

          stripe.createToken(card).then(function(result) {
            if (result.error) {
              // Inform the user if there was an error.
              var errorElement = document.getElementById('card-errors');
              errorElement.textContent = result.error.message;
            } else {
              // Send the token to your server.
              stripeTokenHandler(result.token);
            }
          });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
          // Insert the token ID into the form so it gets submitted to the server
          var form = document.getElementById('payment-form');
          var hiddenInput = document.createElement('input');
          hiddenInput.setAttribute('type', 'hidden');
          hiddenInput.setAttribute('name', 'stripeToken');
          hiddenInput.setAttribute('value', token.id);
          form.appendChild(hiddenInput);

          // Submit the form
          form.submit();
        }
    </script>

@endsection
    
    <?php

    Session::forget('order_id');
    Session::forget('grand_total');
    // Session::forget('CouponCode');
    // Session::forget('CouponAmount');

    ?>