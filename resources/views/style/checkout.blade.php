@extends('style.index')
@section('content')
<!-- start banner -->
@if(Cart::count() > 0)
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home" class="btn btn-primary">{{trans('admin.products')}}</a></li>
    <li><a data-toggle="tab" href="#menu1" class="btn btn-primary">{{trans('admin.desc')}}</a></li>
    <li><a data-toggle="tab" href="#menu2" class="btn btn-primary">{{trans('admin.price')}}</a></li>
    <li><a data-toggle="tab" href="#menu3" class="btn btn-primary">{{trans('admin.quantity')}}</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
        <br>
        <br>
    <center><span style="font-size: 19px;" class="label label-primary">{{trans('admin.products')}}</span></center>
        <br>
        <br>
      @foreach(Cart::content() as $cart)
        <h4  class="alert alert-info">{{session('lang') == 'ar'?$cart->model->name_ar:$cart->model->name_en}}</h4>
      @endforeach
    </div>
    <div id="menu1" class="tab-pane fade">
      <br>
        <br>
    <center><span style="font-size: 19px;" class="label label-primary">{{trans('admin.desc')}}</span></center>
        <br>
        <br>
      <br>
      @foreach(Cart::content() as $cart)
        <span style="font-size: 17px;"  class="alert alert-info">{{session('lang') == 'ar'?$cart->model->name_ar:$cart->model->name_en}}</span>
        <br>
        <br>
        <p>{{$cart->model->description}}</p>
        <br>
      @endforeach
    </div>
    <div id="menu2" class="tab-pane fade">
      <br>
        <br>
    <center><span style="font-size: 19px;" class="label label-primary">{{trans('admin.price')}}</span></center>
        <br>
        <br>
    @foreach(Cart::content() as $cart)
        <span style="font-size: 17px;"  class="alert alert-info">{{session('lang') == 'ar'?$cart->model->name_ar:$cart->model->name_en}}</span>
        <?php $item  = \App\Models\Products::find($cart->id) ?>
        <br>
        <br>
        <p>{{currency($item->price,"USD",session('currc'))}}</p>
        <br>
      @endforeach
     
    </div>
    <div id="menu3" class="tab-pane fade">
      <br>
        <br>
    <center><span style="font-size: 19px;" class="label label-primary">{{trans('admin.quantity')}}</span></center>
        <br>
        <br>
    @foreach(Cart::content() as $cart)
        <span style="font-size: 17px;"  class="alert alert-info">{{session('lang') == 'ar'?$cart->model->name_ar:$cart->model->name_en}}</span>
        <br>
        <br>
        <p>{{$cart->qty}}</p>
        <br>
    @endforeach
      
    </div>
  </div>
