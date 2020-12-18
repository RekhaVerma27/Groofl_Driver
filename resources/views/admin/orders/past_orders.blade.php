@extends('admin.layouts.master')
@section('title','Past Orders')
@section('content')

<!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <div class="header-icon">
                  <i class="fa fa-eye"></i>
               </div>
               <div class="header-title">
                  <h1>View Orders</h1>
                  <small>Orders List</small>
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

            <div id="message_success" style="display: none;" class="alert alert-sm alert-success">Status Enabled</div>
            <div id="message_error" style="display: none;" class="alert alert-sm alert-danger">Status Disabled</div>
            <!-- Main content -->
            <section class="content">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Past Orders</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="btn-group">
                              <div class="buttonexport" id="buttonlist"> 
                                 <a class="btn btn-add" href="{{url('/current-orders')}} "> <i class="fa fa-plus"></i> Current Orders
                                 </a>  
                              </div>
                            </div>  
                           <div class="table-responsive">
                              <table id="table_id" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info">
                                       <th>Id</th>
                                       <th>Order Name</th>
                                       <th>Order Quantity</th>
                                       <th>Order Price</th>
                                       <th>Order Iamge</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                  
                                    <tr>
                                    <td>1</td>
                                    <td>Camera</td>
                                    <td>1</td>
                                    <td>50,000</td>
                                    <td>Image</td>
                                  
                                       <td>
                                          <a href="" class="btn btn-add btn-sm"><i class="fa fa-pencil"></i></button>
                                          <a href="" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> </button>
                                       </td>
                                    </tr>
                                    
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