<?php 

Route::group(['prefix'=>'users', 'namespace'=>'Admin'], function(){
	Config::set('auth.defaults.guard', 'user');
	Route::get('/login','usersAuth@login_user' );
	Route::get('/forgot/password','usersAuth@forgot_password' );
	Route::post('/forgot/password','usersAuth@reset_password' );
	Route::get('/reset/password/{token}','usersAuth@new_password' );
	Route::post('/reset/password/{token}','usersAuth@change_password' );
	Route::post('/login','usersAuth@do_login' );
});

//////////////////User Sign Up ////////////////////
	Route::get('user/signup','UserSignUp@sign_up');
	Route::post('user/signup','UserSignUp@do_sign_up');
//////////////////User Sign Up ////////////////////


			////////////Currency Exchange////////////////
            \App\Models\Currency::where('code','EGP')->update(['exchange_rate'=>1]);
            \App\Models\Currency::where('code','USD')->update(['exchange_rate'=>(1/settings()->dollar_egypt)]);
            \App\Models\Currency::where('code','EUR')->update(['exchange_rate'=>(1/settings()->euro_egypt)]);
            if(!session()->has('currc')){
            	session()->put('currc',settings()->main_currency);
            }
            ////////////Currency Exchange////////////////	
	Route::get('/', function(){
		if(auth()->guard('user')->user()){
			return view('style.home');
		}else{
			return redirect(uurl('login'));
		}
	});
	Route::group(['namespace'=>'Admin'], function(){
			Route::get('/logout','usersAuth@do_logout');
	});
	Route::group(['middleware'=>'Maintenance'],function(){
			Route::get('/','LandingPageController@index');
	});
///////////////////// Maintenance Case //////////////
	Route::get('maintenance', function(){
			if(settings()->status == 'opened'){
				return redirect('/');
			}
			return view('style.maintenance');
	});
///////////////////// Maintenance Case //////////////

//////////////////////////////// Review Controller //////////////////////
	Route::group(['namespace'=>'Admin'],function(){
		Route::delete('review/destory/all','ReviewsController@multi_delete');
		Route::resource('review','ReviewsController');
	});
//////////////////////////////// Review Controller //////////////////////
	
//////////////////Shopping Methods //////////////
	Route::resource('shop','ShopController');
	Route::get('trade/{id}','ShopController@showTradeProducts');
//////////////////Shopping Methods //////////////
Route::group(['middleware'=>'users:user'],function(){
//////////////////Cart Routes //////////////
	Route::get('cart/destroy',function(){
		if(Cart::count() > 0){
			Cart::destroy();
			session()->flash('message',trans('admin.cart_has_been_destroyed'));
			return back();
		}else if(Cart::count() == 0){
			session()->flash('message',trans('admin.cart_already_empty'));
			return back();
		}
	});
	Route::resource('cart','Cart_controller');
	Route::post('cart/saveforlater/{save}','Cart_controller@saveForLater');
	Route::delete('cart/removesaveforlater/{save}','Cart_controller@removeSaved');
	Route::get('callback','Cart_controller@callback');
//////////////////Cart Routes //////////////
});

//////////////////Department Routes //////////////
	Route::get('departments','Departments@showDep');
	Route::get('tradeMarks/{id}','Departments@showTrade');
//////////////////Department Routes //////////////

//////////////////Checkout Methods //////////////
	Route::resource('checkout','CheckoutController');
//////////////////Checkout Methods //////////////

//////////////////Checkout Methods //////////////
	Route::get('tradeMarks','TradeShow@ShowTrade');
//////////////////Checkout Methods //////////////
	
//////////////////////// Subscribe Controller ///////////
	Route::group(['namespace'=>'Admin'], function(){
		Route::delete('subscribe/destory/all','SubscribesController@multi_delete');
		Route::resource('subscribe','SubscribesController');
	});
/////////////////////// Subscribe Controller ////////////

//////////////////////////////// On Recieving Controller //////////////////////
	Route::group(['namespace'=>'Admin'], function(){
		Route::delete('recieve/destory/all','OnRecieveController@multi_delete');
		Route::resource('recieve','OnRecieveController');
	});
//////////////////////////////// On Recieving Controller //////////////////////

//////////////////Contact Page //////////////
	Route::get('contact/us',function(){
		return view('style.contact',['title'=>trans('admin.contact_page')]);
	});
	Route::post('contact/us','ContactController@contact');
//////////////////Contact Page //////////////	

//////////////////Top Selling //////////////
	Route::resource('top/selling','TopSelling');
//////////////////Top Selling //////////////

//////////////////Latest Products //////////////
	Route::resource('latest','LatestProducts');
//////////////////Latest Products //////////////

//////////////////Recent Products //////////////
	Route::get('recently/viewed','RecentlyViewed@show');
//////////////////Recent Products //////////////	

//////////////////About Us Page //////////////
	Route::get('about/us','AboutController@aboutPage');
//////////////////About Us Page //////////////	

//////////////////Serach Controller //////////////
	Route::post('search/products','SerchController@search');
	Route::get('search/products',function(){
		return back();
	});
	Route::get('show/products',function(){
		return view('style.show');
	});

//////////////////Search Controller//////////////

//////////////////// Language specifire ///////////////////
	Route::get('lang/{lang}',function($lang){
		session()->has('lang')? session()->forget('lang'): '';
		if($lang == 'en'){
			session()->put('lang','en');
		}else if($lang == 'ar'){
			session()->put('lang','ar');
		}else if($lang == 'grm'){
			session()->put('lang','grm');
		}
		/*$lang == 'en'? session()->put('lang', 'en'):session()->put('lang', 'ar');*/
		return back();

	});
//////////////////// Language specifire ///////////////////

//////////////////// Currency specifire ///////////////////
	Route::get('currency/{currency}',function($currency){
		if($currency == session('currc') ){
		}else{
			\Cart::destroy();
		}
		session()->has('currc')? session()->forget('currc'): '';
		if($currency == 'USD'){
			session()->put('currc','USD');
		}else if($currency == 'EUR'){
			session()->put('currc','EUR');
		}else if($currency == 'EGP'){
			session()->put('currc','EGP');
		}
		
		return back();

	});
//////////////////// Currency specifire ///////////////////
