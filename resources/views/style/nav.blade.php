<!-- start header menu -->

		<div class="header-top">
			<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class=""><a href="{{url('/')}}">{{trans('admin.dash')}} </a></li>
        <li class="dropdown" >
          <a href="{{url('web')}}/#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{trans('admin.product')}} <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{url('departments')}}">{{trans('admin.dep')}}s</a></li>
            <li><a href="{{url('cart')}}">{{trans('admin.cart')}}</a></li>
          </ul>
        </li>
		 <li class="dropdown">
          <a href="{{url('web')}}/#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{trans('admin.shop')}} <span class="caret"></span></a>
            <ul class="dropdown-menu">
            <li><a href="{{url('shop')}}">{{trans('admin.shop')}}</a></li>
            <li><a href="{{url('tradeMarks')}}">{{trans('admin.trademarks')}}</a></li>
           
          </ul>
        </li>
		<li><a href="{{url('about/us')}}">{{trans('admin.about')}}</a></li>
		<li><a href="{{url('contact/us')}}">{{trans('admin.contact')}}</a></li>
      </ul>
      
    
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
		</div>
		<!-- start header menu -->
	</div>
</div>
</div>
