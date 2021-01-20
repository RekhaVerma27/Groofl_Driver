<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <!-- <title>ThewayShop - Ecommerce Bootstrap 4 HTML Template</title> -->
    <title>@yield('title')</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="{{url('user-assets/wayshop/images/favicon.ico')}}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{url('user-assets/wayshop/images/apple-touch-icon.png')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{url('user-assets/wayshop/css/bootstrap.min.css')}}">
    <!-- Site CSS -->
    <link rel="stylesheet" href="{{url('user-assets/wayshop/css/style.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{url('user-assets/wayshop/css/responsive.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{url('user-assets/wayshop/css/custom.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>

<body>

<div class="main-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="text-slid-box">
                        <div id="offer-box" class="carouselTicker">
                            <ul class="offer-box">
                                <li>
                                    <i class="fab fa-opencart"></i> Off 10%! Shop Now Man
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> 50% - 80% off on Fashion
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> 20% off Entire Purchase Promo code: offT20
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> Off 50%! Shop Now
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> Off 10%! Shop Now Man
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> 50% - 80% off on Fashion
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> 20% off Entire Purchase Promo code: offT20
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> Off 50%! Shop Now
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="custom-select-box">
                        <select id="basic" class="selectpicker show-tick form-control" data-placeholder="$ USD">
            <option>$ USD</option>
          </select>
                    </div>
                    <div class="right-phone-box">
                        <p>Call US :- <a href="#"> +91 88712 87268</a></p>
                    </div>
                    <div class="our-link">
                        <ul>
                            <li><a href="{{url('/cart')}}"><i class="fa fa-cart-plus"></i> Cart</a></li>
                            <li><a href="{{url('/user-logout')}}"><i class="fa fa-cart-plus"></i> logout</a></li>
                            {{--@if(empty(Auth::check()))
                            <li><a href="{{ url('/login-register') }}"><i class="fa fa-lock"></i> Login</a></li>
                            @else
                            <li><a href="{{url('/account')}}"><i class="fa fa-user"></i> Account</a></li>
                            <li><a href="{{url('/user-logout')}}"><i class="fa fa-lock"></i> Logout</a></li>
                            @endif--}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Top -->

    <!-- Start Main Top -->
    <header class="main-header">
        <!-- Start Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
            <div class="container">
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                    <a class="navbar-brand" href="{{url('/user-dashboard')}}"><h1>GWALIOR SHOP</h1></a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="nav-item active"><a class="nav-link" href="{{url('/')}}">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{url('#')}}">About Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{url('#')}}">Contact Us</a></li>
                        <li class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">MY Account</a>
                            <ul class="dropdown-menu animated fadeOutUp" style="display: none; opacity: 1;">
                                <li><a href="{{url('/add-address')}}">Add Address</a></li>
                                <li><a href="{{url('/view-address')}}">List Address</a></li>
                                <li><a href="{{url('/my-order')}}">My Order</a></li>
                            </ul>
                        </li>
                        
                    </ul>
                </div>
                <!-- /.navbar-collapse -->

                <!-- Start Atribute Navigation -->
                <div class="attr-nav">
                    <ul>
                        <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                        <li class="side-menu"><a href="#">
            <i class="fa fa-shopping-bag"></i>
                            <span class="badge">3</span>
          </a></li>
                    </ul>
                </div>
                <!-- End Atribute Navigation -->
            </div>
            <!-- Start Side Menu -->
            <div class="side">
                <a href="#" class="close-side"><i class="fa fa-times"></i></a>
                <li class="cart-box">
                    <ul class="cart-list">
                        <li>
                            <a href="#" class="photo"><img src="{{url('front_assets/images/img-pro-01.jpg')}}" class="cart-thumb" alt="" /></a>
                            <h6><a href="#">Delica omtantur </a></h6>
                            <p>1x - <span class="price">$80.00</span></p>
                        </li>
                        <li>
                            <a href="#" class="photo"><img src="{{url('front_assets/images/img-pro-02.jpg')}}" class="cart-thumb" alt="" /></a>
                            <h6><a href="#">Omnes ocurreret</a></h6>
                            <p>1x - <span class="price">$60.00</span></p>
                        </li>
                        <li>
                            <a href="#" class="photo"><img src="{{url('front_assets/images/img-pro-03.jpg')}}" class="cart-thumb" alt="" /></a>
                            <h6><a href="#">Agam facilisis</a></h6>
                            <p>1x - <span class="price">$40.00</span></p>
                        </li>
                        <li class="total">
                            <a href="#" class="btn btn-default hvr-hover btn-cart">VIEW CART</a>
                            <span class="float-right"><strong>Total</strong>: $180.00</span>
                        </li>
                    </ul>
                </li>
            </div>
            <!-- End Side Menu -->
        </nav>
        <!-- End Navigation -->
    </header>
    <!-- End Main Top -->

    <!-- Start Top Search -->
    <div class="top-search">
        <div class="container">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Search">
                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
            </div>
        </div>
    </div>
    <!-- End Top Search-->

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


    
    <?php

    Session::forget('order_id');
    Session::forget('grand_total');
    // Session::forget('CouponCode');
    // Session::forget('CouponAmount');

    ?>

