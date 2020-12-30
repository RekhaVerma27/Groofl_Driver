@extends('user.layouts.master')
@section('title','Add Address ')

@section('content')
<div class="container">
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="checkout-address">
			                        <div class="title-left">
			                            <center><h1>Add Address</h1></center>
			                        </div>
			                        <form class="needs-validation" novalidate="" method="post" action="{{url('/add-address')}}">@csrf
			                            <div class="row">
			                                <!-- <div class="col-md-6 mb-3">
			                                    <label for="firstName">First name *</label>
			                                    <input type="text" class="form-control" id="firstName" placeholder="" value="" required="">
			                                    <div class="invalid-feedback"> Valid first name is required. </div>
			                                </div>
			                                <div class="col-md-6 mb-3">
			                                    <label for="lastName">Last name *</label>
			                                    <input type="text" class="form-control" id="lastName" placeholder="" value="" required="">
			                                    <div class="invalid-feedback"> Valid last name is required. </div>
			                                </div> -->
			                            </div>
			                            <div class="mb-3">
			                                <label for="address">Address *</label>
			                                <input type="text" name="address" class="form-control" id="address" placeholder="" required="">
			                                <div class="invalid-feedback"> Please enter your shipping address. </div>
			                            </div>
			                            <div class="row">
			                                <div class="col-md-3 mb-3">
			                                    <label for="country">Country *</label>
			                                    <select name="country" class="wide w-100" id="country">
												<option value="Choose..." data-display="Select">Choose...</option>
												<option value="India">India</option>
											</select>
			                                    <div class="invalid-feedback"> Please select a valid country. </div>
			                                </div>
			                                <div class="col-md-3 mb-3">
			                                    <label for="state">State *</label>
			                                    <select name="state" class="wide w-100" id="state">
												<option data-display="Select">Choose...</option>
												<option value="Madhya Pradesh">Madhya Pradesh</option>
											</select>
			                                    <div class="invalid-feedback"> Please provide a valid state. </div>
			                                </div>
			                                <div class="col-md-3 mb-3">
			                                    <label for="city">City *</label>
			                                    <select name="city" class="wide w-100" id="city">
												<option data-display="Select">Choose...</option>
												<option value="Gwalior">Gwalior</option>
												</select>
			                                    <div class="invalid-feedback"> Please provide a valid state. </div>
			                                </div>
			                                <div class="col-md-3 mb-3">
			                                    <label for="zip">Pincode *</label>
			                                    <input type="text" name="pincode" class="form-control" id="zip" placeholder="" required="">
			                                    <div class="invalid-feedback"> Zip code required. </div>
			                                </div>
			                            </div>
			                            <!-- <hr class="mb-4">
			                            <div class="custom-control custom-checkbox">
			                                <input type="checkbox" class="custom-control-input" id="same-address">
			                                <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
			                            </div>
			                            <div class="custom-control custom-checkbox">
			                                <input type="checkbox" class="custom-control-input" id="save-info">
			                                <label class="custom-control-label" for="save-info">Save this information for next time</label>
			                            </div> -->
			                            
			                            <center><input class="btn btn-info" type="submit" name="save" value="Add Address"></center><br>
			                            </form>
			</div>
		</div>
	</div>
</div>

@endsection