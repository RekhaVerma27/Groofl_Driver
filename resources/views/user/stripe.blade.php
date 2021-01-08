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

                      {{-- <form action="/stripe" method="post" id="payment-form">@csrf
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
                            
                          </div>
                          
                          <button class="btn btn-success btn-mini" style="float: right; margin-top: 10px;">Submit Payment</button>
                      
                        </form>  --}}

                        <form action="/stripe" method="post" id="payment-form"> @csrf
                            
                           <div class="group">
                               <b>Total Amount</b>
                            <input type="text" name="total_amount" placeholder="Enter Total Amount" class="form-control">
                            <b>Your Name</b>
                            <input type="text" name="name" placeholder="Enter Your Name" class="form-control">
                            </div>
                            <b>Card Number</b>
                            @if(!empty($cards))
                            @foreach($cards as $card)
                             <label style="margin-left: -66px;">
                               <span><input type="radio" name="payment-source" value="{{$card->id}}"></span>
                               <div id="saved-card">**** **** **** {{$card->last4}}</div>
                             </label>
                             @endforeach
                            @endif
                             <div id="pouet" style="margin-left: -66px;">
                               <span><input type="radio" name="payment-source" value="new-card" id="new-card-radio"></span>
                               <div id="card-element" class="field"></div>      
                             </div>
                           </div>
                           <div style="margin-left: 625px;">
                               <input type="submit" name="" value="Pay" class="btn btn-success" style="width: 385px;">
                          </div>
                           <div class="outcome">
                             <div class="error"></div>
                             <div class="success-saved-card">
                               Success! Your are using saved card <span class="saved-card"></span>
                             </div>
                             <div class="success-new-card">
                               Success! The Stripe token for your new card is <span class="token"></span>
                             </div>
                           </div>
                         </form>
                        
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <!-- End Cart -->

    <script>
      var stripe = Stripe('pk_test_51I42lDHfrmRAqAIlGhoI0HO5UnKTutRZBv1qjlFRKyaWncz030uuNtJaK5KHBnWv7rbdMNlARz3kZuhaMpt7oreL00y5u7bN4Y');
      var elements = stripe.elements();

      var card = elements.create('card', {
        style: {
          base: {
            iconColor: '#666EE8',
            color: '#31325F',
            lineHeight: '40px',
            fontWeight: 300,
            fontFamily: 'Helvetica Neue',
            fontSize: '15px',

            '::placeholder': {
              color: '#CFD7E0',
            },
          },
        }
      });
      card.mount('#card-element');

      function setOutcome(result) {
        var successNewCardElement = document.querySelector('.success-new-card');
        var successSavedCardElement = document.querySelector('.success-saved-card');
        var errorElement = document.querySelector('.error');
        successNewCardElement.classList.remove('visible');
        successSavedCardElement.classList.remove('visible');
        errorElement.classList.remove('visible');
        
        if (result.token) {
          // Use the token to create a charge or a customer
          // https://stripe.com/docs/charges

          // document.getElementById("payment-form").submit();

          stripeTokenHandler(result.token);

          // successNewCardElement.querySelector('.token').textContent = result.token.id;
          // successNewCardElement.classList.add('visible');
        } else if (result.saved_card) {
          document.getElementById("payment-form").submit();
          // successSavedCardElement.querySelector('.saved-card').textContent = result.saved_card;
          // successSavedCardElement.classList.add('visible');
        } else if (result.error) {
          errorElement.textContent = result.error.message;
          errorElement.classList.add('visible');
        }
      }

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

      card.on('focus', function(event) {
        document.querySelector('#new-card-radio').checked = true;
      });

      card.on('change', function(event) {
        setOutcome(event);
      });

      document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        var radioButton = document.querySelector('input[name="payment-source"]:checked');
        if (radioButton.value == 'new-card') {
          stripe.createToken(card).then(setOutcome);
        } else {
          setOutcome({saved_card: radioButton.value});
        }
      });

    </script>

@endsection
    
    <?php

    Session::forget('order_id');
    Session::forget('grand_total');
    // Session::forget('CouponCode');
    // Session::forget('CouponAmount');

    ?>