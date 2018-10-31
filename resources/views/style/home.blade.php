@extends('style.index')
@section('content')
<!-- start banner -->
<div class="banner">
	<div class="container">
		<div class="col-md-6 banner-left">
			<div class="header-slider">
				<div class="slider">
					<div class="callbacks_container">
					  	<ul class="rslides" id="slider">
					  		@foreach($trads as $trad)
							<li>
								<img src="{{Storage::url($trad->logo)}}" class="img-responsive" alt="" style="height: 600px; width: 100%;">
								<div class="caption">
									<h3>{{session('lang') == 'ar'? $trad->name_ar: $trad->name_en}}</h3>
									<p><a href="{{url('trade/'.$trad->id)}}"> {{trans('admin.get_brand_products')}} </a></p>
								</div>
							</li>
							@endforeach
						</ul>
			  		</div>
				 </div>
				</div>
		</div>
		<?php $discounts = \App\Models\Products::orderBy('id','desc')->get();
			$i = 0;
		 ?>
		<div class="special">
	<div class="container">
		<div class="specia-top">
			<ul class="grid_2">
		@foreach($discounts as $discount)
			@if($discount->discount != null and $i < 4)
			<?php $i++; ?>
			<li>
					<a href="{{url('shop/'.$discount->id)}}"><img src="{{Storage::url($discount->logo)}}" class="img-responsive" alt="">
					</a>
					<div class="special-info grid_1 simpleCart_shelfItem">
						<h5>{{session('lang') == 'ar'? $discount->name_ar: $discount->name_en}}</h5>
						<div class="item_add">
							<span class="item_price">
								<h6>
								@if(session('currc') == 'EGP')
									@if(!empty($discount->discount))
								<span class="item_price">
									<span class="reducedfrom"> {{currency_USD_EGP($discount->price)}}</span>
									<span class="actual">{{currency_USD_EGP($discount->price-($discount->price*($discount->discount/100)))}}
									</span>
								</span>
									@else
								<span class="item_price">
									<span class="actual">{{currency_USD_EGP($discount->price-($discount->price*($discount->discount/100)))}}</span>
								</span>
									@endif
								@elseif(session('currc') == "EUR")
									@if(!empty($discount->discount))
								<span class="item_price">
									<span class="reducedfrom"> {{currency_USD_EUR($discount->price)}}</span>
									<span class="actual">{{currency_USD_EUR($discount->price-($discount->price*($discount->discount/100)))}}
									</span>
								</span>
									@else
								<span class="item_price">
									<span class="actual">{{currency_USD_EUR($discount->price-($discount->price*($discount->discount/100)))}}</span>
								</span>
									@endif
								@elseif(session('currc') == "USD")
									@if(!empty($discount->discount))
								<span class="item_price">
									<span class="reducedfrom"> {{currency_USD_USD($discount->price)}}</span>
									<span class="actual">{{currency_USD_USD($discount->price-($discount->price*($discount->discount/100)))}}
									</span>
								</span>
									@else
								<span class="item_price">
									<span class="actual">{{currency_USD_USD($discount->price-($discount->price*($discount->discount/100)))}}</span>
								</span>
									@endif
								@endif
								</h6>
							</span>
						</div>
						<div class="item_add"><span class="item_price"><form action="{{url('cart')}}" method="POST">
										{{csrf_field()}}
										<input type="hidden" name="id" value="{{$discount->id}}">
										@if(session('currc') == "USD")
										<input type="hidden" name="price" value="{{($discount->price - ($discount->price*$discount->discount)/100)+$discount->shipping_cost}}">
										@elseif(session('currc') == "EUR")
										<input type="hidden" name="price" value="{{(($discount->price*(settings()->dollar_egypt/settings()->euro_egypt )) - (($discount->price*(settings()->dollar_egypt/settings()->euro_egypt ))*$discount->discount)/100)+($discount->shipping_cost*(settings()->dollar_egypt/settings()->euro_egypt ))}}">
										@elseif(session('currc') == "EGP")
										<input type="hidden" name="price" value="{{(($discount->price*(settings()->dollar_egypt/1 )) - (($discount->price*(settings()->dollar_egypt/1 ))*$discount->discount)/100)+($discount->shipping_cost*(settings()->dollar_egypt/1 ))}}">
										@endif
										<input type="hidden" name="name" value="{{$discount->name_en}}">
										 <input type="submit" value="{{trans('admin.addToCart')}}" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>
									</form></span></div>
					</div>
			</li>
			@endif
		@endforeach
		<div class="clearfix"> </div>
	</ul>
		</div>
	</div>
</div>
		
	</div>
