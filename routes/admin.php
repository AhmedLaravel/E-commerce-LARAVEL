<?php 

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
	Config::set('auth.defaults.guard', 'admin');
	Route::get('/login','adminAuth@login' );
	Route::get('/forgot/password','adminAuth@forgot_password' );
	Route::post('/forgot/password','adminAuth@reset_password' );
	Route::get('/reset/password/{token}','adminAuth@new_password' );
	Route::post('/reset/password/{token}','adminAuth@change_password' );
	Route::post('/login','adminAuth@do_login' );
//////////////////// Admin Middleware /////////////
	Route::group(['middleware'=>'admin:admin'],function(){
		Route::get('/', function(){
			if(auth()->guard('admin')->user()){
				return view('admin.layout.home');
			}
		});
		Route::get('/logout','adminAuth@do_logout');

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
			return back();

		});
//////////////////// Language specifire ///////////////////

//////////////////////////////// Settings Routes //////////////////////
		Route::get('settings','SettingsAdmin@setting_get');
		Route::post('settings','SettingsAdmin@setting_post');
//////////////////////////////// Settings Routes //////////////////////

//////////////////////////////// Admin Routes //////////////////////
		Route::delete('admin/destory/all','AdminController@multi_delete');
		Route::resource('admin','AdminController');
//////////////////////////////// Admin Routes //////////////////////

//////////////////////////////// On Recieve Controller //////////////////////
		Route::delete('recieve/destory/all','OnRecieveController@multi_delete');
		Route::resource('recieve','OnRecieveController');
//////////////////////////////// On Recieve Controller //////////////////////

//////////////////////////////// Departments Routes //////////////////////
		Route::delete('department/destory/all','DepartmentController@multi_delete');
		Route::resource('department','DepartmentController');
//////////////////////////////// Departments Routes //////////////////////

//////////////////////////////// Users Routes //////////////////////
		Route::delete('users/destory/all','UsersController@multi_delete');
		Route::resource('users','UsersController');
//////////////////////////////// Users Routes //////////////////////

//////////////////////////////// Subscribe Controller //////////////////////
		Route::delete('subscribe/destory/all','SubscribesController@multi_delete');
		Route::resource('subscribe','SubscribesController');
		Route::get('subscribe/email/subscribers','SubscribesController@email_get');
		Route::post('subscribe/email/subscribers','SubscribesController@email_post');
//////////////////////////////// Subscribe Controller //////////////////////

//////////////////////////////// Countries Routes //////////////////////
		Route::delete('countries/destory/all','CountriesController@multi_delete');
		Route::resource('countries','CountriesController');
//////////////////////////////// Countries Routes //////////////////////

//////////////////////////////// On Recieve Routes //////////////////////
		Route::delete('recieve/destory/all','OnRecieveController@multi_delete');
		Route::resource('recieve','OnRecieveController');
//////////////////////////////// On Recieve Routes //////////////////////

//////////////////////////////// City Routes //////////////////////
		Route::delete('cities/destory/all','CitiesController@multi_delete');
		Route::resource('cities','CitiesController');
//////////////////////////////// City Routes //////////////////////

//////////////////////////////// States Routes //////////////////////
		Route::delete('states/destory/all','StatesController@multi_delete');
		Route::resource('states','StatesController');
//////////////////////////////// States Routes //////////////////////
		
//////////////////////////////// Trade Marks Routes //////////////////////
		Route::delete('trademarks/destory/all','TradeMarksController@multi_delete');
		Route::resource('trademarks','TradeMarksController');
//////////////////////////////// Trade Marks Routes //////////////////////

//////////////////////////////// Manifacturer Routes //////////////////////
		Route::delete('manifacts/destory/all','ManifactController@multi_delete');
		Route::resource('manifacts','ManifactController');
//////////////////////////////// Manifacturer Routes //////////////////////

//////////////////////////////// Shipping Companies Routes //////////////////////
		Route::delete('shipping/destory/all','ShippingController@multi_delete');
		Route::resource('shipping','ShippingController');
//////////////////////////////// Shipping Companies Routes //////////////////////

//////////////////////////////// Products Routes //////////////////////
		Route::delete('products/destory/all','ProductsController@multi_delete');
		Route::resource('products','ProductsController');
//////////////////////////////// Products Routes //////////////////////

//////////////////////////////// Accessories Routes //////////////////////
		Route::delete('accessories/destory/all','AccessoriesController@multi_delete');
		Route::resource('accessories','AccessoriesController');
//////////////////////////////// Accessories Routes //////////////////////

//////////////////////////////// Review Controller //////////////////////
		Route::delete('review/destory/all','ReviewsController@multi_delete');
		Route::resource('review','ReviewsController');
//////////////////////////////// Review Controller //////////////////////


//////////////////////////////// Catalog Download //////////////////////
		Route::get('download/{id}/{filename}', function($id){
		    // Check if file exists in app/storage/file folder
		    $prod = \App\Models\Products::find($id);
		    $file_path = storage_path().'/app/public/'.$prod->catalog;
		    // return $file_path;
		    if (file_exists($file_path))
		    {
		        // Send Download
		        return Response::download($file_path, $prod->file_name, [
		            'Content-Length: '. filesize($file_path)
		        ]);
		    }
		    else
		    {
		        // Error
		        exit('Requested file does not exist on our server!');
		    }
		})
		->where('filename', '[A-Za-z0-9\-\_\.]+');
//////////////////////////////// Catalog Download //////////////////////

//////////////////////////////// Contact Controller //////////////////////
		Route::delete('contact/destory/all','Contact_controller@multi_delete');
		Route::resource('contact','Contact_controller');
//////////////////////////////// Contact Controller //////////////////////



	});
	//////////////////// Admin Middleware /////////////
});