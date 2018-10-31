@extends('style.index')
@section('content')
<!-- start banner -->
<!--initiate accordion-->
		<script type="text/javascript">
			$(function() {
			    var menu_ul = $('.menu > li > ul'),
			           menu_a  = $('.menu > li > a');
			    menu_ul.hide();
			    menu_a.click(function(e) {
			        e.preventDefault();
			        if(!$(this).hasClass('active')) {
			            menu_a.removeClass('active');
			            menu_ul.filter(':visible').slideUp('normal');
			            $(this).addClass('active').next().stop(true,true).slideDown('normal');
			        } else {
			            $(this).removeClass('active');
			            $(this).next().stop(true,true).slideUp('normal');
			        }
			    });
			
			});
		</script>
							
<div class="single">
<div class="container">
<div class="content span_1_of_2">
				<?php 
					$brand = session('lang') == 'ar'? \App\Models\TradeMarks::find($product->brand)->name_ar:\App\Models\TradeMarks::find($product->brand)->name_en;
					$accessories = \App\Accessories::where('prod_name_en',$product->name_en)->get();
					$model = \App\Models\Products::where('name_en',$product->name_en)->get();
					$color = \App\Models\Products::where('name_en',$product->name_en)->get();

				?>

					<div class="grid images_3_of_2">
						<div class="slider">
					<div class="callbacks_container"><!-- <div class="wrapper"> -->

						<div class="slideshow-container">

						  <!-- Full-width images with number and caption text -->
						  <div class="mySlides ">
						    <div class="numbertext">{{session('lang') == 'ar'?$product->name_ar:$product->name_en}}</div>
						    <img id="myImg" src="{{Storage::url($product->logo)}}" alt="{{session('lang') == 'ar'?$product->name_ar:$product->name_en}}" style="height:500px;width:350px">
						    <div class="textfont" style="color: blue; font-weight: bold; font-size: 20px;">{{trans('admin.product')}}</div>
						  </div>
						@if(sizeof($accessories) > 0)
					  	@foreach($accessories as $accesso)
						  <div class="mySlides">
						    <div class="numbertext">{{session('lang') == 'ar'?$accesso->name_ar:$accesso->name_en}}</div>
						    <img src="{{Storage::url($accesso->photo)}}" style="height:500px;width:350px">
						    <div class="textfont" style="color: blue;">{{trans('admin.accessories')}}</div>
						  </div>
						@endforeach
						@endif

						  <!-- Next and previous buttons -->
						  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
						  <a class="next" onclick="plusSlides(1)">&#10095;</a>
						</div>
						<br>

						<!-- The dots/circles -->
						<div style="text-align:center">
						  <span class="dot" onclick="currentSlide(1)"></span> 
						@if(sizeof($accessories) > 0)
						<?php $countslid = 0; ?>
					  	@foreach($accessories as $accesso)
					  		<?php $countslid++; ?>
						 	<span class="dot" onclick="currentSlide($countslid)"></span>
						 @endforeach
						@endif 
						</div>

					  	<!-- <ul class="rslides" id="slider">
					  		<li>
				  				<img id="myImg" src="{{Storage::url($product->logo)}}" alt="Snow" style="width:100%;max-width:300px">	
					  		</li>

					  			<li class="example-item" id="modal-image">
									<img src="{{url('Demos')}}/assets/images/example-5.jpg" width="196" height="147" alt="Example 5">
									<a href="#">Modal Image</a>
								</li>
					  		<li>
								<img src="{{Storage::url($product->logo)}}" class="img-responsive" alt="" style="height: 600px; width: 380px;">
							</li>
							@if(sizeof($accessories) > 0)
					  		@foreach($accessories as $accesso)
							<li>
								<img src="{{Storage::url($accesso->photo)}}" class="img-responsive" alt="" style="height: 600px; width: 380px;">
								<div class="caption">
									<h3>{{trans('admin.accessories')}}</h3>
									<p>{{session('lang') == 'ar'?$accesso->name_ar:$accesso->name_en}}</p>
								</div>
							</li>
							@endforeach
							@endif
						</ul> -->
			  		</div>
				 </div>
					</div>
		<div class="desc span_3_of_2">
					<h3>{{trans('admin.great')}}</h3>
			<div class="desc">
				
                <span class="brand">{{trans('admin.brand').":"}} {{$brand}} </span><br>
                <span class="brand">{{trans('admin.products_model').":"}} 
                	@foreach($model as $size)
                	<span> {{($size->model).", "}} </span>
                	@endforeach
                </span><br>
                @if(sizeof($accessories) > 0)
                <span class="brand">{{trans('admin.accessories').":"}} 
                	@foreach($accessories as $accesso)
                		<span> {{(session('lang') == 'ar'?$accesso->name_ar:$accesso->name_en).", "}} </span>
                	@endforeach
                </span><br>
                @endif
                <span class="brand">{{trans('admin.products_size').":"}}{{$product->size}} </span><br>
                <span class="code">{{session('lang') == 'ar'? trans('admin.prod_name_ar'): trans('admin.prod_name_en')}}: {{session('lang') == 'ar'?$product->name_ar: $product->name_en}}</span>
                <br>
                <span class="code">{{trans('admin.colors')}}:
  				<div style="display: flex;">
  				@foreach($color as $col)
                 <span  style="height: 25px; width: 25px; display: block; background-color: {{$col->color}}"></span>&ensp;
                @endforeach
                </div>
             </span>
            	 <span>{{trans('admin.catalog').":"}} 
             	@if(!empty($product->catalog))
                <a href="{{ aurl('download/'.$product->id.'/'.str_slug($product->file_name, '-')) }}" style="font-weight: bold; size: 14px;" >{{trans('admin.download')}}</a>
                <br>
                <br>
              @else
                  <span style="color: black; font-weight: bold; size: 14px;"> {{trans('admin.nofile')}} </span>
              @endif
               </span>
               <br>

            <div class="price">
        		
        		<div class="form-group">
        		<span class="code">{{trans('admin.price').": "}}</span>
            	@if(!empty($product->discount))
            	<div class=" form form-control">
		            <span class="price-new" >{{currency($product->price - ($product->price*$product->discount)/100,'USD' ,session('currc'))}}</span>
		            <span class="price-old">{{currency($product->price,"USD",session('currc'))}}</span>
            	</div>
                @else
                <span class="price-new" style="padding-right: 120px;">{{currency($product->price,"USD",session('currc'))}}</span>
                @endif
                </div> 
                        <!-- <span class="price-tax">Ex Tax: $90.00</span><br>
                        <span class="points"><small>Price in reward points: 400</small></span> -->
            </div>
                  <div class="single-cart">
			        <div class="prod-row">
			          <div class="cart-top">
			            <div class="cart-top-padd">
			              </div>
						  <form action="{{url('cart')}}" method="POST">
									{{csrf_field()}}
									<input type="hidden" name="name" value="{{$product->name_en}}">
									@if(session('currc') == "USD")
									<input type="hidden" name="price" value="{{($product->price - ($product->price*$product->discount)/100)+$product->shipping_cost}}">
									@elseif(session('currc') == "EUR")
									<input type="hidden" name="price" value="{{(($product->price*(settings()->dollar_egypt/settings()->euro_egypt )) - (($product->price*(settings()->dollar_egypt/settings()->euro_egypt ))*$product->discount)/100)+($product->shipping_cost*(settings()->dollar_egypt/settings()->euro_egypt ))}}">
									@elseif(session('currc') == "EGP")
									<input type="hidden" name="price" value="{{(($product->price*(settings()->dollar_egypt/1 )) - (($product->price*(settings()->dollar_egypt/1 ))*$product->discount)/100)+($product->shipping_cost*(settings()->dollar_egypt/1 ))}}">
									@endif
									<input type="hidden" name="id" value="{{$product->id}}">
									<input type="submit" value="{{trans('admin.addToCart')}}" class="btn btn-primary">
								</form>
			          </div>
        			</div>
        		</div>
          </div>
	</div>
				<div class="clearfix"> </div>
		<div class="sap_tabs">	
				     <div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
						  <ul class="resp-tabs-list">
						  	  <li class="resp-tab-item resp-tab-active" aria-controls="tab_item-0" role="tab"><span>{{trans('admin.desc')}}</span></li>
							  <li class="resp-tab-item" aria-controls="tab_item-2" role="tab"><span>{{trans('admin.review')}}</span></li>
							  <div class="clear"></div>
						  </ul>				  	 
							<div class="resp-tabs-container">
							    <h2 class="resp-accordion" role="tab" aria-controls="tab_item-0"><span class="resp-arrow"></span> {{trans('admin.desc')}}</h2><div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
									<div class="facts">
									  <ul class="tab_list">
									  	<li>{{$product->description}}</li>
									  </ul>           
							        </div>
							     </div>		
							      <h2 class="resp-accordion" role="tab" aria-controls="tab_item-2"><span class="resp-arrow"></span>{{trans('admin.review')}}</h2><div class="tab-1 resp-tab-content" aria-labelledby="tab_item-2">
							 <ul class="tab_list">
							<li data-content="television" class="selected">
								<div class="comments-top-top">
									<div class="top-comment-right">
										<h6><a href="#">{{!empty(auth()->guard('user')->user())?auth()->guard('user')->user()->name:"  "}}</a> - {{\Carbon\Carbon::now()->format('y/m/d')}}</h6>
										<!-- <ul class="star-footer">
											<li><a href="#"><i> </i></a></li>
											<li><a href="#"><i> </i></a></li>
											<li><a href="#"><i> </i></a></li>
											<li><a href="#"><i> </i></a></li>
											<li><a href="#"><i> </i></a></li>
										</ul> -->
										<form method="POST" action = "{{url('review')}}" >
                                                    {{csrf_field()}}
                                                    <h2>{{trans('admin.review')}}</h2>
                                                    <div class="submit-review">
                                                        <p><label for="name">{{trans('admin.user_name')}}:</label>
                                                        	<br>
                                                        	<input class="form form-control" value="{{old('name')}}" name="name" placeholder="{{trans('admin.user_name')}}" type="text"></p>
                                                        <p><label for="email">{{trans('admin.email')}}:</label>
                                                        	<br>
                                                         <input class="form form-control" value="{{old('email')}}" name="email" placeholder="{{trans('admin.email')}}" type="email"></p>
                                                        <div class="rating-chooser">
                                                            <p>{{trans('admin.ur_rating')}}</p>

                                                            <div class="rating-wrap-post">
                                                                <i style="color: #ffcc00" class="fa fa-star"></i>
                                                                <i style="color: #ffcc00" class="fa fa-star"></i>
                                                                <i style="color: #ffcc00" class="fa fa-star"></i>
                                                                <i style="color: #ffcc00" class="fa fa-star"></i>
                                                                <i style="color: #ffcc00" class="fa fa-star"></i>
                                                            </div>
                                                            {!! Form::select('rate',[1=>"1 ".trans('admin.star'),2=>"2 ".trans('admin.star'),3=>"3 ".trans('admin.star'),4=>"4 ".trans('admin.star'),5=>"5 ".trans('admin.star')],old('rate'),['class'=>'form form-control', 'placeholder'=>trans('admin.ur_rating')]) !!}
                                                        </div>
                                                        <p><label for="review">{{trans('admin.ur_review')}}</label> 
                                                        	{!! Form::textarea('review',old('review'),['style'=>'height: 200px; width: 400px;','class'=>'form form-control','placeholder'=> trans('admin.review')]) !!}
                                                        	<!-- <textarea name="review"  style="height: 200px; width: 400px;"></textarea></p> -->
                                                        <p><input class="btn btn-primary" type="submit" value="{{trans('admin.add')}}"></p>
                                                </form>
									</div>
										<div class="clearfix"> </div>
								</div>
							</li>
									  </ul>      
							     </div>	
							</div>
					      </div>
					 </div>
				</div>	
					<div class="clearfix"> </div>
					<center><h3 class="alert alert-success">{{trans('admin.related')}}</h3></center>
			<div class="row shop_box-top">
				@foreach($related as $relat)
				@if($relat->id == $product->id)
				@else
				<div class="col-md-3 shop_box"><a href="{{url('shop/'.$relat->id)}}">
					<img src="{{Storage::url($relat->logo)}}" class="img-responsive" alt="">
					</a>
						<div class="special-info grid_1 simpleCart_shelfItem">
							<h5>{{session('lang') == 'ar'? $relat->name_ar:$relat->name_en}}</h5>
							<center>
							@if(session('currc') == 'EGP')
								@if(!empty($relat->discount))
							<span class="item_price">
								<span class="reducedfrom"> {{currency_USD_EGP($relat->price)}}</span>
								<span class="actual">{{currency_USD_EGP($relat->price-($relat->price*($relat->discount/100)))}}
								</span>
							</span>
								@else
							<span class="item_price">
								<span class="actual">{{currency_USD_EGP($relat->price-($relat->price*($relat->discount/100)))}}</span>
							</span>
								@endif
							@elseif(session('currc') == "EUR")
								@if(!empty($relat->discount))
							<span class="item_price">
								<span class="reducedfrom"> {{currency_USD_EUR($relat->price)}}</span>
								<span class="actual">{{currency_USD_EUR($relat->price-($relat->price*($relat->discount/100)))}}
								</span>
							</span>
								@else
							<span class="item_price">
								<span class="actual">{{currency_USD_EUR($relat->price-($relat->price*($relat->discount/100)))}}</span>
							</span>
								@endif
							@elseif(session('currc') == "USD")
								@if(!empty($relat->discount))
							<span class="item_price">
								<span class="reducedfrom"> {{currency_USD_USD($relat->price)}}</span>
								<span class="actual">{{currency_USD_USD($relat->price-($relat->price*($relat->discount/100)))}}
								</span>
							</span>
								@else
							<span class="item_price">
								<span class="actual">{{currency_USD_USD($relat->price-($relat->price*($relat->discount/100)))}}</span>
							</span>
								@endif
							@endif
							
						</center>
							<div class="item_add"><span class="item_price">
								<form action="{{url('cart')}}" method="POST">
									{{csrf_field()}}
									<input type="hidden" name="name" value="{{$relat->name_en}}">
									@if(session('currc') == "USD")
									<input type="hidden" name="price" value="{{($relat->price - ($relat->price*$relat->discount)/100)+$relat->shipping_cost}}">
									@elseif(session('currc') == "EUR")
									<input type="hidden" name="price" value="{{(($relat->price*(settings()->dollar_egypt/settings()->euro_egypt )) - (($relat->price*(settings()->dollar_egypt/settings()->euro_egypt ))*$relat->discount)/100)+($relat->shipping_cost*(settings()->dollar_egypt/settings()->euro_egypt ))}}">
									@elseif(session('currc') == "EGP")
									<input type="hidden" name="price" value="{{(($relat->price*(settings()->dollar_egypt/1 )) - (($relat->price*(settings()->dollar_egypt/1 ))*$relat->discount)/100)+($relat->shipping_cost*(settings()->dollar_egypt/1 ))}}">
									@endif
									<input type="hidden" name="id" value="{{$relat->id}}">
									<input type="submit" value="{{trans('admin.addToCart')}}" class="btn btn-primary">
								</form>
							</span></div>
						</div>
				</div>
				@endif
				@endforeach
			</div>
				
</div>
</div>	
@endsection