</div>
<div class="special">
	<div class="container">
		<div class="specia-top">
			<ul class="grid_2">
		@foreach($newProducts as $newProduct)
		<li>
				<a href="{{url('shop/'.$newProduct->id)}}"><img src="{{Storage::url($newProduct->logo)}}" class="img-responsive" alt="">
				</a>
				<div class="special-info grid_1 simpleCart_shelfItem">
					<h5>{{session('lang') == 'ar'? $newProduct->name_ar: $newProduct->name_en}}</h5>
					<div class="item_add">
						<span class="item_price">
							<h6>
							@if(session('currc') == 'EGP')
								@if(!empty($newProduct->discount))
							<span class="item_price">
								<span class="reducedfrom"> {{currency_USD_EGP($newProduct->price)}}</span>
								<span class="actual">{{currency_USD_EGP($newProduct->price-($newProduct->price*($newProduct->discount/100)))}}
								</span>
							</span>
								@else
							<span class="item_price">
								<span class="actual">{{currency_USD_EGP($newProduct->price-($newProduct->price*($newProduct->discount/100)))}}</span>
							</span>
								@endif
							@elseif(session('currc') == "EUR")
								@if(!empty($newProduct->discount))
							<span class="item_price">
								<span class="reducedfrom"> {{currency_USD_EUR($newProduct->price)}}</span>
								<span class="actual">{{currency_USD_EUR($newProduct->price-($newProduct->price*($newProduct->discount/100)))}}
								</span>
							</span>
								@else
							<span class="item_price">
								<span class="actual">{{currency_USD_EUR($newProduct->price-($newProduct->price*($newProduct->discount/100)))}}</span>
							</span>
								@endif
							@elseif(session('currc') == "USD")
								@if(!empty($newProduct->discount))
							<span class="item_price">
								<span class="reducedfrom"> {{currency_USD_USD($newProduct->price)}}</span>
								<span class="actual">{{currency_USD_USD($newProduct->price-($newProduct->price*($newProduct->discount/100)))}}
								</span>
							</span>
								@else
							<span class="item_price">
								<span class="actual">{{currency_USD_USD($newProduct->price-($newProduct->price*($newProduct->discount/100)))}}</span>
							</span>
								@endif
							@endif
							</h6>
						</span>
					</div>
					<div class="item_add"><span class="item_price"><form action="{{url('cart')}}" method="POST">
									{{csrf_field()}}
									<input type="hidden" name="id" value="{{$newProduct->id}}">
									@if(session('currc') == "USD")
									<input type="hidden" name="price" value="{{($newProduct->price - ($newProduct->price*$newProduct->discount)/100)+$newProduct->shipping_cost}}">
									@elseif(session('currc') == "EUR")
									<input type="hidden" name="price" value="{{(($newProduct->price*(settings()->dollar_egypt/settings()->euro_egypt )) - (($newProduct->price*(settings()->dollar_egypt/settings()->euro_egypt ))*$newProduct->discount)/100)+($newProduct->shipping_cost*(settings()->dollar_egypt/settings()->euro_egypt ))}}">
									@elseif(session('currc') == "EGP")
									<input type="hidden" name="price" value="{{(($newProduct->price*(settings()->dollar_egypt/1 )) - (($newProduct->price*(settings()->dollar_egypt/1 ))*$newProduct->discount)/100)+($newProduct->shipping_cost*(settings()->dollar_egypt/1 ))}}">
									@endif
									<input type="hidden" name="name" value="{{$newProduct->name_en}}">
									 <input type="submit" value="{{trans('admin.addToCart')}}" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>
								</form></span></div>
				</div>
		</li>
		@endforeach
		<div class="clearfix"> </div>
	</ul>
		</div>
	</div>
</div>
<hr>
<div class="footer">
	<div class="container">
		<div class="col-md-3 cust">
			<a href="{{url('top/selling')}}"><h4>{{trans('admin.top_selling')}}</h4></a>
		<div style="padding-left: 50px;">
        @foreach($best_selling_products as $top)
  				<li><a href="{{url('shop/'.$top->id)}}"><img src="{{Storage::url($top->logo)}}" style="height: 50px; width: 50px;"></a></li>
          <a href="{{url('shop/'.$top->id)}}"><small>{{session('lang') == 'ar'?$top->name_ar:$top->name_en}}</small></a>
        @endforeach
    	</div>
      <!--
				<li><a href="{{url('web')}}/#">How To Buy</a></li>
				<li><a href="{{url('web')}}/#">Delivery</a></li>
		 --></div>
		<div class="col-md-3 abt">
			<a href="{{url('latest')}}"><h4>{{trans('admin.latest')}}</h4></a>
			<div style="padding-left: 50px;">
		        @foreach($newests as $newest)
		  				<li><a href="{{url('shop/'.$newest->id)}}"><img src="{{Storage::url($newest->logo)}}" style="height: 50px; width: 50px;"></a></li>
		          <a href="{{url('shop/'.$newest->id)}}"><small>{{session('lang') == 'ar'?$newest->name_ar:$newest->name_en}}</small></a>
		        @endforeach
		    </div>
		</div>
		<div class="col-md-3 myac">
			<a href="{{url('recently/viewed')}}"><h4>{{trans('admin.recently')}}</h4></a>
			<div style="padding-left: 50px;">
				@foreach($recents as $recent)
		  				<li><a href="{{url('shop/'.$recent->id)}}"><img src="{{Storage::url($recent->logo)}}" style="height: 50px; width: 50px;"></a></li>
		          <a href="{{url('shop/'.$recent->id)}}"><small>{{session('lang') == 'ar'?$recent->name_ar:$recent->name_en}}</small></a>
		        @endforeach
		    </div>
		</div>
		<div class="col-md-3 our-st">
				<h4>{{trans('admin.ourstore')}}</h4>
				<li><i class="add"> </i>{{settings()->address1}}</li>
				<li><i class="phone"> </i>{{settings()->phone}}</li>
				<li><a href="{{url(settings()->mail)}}"><i class="mail"> </i>{{settings()->mail}}</a></li>
			
		</div>
		<div class="clearfix"> </div>
	</div>
</div>
<!-- special -->

@endsection