@extends('style.index')
@section('content')
<!-- start banner -->
<div class="shop_top">
		<div class="container">
			<div class="row shop_box-top">
				@foreach($best_selling_products as $product)
				<div class="col-md-3 shop_box"><a href="{{url('shop/'.$product->id)}}">
					<img src="{{Storage::url($product->logo)}}" class="img-responsive" alt="">
					
					
					</a>
						<div class="special-info grid_1 simpleCart_shelfItem">
							<h5>{{session('lang') == 'ar'? $product->name_ar: $product->name_en}}</h5>
							<div class="item_add">
							@if(session('currc') == 'EGP')
								@if(!empty($product->discount))
							<span class="item_price">
								<span class="reducedfrom"> {{currency_USD_EGP($product->price)}}</span>
								<span class="actual">{{currency_USD_EGP($product->price-($product->price*($product->discount/100)))}}
								</span>
							</span>
								@else
							<span class="item_price">
								<span class="actual">{{currency_USD_EGP($product->price-($product->price*($product->discount/100)))}}</span>
							</span>
								@endif
							@elseif(session('currc') == "EUR")
								@if(!empty($product->discount))
							<span class="item_price">
								<span class="reducedfrom"> {{currency_USD_EUR($product->price)}}</span>
								<span class="actual">{{currency_USD_EUR($product->price-($product->price*($product->discount/100)))}}
								</span>
							</span>
								@else
							<span class="item_price">
								<span class="actual">{{currency_USD_EUR($product->price-($product->price*($product->discount/100)))}}</span>
							</span>
								@endif
							@elseif(session('currc') == "USD")
								@if(!empty($product->discount))
							<span class="item_price">
								<span class="reducedfrom"> {{currency_USD_USD($product->price)}}</span>
								<span class="actual">{{currency_USD_USD($product->price-($product->price*($product->discount/100)))}}
								</span>
							</span>
								@else
							<span class="item_price">
								<span class="actual">{{currency_USD_USD($product->price-($product->price*($product->discount/100)))}}</span>
							</span>
								@endif
							@endif
							</div>

							<div class="item_add"><span class="item_price">
								<form action="{{url('cart')}}" method="POST">
									{{csrf_field()}}
									<input type="hidden" name="id" value="{{$product->id}}">
									@if(session('currc') == "USD")
									<input type="hidden" name="price" value="{{($product->price - ($product->price*$product->discount)/100)+$product->shipping_cost}}">
									@elseif(session('currc') == "EUR")
									<input type="hidden" name="price" value="{{(($product->price*(settings()->dollar_egypt/settings()->euro_egypt )) - (($product->price*(settings()->dollar_egypt/settings()->euro_egypt ))*$product->discount)/100)+($product->shipping_cost*(settings()->dollar_egypt/settings()->euro_egypt ))}}">
									@elseif(session('currc') == "EGP")
									<input type="hidden" name="price" value="{{(($product->price*(settings()->dollar_egypt/1 )) - (($product->price*(settings()->dollar_egypt/1 ))*$product->discount)/100)+($product->shipping_cost*(settings()->dollar_egypt/1 ))}}">
									@endif
									<input type="hidden" name="name" value="{{$product->name_en}}">
									 <input type="submit" value="{{trans('admin.addToCart')}}" class="btn btn-primary">
								</form>							
							</span></div>
						</div>
				</div>
				@endforeach
				</div>
			</div>
	   </div>

@endsection