<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('public/uploads/profile/'.Auth::user()->imageName)}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="treeview {{ (Request::is('order/*', 'order') ? 'active' : '') }}">
          <a href="#">
            <i class="fa fa-cart-plus"></i> <span>Orders</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ (Request::is('order/new') ? 'active' : '') }}"><a href="{{action('Admin\Orders\PendingController@index')}}"><i class="fa fa-circle-o"></i> New Order</a></li>
            <li class="{{ (Request::is('order/process') ? 'active' : '') }}"><a href="{{action('Admin\Orders\PendingController@process')}}"><i class="fa fa-circle-o"></i> Processing</a></li>
            <li class="{{ (Request::is('order/complete') ? 'active' : '') }}"><a href="{{action('Admin\Orders\PendingController@complete')}}"><i class="fa fa-circle-o"></i> Completed</a></li>
            <li class="{{ (Request::is('order/cancel') ? 'active' : '') }}"><a href="{{action('Admin\Orders\PendingController@cancel')}}"><i class="fa fa-circle-o"></i> Cancelled</a></li>
          </ul>
        </li>

        <li class="treeview {{ (Request::is('product/*', 'product') ? 'active' : '') }}">
          <a href="#">
            <i class="fa fa-database"></i>
            <span>Product</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li class="{{ (Request::is('product/list') ? 'active' : '') }}"><a href="{{action('Admin\Product\ProductController@index')}}"><i class="fa fa-circle-o"></i> Products</a></li>
            <li class="{{ (Request::is('product/category') ? 'active' : '') }}"><a href="{{action('Admin\Product\CategoryController@index')}}"><i class="fa fa-circle-o"></i> Product Category</a></li>
          </ul>
        </li>
          <li class="treeview">
              <a href="#">
                  <i class="fa fa-user-plus"></i>
                  <span>Doctor</span>
                  <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
              </a>
              <ul class="treeview-menu">

                  <li class="{{ (Request::is('product/list') ? 'active' : '') }}"><a href="{{action('Admin\Product\ProductController@index')}}"><i class="fa fa-circle-o"></i> Doctors</a></li>
                  <li class="{{ (Request::is('product/category') ? 'active' : '') }}"><a href="{{action('Admin\Product\CategoryController@index')}}"><i class="fa fa-circle-o"></i> Departments</a></li>
              </ul>
          </li>
        <li class="{{ (Request::is('customer/list') ? 'active' : '') }}">
          <a href="{{action('Admin\Customer\CustomerController@index')}}">
            <i class="fa fa-users"></i> <span>Customers</span>
          </a>
        </li>
        <li class="{{ (Request::is('admin/list') ? 'active' : '') }}">
            <a href="{{action('Admin\Customer\CustomerController@admin')}}">
              <i class="fa fa-user"></i> <span>Admins</span>
            </a>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
