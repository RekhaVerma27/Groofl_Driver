<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
            <!-- sidebar -->
            <div class="sidebar">
               <!-- sidebar menu -->
               <ul class="sidebar-menu">
                  <li class="active">
                     <a href="index.html"><i class="fa fa-tachometer"></i><span>Dashboard</span>
                     <span class="pull-right-container">
                     </span>
                     </a>
                  </li>

                  <li class="treeview">
                     <a href="#">
                     <i class="fa fa-list"></i><span>Categries</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu">
                        
                        <li><a href="{{url('/add-category')}} ">Add Categries</a></li>
                        <li><a href="{{url('/view-category')}}">View Categries</a></li>
                     </ul>
                  </li>

                  <li class="treeview">
                     <a href="#">
                     <i class="fa fa-users"></i><span>Product</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu">
                        <li><a href="{{url('add-product')}}">Add Product</a></li>
                        <li><a href="{{url('view-products')}}">View Products</a></li>
                     </ul>
                  </li>
                  <li class="treeview">
                     <a href="#">
                     <i class="fa fa-gift"></i><span>Coupons</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu">
                        <li><a href="{{ url('/add-coupon') }}">Add Coupon</a></li>
                        <li><a href="{{ url('/view-coupons') }}">View Coupons</a></li>
                     </ul>
                  </li>
                  <li class="treeview">
                     <a href="#">
                     <i class="pe-7s-cart"></i><span>Order</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu">
                        
                        <li><a href="{{url('/current-orders')}} ">Current Order</a></li>
                        <li><a href="{{url('/past-orders')}}">Past Order</a></li>
                     </ul>
                  </li>

                  <li class="treeview">
                     <a href="#">
                     <i class="pe-7s-cart"></i><span>Drivers</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu">
                        
                        <li><a href="{{url('/view-drivers')}} ">View Drivers</a></li>
                        <li><a href="{{url('/blocked-drivers')}}">Blocked Drivers</a></li>
                     </ul>
                  </li>

                  <li class="treeview">
                     <a href="#">
                     <i class="pe-7s-cart"></i><span>Users</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu">
                        
                        <li><a href="{{url('/view-users')}} ">View Users</a></li>
                        <li><a href="{{url('/blocked-users')}}">Blocked Users</a></li>
                     </ul>
                  </li>
                  
               </ul>
            </div>
            <!-- /.sidebar -->
         </aside>
<!-- =============================================== -->