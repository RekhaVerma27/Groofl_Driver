@extends('admin.layouts.master')
@section('title','Edit User')
@section('content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	   <!-- Content Header (Page header) -->
	   <section class="content-header">
	      <div class="header-icon">
	         <i class="fa fa-product-hunt"></i>
	      </div>
	      <div class="header-title">
	         <h1>Edit User</h1>
	         <small>Edit User</small>
	      </div>
	   </section>

	   <!-- ======================================================================================== -->

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

	   <!-- ======================================================================================== -->

	   <!-- Main content -->
	   <section class="content">
	      <div class="row">
	         <!-- Form controls -->
	         <div class="col-sm-12">
	            <div class="panel panel-bd lobidrag">
	               <div class="panel-heading">
	                  <div class="btn-group" id="buttonlist"> 
	                     <a class="btn btn-add " href="{{url('view-users')}}"> 
	                     <i class="fa fa-list"></i>  View Users </a>  
	                  </div>
	               </div>
	               <div class="panel-body">
	                  <form method="post" action="{{ url('/edit-users/'.$userDetails->id) }}" class="col-sm-6">
	                  	@csrf
	                  	@if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
	                     <div class="form-group">
	                        <label>User Name</label>
	                        <input type="text" name="name" id="name" value="{{$userDetails->name}}" class="form-control" required>
	                     </div>
	                     <div class="form-group">
	                        <label>User Email</label>
	                        <input type="email" name="email" id="email" value="{{$userDetails->email}}" class="form-control" required>
	                     </div>
	                     <div class="reset-button">
	                        <input type="submit" name="submit" value="Update" class="btn btn-success">
	                     </div>
	                  </form>
	               </div>
	            </div>
	         </div>
	      </div>
	   </section>
	   <!-- /.content -->
	</div>
	<!-- /.content-wrapper -->
@endsection