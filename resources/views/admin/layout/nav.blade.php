  <header class="main-header" >
    <!-- Logo -->
    <a href="{{aurl()}}" class="logo"  style="background-color: green;">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>{{session('lang') == 'ar'?settings()->sitename_ar:settings()->sitename_en}}</b></span>
      </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style="background-color: green;">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      @include('admin.layout.menu')

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{url('')}}/design/adminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{!empty(auth()->guard('admin')->user())?auth()->guard('admin')->user()->name: " "}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
     <!--  <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class=" treeview {{active('settings')[0]}}">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>{{trans('admin.dash')}}</span>
            <span class="pull-right-container"> 
            <i class="fa fa-angle-left pull-right"></i> 
            </span>
          </a>
          <ul class="treeview-menu" style="{{active('settings')[1]}};">
            <li class=""><a href="{{aurl('')}}"><i class="fa fa-circle-o"></i> {{trans('admin.Admin_Home')}}</a></li>
            <li class=""><a href="{{aurl('settings')}}"><i class="fa fa-circle-o"></i> {{trans('admin.settings')}}</a></li> 
          </ul>
        </li>
      </ul>
      <ul class="sidebar-menu" data-widget="tree">
        <li class=" treeview {{active('admin')[0]}}">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>{{trans('admin.adm_panel')}}</span>
            <span class="pull-right-container">  
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu " style="{{active('admin')[1]}};">
            <li class="active"><a href="{{aurl('admin')}}"><i class="fa fa-circle-o"></i> {{trans('admin.Admin_Acount')}}</a></li>
            
          </ul>
        </li>
      </ul>
      <ul class="sidebar-menu" data-widget="tree">
        <li class=" treeview {{active('users')[0]}}">
          <a href="#">
            <i class="fa fa-user"></i> <span>{{trans('admin.user_account')}}</span>
            <span class="pull-right-container">  
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu " style="{{active('users')[1]}};">
            <li class=""><a href="{{aurl('users')}}"><i class="fa fa-user-o"></i> {{trans('admin.user_panel')}}</a></li>
          </ul>
        </li>
      </ul>
      <ul class="sidebar-menu" data-widget="tree">
      <li class=" treeview {{active('countries')[0]}}">
          <a href="#">
            <i class="fa fa-flag"></i> <span>{{trans('admin.countries')}}</span>
            <span class="pull-right-container">  
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu " style="{{active('countries')[1]}};">
            <li class=""><a href="{{aurl('countries')}}"><i class="fa fa-flag-o"></i> {{trans('admin.countries')}}</a></li>
            <li class=""><a href="{{aurl('countries/create')}}"><i class="fa fa-plus"></i> {{trans('admin.add')}}</a></li>
            
          </ul>
        </li>
      </ul>
      <!-- <ul class="sidebar-menu" data-widget="tree">
        <li class=" treeview {{active('cities')[0]}}">
          <a href="#">
            <i class="fa fa-flag"></i> <span>{{trans('admin.cities')}}</span>
            <span class="pull-right-container">  
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu " style="{{active('cities')[1]}};">
            <li class=""><a href="{{aurl('cities')}}"><i class="fa fa-flag-o"></i> {{trans('admin.cities')}}</a></li>
            <li class=""><a href="{{aurl('cities/create')}}"><i class="fa fa-plus"></i> {{trans('admin.add')}}</a></li>
            
          </ul>
        </li>
      </ul>
      <ul class="sidebar-menu" data-widget="tree">
        <li class=" treeview {{active('states')[0]}}">
          <a href="#">
            <i class="fa fa-flag"></i> <span>{{trans('admin.states')}}</span>
            <span class="pull-right-container">  
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu " style="{{active('states')[1]}};">
            <li class=""><a href="{{aurl('states')}}"><i class="fa fa-flag-o"></i> {{trans('admin.states')}}</a></li>
            <li class=""><a href="{{aurl('states/create')}}"><i class="fa fa-plus"></i> {{trans('admin.add')}}</a></li>
            
          </ul>
        </li>
      </ul> -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class=" treeview {{active('department')[0]}}">
          <a href="#">
            <i class="fa fa-list"></i> <span>{{trans('admin.dep')}}</span>
            <span class="pull-right-container">  
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu " style="{{active('department')[1]}};">
            <li class=""><a href="{{aurl('department')}}"><i class="fa fa-list"></i> {{trans('admin.dep')}}</a></li>
            <li class=""><a href="{{aurl('department/create')}}"><i class="fa fa-plus"></i> {{trans('admin.add')}}</a></li>
            
          </ul>
        </li>
      </ul>
      <ul class="sidebar-menu" data-widget="tree">
        <li class=" treeview {{active('trademarks')[0]}}">
          <a href="#">
            <i class="fa fa-list"></i> <span>{{trans('admin.trademarks')}}</span>
            <span class="pull-right-container">  
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu " style="{{active('trademarks')[1]}};">
            <li class=""><a href="{{aurl('trademarks')}}"><i class="fa fa-list"></i> {{trans('admin.trademarks')}}</a></li>
            <li class=""><a href="{{aurl('trademarks/create')}}"><i class="fa fa-plus"></i> {{trans('admin.add')}}</a></li>
            
          </ul>
        </li>
      </ul>
      <ul class="sidebar-menu" data-widget="tree">
        <li class=" treeview {{active('manifacts')[0]}}">
          <a href="#">
            <i class="fa fa-list"></i> <span>{{trans('admin.manifacts')}}</span>
            <span class="pull-right-container">  
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu " style="{{active('manifacts')[1]}};">
            <li class=""><a href="{{aurl('manifacts')}}"><i class="fa fa-list"></i> {{trans('admin.manifacts')}}</a></li>
            <li class=""><a href="{{aurl('manifacts/create')}}"><i class="fa fa-plus"></i> {{trans('admin.add')}}</a></li>
            
          </ul>
        </li>
      </ul>
      <ul class="sidebar-menu" data-widget="tree">
        <li class=" treeview {{active('shipping')[0]}}">
          <a href="#">
            <i class="fa fa-list"></i> <span>{{trans('admin.shipping')}}</span>
            <span class="pull-right-container">  
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu " style="{{active('shipping')[1]}};">
            <li class=""><a href="{{aurl('shipping')}}"><i class="fa fa-list"></i> {{trans('admin.shipping')}}</a></li>
            <li class=""><a href="{{aurl('shipping/create')}}"><i class="fa fa-plus"></i> {{trans('admin.add')}}</a></li>
            
          </ul>
        </li>
      </ul>
      <ul class="sidebar-menu" data-widget="tree">
        <li class=" treeview {{active('products')[0]}}">
          <a href="#">
            <i class="fa fa-product-hunt"></i> <span>{{trans('admin.products')}}</span>
            <span class="pull-right-container">  
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu " style="{{active('products')[1]}};">
            <li class=""><a href="{{aurl('products')}}"><i class="fa fa-product-hunt"></i> {{trans('admin.products')}}</a></li>
            <li class=""><a href="{{aurl('products/create')}}"><i class="fa fa-plus"></i> {{trans('admin.add')}}</a></li>
            
          </ul>
        </li>
      </ul>
      <ul class="sidebar-menu" data-widget="tree">
        <li class=" treeview {{active('accessories')[0]}}">
          <a href="#">
            <i class="fa fa-product-hunt"></i> <span>{{trans('admin.accessories')}}</span>
            <span class="pull-right-container">  
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu " style="{{active('accessories')[1]}};">
            <li class=""><a href="{{aurl('accessories')}}"><i class="fa fa-product-hunt"></i> {{trans('admin.accessories')}}</a></li>
            <li class=""><a href="{{aurl('accessories/create')}}"><i class="fa fa-plus"></i> {{trans('admin.add')}}</a></li>
            
          </ul>
        </li>
      </ul>
      <ul class="sidebar-menu" data-widget="tree">
        <li class=" treeview {{active('subscribe')[0]}}">
          <a href="#">
            <i class="fa fa-users"></i> <span>{{trans('admin.subscribe')}}</span>
            <span class="pull-right-container">  
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu " style="{{active('subscribe')[1]}};">
            <li class=""><a href="{{aurl('subscribe')}}"><i class="fa fa-users"></i> {{trans('admin.subscribe')}}</a></li>            
          </ul>
        </li>
      </ul>
      <ul class="sidebar-menu" data-widget="tree">
        <li class=" treeview {{active('recieve')[0]}}">
          <a href="#">
            <i class="fa fa-users"></i> <span>{{trans('admin.recieving')}}</span>
            <span class="pull-right-container">  
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu " style="{{active('recieve')[1]}};">
            <li class=""><a href="{{aurl('recieve')}}"><i class="fa fa-users"></i> {{trans('admin.recieving')}}</a></li>            
          </ul>
        </li>
      </ul>
      <ul class="sidebar-menu" data-widget="tree">
        <li class=" treeview {{active('contact')[0]}}">
          <a href="#">
            <i class="fa fa-phone"></i> <span>{{trans('admin.contact')}}</span>
            <span class="pull-right-container">  
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu " style="{{active('contact')[1]}};">
            <li class=""><a href="{{aurl('contact')}}"><i class="fa fa-phone"></i> {{trans('admin.contact')}}</a></li>            
          </ul>
        </li>
      </ul>
      <ul class="sidebar-menu" data-widget="tree">
        <li class=" treeview {{active('review')[0]}}">
          <a href="#">
            <i class="fa fa-file-text"></i> <span>{{trans('admin.review')}}</span>
            <span class="pull-right-container">  
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu " style="{{active('review')[1]}};">
            <li class=""><a href="{{aurl('review')}}"><i class="fa fa-file-text"></i> {{trans('admin.review')}}</a></li>            
          </ul>
        </li>
      </ul>
 

    </section>
    <!-- /.sidebar --> 
  </aside>
