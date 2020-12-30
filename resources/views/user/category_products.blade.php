@extends('user.layouts.master')
@section('title','Category Product')

@section('content')
<!-- <div class="custom-product">
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
	  <ol class="carousel-indicators">
	    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
	    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
	    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
	  </ol>
	  <div class="carousel-inner">
	    <div class="carousel-item active">
	      <img class="slider-img" src="https://www.teahub.io/photos/full/209-2094319_analog-watch.jpg" class="d-block w-100" alt="...">
	    </div>
	    <div class="carousel-item">
	      <img class="slider-img" src="https://www.wallpapertip.com/wmimgs/227-2274701_product-wallpaper.jpg" class="d-block w-100" alt="...">
	    </div>
	    <div class="carousel-item">
	      <img class="slider-img" src="https://i.pinimg.com/originals/2c/55/f9/2c55f9c9326e9232526557b63cd59638.gif" class="d-block w-100" alt="...">
	    </div>
	  </div>
	  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
	    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	    <span class="sr-only">Previous</span>
	  </a>
	  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
	    <span class="carousel-control-next-icon" aria-hidden="true"></span>
	    <span class="sr-only">Next</span>
	  </a>
	</div>
</div> -->
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
		</div>  <!-- end row -->
</div> <!-- End COntainer -->

@endsection