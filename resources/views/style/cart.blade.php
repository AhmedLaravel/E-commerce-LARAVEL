@extends('style.index')
@section('content')
<!-- start banner -->
<!-- Modal -->
                                                
<div class="check">	 
<div class="container">

			 <div class="col-md-3 cart-total">
			 <a class="continue" href="{{url('shop')}}">{{trans('admin.continue_shopping')}}</a>
			 <div class="price-details">
				 <h3>{{trans('admin.price_details')}}</h3>
				 <span>{{trans('admin.subtotal')}}</span>
				 <span class="total1">{{currency($subtotal,'USD',session('currc'))}}</span>
				 <span>{{trans('admin.tax')}}</span>
				 <span class="total1">{{currency($tax,'USD',session('currc'))}}</span>
				 <div class="clearfix"></div>				 
			 </div>	
			 <ul class="total_price">
			   <li class="last_price"> <h4>{{trans('admin.total')}}</h4></li>	
			   <li class="last_price"><span>{{currency($total,'USD',session('currc'))}}</span></li>
			   <div class="clearfix"> </div>
			 </ul>
			
			 
			 <div class="clearfix">
			 	
			 </div>
			 <!-- <a class="order" href="{{url('checkout')}}">{{trans('admin.checkout')}}</a> -->
			 @if(Cart::count() > 0)
			 <form action='https://sandbox.2checkout.com/checkout/purchase' method='post'>
				<input type='hidden' name='sid' value='901394211' >
				<input type='hidden' name='mode' value='2CO' >
				<input type='hidden' name='currency_code' value="{{session('currc')}}" >
				<input type='hidden' name='user_name' value="{{auth()->guard('user')->user()->name}}" >
				<?php $i = 0; ?>
				@foreach(Cart::content() as $goods)
				<input type='hidden' name="li_{{$i}}_type" value='product' >
				<input type='hidden' name="li_{{$i}}_name" value="{{$goods->name}}" >
				<input type='hidden' name="li_{{$i}}_product_id" value="{{$goods->id}}" >
				<input type='hidden' name="li_{{$i}}__description" value="{{$goods->model->description}}" >
				<input type='hidden' name="li_{{$i}}_price" value="{{ sprintf('%.2f',$goods->price) }}" >
				<input type='hidden' name="li_{{$i}}_quantity" value="{{$goods->qty}}" >
				<input type='hidden' name="li_{{$i}}_tangible" value='Y' >
				<input type='hidden' name="Custom_model_for_product_ID_{{$goods->id}}" value="{{$goods->options['size']}}" >
				<input type='hidden' name="Custom_color_for_product_ID_{{$goods->id}}" value="{{$goods->options['color']}}" >
				<?php $i++ ?>
				@endforeach
				<input name='submit' class="btn btn-primary" type='submit' value='{{trans("admin.check_credit")}}' >
			</form>
			@endif
			<br>
			<br>
			@if(Cart::count() > 0)
			<a class="btn btn-primary" href="{{url('checkout')}}">{{trans('admin.on_recieve')}}</a>
			@endif
			</div>
		 <div class="col-md-9 cart-items">
			 <h1>{{trans('admin.my_cart')}} ({{Cart::count()}})</h1>
			 @foreach(Cart::content() as $item)

			 <div class="cart-header">
				 <div class="">
				 	<?php
                    $rowItem = \App\Models\Products::find($item->id);
                    ?>
				 	<!-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_admin{{$rowItem->id}}"><i class="fa fa-trash"> -->
				 		{{Form::open(['route'=>["cart.destroy",$item->rowId], 'method' => 'DELETE'])}}
				      <!-- <div class="modal-body">
				        <p class="btn btn-danger">{{trans('admin.ask_delte', ['name'=>session('lang') == 'ar'?$rowItem->name_ar:$rowItem->name_en])}}</p>
				      </div> -->
				      <!-- <div class="modal-footer"> -->
				        <!-- <button type="button" class="btn btn-info" data-dismiss="modal">{{trans("admin.close")}}</button> -->
				        {{Form::submit(trans('admin.delete'),['class'=>'btn btn-danger'])}}
				        
				        {{Form::close()}}
				 	</i></a></button>
                                                <hr>
                                                {!! Form::open(['url'=>url('cart/saveforlater/'.$item->rowId), 'method'=>'POST']) !!}
                                                <div class="">
                                                    {!! Form::submit(trans('admin.saveForLater'),['title'=>trans('admin.saveForLater'),'class'=>'btn btn-primary']) !!}
                                                </div>
                                                {!! Form::close() !!}
                                                <hr>
				 </div>
				 <div class="cart-sec simpleCart_shelfItem">
						<div class="cart-item cyc">
							 <img src="{{Storage::url($item->model->logo)}}" class="img-responsive" alt=""/>
						</div>
					   <div class="cart-item-info">
						<h3><a href="{{url('shop/'.$rowItem->id)}}">{{session('lang') == 'ar'?$rowItem->name_ar:$rowItem->name_en}}</a>
							<span>{{trans('admin.products_model')}}: {{$item->options['size']}}</span>
							@if(!empty($rowItem->discount))
							<div class="form form-group" >	
								<span>{{trans('admin.price')}}: {{currency($rowItem->price-($rowItem->price*$rowItem->discount/100),"USD",session('currc'))}}</span>
								<span> <del>{{currency($rowItem->price,"USD",session('currc'))}}</del> </span>
							</div>
							@else
							<span>{{trans('admin.price')}}: {{currency($rowItem->price,"USD",session('currc'))}}</span>
							@endif

						</h3>
						<ul class="qty">
							<li><p>{{trans('admin.color')}} :{{$item->options['color']}} </p></li>
							<li><p>{{trans('admin.quantity')}} : {{$item->qty}}</p></li>
						</ul>
						
							 <div class="delivery">
							 <p>{{trans('admin.shipping_cost')}} : {{currency($rowItem->shipping_cost,"USD",session('currc'))}}</p>
							 <span>{{trans('admin.time_to_deliver')}}: {{settings()->time_to_deliver}}</span>
							 <div class="clearfix"></div>
				        </div>	
				        <br>
					   </div>
					   <br>
					   <br>
					   <br>
					   
					   {{Form::open(['url'=>url('cart/'.$item->rowId), 'method'=>'PATCH'])}}
						   <center>
						   	<span style="font-size: 15px;" class="label label-info">{{trans('admin.edit_quantity')}}</span>

						   </center>
	                        <td >
	                            <div >
	                                
	                                {{Form::select('itemQuantity',[1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10],old('itemQuantity'),[ 'class'=>'form form-control',  'title'=>trans('admin.quantity'),'placeholder'=>$item->qty])}}
	                                
	                            </div>
	                        </td>
	                        <br>
	                        <center>
						   		<span style="font-size: 15px;" class="label label-info">{{trans('admin.edit_model')}}</span>

						   </center>
	                        <td >
	                            <div >
	                                
	                                {{Form::select('itemModel',\App\Models\Products::where('name_en',$item->model->name_en)->pluck('model','model'),old('itemModel'),[ 'class'=>'form form-control',  'title'=>trans('admin.model'),'placeholder'=>$item->options['size']])}}
	                                
	                            </div>
	                        </td>
	                        <br>
	                        <center>
						   		<span style="font-size: 15px;" class="label label-info">{{trans('admin.edit_color')}}</span>

						   </center>
	                        <td >
	                            <div >
	                                
	                                {{Form::select('itemColor',\App\Models\Products::where('name_en',$item->model->name_en)->pluck(session('lang') == 'ar'? 'color_name_ar':'color_name_en','color_name_en'),old('itemColor'),[ 'class'=>'form form-control',  'title'=>trans('admin.color'),'placeholder'=>$item->options['color']])}}
	                                
	                            </div>
	                        </td>
	                        <br>
						<center>{{Form::submit(trans('admin.edit_cart'),['class'=>'btn btn-primary'])}}</center>
						{{Form::close()}}
					   <div class="clearfix"></div>
											
				  </div>
			 </div>
			 <hr>
			 @endforeach
			 <!-- <div class="cart-header2">
				 <div class="close2"> </div>
				  <div class="cart-sec simpleCart_shelfItem">
						<div class="cart-item cyc">
							 <img src="images/11.jpg" class="img-responsive" alt=""/>
						</div>
					   <div class="cart-item-info">
						<h3><a href="#">Mountain Hopper(XS R034)</a><span>Model No: 3578</span></h3>
						<ul class="qty">
							<li><p>Size : 5</p></li>
							<li><p>Qty : 1</p></li>
						</ul>
							 <div class="delivery">
							 <p>Service Charges : Rs.100.00</p>
							 <span>Delivered in 2-3 bussiness days</span>
							 <div class="clearfix"></div>
				        </div>	
					   </div>
					   <div class="clearfix"></div>
											
				  </div>
			  </div>		
		 </div> -->
		 
		
			<div class="clearfix"> </div>
			
			@if(!empty(Cart::instance('saveForLater')->count() > 0))
			<center><h1>{{trans('admin.saveForLater')." ".trans('admin.products')}}</h1></center>
			@foreach(Cart::instance('saveForLater')->content() as $product)
			<?php $item = \App\Models\Products::find($product->id) ?>
				<div class="col-md-3 shop_box"><a href="{{url('shop/'.$product->id)}}">
					<img src="{{Storage::url($item->logo)}}" class="img-responsive" alt="">
					</a>
						<div class="special-info grid_1 simpleCart_shelfItem">
							<center><a href="{{url('shop/'.$product->id)}}"><h5>{{session('lang') == 'ar'? $item->name_ar: $item->name_en}}</h5></a></center>
							<div class="item_add">
							@if(session('currc') == 'EGP')
								@if(!empty($item->discount))
							<span class="item_price">
								<span class="reducedfrom"> {{currency_USD_EGP($item->price)}}</span>
								<span class="actual">{{currency_USD_EGP($item->price-($item->price*($item->discount/100)))}}
								</span>
							</span>
								@else
							<span class="item_price">
								<span class="actual">{{currency_USD_EGP($item->price-($item->price*($item->discount/100)))}}</span>
							</span>
								@endif
							@elseif(session('currc') == "EUR")
								@if(!empty($item->discount))
							<span class="item_price">
								<span class="reducedfrom"> {{currency_USD_EUR($item->price)}}</span>
								<span class="actual">{{currency_USD_EUR($item->price-($item->price*($item->discount/100)))}}
								</span>
							</span>
								@else
							<span class="item_price">
								<span class="actual">{{currency_USD_EUR($item->price-($item->price*($item->discount/100)))}}</span>
							</span>
								@endif
							@elseif(session('currc') == "USD")
								@if(!empty($item->discount))
							<span class="item_price">
								<span class="reducedfrom"> {{currency_USD_USD($item->price)}}</span>
								<span class="actual">{{currency_USD_USD($item->price-($item->price*($item->discount/100)))}}
								</span>
							</span>
								@else
							<span class="item_price">
								<span class="actual">{{currency_USD_USD($item->price-($item->price*($item->discount/100)))}}</span>
							</span>
								@endif
							@endif
							</div>

							<div class="item_add"><span class="item_price">
								<form action="{{url('cart')}}" method="POST">
									{{csrf_field()}}
									<input type="hidden" name="id" value="{{$item->id}}">
									@if(session('currc') == "USD")
									<input type="hidden" name="price" value="{{($item->price - ($item->price*$item->discount)/100)+$item->shipping_cost}}">
									@elseif(session('currc') == "EUR")
									<input type="hidden" name="price" value="{{(($item->price*(settings()->dollar_egypt/settings()->euro_egypt )) - (($item->price*(settings()->dollar_egypt/settings()->euro_egypt ))*$item->discount)/100)+($item->shipping_cost*(settings()->dollar_egypt/settings()->euro_egypt ))}}">
									@elseif(session('currc') == "EGP")
									<input type="hidden" name="price" value="{{(($item->price*(settings()->dollar_egypt/1 )) - (($item->price*(settings()->dollar_egypt/1 ))*$item->discount)/100)+($item->shipping_cost*(settings()->dollar_egypt/1 ))}}">
									@endif
									<input type="hidden" name="name" value="{{$item->name_en}}">
									<div class="form-group">
									 <input type="submit" value="{{trans('admin.addToCart')}}" class="btn btn-primary">
									</div>
										
								</form>
									 <!-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_item{{$product->id}}"><i class="fa fa-trash">  </i></button> -->
									 {{Form::open(['url' => url('cart/removesaveforlater/'.$product->rowId) ,'method'=>'delete'])}}
                                                        
	                                        {{Form::submit(trans('admin.delete'),['class'=>'btn btn-danger'])}}
                                        
                                        {{Form::close()}}				
							</span>
						</div>
						</div>
				</div>
				@endforeach
				@endif
	 </div>
	 </div>
<!-- special -->
<!--  -->
@endsection