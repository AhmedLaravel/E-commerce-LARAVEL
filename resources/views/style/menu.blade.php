<!-- header -->
<div class="header_bg">
<div class="container">
	<div class="header">
	<div class="head-t">
		<div class="logo">
			<a href="{{url('/')}}"><img src="{{Storage::url(settings()->logo)}}" class="img-responsive" alt=""/ style="height: 100px; width: 100px;"> </a>
		</div>
		<!-- start header_right -->
		<div class="header_right">
			<div class="rgt-bottom">
				<div class="dropdown">
				  <span class="btn btn-primary" style="font-size: 13.5px;" ><i class="fa fa-list"></i>{{trans('admin.lang')}}</span>
				  <div class="dropdown-content drop-down">
				  	<div class="d-arrow alert alert-info">
				  		<a href="{{url('lang/en')}}"><span style="color: blue;"><i class="fa fa-select"></i> English</span>  </a>
				  		<hr>
				  		<a href="{{url('lang/ar')}}"><span style="color: blue;">عربي</span> </a>
				  		<hr>
				  		<a href="{{url('lang/grm')}}"><span style="color: blue;">Deutsche</span> </a>
				  	</div>
				    
				  </div>
				</div>
				<div class="dropdown">
				  <span class="btn btn-primary" style="font-size: 13.5px;" ><i class="fa fa-list"></i>{{trans('admin.currency')}} (@if(session('currc') == 'USD')
				  	$
				  	@elseif(session('currc') == "EUR")
				  	€
				  	@elseif(session('currc') == "EGP")
				  	ج.م
				  	@endif)</span>
				  <div class="dropdown-content drop-down">
				  	<div class="d-arrow alert alert-info">
				  		<a href="{{url('currency/USD')}}"> <span style="color: blue;">USD($)</span>  </a>
				  		<hr>
				  		<a href="{{url('currency/EUR')}}" ><span style="color: blue;">EUR(€)</span></a>
				  		<hr>
				  		<a href="{{url('currency/EGP')}}"><span style="color: blue;">EGP(ج.م)</span></a>
				  	</div>
				    
				  </div>
				</div>
				@if(auth()->guard('user')->user())
				<a  href="{{url('logout')}}"><span class="btn btn-primary">{{trans('admin.logout')}}</span></a>
				@else
				<a  href="{{uurl('login')}}"><span class="btn btn-primary">{{trans('admin.login')}}</span></a>
				<a  href="{{url('user/signup')}}"><span class="btn btn-primary">{{trans('admin.sign_up')}}</span></a>
				@endif					
			<div class="clearfix"> </div>
		</div>
		@if(request()->segment(1) == 'checkout')
			@else
		<div class=" form">
			<div class="search form ">
				<form action="{{url('search/products')}}" method = "POST">
					{{csrf_field()}}
					<input type="text" name="search" placeholder="{{trans('admin.search')}}">
					<input class="btn btn-primary" type="submit" value="{{trans('admin.search')}}" > 
				</form>
			</div>
				<div class="cart box_1">
						<a href="{{url('cart')}}">
							<h3>{{trans('admin.the_cart')}} <span class="">
								<?php
									$total = 0;
									$subtotal = 0;
							        foreach (Cart::instance('default')->content() as $item) {
							            $prod = \App\Models\Products::find($item->id);
            							$subtotal += ($prod->price - ($prod->price*$prod->discount)/100)*$item->qty;
							            $total += (($prod->price - ($prod->price*$prod->discount)/100)+$prod->shipping_cost)*$item->qty;
							        } 
								 ?>
							 {{currency($subtotal,"USD",session('currc'))}} </span>  <img src="{{url('web')}}/images/bag.png" alt=""></h3>
						</a>	
						<p><a href="{{url('cart/destroy')}}" class="simpleCart_empty">{{trans('admin.empty_cart_content')}}</a>
							<br>
							<small>{{trans('admin.cart_content')}}{{Cart::instance('default')->count()}}</small>
						</p>
						<div class="clearfix"> </div>
					</div>
					@endif
			<div class="clearfix"> </div>
		</div>
		</div>
			<div class="clearfix"> </div>
	</div>
