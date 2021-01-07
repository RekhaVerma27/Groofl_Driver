@extends('user.layouts.master')
@section('title','Category Product')

@section('content')
<br>
<div class="container" style="text-align: center">
	<center><h1>{{$category_name->category_name}}</h1></center><br>
		<div class="row" >
			@foreach($products as $product)
			<div class="col-md-3" style="margin: auto;">
				<div class="card" style="width: 18rem;">
				  <img src="{{url('/upload/product/'.$product->image)}}" class="card-img-top" alt="...">
				  <div class="card-body">
				    <h5 class="card-title">{{$product->product_name}}</h5>
				    <p class="card-text">Rs. {{$product->product_price}}</p>
				    <a href="{{url('/product-details/'.$product->id)}}" class="btn btn-primary">Product Detail</a>
				  </div>
				</div>
			</div>
			@endforeach
		</div>  <!-- end row --><br>
</div> <!-- End COntainer -->

@endsection