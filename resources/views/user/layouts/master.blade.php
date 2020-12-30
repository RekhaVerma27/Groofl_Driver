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

        
    @include('user.layouts.header')
    
    @yield('content')

    @include('user.layouts.footer')

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