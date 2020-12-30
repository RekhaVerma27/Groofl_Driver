@extends('user.layouts.master')
@section('title','View Address')

@section('content')

<div class="container">
	<h1 class="text-center">List of Address</h1>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Address</th>
                                    <th>Country</th>
                                    <th>State</th>
                                    <th>City</th>
                                    <th>Pincode</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($addresses as $address)
                                <tr>
                                    <td class="name-pr">{{$address->address}}</td>
                                    <td class="name-pr">{{$address->country}}</td>
                                    <td class="name-pr">{{$address->state}}</td>
                                    <td class="name-pr">{{$address->city}}</td>
                                    <td class="name-pr">{{$address->pincode}}</td>
                                    <td class="remove-pr">
                                        <a href="#">
									<i class="fas fa-times"></i>
								</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            

        </div>

@endsection