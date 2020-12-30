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
                                    <a class="btn btn-add " href="{{ url('/view-category') }}"> 
                                    <i class="fa fa-list"></i>  View Categories </a>  
                                 </div>
                              </div>
                              <div class="panel-body">
                                 <form method="post" action="{{ url('/edit-category/'.$categoryDetails->id) }}" class="col-sm-6">
                                    @csrf
                                    <div class="form-group">
                                       <label>Category Name</label>
                                       <input type="text" name="category_name" id="category_name" class="form-control" value="{{ $categoryDetails->category_name }}" required>
                                    </div>
                                    <div class="form-group">
                                       <label>Parent Category</label>
                                       <select name="parent_id" id="parent_id" class="form-control">
                                          <option value="0">Parent Category</option>
                                          @foreach($levels as $val)
                                             <option value="{{$val->id}}" 
                                                @if($val->id==$categoryDetails->parent_id) selected @endif >
                                                {{ $val->category_name }}
                                             </option>
                                          @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group">
                                       <label>URL</label>
                                       <input type="text" name="url" id="url" class="form-control" value="{{ $categoryDetails->url }}" required>
                                    </div>
                                    <div class="form-group">
                                       <label>Category Description</label>
                                       <textarea name="category_description" id="category_description" class="form-control">{{ $categoryDetails->description }}</textarea>
                                    </div>
                                    <div class="reset-button">
                                       <input type="submit" name="submit" value="Edit Category" class="btn btn-success">
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