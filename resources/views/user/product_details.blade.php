@extends('user.layouts.master')
@section('title','User Dashboard')

@section('content')
<br>
<div class="container">
<center><h1>Product Details</h1></center>
<br>
<div class="row">
	<div class="col-sm-6">
		<img class="detail-img" src="{{url('/upload/product/'.$productDetails->image)}}" style="width: 400px">
	</div>
	<div class="col-sm-6">
		<a href="{{url('/user-dashboard')}}">Go Back</a>

		<form action="{{url('/add-to-cart')}}" method="post">@csrf

			<h2>Product Name : {{ $productDetails['product_name'] }}</h2>
			<h2>Price : <input id="total-price" type="disabled" readonly="readonly" value="{{ $productDetails['product_price'] }}" /></h2>
			
			<h2>Quantity :  <input type="button" value="-" id="minus" />
							<input type="text" id="quantity" value="1" min="1" name="product_quantity" style="width: 150px" />
							<input type="button" value="+" id="plus" />
							<br />
			</h2>

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
			<script>
				$('#plus').click(function add() {
				  var $qtde = $("#quantity");
				  var a = $qtde.val();

				  a++;
				  $("#minus").attr("disabled", !a);
				  $qtde.val(a);
				});
				$("#minus").attr("disabled", !$("#quantity").val());

				$('#minus').click(function minust() {
				  var $qtde = $("#quantity");
				  var b = $qtde.val();
				  if (b > 1) {
				    b--;
				    $qtde.val(b);
				  } else {
				    $("#minus").attr("disabled", true);
				  }
				});

				/* On change */
				$(document).ready(function() {
				  function updatePrice() {
				    var quantity = parseFloat($("#quantity").val());
				    var total = quantity *  {{$productDetails['product_price']}} ;
				    var total = total.toFixed(2);
				    $("#total-price").val(total);
				  }
				  // On the click of an input, update the price
				  $(document).on("click", "input", updatePrice);
				});
			</script>
			<br/>
				<input type="hidden" name="product_id" value="{{$productDetails->id}}">
				<input type="hidden" name="product_name" value="{{$productDetails->product_name}}">
				<input type="hidden" name="product_price" value="{{$productDetails->product_price}}">
				<button class="btn btn-success">Add To Cart</button>
		</form>
	</div>

</div>
<br>
</div>
@endsection