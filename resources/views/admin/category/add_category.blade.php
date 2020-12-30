@extends('admin.layouts.master')
@section('title','Add Category')
@section('content')

<div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <div class="header-icon">
                  <i class="fa fa-product-hunt"></i>
               </div>
               <div class="header-title">
                  <h1>Add Category</h1>
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
                        <a class="btn btn-add " href="{{ url('/view-category') }}"> 
                        <i class="fa fa-list"></i>  View Categories </a>  
                     </div>
                  </div>
                  <div class="panel-body">
                     <form method="post" action="{{ url('/add-category') }}" class="col-sm-6">
                        @csrf
                        <div class="form-group">
                           <label>Category Name</label>
                           <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Enter Category Name" required>
                        </div>
                        <div class="form-group">
                           <label>Parent Category</label>
                           <select name="parent_id" id="parent_id" class="form-control">
                              <option value="0">Parent Category</option>
                              @foreach($levels as $val)
                                 <option value="{{$val->id}}">{{ $val->category_name }}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="form-group">
                           <label>URL</label>
                           <input type="text" name="url" id="url" class="form-control" placeholder="Enter url" required>
                        </div>
                        <div class="form-group">
                           <label>Category Description</label>
                           <textarea name="category_description" id="category_description" class="form-control"></textarea>
                        </div>
                        <div class="reset-button">
                           <!-- <a href="#" class="btn btn-warning">Reset</a> -->
                           <input type="submit" name="submit" value="Add Category" class="btn btn-success">
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