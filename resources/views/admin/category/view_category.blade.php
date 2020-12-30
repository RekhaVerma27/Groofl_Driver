@extends('admin.layouts.master')
@section('title','View Category')
@section('content')

<!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <div class="header-icon">
                  <i class="fa fa-eye"></i>
               </div>
               <div class="header-title">
                  <h1>View Category</h1>
                  <small>Category List</small>
               </div>
            </section>
            @if(Session::has('flash_message_error'))
            <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>   
            </button>
               <strong>{{session('flash_message_error')}}</strong>
            </div>
            @endif
            @if(Session::has('flash_message_success'))
            <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>   
            </button>
               <strong>{{session('flash_message_success')}}</strong>
            </div>
            @endif

            <div id="message_success" style="display: none;" class="alert alert-sm alert-success">Status Active</div>
            <div id="message_error" style="display: none;" class="alert alert-sm alert-danger">Status Inactive</div>
            <!-- Main content -->
            <section class="content">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>View Category</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="btn-group">
                              <div class="buttonexport" id="buttonlist"> 
                                 <a class="btn btn-add" href="{{url('/add-category')}} "> <i class="fa fa-plus"></i> Add Category
                                 </a>  
                              </div>
                            </div>  
                           <div class="table-responsive">
                              <table id="table_id" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info">
                                       <th>ID</th>
                                       <th>Category Name</th>
                                       <th>Parent ID</th>
                                       <th>Url</th>
                                       <th>Status</th>
                                       <th>Actions</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($categories as $category)
                                    <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->category_name}}</td>
                                    <td>{{$category->parent_id}}</td>
                                    <td>{{$category->url}}</td>
                                    
     
      <td>
      <input type="checkbox" class="CategoryStatus btn btn-success" rel="{{$category->id}}" data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" @if($category['status']=="1") checked @endif>
      <div id="myElem" style="display: none;" class="alert alert-success">Status Active</div>
      </td>
                                  
                                       <td>
                                          <a href="{{url('/edit-category/'.$category->id)}}" class="btn btn-add btn-sm"><i class="fa fa-pencil"></i></a>
                                          <a href="{{url('/delete-category/'.$category->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> </a>
                                       </td>
                                    </tr>
                                    @endforeach 
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->

@endsection