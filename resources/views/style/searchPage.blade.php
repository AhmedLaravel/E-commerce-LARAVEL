@extends('style.index')
@section('content')    
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2 class="alert alert-success">{{$key_word.' '.$title}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="shop_top">
        <div class="container">
            <div class="row shop_box-top">
                @if(sizeof($results) > 0)
                @foreach($results as $result)
                    <div class="col-md-3 shop_box"><a href="{{url('shop/'.$result->id)}}">
                    <img src="{{Storage::url($result->logo)}}" class="img-responsive" alt="">
                    
                    
                    </a>
                        <div class="special-info grid_1 simpleCart_shelfItem">
                            <h5>{{session('lang') == 'ar'? $result->name_ar: $result->name_en}}</h5>
                            <div class="item_add">
                            @if(session('currc') == 'EGP')
                                @if(!empty($result->discount))
                            <span class="item_price">
                                <span class="reducedfrom"> {{currency_USD_EGP($result->price)}}</span>
                                <span class="actual">{{currency_USD_EGP($result->price-($result->price*($result->discount/100)))}}
                                </span>
                            </span>
                                @else
                            <span class="item_price">
                                <span class="actual">{{currency_USD_EGP($result->price-($result->price*($result->discount/100)))}}</span>
                            </span>
                                @endif
                            @elseif(session('currc') == "EUR")
                                @if(!empty($result->discount))
                            <span class="item_price">
                                <span class="reducedfrom"> {{currency_USD_EUR($result->price)}}</span>
                                <span class="actual">{{currency_USD_EUR($result->price-($result->price*($result->discount/100)))}}
                                </span>
                            </span>
                                @else
                            <span class="item_price">
                                <span class="actual">{{currency_USD_EUR($result->price-($result->price*($result->discount/100)))}}</span>
                            </span>
                                @endif
                            @elseif(session('currc') == "USD")
                                @if(!empty($result->discount))
                            <span class="item_price">
                                <span class="reducedfrom"> {{currency_USD_USD($result->price)}}</span>
                                <span class="actual">{{currency_USD_USD($result->price-($result->price*($result->discount/100)))}}
                                </span>
                            </span>
                                @else
                            <span class="item_price">
                                <span class="actual">{{currency_USD_USD($result->price-($result->price*($result->discount/100)))}}</span>
                            </span>
                                @endif
                            @endif
                            </div>

                            <div class="item_add"><span class="item_price">
                                <form action="{{url('cart')}}" method="POST">
                                    {{csrf_field()}}
                                    <input type="hidden" name="id" value="{{$result->id}}">
                                    @if(session('currc') == "USD")
                                    <input type="hidden" name="price" value="{{($result->price - ($result->price*$result->discount)/100)+$result->shipping_cost}}">
                                    @elseif(session('currc') == "EUR")
                                    <input type="hidden" name="price" value="{{(($result->price*(settings()->dollar_egypt/settings()->euro_egypt )) - (($result->price*(settings()->dollar_egypt/settings()->euro_egypt ))*$result->discount)/100)+($result->shipping_cost*(settings()->dollar_egypt/settings()->euro_egypt ))}}">
                                    @elseif(session('currc') == "EGP")
                                    <input type="hidden" name="price" value="{{(($result->price*(settings()->dollar_egypt/1 )) - (($result->price*(settings()->dollar_egypt/1 ))*$result->discount)/100)+($result->shipping_cost*(settings()->dollar_egypt/1 ))}}">
                                    @endif
                                    <input type="hidden" name="name" value="{{$result->name_en}}">
                                     <input type="submit" value="{{trans('admin.addToCart')}}" class="btn btn-primary">
                                </form>                         
                            </span></div>
                        </div>
                </div>
                @endforeach
                @else
                <br>
                <br>
                <center><h2 class="alert alert-warning">{{trans('admin.noProducts')}}</h2></center>
                <br>
                <br>
                @endif
            </div>
            @if(sizeof($brands) > 0)
                    <div class="row shop_box-top">
                        
                            <center><h2 class="alert alert-success"><span>{{trans('admin.trademarks')}}</span></h2></center>
                            <hr>
                            @foreach($brands as $brand)
                                <div class="col-md-3 shop_box"><a href="{{url('trade/'.$brand->id)}}">
                    <img src="{{Storage::url($brand->logo)}}" class="img-responsive" alt="">
                    
                    
                        <div class="special-info grid_1 simpleCart_shelfItem">
                            <h5>{{session('lang') == 'ar'? $brand->name_ar: $brand->name_en}}</h5>
                    </a>
                    </div>
                </div>
                            @endforeach
            @else
                    <br>
                    <br>
                    <center><h2 class="alert alert-warning">{{trans('admin.noTradeMarks')}}</h2></center>
                    <br>
                    <br>
            @endif
            
            <!-- <div class="row">
        <div class="clearfix"> </div>
                <div class="col-md-12">
                    <div class="result-pagination text-center">
                        <nav>
                          <ul class="pagination">
                            <li>
                              <a href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                              </a>
                            </li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li>
                              <a href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                              </a>
                            </li>
                          </ul>
                        </nav>                        
                    </div>
                </div>
            </div> -->
            
        <div class="clearfix"> </div>
        <br>
        <br>
@endsection