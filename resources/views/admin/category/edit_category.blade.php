@extends('admin.layouts.master')
@section('title','Edit Category')
@section('content')

<div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <div class="header-icon">
                  <i class="fa fa-product-hunt"></i>
               </div>
               <div class="header-title">
                  <h1>Edit Category</h1>
                  <small> Category List</small>
               </div>
            </section>
            <!-- Main content -->
            <section class="content">
               <div class="row">
                  <!-- Form controls -->
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="btn-group" id="buttonlist"> 
                              <a class="btn btn-add " href="{{url('/view-category')}}"> 
                              <i class="fa fa-list" ></i>View Categories </a>  
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-6" method="post" action="{{url('/edit-category/'.$categoryDetails->id)}}" enctype="multipart/form-data">@csrf
                              
                              <div class="form-group">
                                 <label>Category Name</label>
                                 <input type="text" name="category_name" value="{{$categoryDetails->category_name}}" class="form-control" placeholder="Enter Category Name" name="name" required>
                              </div>

                              <div class="form-group">
                           <label>Category Image</label>
                           <input type="file" name="image">
                           <input type="hidden" name="current_image" value="{{ $categoryDetails->image }}">
                           @if(!empty($categoryDetails->image))
                           <img style="width: 100px; margin-top: 10px;" src="{{url('upload/category/'.$categoryDetails->image)}}">
                           @else
                           <h5>No Image</h5>
                           @endif
                           </div>
                              
                              <div class="reset-button">
                                 <input type="submit" class="btn btn-success">
                                 
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <!-- /.content -->
</div>

@endsection