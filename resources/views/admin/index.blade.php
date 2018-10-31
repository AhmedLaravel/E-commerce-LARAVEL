@include('admin.layout.header')
@include('admin.layout.nav')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>{{trans('admin.con_panel')}}</small>
      </h1>
      <ol class="breadcrumb">
        @if(auth()->user())
        <li><a href="{{uurl()}}"><i class="fa fa-dashboard"></i> {{trans('admin.home')}}</a></li>
         <li class="active">Dashboard</li>
        
        @else
        <li class="active">Dashboard</li><li><a href="{{aurl()}}"><i class="fa fa-dashboard"></i> {{trans('admin.home')}}</a></li>
        @endif
       
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
 		   @include('admin.layout.message')
    	@yield('content')
  </section>
</div>

@include('admin.layout.footer')