<!-- Start Footer  -->
    <footer>
        <div class="footer-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-widget">
                            <h4>About TheRkShop</h4>
                            <p>Hello Everyone, This is me Rohit.
                                </p>
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-link">
                            <h4>Information</h4>
                            <ul>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Customer Service</a></li>
                                <li><a href="#">Our Sitemap</a></li>
                                <li><a href="#">Terms &amp; Conditions</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Delivery Information</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-link-contact">
                            <h4>Contact Us</h4>
                            <ul>
                                <li>
                                    <p><i class="fas fa-map-marker-alt"></i>Address: Fort Road, <br>Gwalior, Madhya Pradesh,<br> MP 474003 </p>
                                </li>
                                <li>
                                    <p><i class="fas fa-phone-square"></i>Phone: <a href="tel:+91-8871287268">+91-88712 87268</a></p>
                                </li>
                                <li>
                                    <p><i class="fas fa-envelope"></i>Email: <a href="mailto:rkmahor27@gmail.com">rkmahor27@gmail.com</a></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer  -->

    <!-- Start copyright  -->
    <div class="footer-copyright">
        <p class="footer-company">All Rights Reserved. &copy; 2020 <a href="#">TheRkShop</a> Design By :
            <a href="https://html.design/">Rk Tech</a></p>
    </div>
    <!-- End copyright  -->

<a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

    <!-- ALL JS FILES -->
    <script src="{{url('user-assets/wayshop/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{url('user-assets/wayshop/js/popper.min.js')}}"></script>
    <script src="{{url('user-assets/wayshop/js/bootstrap.min.js')}}"></script>
    <!-- ALL PLUGINS -->
    <script src="{{url('user-assets/wayshop/js/jquery.superslides.min.js')}}"></script>
    <script src="{{url('user-assets/wayshop/js/bootstrap-select.js')}}"></script>
    <script src="{{url('user-assets/wayshop/js/inewsticker.js')}}"></script>
    <script src="{{url('user-assets/wayshop/js/bootsnav.js')}}"></script>
    <script src="{{url('user-assets/wayshop/js/images-loded.min.js')}}"></script>
    <script src="{{url('user-assets/wayshop/js/isotope.min.js')}}"></script>
    <script src="{{url('user-assets/wayshop/js/owl.carousel.min.js')}}"></script>
    <script src="{{url('user-assets/wayshop/js/baguetteBox.min.js')}}"></script>
    <script src="{{url('user-assets/wayshop/js/form-validator.min.js')}}"></script>
    <script src="{{url('user-assets/wayshop/js/contact-form-script.js')}}"></script>
    <script src="{{url('user-assets/wayshop/js/custom.js')}}"></script>
    <script>
        $(document).ready(function(){
            // alert("test");              // for testing

            $("#selSize").change(function(){
                // alert ("test");         // for testing

                var idSize = $(this).val();

                if(idSize=='')
                {
                    return false;
                }

                $.ajax({
                    type : 'get',
                    url  : '/get-product-price',
                    data : {idSize:idSize},

                    success:function(resp)
                    {
                        // alert(resp);
                        var arr = resp.split('#');
                        $("#getPrice").html("Product Price : Rs. "+arr[0]);
                        $('#price').val(arr[0]);
                    },
                    error:function()
                    {
                        alert("Error");
                    }
                });
            });

            $("#billtoship").click(function(){
                if(this.checked)
                {
                    $("#shipping_name").val($("#billing_name").val());
                    $("#shipping_address").val($("#billing_address").val());
                    $("#shipping_city").val($("#billing_city").val());
                    $("#shipping_state").val($("#billing_state").val());
                    $("#shipping_country").val($("#billing_country").val());
                    $("#shipping_pincode").val($("#billing_pincode").val());
                    $("#shipping_mobile").val($("#billing_mobile").val());
                }
                else
                {
                    $("#shipping_name").val('');
                    $("#shipping_address").val('');
                    $("#shipping_city").val('');
                    $("#shipping_state").val('');
                    $("#shipping_country").val($("#select_country").val());
                    $("#shipping_pincode").val('');
                    $("#shipping_mobile").val('');
                }
            });
        });

        function selectPaymentMethod()
        {
            // alert('test');

            if($('.stripe').is(':checked') || $('.paypal').is(':checked') || $('.cod').is(':checked') || $('.paytm').is(':checked')) {
                // alert('checked');
            }
            else
            {
                alert('Please Select Payment Method');
                return false;
            }
        }

    </script>
</body>

</html>