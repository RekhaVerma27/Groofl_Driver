@extends('user.layouts.master')
@section('title','Message')
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
        <div class="container">
            <center><div class="bg-danger"><h1 style="font-size: 55px; color: white;"> Message</h1></div></center>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ url('/msg') }}" method="post">@csrf
                    <div class="coupon-box">
                        <div class="input-group input-group-sm">
                            <input class="form-control" name="msg" placeholder="Enter your Message" type="text">
                            <div class="input-group-append">
                                <button class="btn btn-theme" type="submit">Send</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Cart -->

@endsection