<hr class="btn-primary">
<form  action="{{url('recieve')}}"  id="payment-form" method="POST">
                                {{csrf_field()}}

                                <div id="customer_details" class="col2-set">
                                    <div class="col-1">
                                        <div class="woocommerce-billing-fields">
                                            <h3 class="alert alert-success">{{trans('admin.billing_details')}}</h3>
                                            <p id="billing_country_field" class="form-row form-row-wide address-field update_totals_on_change validate-required woocommerce-validated">
                                                <label class="" for="billing_country">{{trans('admin.country')}} <abbr title="required" class="required">*</abbr>
                                                </label>
                                                {!! Form::select('billing_country', \App\Models\Countries::pluck(session()->has('lang')?'name_'.settings()->main_lang:name_en,session('lang') == 'ar'?'name_ar':'name_en') ,old('country_id'),['class'=>'form form-control', 'id'=>'billing_country',"placeholder"=>trans('admin.select_country')]) !!}  
                                            </p>

                                            <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                                <label class="" for="billing_first_name"> {{trans('admin.nam_user')}} <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" value="{{old('billing_first_name')}}" required placeholder="" id="billing_first_name" name="billing_first_name" class="input-text ">
                                            </p>

                                            <div class="clear"></div>

                                            <p id="billing_company_field" class="form-row form-row-wide">
                                                <label class="" for="billing_company">{{trans('admin.company')}}</label>
                                                <input type="text" value="{{old('billing_company')}}" required placeholder="" id="billing_company" name="billing_company" class="input-text ">
                                            </p>

                                            <p id="billing_address_1_field" class="form-row form-row-wide address-field validate-required">
                                                <label class="" for="billing_address_1">{{trans('admin.address1')}} <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" value="{{old('billing_address_1')}}" required placeholder="{{trans('admin.street')}}" id="billing_address_1" name="billing_address_1" class="input-text " style="color: white;">
                                            </p>

                                            <p id="billing_address_2_field" class="form-row form-row-wide address-field">
                                                <input type="text" value="{{old('billing_address_2')}}" required placeholder="Apartment, suite, unit etc. (optional)" id="billing_address_2" name="billing_address_2" class="input-text ">
                                            </p>

                                            <p id="billing_city_field" class="form-row form-row-wide address-field validate-required" data-o_class="form-row form-row-wide address-field validate-required">
                                                <label class="" for="billing_city">{{trans('admin.city')}} <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <!-- {!! Form::select('billing_city', \App\Models\Cities::pluck(session()->has('lang')?'name_'.settings()->main_lang:name_en,session('lang') == 'ar'?'name_ar':'name_en') ,old('country_id'),['class'=>'form form-control', 'id'=>'billing_city',"placeholder"=>trans('admin.select_city')]) !!} -->  
                                                <input type="text" value="{{old('billing_city')}}" required placeholder="{{trans('admin.city')}}" id="billing_city" name="billing_city" class="input-text ">
                                            </p>

                                            <p id="billing_state_field" class="form-row form-row-first address-field validate-state" data-o_class="form-row form-row-first address-field validate-state">
                                                <label class="" for="billing_state"><!-- {{trans('admin.state')}}</label>
                                                {!! Form::select('billing_state', \App\Models\States::pluck(session()->has('lang')?'name_'.settings()->main_lang:name_en,session('lang') == 'ar'?'name_ar':'name_en') ,old('country_id'),['class'=>'form form-control', 'id'=>'billing_state',"placeholder"=>trans('admin.select_State')]) !!}  -->
                                                <input type="text" id="billing_state" name="billing_state" placeholder="State / County" value="{{old('billing_state')}}" required class="input-text ">
                                            </p>
                                            <p id="billing_postcode_field" class="form-row form-row-last address-field validate-required validate-postcode" data-o_class="form-row form-row-last address-field validate-required validate-postcode">
                                                <label class="" for="billing_postcode">{{trans('admin.postal_code')}} <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" value="{{old('billing_postcode')}}" required placeholder="Postcode / Zip" id="billing_postcode" name="billing_postcode" class="input-text ">
                                            </p>

                                            <div class="clear"></div>

                                            <p id="billing_email_field" class="form-row form-row-first validate-required validate-email">
                                                <label class="" for="billing_email">{{trans('admin.email')}} <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" value="{{old('billing_email')}}" required placeholder="" id="billing_email" name="billing_email" class="input-text ">
                                            </p>

                                            <p id="billing_phone_field" class="form-row form-row-last validate-required validate-phone">
                                                <label class="" for="billing_phone">{{trans('admin.phone')}} <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" value="{{old('billing_phone')}}" required placeholder="" id="billing_phone" name="billing_phone" class="input-text ">
                                            </p>
                                            <div class="clear"></div>


                                            <!-- <div class="form-group">
                                                <label for="card-element">
                                                  Credit or debit card
                                                </label>
                                                <div id="card-element">
                                                  
                                                </div>

                                                
                                                <div id="card-errors" role="alert"></div>
                                            </div>
 -->
                                        </div>
                                    </div>

                                    <!-- <div class="col-2">
                                        <div class="woocommerce-shipping-fields">
                                            <h3 id="ship-to-different-address">
                        <label class="checkbox" for="ship-to-different-address-checkbox">Ship to a different address?</label>
                        <input type="checkbox" value="1" name="ship_to_different_address" checked="checked" class="input-checkbox" id="ship-to-different-address-checkbox">
                        </h3>
                                            <p id="order_comments_field" class="form-row notes">
                                                <label class="" for="order_comments">Order Notes</label>
                                                <textarea cols="5" rows="2" placeholder="Notes about your order, e.g. special notes for delivery." id="order_comments" class="input-text " name="order_comments"></textarea>
                                            </p>


                                        </div>

                                    </div>
 -->
                                </div>

                                        <!-- <ul class="payment_methods methods">
                                            <li class="payment_method_bacs">
                                                <input type="radio" data-order_button_text="" checked="checked" value="bacs" name="payment_method" class="input-radio" id="payment_method_bacs">
                                                <label for="payment_method_bacs">Direct Bank Transfer </label>
                                                <div class="payment_box payment_method_bacs">
                                                    <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                                </div>
                                            </li>
                                            <li class="payment_method_cheque">
                                                <input type="radio" data-order_button_text="" value="cheque" name="payment_method" class="input-radio" id="payment_method_cheque">
                                                <label for="payment_method_cheque">Cheque Payment </label>
                                                <div style="display:none;" class="payment_box payment_method_cheque">
                                                    <p>Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                                </div>
                                            </li>
                                            <li class="payment_method_paypal">
                                                <input type="radio" data-order_button_text="Proceed to PayPal" value="paypal" name="payment_method" class="input-radio" id="payment_method_paypal">
                                                <label for="payment_method_paypal">PayPal <img alt="PayPal Acceptance Mark" src="https://www.paypalobjects.com/webstatic/mktg/Logo/AM_mc_vs_ms_ae_UK.png"><a title="What is PayPal?" onclick="javascript:window.open('https://www.paypal.com/gb/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;" class="about_paypal" href="https://www.paypal.com/gb/webapps/mpp/paypal-popup">What is PayPal?</a>
                                                </label>
                                                <div style="display:none;" class="payment_box payment_method_paypal">
                                                    <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                                                </div>
                                            </li>
                                        </ul> -->

                                        <h3 id="order_review_heading">Your order</h3>

                                <div id="order_review" style="position: relative;">
                                	<table>
										<caption>{{trans('admin.products')." ".trans('admin.price')}}</caption>
										<thead>
										<tr>
										  <th>{{trans('admin.product')}}</th>
										  <th>{{trans('admin.quantity')}}</th>
                                          <th>{{trans('admin.price')}}</th>
										  <th>{{trans('admin.price_with_tax')}}</th>
										  <th>{{trans('admin.total')}}</th>
										  <th>{{trans('admin.total_with_tax')}}</th>
										</tr>
										</thead>
										<tbody>
										@foreach(Cart::content() as $item)
                                        <?php $rowItem = \App\Models\Products::find($item->id) ?>
										<tr>
										  <td>{{session('lang') == 'ar'?$item->model->name_ar:$item->model->name_en}}</td>
										  <td>{{$item->qty}}</td>
										  <td>{{currency($rowItem->price-($rowItem->price*$rowItem->discount/100),'USD',session('currc'))}}</td>
                                          <td>{{currency(($rowItem->price-($rowItem->price*$rowItem->discount/100)+$rowItem->shipping_cost),'USD',session('currc'))}}</td>
										  <td>{{currency($rowItem->price-($rowItem->price*$rowItem->discount/100) * $item->qty,'USD',session('currc'))}}</td>
										  <td>{{currency((($rowItem->price -($rowItem->price* $rowItem->discount/100)) + $rowItem->shipping_cost)*$item->qty,'USD',session('currc'))}}</td>
										</tr>
										@endforeach
										</tbody>
										<tfoot>
										<tr>
										  <th colspan="5">{{trans('admin.grand_total')}}</th>
										  <th>{{currency($total,"USD",session('currc'))}}</th>
										</tr>
										</tfoot>
									</table>
                                        <div class="clear"></div>

                                    </div>
                                </div>
                                        <div class="form-row place-order">

                                            <input type="submit" id="complete_order" data-value="Place order" value="{{trans('admin.place_order')}}" id="place_order" name="woocommerce_checkout_place_order" class="button alt">


                                        </div>
                            </form>
                            @elseif(Cart::count() == 0)
                            <h1 class="alert alert-info">{{trans('admin.empty_cart')}}</h1>
                            @endif
                            <br>
                            <br>
                            <br>
<!-- special -->

@endsection